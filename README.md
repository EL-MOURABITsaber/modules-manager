# Modules Manager

Modules Manager is a Laravel package that simplifies the management of modules in your Laravel applications.


## Installation

Require this package with composer. It is recommended to only require the package for development.

```shell
composer require sabers/modules-manager
```

Next, publish the package's configuration file and assets using the following Artisan command:

```shell
php artisan vendor:publish --tag="modules-manager"
```

After publishing the configuration, make sure to run the install command , this will setup layouts , install frnt and back end packages revolving around the tallStack

```shell
php artisan tallStack:install
```

After the instalation, make sure to install the required frontend dependencies and compile the assets:

```shell
npm install
npm run dev
```

Now, add the following line to the PSR-4 autoload section in your composer.json file:

```shell
"autoload": {
    "psr-4": {
        "Modules\\": "Modules/" // this should be added
    }
},
```

After adding the line, run the following command to autoload the new classmap:

```shell
composer dump-autoload
```
