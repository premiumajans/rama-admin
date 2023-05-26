<?php
/**
 * Created by PhpStorm.
 * User: Fabian
 * Date: 12.05.16
 * Time: 07:24
 */

return [
    'pathToEnv' => base_path('.env'),
    'backupPath' => resource_path('backups/dotenv-editor/'),
    'filePermissions' => env('FILE_PERMISSIONS', 0755),
    // Activate or deactivate the graphical interface
    'activated' => true,
    /* Default view */
    'template' => 'dotenv-editor::master',
    'overview' => 'dotenv-editor::overview',
//    'template'        => 'adminlte::page',
//    'overview'        => 'dotenv-editor::overview-adminlte',
    // Config route group
    'route' => [
        'namespace' => 'Brotzka\DotenvEditor\Http\Controllers',
        'prefix' => 'admin/env',
        'as' => 'admin.env.',
        'middleware' => ['web', 'auth:admin'],
    ],
];
