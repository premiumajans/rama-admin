<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class AddRouteCommand extends Command
{
    protected $signature = 'app:add-route {name} {path} {controller}';
    protected $description = 'Add a new dynamic route to the api.php and admin.php files';
    public function handle()
    {
        $routeName = $this->argument('name');
        $routePath = $this->argument('path');
        $controllerName = $this->argument('controller');
        Route::get($routePath, 'App\Http\Controllers\Api\\'.$controllerName.'Controller@index')->name($routeName . '.index');
        Route::get($routePath . '/{id}', 'App\Http\Controllers\Api\\'.$controllerName.'Controller@show')->name($routeName . '.show');
        Route::get($routePath, 'App\Http\Controllers\Backend\\'.$controllerName.'Controller@index')->name('admin.' . $routeName . '.index');
        Route::get($routePath . '/{id}', 'App\Http\Controllers\Backend\\'.$controllerName.'Controller@show')->name('admin.' . $routeName . '.show');
        $this->info('Routes added successfully.');
    }
}
