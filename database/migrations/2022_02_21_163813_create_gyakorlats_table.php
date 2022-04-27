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
        Schema::create('gyakorlats', function (Blueprint $table) {
            //külső kulcs
        $table->integer('eszkoz_tipus_szamlalo')->unsigned();		
        $table->foreign('eszkoz_tipus_szamlalo')->references('eszkoz_tipus_szamlalo')->on('eszkoz_tipuses');
            //külső kulcs
        $table->integer('izomcsoport_id')->unsigned();		
        $table->foreign('izomcsoport_id')->references('izomcsoport_id')->on('izomcsoports');
        $table->string('megnevezes');
        $table->string('video');
        $table->string('leiras');
        $table->integer('szint');
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
        Schema::dropIfExists('gyakorlats');
    }
};
