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
        Schema::create('berlets', function (Blueprint $table) {
            //külső kulcs
        $table->integer('berlet_tipus_id')->unsigned();		
        $table->foreign('berlet_tipus_id')->references('berlet_tipus_id')->on('berlet_tipuses');;	
            //külső kulcs
        $table->integer('ugyfel')->unsigned();		
        $table->foreign('ugyfel')->references('id')->on('users');	
        $table->datetime('datum_tol');
        $table->datetime('datum_ig');
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
        Schema::dropIfExists('berlets');
    }
};
