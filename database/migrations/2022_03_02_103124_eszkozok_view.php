<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EszkozokView extends Migration
{
   
    public function up()
    {
        DB::statement($this->eszkozokView());
    }

    
    public function down()
    {
        DB::statement($this->dropView());
    }
    private function eszkozokView() :string {
        return <<<SQL
        CREATE VIEW viewEszkoz AS
        SELECT eszkozs.eszkoz_id,
        eszkoz_tipuses.eszkoz_tipus_szamlalo,
         eszkoz_tipuses.eszkoz_neve,
          eszkoz_tipuses.kep, 
          eszkoz_tipuses.leiras ,
          eszkozs.terem_id  
        FROM eszkoz_tipuses ,eszkozs 
        where eszkoz_tipuses.eszkoz_tipus_szamlalo=eszkozs.eszkoz_tipus_szamlalo
        SQL;
        

        
    }

    private function dropView(): string
    {
        return <<<SQL

            DROP VIEW IF EXISTS `viewEszkoz`;
            SQL;
    }
}
