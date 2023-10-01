<?php

namespace Sabers\ModulesManager\Livewire;

use Livewire\Component;

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
        // Update the message when a Livewire action is triggered
        $this->message ++;
    }

    public function render()
    {
        // Render the Livewire component's view
        return view('modules-manager::livewire.example-component');
    }
}
