<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    /**
     * Guarded properties
     * @var array
     */
    protected $guarded = ['id'];

    public static $modules = [
        'quote' => 1,
        'workorder' => 2,
        'recurring_invoice' => 4,
        'expense' => 8,
        'time_tracking' => 16,
        'scheduler' => 32,
        'purchaseorder' => 64,
    ];



    public static $coreevents = [
        'quote' => 1,
        'workorder' => 2,
        'invoice' => 4,
        'payment' => 8,
        'expense' => 16,
        'project' => 32,
        'task' => 64,
        'purchaseorder' => 128,
    ];

    public static function jquiThemes(){

        $themes = array_map('basename',\File::directories(public_path('css/jquery-ui-themes')));

        foreach ($themes as $key => $value){
            unset($themes[$key]);
            $themes[$value] = $value;
        }

        return $themes;
    }

    public static function isModuleEnabled($entityType)
    {
        if (! in_array($entityType, [
            'quote',
            'workorder',
            'recurring_invoice',
            'expense',
            'time_tracking',
            'scheduler',
            'purchaseorder',
        ])) {
            return true;
        }

        $enabledmodules = self::where('setting_key', 'enabledModules')->value('setting_value');

        // note: single & checks bitmask match
        return $enabledmodules & static::$modules[$entityType];
    }


    public function isCoreeventEnabled($entityType)
    {
        if (! in_array($entityType, [
            'quote',
            'workorder',
            'invoice',
            'payment',
            'expense',
            'project',
            'task',
            'purchaseorder',
        ])) {
            return true;
        }

        $enabledcoreevents = $this->where('setting_key', 'schedulerEnabledCoreEvents')->value('setting_value');

        // note: single & checks bitmask match
        return $enabledcoreevents & static::$coreevents[$entityType];
    }

    public function coreeventsEnabled()
    {

        $filter = [];

        $enabledcoreevents = $this->where('setting_key', 'schedulerEnabledCoreEvents')->value('setting_value');

        if ($enabledcoreevents == 0){
            $filter[] = 'none';
            return $filter;
        }

        foreach (static::$coreevents as $key => $value){
            if ($enabledcoreevents & $value){
                $filter[] = $key;
            }
        }

        return $filter;
    }

    public  function scopeLike($query, $field, $value){
        return $query->where($field, 'LIKE', "%$value%");
    }

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function deleteByKey($key)
    {
        self::where('setting_key', $key)->delete();
    }

    public static function getByKey($key)
    {
        $setting = self::where('setting_key', $key)->first();

        if ($setting)
        {
            return $setting->setting_value;
        }

        return null;
    }

    public static function saveByKey($key, $value)
    {
        $setting = self::firstOrNew(['setting_key' => $key]);

        $setting->setting_value = $value;

        $setting->save();

        config(['bt.' . $key => $value]);
    }

    public static function setAll()
    {
        try
        {
            $settings = self::all();

            foreach ($settings as $setting)
            {
                config(['bt.' . $setting->setting_key => $setting->setting_value]);
            }

            return true;
        }
        catch (QueryException $e)
        {
            return false;
        }
        catch (\PDOException $e)
        {
            return false;
        }
    }

    public static function writeEmailTemplates()
    {
        $emailTemplates = [
            'invoiceEmailBody',
            'quoteEmailBody',
            'overdueInvoiceEmailBody',
            'upcomingPaymentNoticeEmailBody',
            'quoteApprovedEmailBody',
            'quoteRejectedEmailBody',
            'workorderApprovedEmailBody',
            'workorderRejectedEmailBody',
            'paymentReceiptBody',
            'quoteEmailSubject',
            'invoiceEmailSubject',
            'overdueInvoiceEmailSubject',
            'upcomingPaymentNoticeEmailSubject',
            'paymentReceiptEmailSubject',
            'purchaseorderEmailSubject',
            'purchaseorderEmailBody',
        ];

        foreach ($emailTemplates as $template)
        {
            $templateContents = self::getByKey($template);
            $templateContents = str_replace('{{', '{!!', $templateContents);
            $templateContents = str_replace('}}', '!!}', $templateContents);

            Storage::put('email_templates/' . $template . '.blade.php', $templateContents);
        }
    }
}
