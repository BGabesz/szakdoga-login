<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Eszkoz;
use App\Models\Eszkoz_tipus;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class EszkozokChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $result= $this->getEszkozByTerem();

        return Chartisan::build()
            ->labels($result['labels'])
            ->dataset('sample',$result['dataset']);
            
    }
    private function getEszkozByTerem()
    {
        $labels=[];
        $dataset=[];

        foreach(Eszkoz_tipus::all() as $terem){
            $labels[]=$terem->eszkoz_tipus_szamlalo;
            $dataset[]=$terem->eszkozok->count();
        }
        return ['labels'=>$labels,'dataset'=>$dataset];
    }
}