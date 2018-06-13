<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Setting::create(["name"=>"tittle","value"=>"Yazilim Dünyası"]);
         Setting::create(["name"=>"author","value"=>"Mehemmed Memmedli"]);
         Setting::create(["name"=>"descripton","value"=>"Az kod çok iş"]);
         Setting::create(["name"=>"keywords","value"=>"yazilim,php,laravel"]);
         Setting::create(["name"=>"facebook","value"=>"nemerki"]);
         Setting::create(["name"=>"twitter","value"=>"nemerki"]);
         Setting::create(["name"=>"github","value"=>"nemerki"]);
    }
}
