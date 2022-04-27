<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ugyfel_edzes', function (Blueprint $table) {
            $table->increments('id'); 
            //külső kulcs
        $table->integer('edzo')->unsigned();		
        $table->foreign('edzo')->references('id')->on('users');
            //külső kulcs
        $table->integer('ugyfel')->unsigned();		
        $table->foreign('ugyfel')->references('id')->on('users');
        $table->datetime('datum');
        $table->time('ora');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ugyfel_edzes');
    }
};
