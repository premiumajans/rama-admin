<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;

class PortfolioPhotos extends Model
{
    public function portfolio()
    {
        $this->belongsTo(Portfolio::class);
    }
    protected $guarded = [];
    public $timestamps = [];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }
}
