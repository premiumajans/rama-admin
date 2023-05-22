<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class CatalogPhotos extends Model
{
    public function catalog()
    {
        $this->belongsTo(Catalog::class);
    }
    protected $guarded = [];
    public $timestamps = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
