<?php

namespace App\Console\Commands\Routes\Backend;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateDeleteRoute extends Command
{
    protected $signature = 'create-delete-route {name} {controller}';
    protected $description = 'Command description';
    public function handle()
    {
        $name = $this->argument('name');
        $controller = $this->argument('controller');
        $controllerName = "{$controller}Controller";
//        $routeName = Str::plural(Str::snake($name));
        $routeName = $name;
        $routePath = base_path('routes/admin.php');
        $controllerNamespace = Str::of("App\Http\Controllers\Backend\\")->append($controllerName);
        $newRoute = "\nRoute::get('{$routeName}/{id}/delete',[$controllerNamespace::class,'delete'])->name('{$name}Delete');\n";
        $routeContents = file_get_contents($routePath);
        $pattern = "/Route::group\(\[\s*'name'\s*=>\s*'delete'\s*\],\s*function\s*\(\)\s*{/";
        preg_match($pattern, $routeContents, $matches, PREG_OFFSET_CAPTURE);
        $offset = $matches[0][1] + strlen($matches[0][0]);
        $routeContents = substr_replace($routeContents, $newRoute, $offset, 0);
        file_put_contents($routePath, $routeContents);
        $this->info('Resource route added successfully!');
    }
}
