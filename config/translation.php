<?php

return [
    'driver' => 'file',
    'route_group_config' => [
        'middleware' => ['web', 'auth:sanctum'],
    ],
    'translation_methods' => ['trans', '__'],
    'scan_paths' => [app_path(), resource_path()],
    'ui_url' => 'admin/manage-languages',
    'database' => [
        'connection' => '',
        'languages_table' => 'languages',
        'translations_table' => 'translations',
    ],
];
