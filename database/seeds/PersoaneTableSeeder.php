<?php

use Illuminate\Database\Seeder;
use gestiune_cimitire\Persoana;

class PersoaneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Persoana::truncate();
        Persoana::create([
        	'nume'=>'Ion',
        	'prenume'=>'Ionescu',
        	'adresa'=>'Buzau',
        	'CNP'=>'1660134100034'
        	]);
         Persoana::create([
        	'nume'=>'Ion',
        	'prenume'=>'Albu',
        	'adresa'=>'Buzau',
        	'CNP'=>'1660134100035'
        	]);
          Persoana::create([
        	'nume'=>'Vasile',
        	'prenume'=>'Moraru',
        	'adresa'=>'Buzau',
        	'CNP'=>'1660134100036'
        	]);
           Persoana::create([
        	'nume'=>'Toma',
        	'prenume'=>'Gheorghe',
        	'adresa'=>'Buzau',
        	'CNP'=>'1660134100037'
        	]);
            Persoana::create([
        	'nume'=>'Sile',
        	'prenume'=>'Stoica',
        	'adresa'=>'Buzau',
        	'CNP'=>'1660134100038'
        	]);
    }
}
