//const { map } = require("lodash");
const queryParams=new URLSearchParams();
let keres="";
let rendezes="";
let superapivegponto = "api/proba";
let Oszlopnev = [];

const termek = [];

let myAjax;
let rend;
let adatMeg;
$(function () {
    let buttonIds = [
        "szemely",
        "eszkoz",
        "gepek",
        "munkaido",
        "edzesek",
        "szekreny",
        "oltozofoglalas",
        "jogosultsag",
        "gyakorlat",
        "berletek",
        "arvaltozas",
        "berletTipus"
        
    ];
     adatMeg=new AdatokMegjeleniteseAdmin();
    var mindenadat = [];
    myAjax = new MyAjax();
    rend = new AdminRend();
    let adat = "gepek";
   
    window.addEventListener('popstate', (event) => {
        event.preventDefault();
       clickToButtonUrlHash();
      },{once:true});
      
    gombok();
  
    clickToButtonUrlHash();
    $("#ujFelvetel").on("click", () => {
        $(".elemek").remove();
        $("main").append(
            '<section class="elemek row clicked" style="border:1px solid black;width:400px;height:550px;overflow:auto" ><div class="elem" >'
        );

       
       
        
        kicsiE(true);
        vizsgal(adat,()=>{
            
            $("#kuld").click(() => {
                
            const inputs = {};
            for (element of $("#javitas select,#javitas input")) {
                const name = $(element).attr("name");
                const value = $(element).val();
                inputs[name] = value;
            }
           
            myAjax. adatkuldes("api/" + adat,
            inputs);
            
            $("#fo").empty();
            $(".elemek").remove();
            $("#fo").append('<section class="elemek row"><div class="elem" ></section>');
            adatMeg.apiOsszealitas(termek,Oszlopnev);
            
        });

        
        adatMeg.apiOsszealitas(termek,Oszlopnev);});
    });
    $("#listaz").on("change", () => {

        adatMeg.apiOsszealitas(termek,Oszlopnev);
    });
    $("#keresSzoveg").on("keyup", () => {
        rend.keresoMezo(termek,Oszlopnev);
    });
    $("#rendezes").on("change", () => {
        rend.rendezesTabla(termek,Oszlopnev);
    });
    $(window).on("torol", function (event) {
        const id = event.detail[Oszlopnev[0]];
        const hasPrimarykey=["edzesek","gyakorlat","munkaido","arvaltozas","berletek"].includes(adat)
         hasPrimarykey 
         ? myAjax.adatkuldes(`api/${adat}/delete`,event.detail)
         :myAjax.adattorles(`api/${adat}`, id);
         adatMeg.apiOsszealitas(termek,Oszlopnev);
        
    });
    $(window).on("modosit", function (eseny) {
        $(".elemek").remove();
        $("main").append(
            '<section class="elemek row clicked" style="border:1px solid black;" ><div class="elem" >'
        );

       
        
        kicsiE(true);
        vizsgal(adat,()=>{
            adatMeg.adatbeilleszt(eseny.detail,Oszlopnev);
            adatMeg.apiOsszealitas(termek,Oszlopnev);
      
            const originalInputs=getinputs();

             $("#kuld").click(() => {
                const newInputs=getinputs();
           
            
            myAjax.adatmodosit(
                "api/" + adat,
                ["edzesek","gyakorlat","munkaido","arvaltozas","berletek"].includes(adat) ?
                 { originalInputs, newInputs } : 
                 newInputs,
                $("#javitas input").val()
            );
            $("#fo").empty();
            $(".elemek").remove();
            $("#fo").append('<section class="elemek row"><div class="elem" ></section>');
            kicsiE()
            adatMeg.apiOsszealitas(termek,Oszlopnev);
        });

       
    });

       
           
    });
    function getinputs(){
        const inputs = {};
         for (element of $("#javitas select,#javitas input")) {
        const name = $(element).attr("name");
        const value = $(element).val();
        inputs[name] = value;

    }
        return inputs
    }
    function kezdes(adat) {
        $(".elemek").remove();
        $("#fo").empty();
        $("#fo").append(
            '<section class="elemek row" ><div class="elem" ></div></section>'
        );
        Oszlopnev = myAjax.adatBeolvasasElore("../json/alapnevek.json", Oszlopnev, adat);
        myAjax.adatbeolvas(superapivegponto, mindenadat, (madatok)=>{
            kicsiE();
        
        rend.rendezoMezoLetreHozas(Oszlopnev);
        adatMeg.apiOsszealitas(madatok,Oszlopnev);
        });
        
        
        
    }

    function kicsiE(ertek=false) {
        if (ertek === true) {
            Oszlopnev = myAjax.adatBeolvasasElore(
                "../json/alapnevek.json",
                Oszlopnev,
                adat + "Kicsik"
            );
        }
        else{
            Oszlopnev = myAjax.adatBeolvasasElore(
                "../json/alapnevek.json",
                Oszlopnev,
                adat 
            );
        }
    }
    function gombok() {
       
        buttonIds.forEach((element) => {
            $("#" + element + "").on("click", () => {
                adat = element;
                megjelenit=0;
                queryParams.delete("_sort");
                queryParams.delete("_order");
                queryParams.delete("q");
                $("#keresSzoveg").val("");
              
                superapivegponto = "api/" + element;
                
                kezdes(adat);
                
            });
        });
    }

    
function setUrlHash(hash){
    const url = new URL(location.href);
    url.hash=hash;
    
  history.pushState(null,'',url);

}
    

function clickToButtonUrlHash(){
    const { hash } =location;
    if(hash){
        
        $(hash).click();
        return
    }
    const newHash=`#${buttonIds[0]}`;
    setUrlHash(newHash);
    $(newHash).click();

}


});
function vizsgal(adat,myCallback=false){
    let keresetErtek="",keresetErtek2="",eldont=false,eldont2=false;
        let seged=[];
    let nemModosithato=0;
    switch (adat) {
        case "szemely":
            keresetTabla = "jogosultsag";
            keresetErtek = "jogosultsag_id";
            eldont = true;
            nemModosithato=0;
            break;
        case "eszkoz":
            keresetTabla = "eszkoz";
            keresetErtek = "eszkoz_neve";
            keresetTabla2="terem"
            keresetErtek2="terem_id"
            eldont = true;
            eldont2=true;;
            nemModosithato=0;
            break;
        case "edzesek":
            keresetTabla = "szemely/edzok";
            keresetTabla2 = "szemely/ugyfelek";
            keresetErtek = "szemely_id";
            keresetErtek2 = "szemely_id";
            eldont = true;
            eldont2 = true;
            nemModosithato=10;
            break;
        case "gyakorlat":
            keresetTabla = "gepek";
            keresetTabla2 = "izomcsoport";
            keresetErtek = "eszkoz_tipus_szamlalo";
            keresetErtek2 = "izomcsoport_id";
            eldont = true;
            eldont2 = true;
            nemModosithato=9;
            break;
        case "munkaido":
            keresetTabla="szemely/dolgozok";
            keresetErtek = "szemely_id";
            eldont=true;
            nemModosithato=9;
            break
        case "oltozofoglalas":
            keresetTabla = "szekreny";
            keresetTabla2 = "szemely/ugyfelek";
            keresetErtek = "szekreny_id";
            keresetErtek2 = "szemely_id";
            eldont = true;
            eldont2 = true;
            nemModosithato=0;
        break
        case "arvaltozas":
            keresetTabla="berletTipus";
            keresetErtek="berlet_tipus_id";
            eldont =true;
            nemModosithato=9
            break;
            case "berletek":
                keresetTabla = "berletTipus";
            keresetTabla2 = "szemely/ugyfelek";
            keresetErtek = "berlet_tipus_id";
            keresetErtek2 = "szemely_id";
            eldont = true;
            eldont2 = true;
           
            nemModosithato=3;
                break
        default:
          
         
            break;
    }
try {
    myAjax.adatbeolvas("api/" + keresetTabla, seged, (tomb) => {
       
        try {
          
            myAjax.adatbeolvas("api/" + keresetTabla2, seged, (tomb2) => {
            
                adatMeg.beviteliMezoGeneralas(tomb, keresetErtek, eldont,Oszlopnev,nemModosithato,tomb2,keresetErtek2,eldont2);
        
        myCallback();
        });} catch (error) {
            adatMeg.beviteliMezoGeneralas(tomb, keresetErtek, eldont,Oszlopnev,nemModosithato);
        
        myCallback();
        }
        
        });
} catch (error) {
    adatMeg.beviteliMezoGeneralas(seged, keresetErtek, eldont,Oszlopnev,nemModosithato);
    myCallback();
}
    
   
    
};


