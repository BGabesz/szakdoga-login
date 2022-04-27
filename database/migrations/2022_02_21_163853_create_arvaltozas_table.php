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
        Schema::create('arvaltozas', function (Blueprint $table) {
            //külső kulcs	
        $table->integer('berlet_tipus_id')->unsigned();
        $table->foreign('berlet_tipus_id')->references('berlet_tipus_id')->on('berlet_tipuses');
        $table->integer('regi_ar');
        $table->integer('uj_ar');
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
        Schema::dropIfExists('arvaltozas');
    }
};
