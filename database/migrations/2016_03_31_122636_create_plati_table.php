<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlatiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('plati' , function(Blueprint $table)
         {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('numar');
            $table->datetime('data');
            $table->double('suma');
            $table->integer('rata_id')->unsigned();
            $table->foreign('rata_id')->references('id')->on('rate');
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
          Schema::drop('plati');
    }
}
