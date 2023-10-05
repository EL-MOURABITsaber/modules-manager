<?php

namespace Sabers\ModulesManager;

use Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http as FacadesHttp;
use Illuminate\Support\Facades\Process;
use Str;

class ModulesManager
{


    // const NPM_PACKAGES_TO_ADD = [
    //     '@tailwindcss/forms' => '^0.5',
    //     '@tailwindcss/typography' => '^0.5',
    //     'alpinejs' => '^3.8',
    //     'autoprefixer' => '^10.4',
    //     'resolve-url-loader' => '^3.1',
    //     'sass' => '^1.3',
    //     'sass-loader' => '^8.0',
    //     'tailwindcss' => '^3.0',
    // ];

    // const NPM_PACKAGES_TO_REMOVE = [
    //     'lodash',
    //     'axios',
    // ];

    // public static function install()
    // {
    //     static::updatePackages();

    //     $filesystem = new Filesystem();
    //     $filesystem->deleteDirectory(resource_path('sass'));
    //     $filesystem->copyDirectory(__DIR__ . '/../stubs/default', base_path());

    //     static::updateFile(base_path('app/Providers/RouteServiceProvider.php'), function ($file) {
    //         return str_replace("public const HOME = '/home';", "public const HOME = '/';", $file);
    //     });

    //     static::updateFile(base_path('app/Http/Middleware/RedirectIfAuthenticated.php'), function ($file) {
    //         return str_replace("RouteServiceProvider::HOME", "route('home')", $file);
    //     });
    // }

    // public static function installAuth()
    // {
    //     $filesystem = new Filesystem();

    //     $filesystem->copyDirectory(__DIR__ . '/../stubs/auth', base_path());
    // }

    // protected static function updatePackageArray(array $packages)
    // {
    //     return array_merge(
    //         static::NPM_PACKAGES_TO_ADD,
    //         Arr::except($packages, static::NPM_PACKAGES_TO_REMOVE)
    //     );
    // }

    // /**
    //  * Update the contents of a file with the logic of a given callback.
    //  */
    // protected static function updateFile(string $path, callable $callback)
    // {
    //     $originalFileContents = file_get_contents($path);
    //     $newFileContents = $callback($originalFileContents);
    //     file_put_contents($path, $newFileContents);
    // }




    //  /**
    //  * Download and install a module from a private GitHub repository.
    //  *
    //  * @param string $repositoryUrl
    //  * @param string $packageName
    //  * @param string $accessToken
    //  * @return bool
    //  */
    // public function downloadModule()
    // {
    //     $repositoryUrl = 'https://github.com/barryvdh/laravel-debugbar.git';
    //     $targetDirectory = base_path('vendor/sabers/modules-manager/modules');
        
        
    //     $originalDirectory = getcwd();
    //     // Change the current working directory
    //     chdir($targetDirectory);
        
        
    //     $result = exec("git clone {$repositoryUrl} ");
        
    //     chdir($originalDirectory); // Revert back to the original directory

    // }

    // public function constructDownloadLink($repoLink,$branch){
    //     return $repoLink . "/archive/refs/heads/{$branch}.zip";
    // }


    // /**
    //  * Install a module from a downloaded ZIP file.
    //  *
    //  * @param string $zipFilePath
    //  * @param string $installationPath
    //  * @return bool
    //  */
    // public function installModule($zipFilePath, $installationPath)
    // {
        

    //     return false;
    // }

   




    // /**
    //  * Enable a specific module.
    //  *
    //  * @param string $moduleName
    //  * @return bool
    //  */
    // public function enableModule($moduleName)
    // {
    //     // Logic to enable the specified module
    //     // For example, update the database or modify configuration
    //     // ...

    //     if (!$this->isModuleEnabled($moduleName)) {
    //         $this->enabledModules[] = $moduleName;
    //         return true;
    //     }

    //     return false; // Module is already enabled
    // }

    // /**
    //  * Disable a specific module.
    //  *
    //  * @param string $moduleName
    //  * @return bool
    //  */
    // public function disableModule($moduleName)
    // {
    //     // Logic to disable the specified module
    //     // For example, update the database or modify configuration
    //     // ...

    //     $key = array_search($moduleName, $this->enabledModules);
    //     if ($key !== false) {
    //         unset($this->enabledModules[$key]);
    //         return true;
    //     }

    //     return false; // Module was not enabled
    // }

    // /**
    //  * Check if a module is enabled.
    //  *
    //  * @param string $moduleName
    //  * @return bool
    //  */
    // public function isModuleEnabled($moduleName)
    // {
    //     return in_array($moduleName, $this->enabledModules);
    // }

    // /**
    //  * Get a list of all enabled modules.
    //  *
    //  * @return array
    //  */
    // public function getEnabledModules()
    // {
    //     return $this->enabledModules;
    // }

    // /**
    //  * Get a list of all enabled modules.
    //  *
    //  * @return array
    //  */
    // public function getAvailableModules()
    // {
    //     return $this->enabledModules;
    // }





}
