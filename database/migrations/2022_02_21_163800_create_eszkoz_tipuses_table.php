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
        Schema::create('eszkoz_tipuses', function (Blueprint $table) {
            //fő kulcs
    	$table->increments('eszkoz_tipus_szamlalo');
        $table->string('eszkoz_neve');
        $table->integer('suly');
        $table->string('kep');
        $table->string('leiras');
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
        Schema::dropIfExists('eszkoz_tipuses');
    }
};
