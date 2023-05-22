<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutTranslation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    public function run()
    {
        $about = new About();
        $about->save();
        foreach (active_langs() as $lang) {
            $trans = new AboutTranslation();
            $trans->about_id = $about->id;
            $trans->description = 'firstPhoto';
            $trans->locale = $lang->code;
            $trans->save();
        }
    }
}
