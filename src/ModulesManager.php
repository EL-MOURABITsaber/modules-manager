<?php

namespace Sabers\ModulesManager;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;

class ModulesManager
{

    const MODULES_FOLDER_PATH = __DIR__ . '/../../../../Modules';

    
    /**
     * downloadModule
     * clones modules from github and outs them modules folder
     *
     * @param string $name
     * @param string $link
     * 
     * @return void
     */

     public function downloadModule($name,$link)
    {
        $targetDirectory = base_path('/Modules');

        File::ensureDirectoryExists($targetDirectory);
        
        

        chdir($targetDirectory);
        $command=  exec("git clone {$link} {$name}");
        chdir(base_path());
        $this->disableModule($name);

    }

    public function deleteModule($name){
        $this->delTree(realpath(static::MODULES_FOLDER_PATH) . DIRECTORY_SEPARATOR . $name);
    }

    public function enableModule($name){
        Module::enable($name);
        chdir(base_path());
        exec("php artisan posts:install-settings");
    }

    public function disableModule($name){
        Module::disable($name);
    }

    public  function delTree($dir) {

        if(!File::exists($dir)) {
            return;
        }

        $files = array_diff(scandir($dir), array('.','..'));
     
         foreach ($files as $file) {
     
            if (is_dir("$dir/$file")) {

                $this->delTree("$dir/$file");
                
            } else {
                // Set full permissions to the file before deleting
                chmod("$dir/$file", 0777);
                
                // Attempt to unlink the file, catch any exceptions if unlink fails
                try {
                    unlink("$dir/$file");
                } catch (\Throwable $th) {
                    // Handle the exception if necessary
                }
            }
     
         }
     
         return rmdir($dir);
     
       }


}
