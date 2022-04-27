class AdatokMegjelenitese{
    constructor(){}
    apiOsszealitas(adatok, oszlopNev) {
        let vegApi = superapivegponto + "?" + queryParams.toString();
           myAjax.adatbeolvas(
            vegApi,
            adatok,
            (adatok) => {
                             this.Alap(oszlopNev);
                rend.elemMegjelenit(adatok, oszlopNev);
            },
            
        );
}
adatbeilleszt(adatok, oszlopNevek) {
   oszlopNevek.forEach((element) => {
        $("#" + element + " ").val(adatok[element]);
      
    });
}
Alap(nev) {
    $(".elemek").empty();
    $(".elemek").append('<div class="elem " ></div>');
    let txt = "";
    let index = 0;

    nev.forEach((element) => {
        if (index == 0) {
           
            txt += "<h5 class=" + element + ">Lorem ipsum dolor</h5>";
        }else if(element==="kep"){
            txt += "<img scr=" + element + "/>";
        } else {
          
            txt += "  <p class=" + element + "></p>";
        }
        index++;
    });
    txt +=
        
    $(".elem").append(txt);
}}


class AdatokMegjeleniteseAdmin  {
    constructor() {}
    
    apiOsszealitas(adatok, oszlopNev) {
        let vegApi = superapivegponto + "?" + queryParams.toString();
        
        myAjax.adatbeolvas(
            vegApi,
            adatok,
            (adatok) => {
                
                this.Alap(oszlopNev);
                rend.elemMegjelenit(adatok, oszlopNev);
            },
            
        );
}
    adatbeilleszt(adatok, oszlopNevek) {
        
        oszlopNevek.forEach((element) => {
            $("#" + element + " ").val(adatok[element]);
           
        });
    }

    beviteliMezoGeneralas(
        seged,
        keresetErtek,
        eldont,
        oszlopNevek,
        nemValtoztathato = false,
        tomb2 = [],
        keresetErtek2 = "",
        eldont2 = false
    ) {
        $("#javitas").remove();
        $("#fo").append('<form id="javitas"></form>');

          let txt = "";
        oszlopNevek.forEach((element, index) => {
            txt += '<label for="' + element + '">' + element + ":</label>";

            if (index === nemValtoztathato) {
                txt +=
                    '<input type="text" id="' +
                    element +
                    '" name="' +
                    element +
                    '" autofocus placeholder="' +
                    element +
                    '" disabled' +
                    ">";
            } else if (eldont === true) {
                eldont = false;
                txt += '<select id="' + element + '" name="' + element + '">';
                seged.forEach((element) => {
                    let nev = "";
                    try {
                        let nevek = element[keresetErtek].split(" ");

                        nevek.forEach((neve) => {
                            nev += neve;
                        });
                    } catch (error) {
                        nev = element[keresetErtek];
                    }

                    txt +=
                        '<option value="' +
                        element[keresetErtek] +
                        '"id="' +
                        nev +
                        's1">' +
                        element[keresetErtek] +
                        "</option>";
                });
                txt += "</select>";
            } else if (eldont2 === true) {
                eldont2 = false;
                txt += '<select id="' + element + '" name="' + element + '">';
                tomb2.forEach((element) => {
                    let nev = "";
                    try {
                        let nevek = element[keresetErtek2].split(" ");

                        nevek.forEach((neve) => {
                            nev += neve;
                        });
                    } catch (error) {
                        nev = element[keresetErtek2];
                    }

                    txt +=
                        '<option value="' +
                        element[keresetErtek2] +
                        '"id="' +
                        nev +
                        's2">' +
                        element[keresetErtek2] +
                        "</option>";
                });
                txt += "</select>";
            } else {
                txt +=
                    '<input type="text" id="' +
                    element +
                    '" name="' +
                    element +
                    '" autofocus placeholder="' +
                    element +
                    '" required>';
            }
        });

        $("#javitas").append(txt);
        $("#javitas").append(`<button type="button" id="kuld" >küld</button`);
    }
     Alap(nev) {
        $(".elemek").empty();
        $(".elemek").append('<div class="elem " ></div>');
        let txt = "";
             nev.forEach((element) => {
           
                txt += "  <h6 >" + element + ":</h6>";
                txt += "  <p class=" + element + "></p>";
            
            
        });
        txt +=
            '<button class="torol">torol</button> <button class="modosit">modosit</button>';
        $(".elem").append(txt);
    }
}
