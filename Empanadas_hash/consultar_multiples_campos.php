<form method="POST" action="buscar.php">
    <label for="campo1">Campo 1:</label>
    <input type="text" name="campo1" id="campo1">
    
    <label for="campo2">Campo 2:</label>
    <input type="text" name="campo2" id="campo2">
    
    <label for="campo3">Campo 3:</label>
    <input type="text" name="campo3" id="campo3">
    
    <label for="campo4">Campo 4:</label>
    <input type="text" name="campo4" id="campo4">
    
    <label for="campo5">Campo 5:</label>
    <input type="text" name="campo5" id="campo5">
    
    <label for="campo6">Campo 6:</label>
    <input type="text" name="campo6" id="campo6">
    
    <label for="campo7">Campo 7:</label>
    <input type="text" name="campo7" id="campo7">
    
    <button type="submit">Buscar</button>
</form>


<?php
// Conectar a la base de datos
$mysqli = new mysqli("localhost", "usuario", "contraseña", "basededatos");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Inicializar la consulta básica
$sql = "SELECT * FROM tabla WHERE 1=1"; // 1=1 para facilitar la construcción de la consulta

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
    $sql .= " AND (" . implode(" OR ", $searchConditions) . ")";
}

// Preparar la consulta
$stmt = $mysqli->prepare($sql);

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
    while ($row = $result->fetch_assoc()) {
        echo "Resultado: " . implode(", ", $row) . "<br>";
    }
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$stmt->close();
$mysqli->close();
?>
