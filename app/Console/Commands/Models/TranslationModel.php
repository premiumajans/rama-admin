<?php

namespace App\Console\Commands\Models;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Str;

class TranslationModel extends Command
{
    protected $signature = 'translation-model {model}';

    protected $description = '';

    public function handle()
    {
        $controllerName = $this->argument('model');
        $controllerPath = app_path('Models/' . $controllerName . 'Translation.php');
        $stubPath = base_path('stubs/models/translation.stub');
        $content = File::get($stubPath);
        $content = str_replace('$name', Str::lower($controllerName), $content);
        $content = str_replace('$controller', $controllerName, $content);
        if (File::exists($stubPath)) {
            $stubContent = File::get($stubPath);
            File::put($controllerPath, $content);

            $this->info('Translation model content replaced with the custom stub.');
        } else {
            $this->error('Custom stub file not found.');
        }
    }
}
