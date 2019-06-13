<?php

namespace BT\Modules\Merchant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantClient extends Model
{
    use SoftDeletes;

    protected $table = 'merchant_clients';

    protected $guarded = ['id'];

    public static function getByKey($driver, $clientId, $key)
    {
        $setting = self::where('driver', $driver)
            ->where('client_id', $clientId)
            ->where('merchant_key', $key)
            ->first();

        if ($setting)
        {
            return $setting->merchant_value;
        }

        return null;
    }

    public static function saveByKey($driver, $clientId, $key, $value)
    {
        $setting = self::firstOrNew([
            'driver'       => $driver,
            'client_id'    => $clientId,
            'merchant_key' => $key,

        ]);

        $setting->merchant_value = $value;

        $setting->save();
    }
}
