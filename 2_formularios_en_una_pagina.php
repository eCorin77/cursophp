<?php
// Iniciar sesión para almacenar datos entre peticiones
session_start();

// Variable para almacenar el mensaje a mostrar
$mensaje = '';

// Procesamos los datos cuando se envíe el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Limpiar los datos recibidos
    $nombre = isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) : '';

    // Si se envió el formulario 1
    if (isset($_POST['formulario_1']) && $nombre) {
        $mensaje = "Formulario 1 enviado. Nombre: $nombre";
    }

    // Si se envió el formulario 2
    if (isset($_POST['formulario_2']) && $email) {
        $mensaje = "Formulario 2 enviado. Correo: $email";
    }
}
?>

<!-- Mostrar el mensaje de confirmación -->
<?php if ($mensaje): ?>
    <div><?php echo $mensaje; ?></div>
<?php endif; ?>

<!-- Si no se ha mostrado el mensaje, mostramos los formularios -->
<?php if (!$mensaje): ?>
    <!-- Formulario 1 -->
    <form method="POST" action="">
        <h3>Formulario 1</h3>
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre" required>
        <button type="submit" name="formulario_1">Enviar Formulario 1</button>
    </form>

    <!-- Formulario 2 -->
    <form method="POST" action="">
        <h3>Formulario 2</h3>
        <label for="email">Correo Electrónico: </label>
        <input type="email" name="email" id="email" required>
        <button type="submit" name="formulario_2">Enviar Formulario 2</button>
    </form>
<?php endif; ?>
