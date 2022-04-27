$(function () {
    let szoveg;
      const myAjax = new MyAjax();
      //-----------------------------------------------------------------------------------------------------------------------
      //hibaüzenetek 2 ms után eltűnik lassan, vagy ha rányomunk valahol az oldalon akkor gyorsabban
      $(document).on("click", () => {
          //rákattintás az oldalon
          $(".sikeresUzenet").fadeOut(1000);
          $(".sikertelenUzenet").fadeOut(1000);
      });
      setTimeout(function () {
          $(".sikeresUzenet").fadeOut(3000);
          $(".sikertelenUzenet").fadeOut(3000);
      }, 2000);
      //-----------------------------------------------------------------------------------------------------------------------
      //szűrés inputnál db számok és a szabad helyek létszáma
      let apiVegpont = "/api/szekrenyLetszam";
      myAjax.adatbeolvas(apiVegpont, false, letszam);
      function letszam(tomb) {
          console.log(tomb);
          let osszesSzekrenySzam = 0;
          let NoiSzekrenyDb = 0;
          let FerfiSzekrenyDb = 0;
          let foglaltSzamF = 0;
          let foglaltSzamN = 0;
          let foglaltSzam = 0;
          let rosszSzamF = 0;
          let rosszSzamN = 0;
          let rosszSzam = 0;
          let üresSzamF = 0;
          let üresSzamN = 0;
          let üresSzam = 0;
          let szekrenySzuresValasztas;
          tomb.forEach(function (key) {
              osszesSzekrenySzam += key.db;
              if (key.ures_e === "F" && key.tipusa === "Férfi") {
                  foglaltSzamF += key.db;
                  foglaltSzam += key.db;
              } else if (key.ures_e === "F" && key.tipusa === "Nő") {
                  foglaltSzamN += key.db;
                  foglaltSzam += key.db;
              } else if (key.ures_e === "R" && key.tipusa === "Férfi") {
                  rosszSzamF += key.db;
                  rosszSzam += key.db;
              } else if (key.ures_e === "R" && key.tipusa === "Nő") {
                  rosszSzamN += key.db;
                  rosszSzam += key.db;
              } else if (key.ures_e === "Ü" && key.tipusa === "Férfi") {
                  üresSzamF += key.db;
                  üresSzam += key.db;
              } else if (key.ures_e === "Ü" && key.tipusa === "Nő") {
                  üresSzamN += key.db;
                  üresSzam += key.db;
              }
              if (key.tipusa === "Férfi") {
                  FerfiSzekrenyDb += key.db;
              } else if (key.tipusa === "Nő") {
                  NoiSzekrenyDb += key.db;
              }
              /* console.log(key); */
          });
          /* console.log("Összes szekrény db: "+osszesSzekrenySzam);
      console.log("Férfi szekrény db: "+FerfiSzekrenyDb);
      console.log("Női szekrény db: "+NoiSzekrenyDb);
  
      console.log("Üres  db: "+üresSzam);
      console.log("Üres férfi db: "+üresSzamF);
      console.log("Üres női db: "+üresSzamN);
  
      console.log("Foglalt db: "+foglaltSzam);
      console.log("Foglalt férfi db: "+foglaltSzamF);
      console.log("Foglalt női db: "+foglaltSzamN);
  
      console.log("Rossz db: "+rosszSzam);
      console.log("Rossz férfi db: "+rosszSzamF);
      console.log("Rossz női db: "+rosszSzamN);
       */
          szekrenySzuresValasztas =
              '<option class="a" value="osszes"><p>' +
              "Összes szekrény (" +
              osszesSzekrenySzam +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=osszesN><p>" +
              "Összes női szekrény (" +
              NoiSzekrenyDb +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=osszesF><p>" +
              "Összes férfi szekrény (" +
              FerfiSzekrenyDb +
              ")" +
              "</p></option>";
  
          szekrenySzuresValasztas +=
              "<option value=Üres><p>" +
              "Üres szekrények (" +
              üresSzam +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=ÜresNő><p>" +
              "Üres női szekrények (" +
              üresSzamN +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=ÜresFérfi><p>" +
              "Üres férfi szekrények (" +
              üresSzamF +
              ")" +
              "</p></option>";
  
          szekrenySzuresValasztas +=
              "<option value=Foglalt><p>" +
              "Foglalt szekrények (" +
              foglaltSzam +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=FoglaltN><p>" +
              "Foglalt női szekrények (" +
              foglaltSzamN +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=FoglaltF><p>" +
              "Foglalt férfi szekrények (" +
              foglaltSzamF +
              ")" +
              "</p></option>";
  
          szekrenySzuresValasztas +=
              "<option value=Rossz><p>" +
              "Rossz szekrények (" +
              rosszSzam +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=RrosszN><p>" +
              "Rossz női szekrények (" +
              rosszSzamN +
              ")" +
              "</p></option>";
          szekrenySzuresValasztas +=
              "<option value=RrosszF><p>" +
              "Rossz férfi szekrények (" +
              rosszSzamF +
              ")" +
              "</p></option>";
          $(".szekrenyekValasztas").html(szekrenySzuresValasztas);
          $(".ferfiLetszam").html(üresSzamF); //férfi szabad hely db
          $(".noiiLetszam").html(üresSzamN); //női szabad hely db
          szekrenyekInformacioKuldes(); //oldal betöltésekor lefut
      }
  
      //-----------------------------------------------------------------------------------------------------------------------
      $(".szekrenyekValasztas").on("input", () => {
          //kiválasztunk egy szűrést akkor fut le
          szekrenyekInformacioKuldes();
      });
      function szekrenyekInformacioKuldes() {
          let apiVegpont = "/api/szekreny";
          apiVegpont += "?szuro=" + $(".szekrenyekValasztas").val();
          myAjax.adatbeolvas(apiVegpont, false, szekreny);
      }
      function szekreny(szekrenyek) {
          //szekrények táblába belerakja az adatokat
          console.log(szekrenyek);
          const szuloElem = $(".szekrenyek");
          const sablonElem = $("footer .szekreny ");
          sablonElem.show();
          szuloElem.empty();
          szekrenyek.forEach(function (elem) {
              let node = sablonElem.clone().appendTo(".szekrenyek");
              const obj = new Szekreny(node, elem);
              if (elem.ures_e === "Ü") {
                  obj.szekreny_feloldas.parent().hide();
                  $(node[0].children[0]).css("background-color", "green"); //adott szekrény circle divjének a háttérszín megváltoztatása
              } else if (elem.ures_e === "R") {
                  obj.szekreny_feloldas.parent().hide();
                  obj.szekreny_rosszCheckBox.attr("checked", true);
                  $(node[0].children[0]).css("background-color","rgb(105, 0, 0)"); //adott szekrény circle divjének a háttérszín megváltoztatása
              }
              /* if(elem.tipusa=== "Férfi"){//ha férfi szekrény akkor zöldes
          $(node[0]).css("background-color", "rgb(234, 255, 233)");
        }else if(elem.tipusa=== "Nő"){//ha női szekrény akkör rózsaszínes
          $(node[0]).css("background-color", "(255, 233, 250)");
        } */
          });
          sablonElem.hide();
          $("footer .szemely").hide();
      }
  
      //-------------------------------------------------------------------------------------------------------------------------
      $(window).on("rossz", (event) => {
          //ha rányomok a checkboxot akkor modositja az adatot
          console.log(event.detail.ures_e);
          if (event.detail.ures_e === "Ü") {
              szoveg = {
                  szekreny_id: event.detail.szekreny_id,
                  ures_e: "R",
                  tipusa: event.detail.tipusa,
              };
          } else if (event.detail.ures_e === "R") {
              szoveg = {
                  szekreny_id: event.detail.szekreny_id,
                  ures_e: "Ü",
                  tipusa: event.detail.tipusa,
              };
              
          }else if (event.detail.ures_e === "F") {
            szoveg = {
                szekreny_id: event.detail.szekreny_id,
                ures_e: "R",
                tipusa: event.detail.tipusa,
            };
          }
          console.log(event.detail.szekreny_id);
          apiVegpont = "api/szekreny";
          console.log(szoveg);
          myAjax.adatmodosit(apiVegpont, szoveg, event.detail.szekreny_id);
          window.location.reload();
      });
      //-------------------------------------------------------------------------------------------------------------------------
      $(window).on("felold", (event) => {//ha rányomok a feloldra modositja az adatot(feloldja a szekrényt)
          console.log(event.detail.szekreny_id);
          apiVegpont = "api/szekreny";
          szoveg = {
              szekreny_id: event.detail.szekreny_id,
              ures_e: "Ü",
              tipusa: event.detail.tipusa,
          };
          myAjax.adatmodosit(apiVegpont, szoveg, event.detail.szekreny_id);
          window.location.reload();
      });
      //-------------------------------------------------------------------------------------------------
      $(document).ready(function (e) {// személy kereső inputnál gépelek csak akkor fut le a SzemélyKeres metódus ha abbahagyom
          var timeout;
          var delay = 1000; // 1 másodperc
  
          $(".keresSzemely").on("input", () => {
              if (timeout) {
                  clearTimeout(timeout);
              }
              timeout = setTimeout(function () {
                  szemelyKeres();
              }, delay);
          });
      });
  
      function szemelyKeres() {//beolvassa az adatokat az adatbázisbol és átadja a  szemelyKeresoMegjelenit-metódusnak
          let tomb = [];
          let apiVegpont = "/api/szemelyLekerdezes";
          apiVegpont += "?name=" + $(".keresSzemely").val();
          if (!($(".keresSzemely").val() === "")) {
              // ha nincs semmise megadva az inputnak akkor ne fusson le
              myAjax.adatbeolvas(apiVegpont, tomb, szemelyKeresoMegjelenit);
          } else {
              $(".keresettSzemely ").empty();
          }
      }
      function szemelyKeresoMegjelenit(szemely) {//az oldalra létrehozza az adott adatokat
          //sablonelemet klónozza és ha nincs igazolványa létrehoz egy inputot
          console.log(szemely);
          const szuloElem = $(".keresettSzemely");
          const sablonElem = $("footer .szemely ");
          sablonElem.show();
          szuloElem.empty();
          szemely.forEach(function (elem) {
              let node = sablonElem.clone().appendTo(".keresettSzemely");
              const obj1 = new Szemely(node, elem); //példányosítja a személy osztályt
          });
          console.log(szemely);
          sablonElem.hide();
          if (szemely[0].igazolvany_szam === "" ||szemely[0].igazolvany_szam === "null") {
              $(".igazolvanySzama").html(
                  'Igazolvány száma: <input type="txt" placeholder="Igazolvány Száma" class="bekerIgazolvanySzam" />'
              );
              $(".igazolvanyTipusa").html(
                  'Igazolvány típusa: <select class="bekerIgazolvanyTipus"><option value="Rendőr">Rendőr</option><option value="Diák">Diák</option><option value="Felnőtt">Felnőtt</option></select>'
              );
              $(".felviszGomb").show();
              $(".fajlKivalaszt").show();
          } else {
              $(".felviszGomb").hide();
              $(".fajlKivalaszt").hide();
          }
          /* console.log($('profilkepe')); */
      }
      $(window).on("kivalasztFile", (event) => {//fájl kiválasztása
          /* console.log(event.detail.div.children()[6].src="kepek/SzemelyKepek/Sanyi.png"); */
          /* event.detail.div.children()[6]; */
          console.log(event.detail.div.children()[4].files);
          var file2 = event.detail.div.children()[4].files;
          if (file2.length > 0) {
              console.log("igen");
              var reader = new FileReader(file2);
              let div = event.detail.div.children()[6];
              reader.onload = function (event) {
                  console.log(div.src);
                  div.src = event.target.result;
              };
              reader.readAsDataURL(file2[0]);
          } else {
              event.detail.div.children()[6].src =
                  "kepek/SzemelyKepek/alap_ert.png";
          }
      });
      $(window).on("felviszAdat", (event) => {///ha rányomok a felviszre felviszi az igazolványát, képét
          apiVegpont = "api/feltoltes";
          $igazolvanySzam = $(".bekerIgazolvanySzam").val();
          $igazolvanyTipus = $(".bekerIgazolvanyTipus").val();
          formdata = new FormData();
          /* console.log(event.detail.div.children()[4].files[0]); */
          let $kepnev = event.detail.adat.name + "Kepe.png";
          event.detail.div.children()[4].files[0].name = $kepnev;
          formdata.append(
              "image",
              event.detail.div.children()[4].files[0],
              $kepnev
          );
          formdata.append("szemely_id", event.detail.adat.id);
          formdata.append("igazolvany_szam", $igazolvanySzam);
          formdata.append("igazolvany_tipusa", $igazolvanyTipus);
  
          /* console.log(formdata.getAll("image")[0]); */
          if (formdata) {
             myAjax.kepfeltolt(apiVegpont,formdata);
          } 
      });
      //-------------------------------------------------------------------------------------------------
      $(document).ready(function (e) {
          // Szekrény kereső inputnál gépelek csak akkor fut le a SzemélyKeres metódus ha abbahagyom
          var timeout;
          var delay = 1000; // 1 másodperc
  
          $(".keresSzekrenykulcs").on("input", () => {
              if (timeout) {
                  clearTimeout(timeout);
              }
              timeout = setTimeout(function () {
                  szekrenyKereso();
              }, delay);
          });
      });
  
      function szekrenyKereso() {
          let tomb = [];
          let apiVegpont = "/api/szekreny";
          apiVegpont += "?pontosSzekreny=" + $(".keresSzekrenykulcs").val();
          if (!($(".keresSzekrenykulcs").val() === "")) {
              // ha nincs semmise megadva az inputnak akkor ne fusson le
              myAjax.adatbeolvas(apiVegpont, tomb, szekrenyKeresoMegjelenit);
          } else {
              $(".keresettSzekreny ").empty();
          }
      }
      function szekrenyKeresoMegjelenit(tomb) {//kiiratja a keresett szekrényt a klónozott szekrény osztályból
          const sablonElem = $("footer .szekreny ");
          sablonElem.show();
          $(".keresettSzekreny").empty();
          tomb.forEach(function (elem) {
              let node = sablonElem.clone().appendTo(".keresettSzekreny");
              const obj = new Szekreny(node, elem);
              if (elem.ures_e === "Ü") {
                  obj.szekreny_feloldas.parent().hide();
              } else if (elem.ures_e === "R") {
                  obj.szekreny_feloldas.parent().hide();
                  obj.szekreny_rosszCheckBox.attr("checked", true);
              }
          });
          sablonElem.hide();
          $(".keresettSzekreny .szama").prepend("Szekrény száma: ");
          $(".keresettSzekreny .neme").prepend("Tulajdonsága: ");
          $(".keresettSzekreny .uresE").prepend("Állapota: ");
          $(".keresettSzekreny .hibasGomb").parent().prepend("Funkció: ");
          $(".feloldasGomb").on("click", (event) => {
              let id = $(event.target).attr("data-id");
              szekrenyemben.katt(tomb[0].szekreny_id, "kattint", "Ü");
          });
          $(".hibasGomb").on("change", (event) => {
              //adott szekrény
              if (event.target.checked === true) {
                  szekrenyemben.katt(szekreny_id, "kattint", "R");
              } else {
                  szekrenyemben.katt(szekreny_id, "kattint", "Ü");
              }
          });
      }
      $(".osszesFeloldasGomb").on("click", () => {
          //összes szekrény feloldása
          apiVegpont = "/api/szekrenyOsszesFelold";
          myAjax.adatkuldes(apiVegpont);
          window.location.reload();
      });
      //-------------------------------------------------------------------------------------------------
  });
  