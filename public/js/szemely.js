class Szemely{
    constructor(node,adat)  {
        this.node = node;
        this.adat = adat;
        this.neve = this.node.children(".neve");
        this.neve.text("Neve: "+adat.name);

        this.neme = this.node.children(".neme");
        this.neme.text("Neme: "+adat.neme);

        this.igazolvanySzam = this.node.children(".igazolvanySzama");
        this.igazolvanySzam.text("Igazolvány száma: "+adat.igazolvany_szam);

        this.igazolvanyTipus = this.node.children(".igazolvanyTipusa");
        this.igazolvanyTipus.text("Igazolvány típusa: "+adat.igazolvany_tipusa);

        this.felvisz = this.node.children(".felviszGomb");
        this.felvisz.on("click ", () => {
            this.kattintasTrigger("felviszAdat");
        });

        this.fajlKivalaszt = this.node.children(".fajlKivalaszt");
        this.fajlKivalaszt.on("change ", () => {
            this.kattintasTrigger("kivalasztFile");
        });

        this.email = this.node.children(".email");
        this.email.text("E-mail címe: "+adat.email);

        this.kep = this.node.children(".szemelyKep");/* adat.kep+".jpg" */
        this.kep.attr("src","kepek/SzemelyKepek/"+adat.kep);/* +".png" */

        this.berlet = this.node.children(".berlete");
        console.log(adat);
        
        if(adat.MegMeddigJo){
            this.berlet.text("Bérlete: "+adat.MegMeddigJo+"napig jó");
        }else{
            this.berlet.text("Bérlete: NINCS!").css("color", "red");
        }
    }
    kattintasTrigger(esemenyneve) {// A főablakhoz adom az eseményt,
        let esemeny = new CustomEvent(esemenyneve, {
            detail: {
                adat: this.adat,
                div:this.node
            }
            /* detail: this.adat,//ezzel adatokat tudok átadni */
        });
        window.dispatchEvent(esemeny);
        //Az eseményt majd a script.js-ben el tudom kapni.
      }
}