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
        Schema::create('terems', function (Blueprint $table) {
            //fő kulcs
        $table->increments('terem_id');
        $table->string('terem_neve');
        $table->integer('ferfi_ferohely');
        $table->integer('noi_ferohely');
        $table->time('nyitas');
        $table->time('zaras');
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
        Schema::dropIfExists('terems');
    }
};
