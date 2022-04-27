  
  @include('layouts.edzo')
  @section('content')
        <form action="{{route('ugyfelEdzesFoglalasFelvitel1')}}" method="post">
        @csrf
        
        <input placeholder="személy neve" type="txt"  class="szemelyKereso" name="ugyfelNev"  required/>

        <input type="date" class="datum" list="datumValasztasok" name="datum" required/>
        <datalist id="datumValasztasok"></datalist>

        <input class="orara"type="text" list="oraraValasztasok" placeholder="órára" minlength="4" maxlength="10" name="orara" required/>
        <datalist id="oraraValasztasok"> </datalist>

        <input  class="ora"type="text" list="oraValasztasok" placeholder="edzés hossza(1:00)" maxlength="4" name="ora" required/>
        <datalist id="oraValasztasok"> </datalist>
        {{-- <div class="gomb"></div> --}}
        <button type="submit"  class=lefoglal>Lefoglal</button>
        @if(Session::has('sikeres'))
          <div class="alert alert-sikeres">{{Session::get('sikeres')}}</div>
        @endif
        @if(Session::has('sikertelen'))
          <div class="alert alert-sikertelen">{{Session::get('sikertelen')}}</div>
        @endif
      </form>
  </article>
  <div class="tablaSeged">
    <div class="szures">
      {{-- <input type="image" class="BalraCsokkent" id="gomb" src="{{ asset('kepek/nyil.png') }}" /> --}}
      <div class="tol">
        <button class="BalraCsokkentTol">-</button>
        <input type="date" class="datumKeresTol" >
        <button class="JobbraNovelTol">+</button>
        <p>-tól</p>
      </div>
      <div class="ig">
        <button class="BalraCsokkentIg">-</button>
        <input type="date" class="datumKeresIg" >
        <button class="JobbraNovelIg">+</button>
        <p>-ig</p>
      </div>
      <div class="szemelyreSzures">
        <input type="text" class="SzemelySzuro" placeholder="Személy kereső">
      </div>
    </div>
    <div class="a">

      <div class="Foglalasok" id="oszlop"></div>
    </div>
  
  <footer>
    <div id="kartya" class="idopont">
      {{-- <div class="megjelenites">
        <h3 class="szemelyNeve">a</h3>
        <p class="datumtol">10</p>
        <p class="ora">1</p>
        <button type="submit" class="modositGomb">Módosít</button>
        <button type="submit" class="feloldasGomb">Felold</button>
      </div> --}}
      <div class="megjelenites">
        <p class="honap">Április</p>
        <p class="nap">Kedd</p>
        <p class="datum">5</p>
        <p class="ora1">10:00</p>
        <p class="oras">1:15-perc</p>
        <p class="ev">2022</p>
        <h3 class="szemelyNeve">Joó Edvárd</h3>
        <button type="submit" class="modositGomb">Módosít</button>
        <button type="submit" class="feloldasGomb">Felold</button>
      </div>
      <div class="modosit">
        <p class="honap">Módosít</p>
            <label class="modositLabel" ></label><input type="date" class="datumModosit" list="datumValasztasok" name="datum"/><br>
            <label class="modositLabel" >Órára: </label><input type="time" class="modositOrara"><br>
            <label class="modositLabel" ></label><input class="modositNev" type="text"/><br>
            <label class="modositLabel" id="edzesHossz" ></label><input type="time" class="modositEdzesHossz" min="01:00" max="03:00"><br>
            <button type="submit" class="modositFelvisz">Megerősít</button>
            <button type="submit" class="megseModosit">Mégse</button>
      </div>
  </div>
    © Minden jog fenntartva ©<br />

  </footer>