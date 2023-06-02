<?php

namespace App\Console\Commands\lang;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AddTranslationKey extends Command
{
    protected $signature = 'translation:add {key}';
    public function handle()
    {
        $key = $this->argument('key');
        $langPath = resource_path('lang');
        foreach (File::directories($langPath) as $langDir) {
            if (strpos($langDir, 'vendor') !== false) {
                continue;
            }
            $langCode = basename($langDir);
            $langFile = $langDir . '/backend.php';
            $langData = require $langFile;
            if (! isset($langData[$key])) {
                $langData[$key] = '';
                File::put($langFile, '<?php return ' . var_export($langData, true) . ';');
                $this->info("Added translation key [$key] to language file [$langCode].");
            } else {
                $this->warn("Translation key [$key] already exists in language file [$langCode].");
            }
        }
        $this->info('All language files updated.');
    }
}
