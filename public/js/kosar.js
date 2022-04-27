class Kosar {
    constructor() {
        if ((typeof (Storage) !== "undefined")) {
            this.kosar = [];
            let teliKosar = JSON.parse(localStorage.getItem("kosarban"));
            for (let elem in teliKosar) {
                this.kosar.push(teliKosar[elem]);
                this.megjelenit();
            }
        } else {
            this.kosar = [];
        }
    }

    getKosar() {
        for (const elem in this.kosar) {
            $("#kosar").append(this.kosar[elem]);
        }
    }

    setKoarhozAdd(elem) {
        this.kosar.push(elem);
        this.megjelenit();
        localStorage.setItem("kosarban", JSON.stringify(this.kosar));
    }

    megjelenit() {
        let tartalom = 0;
        let darabszam = 1;
        $("#kosar").empty();
        $("#kosar").append("<table>");
        let elem = "<tr id='fejlec'><th>Típus:</th><th>Ídőtaram(nap):</th><th>Ár(Forint):</th><th>Darabszám:</th></tr>";
        this.kosar.forEach((value, index) => {
            console.log(value);
            for (let item in value) {
                if (item === "megnevezes" || item === "idotartam_nap" || item === "ar" ){
                    elem += "<td>" + value[item] + "</td>";}
                tartalom++;
            }
            elem += "<td>" + darabszam + "</td>"; 
            elem += "<td>" + "<button class='torol' data-id='" + index + "'>Töröl</button>" + "</td>";
            elem += "</tr>";
        });

        $("table").append(elem);
        $(".torol").on("click", (event) => {
            let aktTermek = $(event.target).attr("data-id");
            this.kosar.splice(aktTermek, 1);
            localStorage.setItem("kosarban", JSON.stringify(this.kosar));
            this.megjelenit();
            tartalom--;
            if (this.kosar.length == 0) {
                $("#kosar").empty();
                localStorage.removeItem("kosarban");
            }
        });
    }
}