



$(document).ready(function(){
    
    
    $( "#canvas" ).animate({ "left": "+=250px" }, "slow" );
    $( "#canvas" ).animate({ "rigth": "-=250px" }, "slow" );
    $( "#canvas" ).animate({ "top": "+=250px" }, "slow" );


    $( "#canvas" ).focus(function(e){
        e.preventDefault();
    });
});

