class Berlet {
    constructor(node, elem, index) {
        this.node = node;
        this.cim = this.node.children(".cim");
        this.leiras = this.node.children(".leiras");
        this.ar = this.node.children(".ar");
        this.elem = elem;
        this.elem.index = index;
        this.setBerletAdatok(this.elem);
        this.node.children(".hozzaAd").on("click", () => {
            this.KattintasTrigger();
        });
    };
    KattintasTrigger() {
        let esemeny = new CustomEvent("kosarhozad", { detail: this.elem });
        window.dispatchEvent(esemeny);
    }

    setBerletAdatok(ertek){
        this.cim.html(ertek.megnevezes);
        this.leiras.html(ertek.idotartam_nap);
        this.ar.html(ertek.ar+" Ft");
    }
}
