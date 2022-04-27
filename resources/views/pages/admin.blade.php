@extends('layouts.admin')
@section('javascript')
<script src="../js/admin/admin.js"></script>
<script src="../js/admin/sablon.js"></script>
<script src="../js/admin/megjelenites.js"></script>
<script src="../js/rendezeés.js"></script>

@endsection
@section('content')
<main>
    <header>
        <a href="/">Főoldal</a>
    </header>
    <aside> 
        @include('includes.adminNavigation')
    
    </aside>
    
    @include('includes.rendezés')
    
    <article>
       
        <button id="ujFelvetel">uj</button>
        
        <section id="fo">
            
</section>
<nav id="navig">

</nav>
@endsection
{{--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
  
 
    <link rel="stylesheet" href="../css/admin.css">
    <script src="../js/admin/admin.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/admin/sablon.js"></script>
    <script src="../js/rendezeés.js"></script>

    <title>Document</title>
</head>
<body>
    <main>
        <header>
<p>kijelentkezés</p>
        </header>
        <aside> 
            <button id="szemely">emberek</button>
            <button id="eszkoz">gepek</button>
            <button id="gepek">eszkoz tipus</button>
            <button id="munkaido">munkaido</button>
            <button id="edzések">edzések</button>
            <button id="szekrenyek">szekrenyek</button>
            <button id="gyakorlatok">gyakorlatok</button>
            <button id="termek">termek</button>
            <button id="termek">berletek</button>
        
        </aside>
        <article>
            <section id="RendezesekHelye">
                <select id="rendezes">
                    <option id="NameListAsc" value="NameListAsc">Név szerint csökkenő</option>
                    <option id="NameListDesc" value="NameListDesc">Név szerint emelkedő</option>
                    <option id="CostListDesc" value="CostListDesc">Ár szerint csökkenő</option>
                    <option id="CostListAsc" value="CostListAsc">Ár szerint emelkedő</option>
                </select>
                <select id="listaz">
                    <option id="25" value="5" >5</option>
                    <option id="50" value="10">10</option>
                    <option id="100" value="15">15</option>
                    
                </select>
            <form>
                
                <input type="text" id="keresSzoveg">
                
                </form>
                
            </section>
            
            <section id="fo">
                
</section>
<nav id="navig">

</nav>
          
    </article>
   
    </main>


</body>
</html>--}}