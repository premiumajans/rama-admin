<?php

namespace Database\Seeders;

use App\Models\SiteLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $az = SiteLanguage::create(['name'=>'Azərbaycan','code' => 'az','icon' => 'images/flags/az.png','status' => 1]);
        $en = SiteLanguage::create(['name'=>'English','code' => 'en','icon' => 'images/flags/en.jpg','status' => 1]);
        $ru = SiteLanguage::create(['name'=>'Русский','code' => 'ru','icon' => 'images/flags/ru.jpg','status' => 1]);
        }
}
