<?php

namespace App\Console\Commands\Routes\Api;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateIndexRoute extends Command
{
    protected $signature = 'create-api-route {name} {controller}';
    protected $description = '';
    public function handle()
    {
        $name = $this->argument('name');
        $controller = $this->argument('controller');
        $controllerName = "{$controller}Controller";
        $routeName = $name;
        $routePath = base_path('routes/api.php');
        $controllerNamespace = Str::of("App\Http\Controllers\Api\\")->append($controllerName);
        $newRoute = "\nRoute::get('/{$routeName}',[$controllerNamespace::class,'index']);\n";
        $newShowRoute = "\nRoute::get('/{$routeName}/{id}',[$controllerNamespace::class,'show']);\n";
        $routeContents = file_get_contents($routePath);
        $pattern = "/Route::group\(\[\s*'name'\s*=>\s*'api'\s*\],\s*function\s*\(\)\s*{/";
        preg_match($pattern, $routeContents, $matches, PREG_OFFSET_CAPTURE);
        $offset = $matches[0][1] + strlen($matches[0][0]);
        $routeContents = substr_replace($routeContents, $newRoute, $offset, 0);
        $routeContents = substr_replace($routeContents, $newShowRoute, $offset, 0);
        file_put_contents($routePath, $routeContents);
        $this->info('Api routes added successfully!');
    }
}
