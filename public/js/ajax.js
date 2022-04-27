class MyAjax {
  constructor() {}

  KattintasTrigger() {
    let esemeny = new CustomEvent("sorszam", { detail: this.id });
    window.dispatchEv
    ent(esemeny);
  }
  adatBeolvasasElore(api,tombe,adat){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function () {
      tombe = JSON.parse(this.responseText)[adat];
    };
    xhttp.open("GET", api, false);
    xhttp.send();
    return tombe
  }

  adatbeolvasEredeti(faljnev, tomb, myCallback, seged=false) {
    tomb.splice(0, tomb.length);
     $.ajax({
       url: faljnev,
       type: "GET",
       success: function (result) {
         result.forEach((value) => {
           tomb.push(value);
         });
         if (seged === false) {
           myCallback(tomb);
         } else {
           myCallback(tomb, seged);
         }
         //console.log(tomb);
       },
     });
   }
  
  adatbeolvas(faljnev, tomb, myCallback, seged=false) {
   tomb=[];
    $.ajax({
      url: faljnev,
      type: "GET",
      success: function (result) {
        result.forEach((value) => {
          tomb.push(value);
        });
        if (seged === false) {
          myCallback(tomb);
        } else {
          myCallback(tomb, seged);
        }
        //console.log(tomb);
      },
    });
  }

  adatkuldes(faljnev, adat) {
    $.ajax({
      url: faljnev,
      type: "POST",
      data: adat,
      success: function (result) {
        console.log(result);
      },
      //console.log(tomb);
    });
  }

  adattorles(faljnev, id) {
    $.ajax({
      url: faljnev + "/" + id,
      type: "DELETE",
      success: function (result) {
        console.log(result);
      },
      //console.log(tomb);
    });
  }

  adatmodosit(faljnev, adat, id) {
    $.ajax({
      url: faljnev + "/" + id,
      type: "PUT",
      data: adat,
      success: function (result) {
        console.log(result);
      },
      //console.log(tomb);
    });
  }
  kepfeltolt(apiVegpont,formdata){
    $.ajax({
      url: apiVegpont,
      method: "post",
      data: formdata,
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data);
      },
  });
  }
}
