<?php
class TargetsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('targets')->delete();

        \Models\Client\Target::create(['name' => 'Wordpress', 'slug' => 'WP']);
        \Models\Client\Target::create(['name' => 'PrestaShop', 'slug' => 'PS']);
    }

}