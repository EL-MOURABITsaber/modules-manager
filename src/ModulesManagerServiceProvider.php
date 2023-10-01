<?php

namespace Sabers\ModulesManager;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sabers\ModulesManager\Livewire\ExampleComponent;

class ModulesManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    public function boot(){

        // load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        
        //load views 
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'modules-manager');
        

        // register liveiwre component 
        Livewire::component('example-component', ExampleComponent::class);


         // Publish the configuration file
         $this->publishes([
            __DIR__.'/../config/config.php' => config_path('modules-manager.php'),
        ], 'modules-manager');
    }
}
