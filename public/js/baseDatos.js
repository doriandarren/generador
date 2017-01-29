$( function() {    
    
    var res = buscar();
    
    $( "#nombre_tabla" ).autocomplete({
        source: res
    });
  } );

function buscar(){
    var availableTags;
    $.ajax({
        type: "POST",
        /*dataType: "json",*/
        url: baseurl + "Generador/listar_bd/",
        data: {bus_bd: "bd"},
        //data: {name: user_name, pwd: password},
        success: function (data) {
            alert(data);
            availableTags=data;
            /*$("#res").html(data);*/
        },
        error: function (data) {
            $("#res").html(data.responseText);
            /*alert('Error: ' + data.responseText);*/
        }
    });
    return availableTags;
}