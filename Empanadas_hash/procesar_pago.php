<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Pago</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
    <h1>Aca procesamos el pago</h1>

    <?php
    // Verificar si el pedido fue enviado
    if (!empty($_POST)) {
        // Inicializar el pedido
        $pedido = [];

        // Rellenar el array $pedido a partir de los datos del formulario
        foreach ($_POST as $key => $value) {
            if (strpos(haystack: $key, needle: '_precio') === false && $value > 0) { // Solo procesar si no es un precio
                $precio_key = $key . '_precio'; // Generar el nombre del campo de precio
                if (isset($_POST[$precio_key])) {
                    $pedido[$key] = [
                        'cantidad' => $value,
                        'precio' => $_POST[$precio_key]
                    ];
                }
            }
        }

        // Variable para el total
        $total_pago = 0;

        // Procesar el pedido y mostrar la información
        foreach ($pedido as $gusto => $info) {
            $cantidad = $info['cantidad'];
            $precio = $info['precio'];
            $subtotal = $precio * $cantidad;
            $total_pago += $subtotal;
            echo "<div class='row'>$cantidad empanadas de $gusto a \$ $precio c/u. Subtotal: \$ $subtotal</div>";
        }

        // Mostrar el total
        echo "<h2>Total a pagar: \$ $total_pago</h2>";
    } else {
        echo "<p>No se recibió ningún pedido.</p>";
    }
    ?>
</body>
</html>
