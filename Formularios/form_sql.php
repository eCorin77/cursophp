<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$baseDeDatos = "prueba";

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
            <input type="text" name="correo" placeholder="correo">
            <select type="text" name="gen" placeholder="genero">
                <option value="varon">Varón</option>
                <option value="mujer">Mujer</option>
                <option value="nn">Prefiero no decirlo</option>
            </select>

            <input type="submit" name="registro">
            <input type="reset">

        </form>


       
        
        <!-- <script src="" async defer></script> -->
    </body>
</html>

<?php
    if(isset($_POST["registro"])){
        $nombre = $_POST["nombre"];
        $correo = $_POST["correo"];
        $gen = $_POST["gen"];

        $insertarDatos = "INSERT INTO datos VALUES('$nombre','$correo','$gen','')";
        $ejecutarInsertar = mysqli_query($enlace, $insertarDatos);

        echo "<br>";
        echo "Se registró usuario: {$nombre} <br>";
        echo  "Correo electronico: {$correo} <br>";


    }
?>