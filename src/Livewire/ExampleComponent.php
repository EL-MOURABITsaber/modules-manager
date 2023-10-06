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
        // Initialize the message when the component is mounted
        $this->message = 1;
    }

    public function updateMessage()
    {


        ModulesManagerFacade::downloadModule();

        $this->message += 1;
    }

    public function render()
    {
        // Render the Livewire component's view
        return view('modules-manager::livewire.example-component')->layout('components.layouts.guest');
    }
}
