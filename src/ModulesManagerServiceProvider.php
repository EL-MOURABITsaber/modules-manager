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
        $this->mergeConfigFrom(__DIR__.'/../config/modules-manager.php', 'modules-manager');
        $this->app->singleton('modules-manager', function () {
            return new ModulesManager();
        });
    }

    public function boot(){

        $this->configureCommands();

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
