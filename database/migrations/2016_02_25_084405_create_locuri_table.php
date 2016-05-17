<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocuriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('locuri' , function(Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('numar');
        $table->double('lungime');
        $table->double('latime');
        $table->integer('numar_locuri');
        $table->string('constructie');
        $table->integer('parcela_id')->unsigned();
        $table->foreign('parcela_id')
            ->references('id')->on('parcele');
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
        Schema::drop('locuri');
    }
}
