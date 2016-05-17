<?php

use Illuminate\Database\Seeder;
use gestiune_cimitire\Cimitir;

class CimitireTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Cimitir::truncate();
        Cimitir::create([
        	'nume'=>'Dumbrava',
        	'adresa'=>'',
        	]);
     	Cimitir::create([
        	'nume'=>'Eroilor',
        	'adresa'=>'',
        	]);
        Cimitir::create([
        	'nume'=>'Sf. Gheorghe',
        	'adresa'=>'',
        	]);
        Cimitir::create([
        	'nume'=>'Sf. Constantin si Elena',
        	'adresa'=>'',
        	]);   
    }
}
