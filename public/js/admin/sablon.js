class Kartya {
  constructor(elem, adat, elemnev) {
    this.elem = elem;
   
   
    elemnev.forEach((element) => {
      this[element] = this.elem.children("." + element);
      // console.log( this[element] );
    });

    this.adat = adat;
    
    this.termekTorles = this.elem.children(".torol");
    this.termekModosit = this.elem.children(".modosit");
    this.setAdatok(adat, elemnev);
    this.termekTorles.on("click ", ()=> {
      // this.kattintasTrigger("torol");
      this.torol();
      //console.log("torlés");
    });
    this.termekModosit.on("click ", ()=>{
      // this.kattintasTrigger("modosit");
      this.modosit();
      //console.log("modosit");
    });
  }

  setAdatok(ertekek, elemnev) {
    
    elemnev.forEach((element) => {
      this[element].html(ertekek[element]);
    });
  }
  

  torol() {
    let esemeny = new CustomEvent("torol", { detail: this.adat });
    window.dispatchEvent(esemeny);
    console.log("bent vagyokk azéterben ");
  }
  modosit() {
    let esemeny = new CustomEvent("modosit", { detail: this.adat });
    window.dispatchEvent(esemeny);
    console.log("bent vagyokk azéterben ");
  }
}
