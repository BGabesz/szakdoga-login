$(function () {

    const myajax = new MyAjax();
    const berletek = [];
    const kisKosar = new Kosar();
    let apiVegpont = "/api/berletTipus";

    myajax.adatbeolvasEredeti(apiVegpont, berletek, berletekMegjelenitese);

    function berletekMegjelenitese(){
        const szuloElem = $("#taroloSzulo");
        const sablon = $("footer .taroloGyerek");
        szuloElem.empty();
        sablon.show();
        berletek.forEach(function(elem, index) {
            const berlet = sablon.clone().appendTo(szuloElem);
            const beolvasottGep = new Berlet(berlet, elem, index); 
        });
        sablon.hide();
    }

    
    $(".osszegzes").on("click", function(){
        let szamla = window.open(/*URL, name, specs, replace*/
            "", 
            "Szamla",
            "toolbar=yes, scrollbars=yes, resizeable=yes, top=50%, left=50%, width=600, height=600",
            ""
        );
        szamla.document.write("<main style='max-width:600px; width:100%; margin:auto;'>");
        szamla.document.write("<h1>Számla:</h1>");
        let localkosar = [];
        let kosarka = JSON.parse(localStorage.getItem("kosarban"));
        for (let elem in kosarka) {
            localkosar.push(kosarka[elem]);
        }  

        console.log(localkosar);
        szamla.document.write(
            "<div style='max-width:600px; width:100%; margin:auto;'>"+
            "<table>"+
            "<tr id='fejlec'><th>Típus:</th><th>Ídőtaram(nap):</th><th>Ár(Forint):</th><th>Darabszám:</th></tr>"
        );

        for (let index = 0; index < localkosar.length; index++) {
            szamla.document.write(
            "<tr>"+
                "<th>"+localkosar[index].megnevezes+"</th>"+
                "<th>"+localkosar[index].idotartam_nap+"</th>"+
                "<th>"+localkosar[index].ar+"</th>"+
                "<th>1</th>"+
            "</tr>"
            );
        }

        let osszeg=0;
        for (let index = 0; index < localkosar.length; index++) {
            osszeg+=localkosar[index].ar;
        }

        szamla.document.write("</table></div><br>");
        szamla.document.write("<p>Végösszeg: "+ osszeg + " Ft<p><br><br>");
        szamla.document.write("<input onclick='window.close();' type='button' value='Fizetés' class='bezaras'>");
        szamla.document.write("</main>");


    });

    

    $(window).on("kosarhozad", (esemeny) => {
        let aktTermek = esemeny.detail;
        kisKosar.setKoarhozAdd(aktTermek);
    });

});