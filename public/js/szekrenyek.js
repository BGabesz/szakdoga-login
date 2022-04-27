class Szekrenyek {
    constructor(tomb) {
        this.szekrenyTomb = tomb;
    }
    getTomb(tomb) {
        console.log(tomb);
    }
    getSzabadHelySzam(tomb, nem) {
        let db = 0;
        for (let index = 0; index < tomb.length; index++) {
            if (
                tomb[index].ures_e == "Ü" &&
                !(tomb[index].ures_e == "R") &&
                tomb[index].tipusa == nem
            ) {
                db++;
            }
        }
        return db;
    }
    kattintasTrigger(esemenyneve) {// A főablakhoz adom az eseményt,
      let esemeny = new CustomEvent(esemenyneve, {
          detail: this.adat,//ezzel adatokat tudok átadni
      });
      window.dispatchEvent(esemeny);
      //Az eseményt majd a script.js-ben el tudom kapni.
    }
    megjelenit(tomb, hova) {
        let fejléc ='<table class="szekrenyekTabla"><thead><tr class="cim"> <th>Szekrény szám</th> <th>Neme</th> <th>Üres-e</th> <th><button type="submit" class="osszesFeloldasGomb">Összes felold</button></th> <th></th> </tr></thead>';
        let txt=fejléc+'';
        for (let index = 0; index < tomb.length; index++) {
          txt+='<tr class="tablaadat0"></tr>'
        }
        txt += '</table>';
  
        $(hova).html(txt);
  
        $(".osszesFeloldasGomb").on("click", () => {
                this.kattintasTrigger("osszesFelold");
        });
    }
  }
  