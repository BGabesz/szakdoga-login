class Szekreny {
  constructor(node,adat)  {
    this.node = node;
    this.adat = adat;
    this.syekreny_szama = this.node.children().children(".szama");
    this.syekreny_szama.text(adat.szekreny_id);

    this.szekreny_neme = this.node.children().children(".neme");
    this.szekreny_neme.text(adat.tipusa);

    this.szekreny_uresE = this.node.children().children(".uresE");
    if(adat.ures_e==="Ü"){
      this.szekreny_uresE.text("Üres").css("color", "green");
    }else if(adat.ures_e==="R"){
      this.szekreny_uresE.text("Rossz!").css("color", "rgb(105, 0, 0)");
    }else if(adat.ures_e==="F"){
      this.szekreny_uresE.text("Foglalt").css("color", "orange");
    }
    this.szekreny_feloldas = this.node.children().children().children(".feloldasGomb");
    this.szekreny_feloldas.on("click ", () => {
      this.kattintasTrigger("felold");
    });

    this.szekreny_rosszCheckBox = this.node.children().children().children(".hibasGomb");
    this.szekreny_rosszCheckBox.on("input ", () => {
      this.kattintasTrigger("rossz");
    });
  }
  kattintasTrigger(esemenyneve) {// A főablakhoz adom az eseményt,
    let esemeny = new CustomEvent(esemenyneve, {
        detail: this.adat,//ezzel adatokat tudok átadni
    });
    window.dispatchEvent(esemeny);
    //Az eseményt majd a script.js-ben el tudom kapni.
  }
}
