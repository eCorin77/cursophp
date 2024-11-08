<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
function conectardb($db){
    global $servidor, $usuario, $clave;
    
    $enlace = mysqli_connect($servidor, $usuario, $clave, $db);
    
    if (!$enlace) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }
    
    return $enlace; 
}

function desconectar($enlace){
    mysqli_close($enlace);  
}

?>
