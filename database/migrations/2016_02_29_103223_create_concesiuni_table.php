<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcesiuniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('concesiuni' , function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('numar');
            $table->integer('tarif_id')->unsigned();
            $table->foreign('tarif_id')->references('id')->on('tarife');
            $table->integer('durata')->default(100); 
            $table->boolean('activa')->default(1);
            $table->integer('tip_id')->unsigned();
            $table->foreign('tip_id')->references('id')->on('tipuri');
            $table->integer('loc_id')->unsigned();
            $table->foreign('loc_id')->references('id')->on('locuri');
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
        Schema::drop('concesiuni');
    }
}
