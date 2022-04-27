<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\Oltozofoglalas;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class NapiletszamChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $result= $this->getEszkozByTerem($request->input("napok"));

        return Chartisan::build()
            ->labels($result['labels'])
            ->dataset('sample',$result['dataset']);
            
    }
    private function getEszkozByTerem(string $napok)
    {       
        $oltozok=Oltozofoglalas::selectRaw("date_format(datum, '%Y %m %d %H') as napok,count(1) as letszam")
        ->whereRaw("date(datum) = ?",[$napok])
        ->groupByRaw("date_format(datum, '%Y %m %d %H')")->get();
        
        $array = [];

        foreach($oltozok as $oltozo) {
            $array[(int)substr($oltozo->napok, -2)] = $oltozo->letszam;
        }

        for ($i=6; $i <23 ; $i++) { 
            if (!array_key_exists($i, $array)) {
                $array[$i] = 0;
            }
        }

        ksort($array);

        $labels = [];
        $dataset = [];

        foreach ($array as $key => $elom) {
            $labels[] = $key;
            $dataset[] = $elom;
        }

        return ['labels'=>$labels,'dataset'=>$dataset];
    }
}