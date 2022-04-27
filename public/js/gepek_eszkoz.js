class Gep{
    constructor(node, adat, index){
        this.node = node;
        this.cim = this.node.children(".cim");
        this.kep = this.node.children(".kep");
        this.leiras = this.node.children(".leiras");
        this.adat = adat;
        this.adat.index = index;
        this.setGepAdatok(this.adat);
    };

    setGepAdatok(ertek){
        this.cim.html(ertek.eszkoz_neve);
        this.kep.attr("src", ertek.kep);
        this.leiras.html(ertek.leiras);
    };

}