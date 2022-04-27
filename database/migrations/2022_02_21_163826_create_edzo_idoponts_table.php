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
        Schema::create('edzo_idoponts', function (Blueprint $table) {
            //külső kulcs
        $table->integer('ugyfel')->unsigned();		
        $table->foreign('ugyfel')->references('id')->on('users');
            //külső kulcs
        $table->integer('terem_id')->unsigned();		
        $table->foreign('terem_id')->references('terem_id')->on('terems');
        $table->datetime('belepes_datum_ido');
        $table->datetime('kilepes_datum_ido');
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
        Schema::dropIfExists('edzo_idoponts');
    }
};
