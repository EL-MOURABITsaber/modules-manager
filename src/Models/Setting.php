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

    public static function getSettingsByModule($moduleName){
        return self::where('key','like', strtolower($moduleName) . '::'.'%')->pluck('value','key')->map(function ($value) {
            return unserialize($value);
        })->toArray();
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

    public static function updateSetting($key, $value, $isEncrypted = false, $description = null)
    {
        $setting = self::findByKey($key);
        if ($setting) {

            try {
                if($setting->is_encrypted){
                    $setting->value = Crypt::encrypt(serialize($value));
                }else{
                    $setting->value = serialize($value);
                }
                $setting->save();
            } catch (\Throwable $th) {
                return null ;
            }

            return $setting;
        }
        return null; // Setting not found
    }

    public static function updateSettingsByArray($settings)
        {
            foreach ($settings as $key => $value) {
                self::updateSetting($key,$value);
            }

            return true; // Settings updated successfully
        }


    public function scopeFindByKey($query, $value)
    {
        return $query->where('key', $value)->first();
    }
}
