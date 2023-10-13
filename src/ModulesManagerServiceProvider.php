<?php

namespace Sabers\ModulesManager;

use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Nwidart\Modules\Facades\Module;
use Sabers\ModulesManager\Livewire\ExampleComponent;
use Sabers\ModulesManager\Models\Setting;

class ModulesManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('modules-manager', function () {
            return new ModulesManager();
        });

        $this->app->alias(Module::class, 'Module');
    }

    public function boot(){
        
        $this->configureCommands();

        // load Settings 
        $this->loadSettings();

        // load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        //load views 
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'modules-manager');

        //load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        

        // register liveiwre component 
        Livewire::component('example-component', ExampleComponent::class);


         // Publish the configuration file
         $this->publishes([
            __DIR__.'/../config/config.php' => config_path('modules-manager.php'),
        ], 'modules-manager');
    }


    protected function loadSettings(){

        if(! $this->connectionToDatabaseExists()){
            return false ;
        }

        if(! $this->SettingsTableExists()){
            return false ;
        }


        $settings = Cache::rememberForever('settings', function () {
            $settingsData = Setting::all();
           
            $settings = [];
        
            foreach ($settingsData as $setting) {

                if($setting->is_encrypted){
                    $setting->value=Crypt::decrypt($setting->value);
                }


                    $setting->value = unserialize($setting->value);


                $settings[$setting->key] = $setting->value;
                
            }
        
            return $settings;
        });


        config(['settings' => $settings]);

        
    }



    private function connectionToDatabaseExists(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function SettingsTableExists(): bool
    {
        return Schema::hasTable('settings');
    }

    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }
}
