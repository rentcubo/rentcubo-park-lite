<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
        DB::table('settings')->insert([
            [
            	'key' => 'site_name',
            	'value' => 'RentPark-Lite'
            ],

            [
            	'key' => 'favicon',
            	'value' => '/favicon.png'
            ],

            [
            	'key' => 'site_logo',
            	'value' => '/logo.png'
            ],
            [
            	'key' => 'currency',
            	'value' => '$'
            ],
            [
                'key' => 'is_email_configured',
                'value' => '0'
            ],
        ]);
    }
}
