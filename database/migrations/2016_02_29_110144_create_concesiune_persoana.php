<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcesiunePersoana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('concesiune_persoana' , function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('persoana_id')->unsigned()->nullable;
            $table->foreign('persoana_id')->references('id')->on('persoane');
            $table->integer('concesiune_id')->unsigned()->nullable;
            $table->foreign('concesiune_id')->references('id')->on('concesiuni');
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
        Schema::drop('concesiune_persoana');
    }
}
