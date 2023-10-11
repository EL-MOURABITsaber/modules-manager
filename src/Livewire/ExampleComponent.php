<?php

namespace Sabers\ModulesManager\Livewire;

use App\Jobs\DownloadModuleJob;
use Livewire\Component;
use Sabers\ModulesManager\Facades\ModulesManagerFacade;

class ExampleComponent extends Component
{
    public $message;

    public function mount()
    {
        
    }

    public function installModule($name,$link){
        ModulesManagerFacade::downloadModule($name,$link);

    }
    public function deletModule($name){
        ModulesManagerFacade::deleteModule($name);
    }

    public function render()
    {
        // Render the Livewire component's view
        return view('modules-manager::livewire.example-component')->layout('components.layouts.guest');
    }
}
