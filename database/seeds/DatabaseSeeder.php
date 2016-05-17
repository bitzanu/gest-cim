<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement("SET foreign_key_checks = 0");
        $this->call(UserTableSeeder::class);
        $this->call(CimitireTableSeeder::class);
        $this->call(TipuriTableSeeder::class);
        $this->call(TarifeTableSeeder::class);
        $this->call(PersoaneTableSeeder::class);
    }
}
