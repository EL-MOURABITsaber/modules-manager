<?php

namespace Sabers\ModulesManager\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tallStack:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs the tall stack';

    const NPM_PACKAGES_TO_ADD = [
        'tailwindcss' => '^3.1.0',
        '@tailwindcss/forms' => '^0.5.2',
        '@tailwindcss/typography' => '^0.5.0',
        'autoprefixer' => '^10.4.7',
        'postcss' => '^8.4.14',
        "@ryangjchandler/alpine-tooltip"=> "^1.3.0"
    ];


    public function handle(){

         // Storage...
         $this->callSilent('storage:link');

         // Install Livewire...
        if (! $this->requireComposerPackages('livewire/livewire:^3.0')) {
            return false;
        }

        // Install laravel-modules...
        if (! $this->requireComposerPackages('nwidart/laravel-modules": "^10.0')) {
            return false;
        }

        // Install laravel-modules-livewire...
        if (! $this->requireComposerPackages('mhmiton/laravel-modules-livewire": "^2.1')) {
            return false;
        }

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return static::NPM_PACKAGES_TO_ADD + $packages;
        });

       // Tailwind Configuration...
       copy(__DIR__.'/../../stubs/tailwind.config.js', base_path('tailwind.config.js'));
       copy(__DIR__.'/../../stubs/postcss.config.js', base_path('postcss.config.js'));
       copy(__DIR__.'/../../stubs/vite.config.js', base_path('vite.config.js'));

        // Installing the ressources
        $filesystem = new Filesystem();
        $filesystem->deleteDirectory(resource_path());
        $filesystem->copyDirectory(__DIR__ . '/../stubs/ressources', base_path());




    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT).PHP_EOL
        );
    }


}