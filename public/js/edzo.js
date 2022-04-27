$(function () {
  var idopontokTomb=[];
  const myAjax = new MyAjax();
  /* idopontok.megjelenit(idopontokTomb,jelenlegiDatum); */
  const munkaoratol=8;
  const munkaoraig=22;
  var apiSzemelyek="/api/szemely";


//-----------------------------------------------------------------------------------------------------------------------
//hibaüzenetek 2 ms után eltűnik lassan
$(document).on("click", () => {//rákattintás az oldalon
  $(".alert-sikeres").fadeOut(1000);
  $(".alert-sikertelen").fadeOut(1000);
});
setTimeout(function() {
  $(".alert-sikeres").fadeOut(3000);
  $(".alert-sikertelen").fadeOut(3000);
}, 2000);
//-----------------------------------------------------------------------------------------------------------------------
//Inputok elrejtése
  Elrejt(".datum");
  Elrejt(".orara");
  Elrejt(".ora");
  Elrejt(".lefoglal");
  function Elrejt(mit){//elrejt
    $(mit)[0].style.display = "none";
  }
  function Megjelenit(mit){//megjelenit
    $(mit)[0].style.display = "block";
  }
//-----------------------------------------------------------------------------------------------------------------------
    $(".szemelyKereso").on("keyup", () => {//ha lenyomja a szememely beirasa kozben a billentyut
      if($(".szemelyKereso").val()==""){
        console.log("nincs megadva szemely");
        Elrejt(".datum");
        Elrejt(".orara");
        Elrejt(".ora");
        Elrejt(".lefoglal");
      }else{
      apiVegpont = "/api/szemely?nev=" + $(".szemelyKereso").val();
      myAjax.adatbeolvas(apiVegpont, false, szemlyFunction);
    }
    });
    function szemlyFunction(tomb){
      if(tomb[0]===undefined ||tomb.length>1){
        console.log("nincs ilyen nev");
        Elrejt(".datum");
        Elrejt(".orara");
        Elrejt(".ora");
        Elrejt(".lefoglal");
      }else if(tomb.length===1){
        console.log("van ilyen név");
        Megjelenit(".datum");
      }
    }
      //-----------------------------------------------------------------------------------------------------------------------

  function jelenlegiDatum(napvaltoztat) {//függvény paramétereként megadhatjuk hogy a jelenlegi dátumhoz hány napot adjon hozzá(formátum:2022-03-10 06:14:58)
    let jelenlegiDatum = new Date();
    jelenlegiDatum.setDate(jelenlegiDatum.getDate() + napvaltoztat);
    return jelenlegiDatum.toJSON().replace("T", " ").slice(0, 19);
}
//-----------------------------------------------------------------------------------------------------------------------
    //Dátum megadásánál min és max
      $(".datum")[0].min=jelenlegiDatum(0).slice(0,10);//a jelenlegi idő a minimum, utólagos lefoglalás nem lehetséges
      $(".datum")[0].max=jelenlegiDatum(365).slice(0,10);//a jelenlegi idő +1 év a maximum
//-----------------------------------------------------------------------------------------------------------------------
function datumListaz(){//Datum lefoglalás időponthoz hozzá ad 7 nap választást
  const hetNapjai = ["Vasárnap","Hétfő","Kedd","Szerda","Csütörtök","Péntek","Szombat"];
  var datumok=[];
  let datumValasztasokSzoveg;
  let kiegeszit;
  for (let index = 0; index < 7; index++) {//7 segédet ír ki
    datumok.push(jelenlegiDatum(index).slice(0,10));
    let datum = new Date(jelenlegiDatum(index));
    /* console.log(datum); */
    if(index===0){//ma datum esaz elso elore foglalhato datum
      kiegeszit="(Ma)";
    }else if(index===1){//holnapi datum 
      kiegeszit="(Holnap)";
    }else if(index===2){//holnaputani datum
      kiegeszit="(Holnap után)";
    }else{
      kiegeszit="";
    }
    datumValasztasokSzoveg +='<option label='+hetNapjai[datum.getDay()]+kiegeszit+'>'+datumok[index]+'</option>';
  }
  $("#datumValasztasok").html(datumValasztasokSzoveg);
}
datumListaz();
//---------------------------
    $(".datum").on("input", () => {//rákattintás a dátumra,dátum beírása
      let datumBeirt =new Date($(".datum").val());//beirt datum
       datumBeirt =datumBeirt.toJSON().slice(0, 10);
      let maiDatum=jelenlegiDatum(0).slice(0, 10);
      if(!($(".datum").val()==="")){//ha megvan adva dátum 

        if(maiDatum===datumBeirt){//mai napot irt be
          if(new Date().getHours()>munkaoraig-2){//mai nap de 21 után nem lehet foglalni new Date("2022-04-09 20:59:00").getHours()>munkaoraig-2
            Elrejt(".orara");
            Elrejt(".ora");
            Elrejt(".lefoglal");
            $(".orara").val("");
            $(".ora").val("");
          }else{
            console.log("mai nap");
            oraraListaz(true);//mara adja a segitsegeket a jelenlegi oratol
            Megjelenit(".orara");
          }
        }else if(maiDatum<datumBeirt){//jövőbeli datumot irt be
          oraraListaz(false);//jovobeli datum 8tol adja a segitsegeket
          Megjelenit(".orara");
        }else if(maiDatum>datumBeirt){//multbéli dátumot írt be
          Elrejt(".orara");
          Elrejt(".ora");
          Elrejt(".lefoglal");
          $(".orara").val("");
          $(".ora").val("");
        }
      }else{
        Elrejt(".orara");
        Elrejt(".ora");
        Elrejt(".lefoglal");
        $(".orara").val("");
        $(".ora").val("");
      }
    });
    //-----------------------------------------------------------------------------------------------------------------------
    var utolsoElemhosszSeged1=0;
    $(".orara").on("keyup", () => {//ha az orara(Edzés időpont) viszunk be adatot
        let bevittErtek=$(".orara").val();//bevitt ertek
        let bevittErtek0Karakter=bevittErtek.charAt(0);//bevitt ertek
        let bevittErtek1Karakter=bevittErtek.charAt(1);//bevitt ertek
        let bevittErtek2Karakter=bevittErtek.charAt(2);//bevitt ertek
        let bevittErtek3Karakter=bevittErtek.charAt(3);//bevitt ertek
        let bevittErtek4Karakter=bevittErtek.charAt(4);//bevitt ertek
        if(!(bevittErtek0Karakter>0)){//ha 1. nem szam torol mindent
          console.log("elso nem szam");
          bevittErtek="";
        }
        if(parseInt(bevittErtek0Karakter)===1||parseInt(bevittErtek0Karakter)===2){//ha egy vagy 2 vel kezdődik akkor biztos hogy 9 óránál nagyobb tehát 2 számjegyü
          $(".orara").attr('maxlength','5');
          console.log("kettö szamjegyu lesz");
          if(!(parseInt(bevittErtek1Karakter)>-1&&(parseInt(bevittErtek1Karakter))<10)&&bevittErtek.length===2){//ha 2. nem szam torli a 2.at
            bevittErtek=bevittErtek0Karakter;
            console.log("masodik nem szam");
          }else if(!(parseInt(bevittErtek3Karakter)>-1&&(parseInt(bevittErtek3Karakter))<10)&&bevittErtek.length===4){//ha a 4. nem szam akkor törli a negyediket
            bevittErtek=bevittErtek0Karakter+bevittErtek1Karakter+bevittErtek2Karakter;
            console.log("negyedik nem szam");
          }else if(!(parseInt(bevittErtek4Karakter)>-1&&(parseInt(bevittErtek4Karakter))<10)&&bevittErtek.length===5){//ha 5. nem szam akkor torli az 5.et
            bevittErtek=bevittErtek0Karakter+bevittErtek1Karakter+bevittErtek2Karakter+bevittErtek3Karakter;
            console.log("otodik nem szam");
          }
          if((parseInt(bevittErtek1Karakter)>-1)&&(parseInt(bevittErtek1Karakter)<10)&&utolsoElemhosszSeged1===1){//ha megvan adva a 2. karakter akkor beallitjuk mögé a :
          //if(bevittErtek.length===2){
            bevittErtek+=":"
          }else if(!(bevittErtek2Karakter===":")&&bevittErtek.length===3){//ha a harmadik nem :
            console.log("masodik szam");
            bevittErtek=bevittErtek0Karakter+bevittErtek1Karakter+":";
          }
          if(bevittErtek.length===5){
            Megjelenit(".ora");
          }else{
            Elrejt(".ora");
            $(".ora").val("");
            Elrejt(".lefoglal");
          }
        }else if(parseInt(bevittErtek0Karakter)>2){//ha nem egy vagy 2 vel kezdődik akkor biztos hogy 10 óránál kisebb tehát 1 számjegyü
          console.log("egy szamjegyü lesz");
          if(!($(".orara").val().length===4)){//ne fusson le ha mar 4 hosszu automatikus beirasnal van szükség rakna egy :-ot
            if(utolsoElemhosszSeged1===0){//ha megvan adva a 2. karakter akkor beallitjuk mögé a :
              //if(bevittErtek.length===2){
                bevittErtek+=":"
              }else if(!(bevittErtek1Karakter===":")&&bevittErtek.length===2){//ha a masodik nem :
                console.log("masodik szam");
                bevittErtek=bevittErtek0Karakter+":";
              }
              if(!(parseInt(bevittErtek2Karakter)>-1&&(parseInt(bevittErtek2Karakter))<10)&&bevittErtek.length===3){//ha a 3. nem szam akkor torli a 3.at
                bevittErtek=bevittErtek0Karakter+bevittErtek1Karakter;
              }else if(!(parseInt(bevittErtek3Karakter)>-1&&(parseInt(bevittErtek3Karakter))<10)&&bevittErtek.length===4){//ha a 4. nem szam akkor torli a 4.et
                bevittErtek=bevittErtek0Karakter+bevittErtek1Karakter+bevittErtek2Karakter;
              }
              if(!(bevittErtek0Karakter>0)){//ha 1. nem szam torol mindent
                console.log("elso nem szam");
                bevittErtek="";
              }
              if(bevittErtek.length===4){
                Megjelenit(".ora");
              }else{
                Elrejt(".lefoglal");
                Elrejt(".ora");
                $(".ora").val("");
              }
          }else{//ha a segedlettel viszunk be szamot akkor biztos hogy jo formatum van beirva ezert jelenhet meg a kövi input
            Megjelenit(".ora");
          }
        }
          utolsoElemhosszSeged1=bevittErtek.length; 
        $(".orara")[0].value=bevittErtek;
    });


//-----------------------------------------------------------------------------------------------------------------------




    function oraraListaz(maE){//órára választás segítségek
      $("#oraraValasztasok").html("");//mindig kiuritjuk a segedletet
      let oraraValasztasokSzoveg;
      let oraraLista=[];
      let kiegeszit;
      for (let index = 0; index < 8; index++) {//8 segédlet
        let ora2Szamjegy;
        let datum = new Date();//mindig lenullázuk a jelenlegi dátumot
        if(maE){//ha true tehat ma ,ha egyik se akkor a jelenlegi oratol megy
        
          /* datum.setHours(8);///teszteléshez beállítja az időt
          datum.setMinutes(00);///teszteléshez beállítja az időt */
          if(datum.getHours()<munkaoratol){//8 ora elott van a jelenlegi datum akkor segitsegek 8 tol kezdodnek
            datum.setHours(8);
            datum.setMinutes(00);
            console.log("segitseg 8 tol kezdodik");
          }
        }else if(!(maE)){//nem ma tehat 8 tol listazas ,ha egyik se akkor a jelenlegi oratol megy
          console.log("holnap vagy masnap");
            datum.setHours(8);
            datum.setMinutes(00);
        }

        let hanyperccelNagyobb=index*15
        datum.setMinutes(datum.getMinutes()+hanyperccelNagyobb);
        let oraraBeallit=datum.getMinutes();
        if(oraraBeallit<1){//időbeállítások csak 00 15 30 45 lehet a perc
          datum.setMinutes(00);
          if(index===0){
            kiegeszit="Egyből kezdés";
          }else{
            kiegeszit="";
          }
        }else if(oraraBeallit>0&&oraraBeallit<16){//0-16 perc kozott
            datum.setMinutes(15);
            kiegeszit="";
          }else if(oraraBeallit>15&&oraraBeallit<31){//15-31 perc kozott
            datum.setMinutes(30);
            kiegeszit="";
          }else if(oraraBeallit>30&&oraraBeallit<46){//30-46 perc kozott
            datum.setMinutes(45);
            kiegeszit="";
          }else if(oraraBeallit>45&&oraraBeallit<61){//45-61 perc kozott
            datum.setHours(datum.getHours()+1, 00);
            kiegeszit="";
          }

          oraraLista.push(datum);
          if(datum.getHours()>=10){//ha az adott ora amit bepakolunk a választasban kisebb mint 10 tehat 1 szamjegyu akkor a 0 -at kiszedi elole
            oraraValasztasokSzoveg ='<option label="'+kiegeszit+'">'+(oraraLista[index]).toString().slice(16,21)+'</option>'
          }else if(datum.getHours()<10){//ha az adott ora amit bepakolunk a választasban nagyobb mint 10 tehat 2 szamjegyu
            oraraValasztasokSzoveg ='<option label="'+kiegeszit+'">'+(oraraLista[index]).toString().slice(17,21)+'</option>'
          }
          if(datum.getHours()>munkaoraig-1){//21 ora utan mar nem ad segitseget
            console.log("mara mar nem lehet foglalni");
            $("#oraraValasztasok").append("");
            Elrejt(".lefoglal");
            Elrejt(".ora");
            $(".ora").val("");
          }else{
            console.log("lehet");
            Megjelenit(".orara");
            $("#oraraValasztasok").append(oraraValasztasokSzoveg);
            oraBeallitas();
          }
      }
    }
//-----------------------------------------------------------------------------------------------------------------------
    function oraBeallitas(){//edzéshossz
      if(!($(".ora").val()==="")){//ha megvan adva az edzéshossz 
        let oraBeallit=parseInt($(".ora").val().slice(2,4));
        if(oraBeallit<8){//időbeállítások csak 00 15 30 45 lehet a perc
          $(".ora")[0].value=$(".ora").val().slice(0,1)+":00";
        }else if(oraBeallit>7&&oraBeallit<23){
          $(".ora")[0].value=$(".ora").val().slice(0,1)+":15";
        }else if(oraBeallit>22&&oraBeallit<38){
          $(".ora")[0].value=$(".ora").val().slice(0,1)+":30";
        }else if(oraBeallit>37&&oraBeallit<53){
          $(".ora")[0].value=$(".ora").val().slice(0,1)+":45";
        }else if(oraBeallit<100){
          $(".ora")[0].value=$(".ora").val().slice(0,1)+":00";
        }
      }else{
        Elrejt(".lefoglal");
      }
    }

//-----------------------------------------------------------------------------------------------------------------------
    function oraListaz(){//edzés hossza hozzá adja a valószínű lehettőségeket opciok nak
    const orak=["1:00","1:15","1:30","1:45","2:00","2:15","2:30","2:45","3:00"];
    const edzesekHossz=["Rövid edzés","Közepes edzés","Hosszú edzés"]
    var oravalasztasok=[];
    for (let index = 0; index < orak.length; index++) {//orak tomb vegigjarasa
      let i;
      if(index>-1&&index<3){//ha elso harom elem
        i=0;
      }else if(index>2&&index<6){// ha 4.-6.elem
        i=1;
      }else if(index>5&&index<9){//ha 7.-9.elem
        i=2;
      }
      oravalasztasok+='<option label="'+edzesekHossz[i]+'">'+orak[index]+'</option>'
    }
    $("#oraValasztasok").html(oravalasztasok);
    }
    oraListaz();

//-----------------------------------------------------------------------------------------------------------------------

    var utolsoElemhosszSeged=0;
    $(".ora").on("keyup", () => {//ha az edzeshossznál viszunk be adatot
      let edzeshossz=$(".ora").val();//bevitt ertek
      console.log(edzeshossz);
      if(!(edzeshossz.charAt(1)===":")&&utolsoElemhosszSeged===1){//ha a második nem :
        console.log("masodik szam");
        edzeshossz=edzeshossz.charAt(0)+":";
      }
      if(parseInt(edzeshossz.charAt(0))>3){
        edzeshossz="";
        console.log("3 oras edzésnél nem lehet hosszabb");
      }else{
        if(!(parseInt(edzeshossz.charAt(0))>-1&&(parseInt(edzeshossz.charAt(0))<10))&&edzeshossz.length===1){
          edzeshossz="";
          console.log("elso nem szam");
        }else if(!(parseInt(edzeshossz.charAt(2))>-1&&(parseInt(edzeshossz.charAt(2)))<10)&&edzeshossz.length===3){
          edzeshossz="";
          console.log("harmadik nem szam");
        }else if(!(parseInt(edzeshossz.charAt(3))>-1&&(parseInt(edzeshossz.charAt(3)))<10)&&edzeshossz.length===4){
          edzeshossz="";
          console.log("negyedik nem szam");
        }
      }
      utolsoElemhosszSeged=edzeshossz.length;
      $(".ora").val(edzeshossz);
      if(edzeshossz.length===4){
        oraBeallitas();
        Megjelenit(".lefoglal")
      }else{
        Elrejt(".lefoglal");
      }
      }
    );
    //-----------------------------------------------------------------------------------------------------------------------
//Szűrés dátum input tól és ig re
$(".datumKeresTol").val(jelenlegiDatum(-3).slice(0, 10));//input erteket automatikusan a jelenlegi datum -3 napra allítja
$(".datumKeresIg").val(jelenlegiDatum(3).slice(0, 10));//input erteket automatikusan a jelenlegi datum +3 napra allítja
minMax();
function minMax(){//minimum és maximum értéket ne lehessen választani az adott inputnal
  $(".datumKeresTol").attr("max",$(".datumKeresIg").val());
  $(".datumKeresIg").attr("min",$(".datumKeresTol").val());
}
$(".BalraCsokkentTol").on("click ", () => {//Időpont szőrés tól
  lehetE(".datumKeresTol","--");
  minMax();
});
$(".JobbraNovelTol").on("click ", () => {//Időpont szőrés tól
  lehetE(".datumKeresTol","++");
  minMax();
});
$(".BalraCsokkentIg").on("click ", () => {//Időpont szőrés ig
  lehetE(".datumKeresIg","--");
  minMax();
});
$(".JobbraNovelIg").on("click ", () => {//Időpont szőrés ig
  lehetE(".datumKeresIg","++");
  minMax();
});
function lehetE(mit,merre){//lehet e emelni vagy csökkenteni
  let tol=new Date($(".datumKeresTol").val());
  /* $(".datumKeresTol").max=$(".datumKeresIg").val(); */
  
  let ig=new Date($(".datumKeresIg").val());
  /* $(".datumKeresIg").min=$(".datumKeresTol").val(); */
  if(tol<ig){//tol lehet emelni, ig lehet csokkentteni
    IdopontKereses(mit,merre);
  }else if(+tol=== +ig){//tol nem lehet emelni, ig nem lehet csokkentteni, ugyanakkora
    if(mit===".datumKeresTol"&&merre==="--"){
      IdopontKereses(mit,merre);
    }else if(mit===".datumKeresIg"&&merre==="++"){
      IdopontKereses(mit,merre);
    }
  }else if(tol<ig){//tol nem lehet emelni, ig nem lehet csokkentteni 
    if(mit===".datumKeresTol"&&merre==="--"){
      IdopontKereses(mit,merre);
    }else if(mit===".datumKeresIg"&&merre==="++"){
      IdopontKereses(mit,merre);
    }
  }

  function IdopontKereses(mit,merre){
    let datumkeres=$(mit).val();
    const datum = new Date(datumkeres);
    if(merre==="--"){
      datum.setDate(datum.getDate()-1);
    }else if(merre==="++"){
      datum.setDate(datum.getDate()+1);
    }
    $(mit).val(datum.toJSON().slice(0, 10));
    szures();
  }
  }
  function szures(){//szűrés ami az inputokban van
    let datum = new Date($(".datumKeresIg").val());//azert kell mert a controllerben ha összehasonlítjuk a 2 dátumot akkor 2022-04-10 10:00:00-percet  2022-04-11 nek veszi
    datum.setDate(datum.getDate()+1);//azert kell
    datum=datum.toJSON().slice(0, 10);//azert kell

    apiVegpont="/ugyfelEdzes?datumTolIgSzemellyel=";
    apiVegpont+=$(".datumKeresTol").val()+"T"+datum+"T"+$(".SzemelySzuro").val();
    myAjax.adatbeolvas(apiVegpont, false,idopontLista);
  }
  $(".datumKeresTol").on("change ", () => {
    szures();
  });
  $(".datumKeresIg").on("change ", () => {
    szures();
  });
  szures();//inputban lévő adatok szerint szűri
  //-----------------------------------------------------------------------------------------------------------------------
  //Személy szűrés
  $(".SzemelySzuro").on("change ", () => {
    let datum = new Date($(".datumKeresIg").val());//azert kell mert a controllerben ha összehasonlítjuk a 2 dátumot akkor 2022-04-10 10:00:00-percet  2022-04-11 10:00:00 nek veszi
    datum.setDate(datum.getDate()+1);//azert kell
    datum=datum.toJSON().slice(0, 10);//azert kell
    apiVegpont="/ugyfelEdzes?datumTolIgSzemellyel=";
    apiVegpont+=$(".datumKeresTol").val()+"T"+datum+"T"+$(".SzemelySzuro").val();
    myAjax.adatbeolvas(apiVegpont, false,idopontLista);
  });
//-----------------------------------------------------------------------------------------------------------------------
function idopontLista(idopontokT){//időpontokat megejeleniti az oldalon
  console.log(idopontokT);
  const szuloElem = $('.Foglalasok');
  const sablonElem = $('footer .idopont');
  sablonElem.show();
  szuloElem.empty();
    idopontokT.forEach(function (elem) {
      let datum1=elem.datum.slice(0,10);
        let node = sablonElem.clone().appendTo(szuloElem);
        const obj = new Idopont(node, elem);
        if(new Date(elem.datum)<new Date()){//ha régebbi foglalásokat nézünk akkor ne lehessen feloldani
          obj.feloldas.hide();
          obj.modosit.hide();
        } 
    });
  sablonElem.hide(); 
}
//-----------------------------------------------------------------------------------------------------------------------
$(window).on('felold', (event) => {//ha rányomok a feloldra torli az adatot
  apiVegpont = "api/ugyfelEdzes/delete";
  console.log(event.detail.adat);
  myAjax.adatkuldes(apiVegpont, event.detail.adat);
  window.location.reload();
});
//-----------------------------------------------------------------------------------------------------------------------
      $(".modosit").hide();//alapértelmezetten elrejtve a módosítás
      $(".megjelenites").show();//alapértelmezetten megjelenítve a alap nézet
    $(window).on('modosit', (event) => {//ha rányomok a módosítra megjeleníti a módosítás nézetet és elrejti a alap nézetet, itt lehet szerkeszteni a foglalást
      /* console.log(event.detail.div.children()[1].style="display: contents"); */
      event.detail.div.children().children()[9].textContent="Módosít";
      event.detail.div.children()[1].style="display: block";
      event.detail.div.children()[0].style="display: none";
    });
    $(window).on('modositFelvitel', (event) => {//módosítás véglegesítése ha rányomok felviszi a megadott adatokat az adatbázisba
      console.log(event);
        apiVegpont = "api/ugyfelEdzes/update";
        console.log(event.detail.adat);
        console.log(event.detail.div.children().children());
        szoveg = {
          nevUj:event.detail.div.children().children()[17].value,//adott divnek az értékét megkapjuk
          datumUj: event.detail.div.children().children()[11].value+" "+event.detail.div.children().children()[14].value+":00",
          oraUj: event.detail.div.children().children()[20].value+":00",

          nevR:event.detail.adat.name,
          datumR: event.detail.adat.datum,
          oraR: event.detail.adat.ora,
          ugyfelR: event.detail.adat.ugyfel,
          edzo:event.detail.adat.edzo
        };
        console.log(szoveg);
        myAjax.adatkuldes(apiVegpont,szoveg);
        window.location.reload();
    });
    $(window).on('megseModositas', (event) => {//ha mégse akarjuk módosítani a foglalást akkor elrejti a módosítás nézetet és megjeleníti a alap nézetet
      event.detail.div.children()[1].style="display: none";
      event.detail.div.children()[0].style="display: block";
    });
});