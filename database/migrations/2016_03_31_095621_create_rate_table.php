<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('rate' , function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('concesiune_id')->unsigned()->nullable;
            $table->foreign('concesiune_id')->references('id')->on('concesiuni');
            $table->integer('tarif_id')->unsigned()->nullable;
            $table->foreign('tarif_id')->references('id')->on('tarife');
             $table->unique(array('concesiune_id', 'tarif_id'));     
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
        //public function down()
    {
        //
          Schema::drop('concesiuni_tarife');
    }
    }
}
