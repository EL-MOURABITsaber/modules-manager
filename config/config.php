<?php


return [


    'available_modules' => [

        'users_managment' => [
            'name' => 'Posts', // shouldn't have spaces
            'description' => 'Description of Module One.',
            'category'=>'user auth',
            'link'=>'https://github.com/EL-MOURABITsaber/first-module',
            'downloaded'=>true,
            'enabled' => true,
           

        ],
        
        'module_two' => [
            'name' => 'Module Two',
            'description' => 'Description of Module Two.',
            'link'=>'https://github.com/barryvdh/laravel-ide-helper',
            'category'=>'user auth',
            'downloaded'=>false,
            'enabled' => false,
        ],
        

    ],  
];
