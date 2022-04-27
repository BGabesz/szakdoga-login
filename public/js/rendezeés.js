class AdminRend{
  
    constructor(){
      
     
    };
    
   keresoMezo(termek,Oszlopneve) {
    

    megjelenit=0;
       // keres= "?q=" + $("#keresSzoveg").val();
        queryParams.set("q",$("#keresSzoveg").val());
       
        
    
        adatMeg.apiOsszealitas(termek,Oszlopneve);
   };
       
   


    
      

    rendezesTabla(termek,Oszlopneve){
      let darabolas = $("#rendezes").val();
      let vegtemek = darabolas.split("!");

         queryParams.set("_sort",vegtemek[0])
         queryParams.set("_order",vegtemek[1])
          
          adatMeg.apiOsszealitas(termek,Oszlopneve);
           
    }

    rendezoMezoLetreHozas(nev){
        let txt="";
        $("#rendezes").empty();
        
        nev.forEach(element => {
            txt+='<option id="'+element+'Asc" value="'+element+'!asc">'+element+' szerint emelkedő</option>';
            txt+='<option id="'+element+'Desc" value="'+element+'!desc">'+element+' szerint csökkenő </option>';
        });
        $("#rendezes").append(txt);

    
    };
    elemMegjelenit(termekek, tomb) {
      
      rend.oldalakSzama(termekek ,tomb);
      const szuloElem = $(".elemek");
      const sablonElem = $(".elem");
      //  myAjax.getjson("alapnevek.json", tomb);
  
      szuloElem.empty();
     
      if(megjelenit>=termekek.length){
          
         megjelenit=megjelenit-parseInt($("#listaz").val());
      };
      termekek.forEach(function (elem, index) {
          if (
              (megjelenit <= index) &
              (megjelenit + parseInt($("#listaz").val()) > index)
          ) {
              let node = sablonElem.clone().appendTo(szuloElem);
              const obj = new Kartya(node, elem, tomb);
          }
      });
      sablonElem.hide(); //sablonelem eltávolítása
  }


    oldalakSzama(mindenadat,Oszlopnev){
        let txt="";
       
        let adathoszz=mindenadat.length ;
          $("#navig").empty();
          
      for (let index = 0; index <adathoszz / $("#listaz").val(); index++) {
          $("#navig").append(' <button class="oldal"  id='+index+'>'+index+'</button>');
          $('#'+index+'').on("click", function() {
            oldalValt(index,mindenadat ,Oszlopnev);
              
             });
      }
    }
   

     
    

} 
function oldalValt(ertek,mindenadat,Oszlopnev){
    megjelenit=($("#listaz").val()*ertek)
    
    
    adatMeg.apiOsszealitas(mindenadat,Oszlopnev);
  
  }