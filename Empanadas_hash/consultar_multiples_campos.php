<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Consultar Multiples Campos</title>
    <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
</head>

    <form method="POST" action="consultar_multiples_campos.php">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo">
        
        <!-- <label for="campo3">Campo 3:</label>
        <input type="text" name="campo3" id="campo3">
        
        <label for="campo4">Campo 4:</label>
        <input type="text" name="campo4" id="campo4">
        
        <label for="campo5">Campo 5:</label>
        <input type="text" name="campo5" id="campo5">
        
        <label for="campo6">Campo 6:</label>
        <input type="text" name="campo6" id="campo6">
        
        <label for="campo7">Campo 7:</label>
        <input type="text" name="campo7" id="campo7"> -->
        
        <button type="submit">Buscar</button>
    </form>
</html>

<?php
include "conexiondb.php";

$enlace = conectardb("empanadas");

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
    $enlace = conectardb("empanadas");

    // Verificar la conexión
    if ($enlace->connect_error) {
        die("Error de conexión: " . $enlace->connect_error);
    }

    // Inicializar la consulta básica
    $query = "SELECT * FROM clientes_hash WHERE 1=1"; // 1=1 para facilitar la construcción de la consulta

    // Array para almacenar los valores de los parámetros de búsqueda
    $params = array();

    // Array para almacenar las condiciones de búsqueda
    $searchConditions = [];

    // Iterar sobre todos los campos de $_POST
    foreach ($_POST as $campo => $valor) {
        // Verificar si el campo tiene valor (no está vacío)
        if (!empty($valor)) {
            // Agregar la condición de búsqueda con LIKE
            $searchConditions[] = "$campo LIKE ?";
            $params[] = "%" . $valor . "%";  // `%` para coincidencias parciales
        }
    }

    // Si se definieron condiciones de búsqueda, agrégalas a la consulta
    if (count($searchConditions) > 0) {
        $query .= " AND (" . implode(" AND ", $searchConditions) . ")";
    

        // Preparar la consulta
        $stmt = $enlace->prepare($query);

        // Vincular los parámetros a la consulta preparada si los hay
        if (!empty($params)) {
            $types = str_repeat('s', count($params)); // 's' para cada string
            $stmt->bind_param($types, ...$params);
        }

        // Ejecutar la consulta
        $stmt->execute();
        $result = $stmt->get_result();

        // Mostrar los resultados
        if ($result->num_rows > 0) {
            
            echo "<br>Resultados: "."$result->num_rows <br><br>";
            echo "
                <table style='width: 50%; border-collapse: collapse; border: 1px solid black;'>
                <tr>
                    <td width=\"30px\" style='padding-left:10px; border: 1px solid black;'><b><center>Id</center></b></td>
                    <td width=\"300px\" style='padding-left:10px; border: 1px solid black;'><b><center>Nombre</center></b></td>
                    <td width=\"400px\" style='padding-left:10px; border: 1px solid black;'><b><center>Correo electrónico</center></b></td>
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
            echo "No se encontraron resultados.";
        }

        // Cerrar la conexión
        $stmt->close();
    } else {
        // Mostrar mensaje si no se ingresaron criterios de búsqueda
        echo "Por favor, ingrese al menos un criterio de búsqueda.";
    }
    desconectar($enlace);
}
?>
