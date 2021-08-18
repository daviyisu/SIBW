function mostrarEventos(eventos){
    $("#listaEventos").fadeIn();
    $("#listaEventos").html(eventos);
}

function hide(){
    $("#listaEventos").display === "none";
}

function eventoOnInput() {
    var busqueda = $(this).val();
    var id = document.getElementById("id").value;
    

    if(busqueda.length > 1){   //Limitamos que se haga la búsqueda solo cuando hay más de dos caracteres
        opcionesAjax = {
            url: "busqueda.php",
            method: "post",
            data: {busqueda: busqueda, id: id},
            success: mostrarEventos
        };
        $.ajax(opcionesAjax);
    }
    else{
        hide();
    }
    
}

function cargarEventos() {
    $('#evento').keyup(eventoOnInput);

   
}

$(document).ready(cargarEventos);