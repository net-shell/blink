<?php
class TemplatesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('templates')->delete();

        \Models\Client\Template::create(['name' => 'Zlatanov Fashion', 'user_id' => 1]);
    }

}