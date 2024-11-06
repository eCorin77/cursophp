<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "trabajadores";

$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos)


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Form con SQL</title>
        <!-- <link rel="stylesheet" href=""> -->
    </head>
    <body>
        <form action="#" name="prueba" method="post">
            <input type="text" name="nombre" placeholder="nombre">
            <input type="text" name="password" placeholder="password">
            
            <input type="submit" name="registro">
            <input type="reset">
        </form>

    </body>
</html>

<?php
    if(isset($_POST["registro"])){
        $nombre = $_POST["nombre"];
        $password = $_POST["password"];

        $insertarDatos = "INSERT INTO `datos`(`nombre`, `mail`) VALUES ('$nombre','$password')";
        $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);
        
        if($ejecutarInsertar){
            echo "<br>";
            echo "Se registró usuario: {$nombre} <br>";
            echo  "password electronico: {$password} <br>";
        }else{
            echo "<br>";
            echo "Error al Conectar";
        }

        mysqli_close($enlace);
    }
?>