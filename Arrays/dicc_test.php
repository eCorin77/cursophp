<?php
$dicc = array(
    "casa" => array("house", "home"),
    "perro" => array("dog", "puppy"),
    "gato" => array("cat"),
    "libro" => array("book"),
    "comida" => array("food", "meal"),
    "feliz" => array("happy", "joyful"),
    "niño" => array("child", "kid"),
    "agua" => array("water"),
    "amigo" => array("friend"),
    "familia" => array("family")
);

// Elegir una palabra aleatoria
$palabraAleatoria = array_rand($dicc);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Traducción</title>
</head>
<body>
    <h2>Verificar Traducción de "<?php echo $palabraAleatoria; ?>"</h2>
    <form method="post">
        <label for="traduccion">Ingresa la traducción de <?php echo $palabraAleatoria; ?> en inglés:</label>
        <input type="text" name="traduccion" id="traduccion" required>
        <button type="submit">Verificar</button>
    </form>

    <?php
    // Función para verificar si la traducción es válida
    function esTraduccionCorrecta($palabraAleatoria, $traduccion) {
        global $dicc;
        // Verificamos si la traducción está en el array de la palabra aleatoria
        if (in_array($traduccion, $dicc[$palabraAleatoria])) {
            return true;
        }
        return false;
    }

    // Procesar la entrada del usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $traduccion = trim($_POST['traduccion']);  // Limpiamos el input

        if (esTraduccionCorrecta($palabraAleatoria, $traduccion)) {
            // Mostrar el mensaje de éxito y el botón de confirmación
            echo "<p>¡Correcto! La traducción de '$palabraAleatoria' es válida: '$traduccion'.</p>";
            echo '<form method="post">
                    <button type="submit" name="confirm" value="1">Confirmar y Continuar</button>
                  </form>';
        } else {
            // Mostrar el mensaje de error y el botón de confirmación
            echo "<p>Lo siento, la traducción '$traduccion' no es correcta para '$palabraAleatoria'.</p>";
            echo '<form method="post">
                    <button type="submit" name="confirm" value="0">Intentar de nuevo</button>
                  </form>';
        }
    }

    // Redirigir a otra página después de que el usuario confirme
    if (isset($_POST['confirm'])) {
        if ($_POST['confirm'] == 1) {
            // Si el usuario confirmó, redirigimos
            header("Location: dicc_test.php");
            exit;
        } else {
            // Si el usuario quiere intentar de nuevo, recargamos la página
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    ?>
</body>
</html>
