



function capacidad_datos() {
    $("#capacidad").load("capacidad_datos");
    setTimeout(capacidad_datos, 2000);
};

function numero_canales(){
    $("#canales").load("numero_canales");
    setTimeout(numero_canales,2000); //2 segundos
}

function numero_sensores(){
    $("#sensores").load("numero_sensores");
    setTimeout(numero_sensores,2000); //2 segundos
}


function numero_usuario(){
    $("#usuarios").load("numero_usuarios");
    setTimeout(numero_usuario,2000); //2 segundos
}



