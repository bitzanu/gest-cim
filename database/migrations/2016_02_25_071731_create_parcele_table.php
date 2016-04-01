<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParceleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('parcele' , function(Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('numar');
        $table->integer('cimitir_id')->unsigned();
        $table->foreign('cimitir_id')
            ->references('id')->on('cimitire');
        $table->unique(array('numar', 'cimitir_id'));
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
        Schema::drop('parcele');
    }
}
