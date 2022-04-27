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
        Schema::create('munkaidos', function (Blueprint $table) {
            //külső kulcs
        $table->integer('dolgozo')->unsigned();	
        $table->foreign('dolgozo')->references('id')->on('users');	
        $table->datetime('mettol');
        $table->datetime('meddig');
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
        Schema::dropIfExists('munkaidos');
    }
};
