<?php

use Illuminate\Database\Seeder;
use gestiune_cimitire\Tarif;
class TarifeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Tarif::truncate();
        for ($i=1900; $i<2100 ; $i++) {
        Tarif::create([
        	'an'=>$i,
        	'redeventa'=>50+$i,
        	'intretinere'=>100+$i
        	]);
    }
    }
}
