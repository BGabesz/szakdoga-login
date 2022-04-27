<?php
     $isAdmin =Request::is('admin') ;
    $buttons =[
        ['id'=>'szemely','text'=>'emberek'],
        ['id'=>'eszkoz','text'=>'gepek'],
        ['id'=>'gepek','text'=>'eszkoz'],
        ['id'=>'munkaido','text'=>'munkaido'],
        ['id'=>'edzesek','text'=>'edzesek'],
        ['id'=>'oltozofoglalas','text'=>'oltozofoglalas'],
        ['id'=>'gyakorlat','text'=>'gyakorlat'],
        ['id'=>'berletTipus','text'=>'berletTipus'],
        ['id'=>'berletek','text'=>'berletek'],
        ['id'=>'arvaltozas','text'=>'arvaltozas'],
        
];

?>

@foreach ($buttons as list('id' => $id,'text' => $text) )

<a href="{{$isAdmin ? '' : '/admin' }}#{{$id}}"><button id="{{$id}}" >
    {{$text}}

</button></a>

@endforeach


<a href="{{$isAdmin ? '/chart' : '' }}"><button id="diagram">
   diagram
   
    </button> </a>