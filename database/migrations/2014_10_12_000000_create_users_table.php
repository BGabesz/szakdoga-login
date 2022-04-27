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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('neme');
            $table->date('szul_datum');
            $table->string('tel_szam');
            $table->integer('jogosultsag_id')->unsigned(); 		
	        $table->foreign('jogosultsag_id')->references('jogosultsag_id')->on('jogosultsags');
            $table->string('igazolvany_szam');
            $table->string('igazolvany_tipusa');
            $table->string('kep');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
