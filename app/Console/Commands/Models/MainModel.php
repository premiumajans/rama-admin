<?php

namespace App\Console\Commands\Models;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MainModel extends Command
{
    protected $signature = 'main-model {model}';
    protected $description = '';

    public function handle()
    {
        $controllerName = $this->argument('model');
        $controllerPath = app_path('Models/' . $controllerName . '.php');
        $stubPath = base_path('stubs/models/main.stub');
        $content = File::get($stubPath);
        $content = str_replace('$name', Str::lower($controllerName), $content);
        $content = str_replace('$controller', $controllerName, $content);

        if (File::exists($stubPath)) {
            $stubContent = File::get($stubPath);
            File::put($controllerPath, $content);

            $this->info('Model content replaced with the custom stub.');
        } else {
            $this->error('Custom stub file not found.');
        }
    }
}
