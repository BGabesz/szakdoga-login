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
        Schema::create('oltozofoglalas', function (Blueprint $table) {
             //fő kulcs
         $table->increments('oltozofog_id');
         //külső kulcs
	 $table->integer('szekreny_id')->unsigned();
	 $table->foreign('szekreny_id')->references('szekreny_id')->on('szekenies');
         //külső kulcs
	 $table->integer('ugyfel')->unsigned();		
	 $table->foreign('ugyfel')->references('id')->on('users');
	 $table->datetime('datum');
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
        Schema::dropIfExists('oltozofoglalas');
    }
};
