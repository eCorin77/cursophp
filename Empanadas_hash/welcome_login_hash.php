<?php
// Incluir la conexión a la base de datos
include 'conexiondb.php';

// Recuperar los valores del formulario
$user = $_REQUEST["user"];
$password_ingresado = $_REQUEST["password"];

// Función para validar el usuario y la contraseña
function validateUser($user, $password_ingresado) {
    global $enlace;

    // Prevenir inyecciones SQL usando mysqli_real_escape_string
    $user = mysqli_real_escape_string($enlace, $user);
    $password_ingresado = mysqli_real_escape_string($enlace, $password_ingresado);

    // Consulta para buscar el usuario por nombre o correo
    $query = "SELECT * FROM clientes_hash WHERE nombre = '$user' OR correo = '$user'";
    $result = mysqli_query($enlace, $query);

    if (mysqli_num_rows($result) > 0) {
        // Si el usuario existe, verificamos la contraseña
        $row = mysqli_fetch_assoc($result);
        $hashed_pass_saved = $row['password'];

        // Compara las contraseñas (sin cifrar)
        if (password_verify($password_ingresado, $hashed_pass_saved)) {
            return true; // Contraseña correcta
        } else {
            return false; // Contraseña incorrecta
        }
    } else {
        return false; // Usuario no encontrado
    }
}

// Conectar a la base de datos
$enlace = conectardb("empanadas");

// Validar el usuario y la contraseña
if (validateUser($user, $password_ingresado)) {
    echo "<h1>Bienvenido, $user!</h1>";
    echo '<a href="menu.php"><button>Ir al menu</button></a>';
} else {
    echo "<h1>Usuario o contraseña incorrectos</h1>";
    echo '<a href="log_in_cliente.html"><button>Volver</button></a>';
}

// Desconectar de la base de datos
desconectar($enlace);
?>
