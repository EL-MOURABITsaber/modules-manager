<?php

namespace Sabers\ModulesManager;

use Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http as FacadesHttp;
use Illuminate\Support\Facades\Process;
use Str;

class ModulesManager
{


    protected $enabledModules = [];




     /**
     * Download and install a module from a private GitHub repository.
     *
     * @param string $repositoryUrl
     * @param string $packageName
     * @param string $accessToken
     * @return bool
     */
    public function downloadModule()
    {
        // $modulesPath = base_path("packages/{$packageName}/modules");

        // if (!File::exists($modulesPath)) {
        //     File::makeDirectory($modulesPath, 0755, true, true);
        // }

        // $repositoryUrlWithToken = str_replace('https://', "https://{$accessToken}@", $repositoryUrl);
        // $command = "git clone {$repositoryUrlWithToken} {$modulesPath}";
        // exec($command, $output, $exitCode);

        // if ($exitCode === 0) {
        //     return true; // Cloning successful
        // } else {
        //     return false; // Cloning failed
        // }

        // $repositoryUrl = 'https://github.com/barryvdh/laravel-debugbar.git';
        // $modulesPath = base_path('vendor/sabers/modules-manager/modules');

        // if (!File::exists($modulesPath)) {
        //     File::makeDirectory($modulesPath, 0755, true, true);
        // }
        // $reults=Process::run('git clone https://github.com/barryvdh/laravel-debugbar.git ');
        // dd($reults);

        // $repositoryUrl = 'https://github.com/barryvdh/laravel-debugbar.git';
        // $modulesPath = base_path('vendor/sabers/modules-manager/modules');

        // if (!File::exists($modulesPath)) {
        //     File::makeDirectory($modulesPath, 0755, true, true);
        // }

        // $command = "git clone {$repositoryUrl} {$modulesPath} > /dev/null 2>&1 &";
        // shell_exec($command);

        // // Check if the repository was cloned successfully
        // if (File::exists($modulesPath . DIRECTORY_SEPARATOR . '.git')) {
        //     dd(true);
        // }
        // dd(false);

        // $repositoryOwner = 'barryvdh';
        // $repositoryName = 'laravel-debugbar';
        // $modulesPath = base_path('vendor/sabers/modules-manager/modules/debugbar');

        // if (!File::exists($modulesPath)) {
        //     File::makeDirectory($modulesPath, 0755, true, true);
        // }

        // // GitHub API endpoint for getting the repository archive link
        // $apiEndpoint = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/zipball/master";

        // // Asynchronously download and save the repository archive
        // FacadesHttp::asynchronous()->withHeaders(['Authorization' => 'token YOUR_GITHUB_ACCESS_TOKEN'])
        //     ->get($apiEndpoint)
        //     ->toStream($modulesPath . '/repository.zip');

        // // Assume the download is initiated successfully, since it's running asynchronously
        // return true;

        $repositoryUrl = "https://github.com/EL-MOURABITsaber/Croa-tetouan/archive/refs/heads/main.zip";
        $modulesPath = base_path("vendor/sabers/modules-manager/modules");

        if (!File::exists($modulesPath)) {
            File::makeDirectory($modulesPath, 0755, true, true);
        }

        $response = Http::get($repositoryUrl);

        if ($response->successful()) {
            $zipPath = $modulesPath . '/' . Str::random(40) . '.zip';
            file_put_contents($zipPath, $response->body());

            // Extract the ZIP file to the destination folder
            $zip = new \ZipArchive();
            $zip->open($zipPath);
            $zip->extractTo($modulesPath);
            $zip->close();

            // Clean up: delete the ZIP file after extraction
            unlink($zipPath);}

    }

    public function constructDownloadLink($repoLink,$branch){
        return $repoLink . "/archive/refs/heads/{$branch}.zip";
    }


    /**
     * Install a module from a downloaded ZIP file.
     *
     * @param string $zipFilePath
     * @param string $installationPath
     * @return bool
     */
    public function installModule($zipFilePath, $installationPath)
    {
        

        return false;
    }

   




    /**
     * Enable a specific module.
     *
     * @param string $moduleName
     * @return bool
     */
    public function enableModule($moduleName)
    {
        // Logic to enable the specified module
        // For example, update the database or modify configuration
        // ...

        if (!$this->isModuleEnabled($moduleName)) {
            $this->enabledModules[] = $moduleName;
            return true;
        }

        return false; // Module is already enabled
    }

    /**
     * Disable a specific module.
     *
     * @param string $moduleName
     * @return bool
     */
    public function disableModule($moduleName)
    {
        // Logic to disable the specified module
        // For example, update the database or modify configuration
        // ...

        $key = array_search($moduleName, $this->enabledModules);
        if ($key !== false) {
            unset($this->enabledModules[$key]);
            return true;
        }

        return false; // Module was not enabled
    }

    /**
     * Check if a module is enabled.
     *
     * @param string $moduleName
     * @return bool
     */
    public function isModuleEnabled($moduleName)
    {
        return in_array($moduleName, $this->enabledModules);
    }

    /**
     * Get a list of all enabled modules.
     *
     * @return array
     */
    public function getEnabledModules()
    {
        return $this->enabledModules;
    }

    /**
     * Get a list of all enabled modules.
     *
     * @return array
     */
    public function getAvailableModules()
    {
        return $this->enabledModules;
    }





}
