<?php

include "conexiondb.php";

$enlace = conectardb("empanadas");

$result = $enlace->query("SELECT * FROM clientes");

$cant_encontrados = mysqli_num_rows($result);

echo "<h2 style='margin-left: 10%;'>Consulta de Clientes</h2>";
echo "<br>Cantidad de resultados: $cant_encontrados <br><br>";



if ($result->num_rows > 0) {
    // while ($row = $result->fetch_assoc()) {
        // echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre"] ."  -  email: ".$row["correo"]. "<br>";
        echo "
            <table style='width: 50%; border-collapse: collapse; border: 1px solid black;'>
              <tr>
                <td width=\"30px\" style='padding-left:10px; border: 1px solid black;'><b><center>Id</center></b></td>
                <td width=\"300px\" style='padding-left:10px; border: 1px solid black;'><b><center>Nombre</center></b></td>
                <td width=\"400px\" style='padding-left:10px; border: 1px solid black;'><b><center>email</center></b></td>
                
              </tr>";
               while ($row = $result->fetch_assoc()) { 
             echo "<tr>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['id']."</td>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['nombre']."</td>
                <td style='padding-left:10px; border: 1px solid black;'>".$row['correo']."</td>
                
              </tr>";
          
    }
    echo  "</table>";
} else {
    echo " 0 resultados encontrados.";
}



desconectar($enlace);
?>