<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Str;

class FindMigrationNameCommand extends Command
{
    protected $signature = 'find:migration-name {model}';

    protected $description = 'Find the name of the migration file associated with a table.';

    public function handle()
    {
        $model = $this->argument('model');

        $migrationName = $this->getMigrationName($model);

        if ($migrationName) {
            $this->info("Migration Name: $migrationName");
        } else {
            $this->error('Migration not found for the specified model.');
        }
    }

    private function getMigrationName($model)
    {
        $modelName = Str::studly($model);
        $tableName = Str::snake($modelName);
        $migrations = Artisan::call('migrate:status', ['--path' => 'database/migrations']);
        $output = Artisan::output();

        preg_match("/^\|.*$tableName.*$/m", $output, $matches);

        if (!empty($matches)) {
            preg_match("/^\|[^\s]+\s+([^\s]+)/", $matches[0], $nameMatches);

            if (!empty($nameMatches)) {
                return trim($nameMatches[1]);
            }
        }

        return null;
    }
}
