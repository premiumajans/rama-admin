<?php

namespace Database\Seeders;

use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            ['name' => 'phone', 'link' => '+994512951211'],
            ['name' => 'facebook', 'link' => 'https://facebook.com/gead.az'],
            ['name' => 'instagram', 'link' => 'https://instagram.com/gead_ib'],
            ['name' => 'twitter', 'link' => 'https://twitter.com/GEAD_ib'],
            ['name' => 'youtube', 'link' => 'https://www.youtube.com/channel/UCxn8MoGUHPlGni6IbugpdNQ'],
            ['name' => 'email', 'link' => 'gead.mail@gmail.com'],
            ['name' => 'address_az', 'link' => 'Bakı ş. Yasamal r. Mirəli Seyidov 31/38'],
            ['name' => 'address_en', 'link' => 'Baku Yasamal r. Mirali Seyidov 31/38'],
            ['name' => 'address_ru', 'link' => 'Баку Ясамал р. Мирали Сеидов 31/38'],
        ];
        foreach ($settings as $key => $setting) {
            $set = new Setting();
            $set->name = $setting['name'];
            $set->link = $setting['link'];
            $set->status = 1;
            $set->save();
        }
    }
}
