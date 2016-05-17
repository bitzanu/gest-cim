<?php

use Illuminate\Database\Seeder;
use gestiune_cimitire\Tip;

class TipuriTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tip::truncate();
        Tip::create([
        	'nume'=>'normal',
        	'reducere'=> 0
        	]);
        Tip::create([
        	'nume'=>'pensionar',
        	'reducere'=> 50
        	]);
        Tip::create([
        	'nume'=>'revolutionr',
        	'reducere'=> 100
        	]);
    }
}
