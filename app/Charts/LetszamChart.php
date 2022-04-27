<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Oltozofoglalas;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class LetszamChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $result= $this->getEszkozByTerem();

        return Chartisan::build()
            ->labels($result['labels'])
            ->dataset('sample',$result['dataset']);
            
    }
    private function getEszkozByTerem()
    {
       
        
        $oltozok=Oltozofoglalas::selectRaw("date_format(datum,'%Y %M %D %H') as napok,count(1) as letszam")
        ->groupByRaw('date_format(datum,"%Y %M %D %H")')->get();
        
        $labels=$oltozok->map(fn($oltozo)=>
            $oltozo->napok
        )->toArray();
        $dataset=$oltozok->map(fn($oltozo)=>$oltozo->letszam)->toArray();
        
        return ['labels'=>$labels,'dataset'=>$dataset];
    }
  
}