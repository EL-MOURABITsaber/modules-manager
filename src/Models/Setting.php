<?php

namespace Sabers\ModulesManager\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'settings';

    protected static function booted()
    {
        static::saving(function() {
            Cache::forget('settings');
        });
    }

    public static function createSetting($key, $value, $isEncrypted = false, $description = null)
    {
        $setting = new Setting();
        $setting->key = $key;
        $setting->value = serialize($value);
        if($isEncrypted){
            $setting->value = Crypt::encrypt($setting->value);
        }
        $setting->is_encrypted = $isEncrypted;
        $setting->description = $description;
        $setting->save();

        return $setting;
    }

    public static function updateSetting($id, $value, $isEncrypted = false, $description = null)
    {
        $setting = self::find($id);
        if ($setting) {

            try {
                $setting->value = serialize($value);
                $setting->encrypt = $isEncrypted;
                if($description){
                    $setting->description = $description;
                }
                $setting->save();
            } catch (\Throwable $th) {
                return null ;
            }

            return $setting;
        }
        return null; // Setting not found
    }
}
