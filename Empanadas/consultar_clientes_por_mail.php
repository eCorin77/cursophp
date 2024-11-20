<?php

if (isset($_POST['dom_mail'])) {
    // Recoge el dominio del correo introducido
    $dom_mail = $_POST['dom_mail'];

    // Incluye la conexión a la base de datos
    include "conexiondb.php";
    
    // Conectamos a la base de datos
    $enlace = conectardb("empanadas");
    
    // Sanitizar el valor del dominio del correo (esto previene inyecciones SQL)
    //$dom_mail = $enlace->real_escape_string($dom_mail);                                          sin esto funciona igual
    
    // Realiza la consulta SQL para filtrar por el dominio del correo
    $query = "SELECT * FROM clientes WHERE correo LIKE '%$dom_mail%'";
    $result = $enlace->query($query);
    
    // Contamos los resultados encontrados
    $cant_encontrados = mysqli_num_rows($result);

    // Mostrar cantidad de resultados
    echo "<h2 style='margin-left: 10%;'>Consulta de Clientes</h2>";
    echo "<br>Cantidad de resultados: $cant_encontrados <br><br>";

    // Si se encuentran resultados, mostrar la tabla
    if ($result->num_rows > 0) {
        echo "
            <table style='width: 50%; border-collapse: collapse; border: 1px solid black;'>
              <tr>
                <td width=\"30px\" style='padding-left:10px; border: 1px solid black;'><b><center>Id</center></b></td>
                <td width=\"300px\" style='padding-left:10px; border: 1px solid black;'><b><center>Nombre</center></b></td>
                <td width=\"400px\" style='padding-left:10px; border: 1px solid black;'><b><center>Email</center></b></td>
              </tr>";
        // Mostrar los resultados
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['id']."</td>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['nombre']."</td>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['correo']."</td>
              </tr>";
        }
        echo  "</table>";
    } else {
        echo "0 resultados para ese dominio de mail.";
    }
    
    // Desconectar la base de datos
    desconectar($enlace);
}

?>
