<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('tarife' , function(Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->integer('an')->unique();
        $table->double('redeventa');
        $table->double('intretinere');       
        $table->timestamps();
        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('tipuri');
    }
}
