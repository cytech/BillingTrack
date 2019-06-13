<?php

namespace BT\Http\Middleware;

use Closure;
use BT\Modules\Currencies\Models\Currency;
use BT\Modules\Settings\Models\Setting;
use BT\Support\DateFormatter;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class BeforeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (config('app.debug'))
        {
            DB::enableQueryLog();
        }

        // Set the application specific settings under bt. prefix (bt.settingName)
        if (Setting::setAll())
        {
            if (config('bt.forceHttps') and !$request->secure())
            {
                return redirect()->secure($request->getRequestUri());
            }

            // This one needs a little special attention
            $dateFormats = DateFormatter::formats();
            config(['bt.datepickerFormat' => $dateFormats[config('bt.dateFormat')]['datepicker']]);

            // Set the environment timezone to the application specific timezone, if available, otherwise UTC
            date_default_timezone_set((config('bt.timezone') ?: config('app.timezone')));

            $mailPassword = '';

            try
            {
                $mailPassword = (config('bt.mailPassword')) ? Crypt::decrypt(config('bt.mailPassword')) : '';
            }
            catch (\Exception $e)
            {
                if (config('bt.mailDriver') == 'smtp')
                {
                    session()->flash('error', '<strong>' . trans('bt.error') . '</strong> - ' . trans('bt.mail_hash_error'));
                }
            }

            // Override the framework mail configuration with the values provided by the application
            config(['mail.driver' => (config('bt.mailDriver')) ? config('bt.mailDriver') : 'smtp']);
            config(['mail.host' => config('bt.mailHost')]);
            config(['mail.port' => config('bt.mailPort')]);
            config(['mail.encryption' => config('bt.mailEncryption')]);
            config(['mail.username' => config('bt.mailUsername')]);
            config(['mail.password' => $mailPassword]);
            config(['mail.sendmail' => config('bt.mailSendmail')]);

            if (config('bt.mailAllowSelfSignedCertificate'))
            {
                config([
                    'mail.stream.ssl' => [
                        'allow_self_signed' => true,
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                    ],
                ]);
            }

            // Force the mailer to use these settings
            (new \Illuminate\Mail\MailServiceProvider(app()))->register();

            // Set the base currency to a config value
            config(['bt.currency' => Currency::where('code', config('bt.baseCurrency'))->first()]);
        }

        config(['bt.clientCenterRequest' => (($request->segment(1) == 'client_center') ? true : false)]);

        if (!config('bt.clientCenterRequest'))
        {
            app()->setLocale((config('bt.language')) ?: 'en');
        }
        elseif (config('bt.clientCenterRequest') and auth()->check() and auth()->user()->client_id)
        {
            app()->setLocale(auth()->user()->client->language);
        }

        config(['bt.mailConfigured' => (config('bt.mailDriver') ? true : false)]);

        config(['bt.merchant' => json_decode(config('bt.merchant'), true)]);

        return $next($request);
    }
}
