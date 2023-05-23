<?php

namespace App\Console\Commands\view;

use Illuminate\Console\Command;

class CreateBlade extends Command
{
    protected $signature = 'app:create-blade {name}';

    protected $description = 'Command description';

    public function handle()
    {
        $name = $this->argument('name');
        $indexPath = resource_path("views/backend/{$name}/index.blade.php");
        $editPath = resource_path("views/backend/{$name}/edit.blade.php");
        $createPath = resource_path("views/backend/{$name}/create.blade.php");

        $copyFromIndex = resource_path('views/backend/templates/multi-language/index.blade.php');
        $copyFromContentsIndex = file_get_contents($copyFromIndex);
        $copyFromContentsIndex = str_replace('selection', $name, $copyFromContentsIndex);

        $copyFromEdit = resource_path('views/backend/templates/multi-language/edit.blade.php');
        $copyFromContentsEdit = file_get_contents($copyFromEdit);
        $copyFromContentsEdit = str_replace('selection', $name, $copyFromContentsEdit);

        $copyFromCreate = resource_path('views/backend/templates/multi-language/create.blade.php');
        $copyFromContentsCreate = file_get_contents($copyFromCreate);
        $copyFromContentsCreate = str_replace('selection', $name, $copyFromContentsCreate);

        if (! is_dir(resource_path("views/backend/{$name}"))) {
            mkdir(resource_path("views/backend/{$name}"), 0755, true);
        }
        if (! file_exists($indexPath)) {
            file_put_contents($indexPath, $copyFromContentsIndex);
        }
        if (! file_exists($editPath)) {
            file_put_contents($editPath, $copyFromContentsEdit);
        }
        if (! file_exists($createPath)) {
            file_put_contents($createPath, $copyFromContentsCreate);
        }
    }
}
