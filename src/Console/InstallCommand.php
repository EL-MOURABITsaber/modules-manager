<?php

namespace Sabers\ModulesManager\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

class InstallCommand extends Command 
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tallStack:install {--composer=global : Absolute path to the Composer binary which should be used to install packages}';

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
        '@ryangjchandler/alpine-tooltip'=> '^1.3.0'
    ];


    public function handle(){

         // Storage...
         $this->callSilent('storage:link');

         // Install Livewire...
        if (! $this->requireComposerPackages('livewire/livewire:^3.0')) {
            return false;
        }

        // Install laravel-modules...
        if (! $this->requireComposerPackages('nwidart/laravel-modules:^10.0')) {
            return false;
        }

        // Install laravel-modules-livewire...
        if (! $this->requireComposerPackages('mhmiton/laravel-modules-livewire:^2.1')) {
            return false;
        }

        // NPM Packages...
        $this->updateNodePackages(function ($packages) {
            return static::NPM_PACKAGES_TO_ADD + $packages;
        });

       

        // Installing the ressources
        $filesystem = new Filesystem();
        $filesystem->deleteDirectory(resource_path());
        $filesystem->copyDirectory(__DIR__ . '/../../stubs', base_path());




    }

    /**
     * Update the "package.json" file.
     *
     * @param  callable  $callback
     * @param  bool  $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = false)
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = 'dependencies';

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

    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = [$this->phpBinary(), $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        return ! (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }


}