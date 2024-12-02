<?php

include "conexiondb.php";

$enlace = conectardb("empanadas");

$result = $enlace->query("SELECT * FROM clientes_hash");

$cant_encontrados = mysqli_num_rows($result);

echo "Cantidad de resultados: $cant_encontrados <br>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Nombre: " . $row["nombre"] ."  -  email: ".$row["correo"]. "<br>";
    }
} else {
    echo "0 results found.";
}



desconectar($enlace);
?>