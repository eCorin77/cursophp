<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$enlace = null; // Variable para la conexión

// Función para conectar a la base de datos
function conectardb($db){
    global $servidor, $usuario, $clave;
    
    $enlace = mysqli_connect($servidor, $usuario, $clave, $db);
    
    if (!$enlace) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }
    
    return $enlace; 
}

// Función para desconectar la base de datos
function desconectar($enlace){
    mysqli_close($enlace);  
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Prueba de Conexión a la Base de Datos</title>
</head>
<body>

<h1>Conectar y Desconectar de la Base de Datos</h1>

<?php
// Acciones de los botones
if (isset($_POST['conectar'])) {
    // Probar conexión
    $enlace = conectardb("empanadas"); // Aquí "clientes" es el nombre de la base de datos
    echo "<p>Conexión exitosa a la base de datos 'clientes'.</p>";
}

if (isset($_POST['desconectar']) && $enlace) {
    // Desconectar si hay una conexión
    desconectar($enlace);
    echo "<p>Conexión cerrada.</p>";
}
?>

<!-- Formulario HTML con botones para probar conexión y desconectar -->
<form method="post">
    <input type="submit" name="conectar" value="Probar Conexión">
    <input type="submit" name="desconectar" value="Desconectar" <?php echo !$enlace ? 'disabled' : ''; ?>>
</form>

</body>
</html>
