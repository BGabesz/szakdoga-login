<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Berlet_tipus;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class BerleteladasokChart extends BaseChart
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

        foreach(Berlet_tipus::all() as $terem){
            $labels[]=$terem->megnevezes;
            $dataset[]=$terem->eszkozok->count();
        }
        return ['labels'=>$labels,'dataset'=>$dataset];
    }
}