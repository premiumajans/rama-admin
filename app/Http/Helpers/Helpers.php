<?php

use App\Models\SiteLanguage;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

if (!function_exists('upload')) {
    function upload($path, $file)
    {
        try {
            if (!File::isDirectory(public_path('images/' . $path))) {
                File::makeDirectory(public_path('images/' . $path), 0777, true, true);
            }
            $filename = uniqid() . '.webp';
            Image::make($file)->resize(null, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
            return 'images/' . $path . '/' . $filename;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (!function_exists('video_upload')) {
    function video_upload($file)
    {
        try {
            if ($file->isValid()) {
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $path = $file->move('videos', $filename);
                return $path;
            }
            return null;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

if (!function_exists('pdf_upload')) {
    function pdf_upload($file)
    {
        try {
            $img = $file;
            $extension = $img->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $img->move('pdf', $filename);
            $data['pdf'] = 'pdf/' . $filename;
            return $data['pdf'];
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}


if (!function_exists('multi_upload')) {
    function multi_upload($path, $files): array|\Illuminate\Http\RedirectResponse
    {
        try {
            $result = [];
            if (!File::isDirectory(public_path('images/' . $path))) {
                File::makeDirectory(public_path('images/' . $path), 0777, true, true);
            }
            foreach ($files as $file) {
                $filename = uniqid() . '.webp';
                Image::make($file)->resize(null, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode('webp', 75)->save(public_path('images/' . $path . '/' . $filename), 60);
                $result[] = "images/$path/$filename";
            }
            return $result;
        } catch (Exception $e) {
            return redirect()->back();
        }
    }
}

if (!function_exists('creation')) {
    function creation($name, $modelName = null, $translateModel = false, $photoModel = false)
    {
        Artisan::call('make:controller Backend/' . $name . 'Controller --resource');
        Artisan::call('create-status-route ' . Str::lower($name) . ' ' . $name);
        Artisan::call('create-delete-route ' . Str::lower($name) . ' ' . $name);
        Artisan::call('create-resource-route ' . Str::lower($name) . ' ' . $name);
        Artisan::call('make:controller Api/' . $name . 'Controller');
        Artisan::call('fill-controller:functions ' . $name);
        Artisan::call('fill-api-controller ' . $name);

        $permissionSeederCommand = "sed -i \"s/\\\$permissions = \\\[/\\\$permissions = \\\[\\n        '" . Str::lower($name) . "',/\" database/seeders/PermissionsSeeder.php";
        exec($permissionSeederCommand);
        if ($modelName != null) {
            Artisan::call('make:model ' . $modelName . ' -m');
            Artisan::call('main-model ' . $modelName);
        }
        if ($translateModel) {
            Artisan::call('make:model ' . $modelName . 'Translation -m');
            Artisan::call('translation-model ' . $modelName . 'Translation');
        }
        if ($photoModel) {
            Artisan::call('make:model ' . $modelName . 'Photos -m');
            Artisan::call('photo-model ' . $modelName . 'Photos');
        }
        add_permission(Str::lower($name));
        Artisan::call('app:create-blade ' . Str::lower($name));
        Artisan::call('translation:add ' . Str::lower($name));
    }
}

if (!function_exists('check_permission')) {
    function check_permission($permission_name)
    {
        return abort_if(Gate::denies($permission_name), Response::HTTP_FORBIDDEN, '403 Forbidden');
    }
}

if (!function_exists('admin_delete')) {
    function admin_delete($route, $id)
    {
        return '<a class="btn btn-danger" href="' . route($route, ['id' => $id]) . '"><i class="fas fa-trash"></i></a>';
    }
}

if (!function_exists('admin_edit')) {
    function admin_edit($route, $parameter1, $parameter2)
    {
        return '<a class="btn btn-primary" href="' . route($route, [$parameter1 => $parameter2]) . '"><i class="fas fa-edit"></i></a>';
    }
}

if (!function_exists('admin_status')) {
    function admin_status($route, $value)
    {
        $isChecked = ($value->status == 1) ? 'checked' : '';
        return '<a href="' . route($route, ['id' => $value->id]) . '" >
        <input ' . $isChecked . ' type="checkbox" id="switch" switch="primary" />
                <label for="switch4"></label></a>';
    }
}

if (!function_exists('add_permission')) {
    function add_permission($permission_name)
    {
        try {
            $permission_extensions = ['index', 'create', 'edit', 'delete'];
            foreach ($permission_extensions as $extension) {
                $permission = new \Spatie\Permission\Models\Permission();
                $permission->name = $permission_name . ' ' . $extension;
                $permission->guard_name = 'admin';
                $permission->save();
            }
        } catch (Exception $exception) {
            return redirect()->back();
        }
    }
}


if (!function_exists('active_langs')) {
    function active_langs()
    {
        return SiteLanguage::where('status', 1)->get();
    }
}

if (!function_exists('settings')) {
    function settings($name)
    {
        return Setting::where('name', $name)->value('link');
    }
}

if (!function_exists('validation_response')) {
    function validation_response($name)
    {
        return '<div class="valid-feedback">' . __($name) . ' ' . __('messages.is-correct') . '</div><div class="invalid-feedback">' . __($name) . ' ' . __('messages.not-correct') . '</div>';
    }
}

if (!function_exists('convert_number')) {
    function convert_number($value)
    {
        if ($value >= 1000 and $value < 1000000) {
            return round($value / 1000, 0) . 'k';
        }
        if ($value >= 1000000) {
            return round($value / 1000000, 0) . 'M';
        } else {
            return $value;
        }
    }
}
