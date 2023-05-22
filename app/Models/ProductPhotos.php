<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class ProductPhotos extends Model
{
    public function product()
    {
        $this->belongsTo(Product::class);
    }
    protected $guarded = [];
    public $timestamps = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
