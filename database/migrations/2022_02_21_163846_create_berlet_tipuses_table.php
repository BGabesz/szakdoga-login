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
        Schema::create('berlet_tipuses', function (Blueprint $table) {
            //fő kulcs
         $table->increments('berlet_tipus_id');
         $table->string('megnevezes');
         $table->string('idotartam_nap');
         $table->integer('ar');
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
        Schema::dropIfExists('berlet_tipuses');
    }
};
