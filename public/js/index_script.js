$(function(){
    $("main").scroll(console.log("szia"));

    function gorgetes(){
        console.log("szia");
        $("main").css("grid-template-areas:","'n n n n n n''h h h h h h''s a a a a a''f f f f f f'");
    }
});


$(window).resize(function () {
    if ($(this).width() < 850) {
        $("nav ul li").css("visibility: hidden;")
        $("nav ul li:first").css("visibility: none;")
    } else { 
        $("nav ul li").on("click", function(){
            $("nav ul li").css("visibility: none;");
        });
    }
  });

