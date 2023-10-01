<?php


use Sabers\ModulesManager\Livewire\ExampleComponent;
use Illuminate\Support\Facades\Route;




Route::middleware(['web'])->group(function () {
    Route::get('/example', ExampleComponent::class);
});