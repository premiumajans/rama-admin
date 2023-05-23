<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class BlogPhotos extends Model
{
    public function blog()
    {
        $this->belongsTo(Blog::class);
    }
    protected $guarded = [];
    public $timestamps = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
