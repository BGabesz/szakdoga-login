@include('layouts.recepcio')
@section('content')
    <main>
        <header>
            
            
            <form action="{{ route('OltozoFoglalasFelvitel') }}" method="post" class=lefoglalas>
                @csrf
                <div id="kereso">
                    <div class="bal1">
                        <label id="keresoSzoveg" for="fname">Személy kereső:</label>
                        <input type="txt" id="keresoInput" placeholder="Személy kereső" class="keresSzemely"
                            name="ugyfelNev" value="{{ old('ugyfelNev') }}" />
                        <div class="keresettSzemely"></div>
                    </div>
                    <div class="jobb1">
                        <label id="keresoSzoveg" for="fname">Szekrény kereső:</label>
                        <input type="number" id="keresoInput" placeholder="Szekrény kereső" min="0"
                            class="keresSzekrenykulcs" name="szekrenySzama" value="{{ old('szekrenySzama') }}" />
                        <div class="keresettSzekreny"></div>
                    </div>
                    <div class="gomb">
                        <button type="submit" class="lefoglal">Lefoglal</button>
                    </div>
                    <div class="letszam">
                        <p id="SzabadSzoveg">Férfi szabad hely:</p>
                        <span class="ferfiLetszam"></span>
                        <p id="SzabadSzoveg">Női szabad hely:</p>
                        <span class="noiiLetszam">100</span>
                    </div>
                </div>
                @if (Session::has('sikeres'))
                    <div class="hibaüzenet sikeresUzenet">{{ Session::get('sikeres') }}</div>
                @endif
                @if (Session::has('sikertelen'))
                    <div class="hibaüzenet sikertelenUzenet">{{ Session::get('sikertelen') }}</div>
                @endif
            </form>
        </header>
        <section>
            
            <div class="szekrenyValtoztat">
                <select class="szekrenyekValasztas"></select>
                <button type="button" class="osszesFeloldasGomb">Összes felold</button>
                <span id="msg" style="color:red"></span><br />
            </div>
            <div class="szekrenyek"></div>
        </section>
        <footer>
            <div class="szemely">
                <p class="neve"></p>
                <p class="neme"></p>
                <p class="igazolvanySzama"></p>
                <p class="igazolvanyTipusa"></p>
                <input type="file" id="files" class="fajlKivalaszt" accept="image/*" /><br>
                <img alt="profilkepe" class="szemelyKep" width="100"><br>
                <button type="submit" class="felviszGomb">Felvisz</button>
                <p class="email"></p>
                <p class="berlete"></p>
            </div>
            <table>
                <div class="szekreny">
                    <div class="circle">
                        <p class="szama"></p>
                    </div>
                    <div class="tartalom">
                        <p class="neme"></p>
                        <p class="uresE"></p>
                        <p><button type="submit" class="feloldasGomb">Felold</button></p>
                        <p class="check"><input type="checkbox" class="hibasGomb" name="switch"></p>
                    </div>
                </div>
        </footer>
    </main>
    </body>

    </html>
