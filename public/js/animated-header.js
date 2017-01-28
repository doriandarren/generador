$(document).ready(function () {
    
    $('img').on("click",function(e){
        
        var imagen = $(this); 
        var url = imagen.attr("src");
        imagen.removeAttr("width"); // quitamos el atributo width 
        imagen.removeAttr("height"); // quitamos el atributo height        
        
        alert("Ancho: " + imagen.width() + "Alto" + imagen.height()+ " Url:"+url);
        e.stopPropagation();
    });
    
});















/*
$(document).ready(function(){
  $(window).bind('scroll', function() {
    var navHeight = 50; // custom nav height
    ($(window).scrollTop() > navHeight) ? $('nav').addClass('navbar-shrink') : $('nav').removeClass('navbar-shrink');
  });
});

(function ($) {
  $(document).ready(function(){
 
    // hide .navbar first
    $(".navbar").hide();
 
    // fade in .navbar
    $(function () {
        $(window).scroll(function () {
            // set distance user needs to scroll before we fadeIn navbar
            if ($(this).scrollTop() > 100) {
                $('.navbar').fadeIn();
            } else {
                $('.navbar').fadeOut();
            }
        });

 
    });

});
  }(jQuery));*/