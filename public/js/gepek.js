let rend;
let adatMeg;
let superapivegponto = "api/gepek";
const queryParams=new URLSearchParams();
let myAjax;
let alapnev=[];
let megjelenit=0;
$(function(){
    myAjax = new MyAjax();
    
    const eszkozokTomb = [];
    
   
   
adatMeg=new AdatokMegjelenitese();
rend = new AdminRend();
$("#listaz").on("change", () => {
    console.log($("#listaz").val());

    adatMeg.apiOsszealitas(eszkozokTomb,alapnev);
});
$("#keresSzoveg").on("keyup", () => {
    rend.keresoMezo(eszkozokTomb,alapnev);
    console.log(rendezes);
});
$("#rendezes").on("change", () => {
    rend.rendezesTabla(eszkozokTomb,alapnev);
});

    /*let szamApiVegpont = "/api/gepek/";
    let szoApiVegpont = "/api/gepek/search?eszkoz_neve=";*/

    alapnev=myAjax.adatBeolvasasElore("../json/alapnevek.json", alapnev, "gepekoldal");
    myAjax.adatbeolvas(superapivegponto,eszkozokTomb,(eszkozok)=>{
        adatMeg.apiOsszealitas(eszkozok,alapnev);
        rend.oldalakSzama(eszkozokTomb,alapnev);
        rend.rendezoMezoLetreHozas(alapnev);
    })
  
    
    
    /*$(".k_mezo").on("keyup", ()=>{
        if(typeof ($(".k_mezo").val()) === Number){  //ez nem űködik
            let keresId = $(".k_mezo").val();
            myAjax.adatbeolvas(szamApiVegpont + keresId, eszkozokTomb, adatokMegjelenitese);
            console.log(szamApiVegpont);
        }else{
            let keresId = $(".k_mezo").val();
            myAjax.adatbeolvas(szoApiVegpont + keresId, eszkozokTomb, adatokMegjelenitese);
        }
    });*/
    
    function adatokMegjelenitese() {
        const szuloElem = $("#allomany");
        const sablon = $(".klonja");
        szuloElem.empty();
        sablon.show();
        eszkozokTomb.forEach(function(elem, index) {
            const gep = sablon.clone().appendTo(szuloElem);
            const beolvasottGep = new Gep(gep, elem, index); 
        });
        sablon.hide();
    };

});

