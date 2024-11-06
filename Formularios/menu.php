<?php
// Array de gustos de empanadas con precios
$gustos_empanadas = [
    'Carne' => 200,
    'Pollo' => 180,
    'Jamón y queso' => 220,
    'Humita' => 190,
    'Roquefort' => 240,
    'Verdura' => 180
];

// Inicializar el pedido con cantidad y precio
$pedido = [];
foreach ($gustos_empanadas as $gusto => $precio) {
    $pedido[$gusto] = [
        'cantidad' => 0,
        'precio' => $precio
    ];
}

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($gustos_empanadas as $gusto => $precio) {
        // Obtener la cantidad de empanadas seleccionadas
        $cantidad = isset($_POST[$gusto]) ? (int)$_POST[$gusto] : 0;
        // Actualizar el pedido
        $pedido[$gusto]['cantidad'] += $cantidad;
    }
}

$total_empanadas = array_sum(array_column($pedido, 'cantidad'));
$total_precio = array_sum(array_map(function($item) {
    return $item['cantidad'] * $item['precio'];
}, $pedido));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empanadas</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

    <script>
        function calcularSubtotal(precio, cantidadInput, subtotalSpan) {
            const cantidad = cantidadInput;
            const subtotal = precio * cantidad;
            subtotalSpan.textContent = subtotal.toFixed(0);
            calcularTotal();
        }

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(function(subtotalSpan) {
                total += parseFloat(subtotalSpan.textContent);
            });
            document.getElementById('total').textContent = total.toFixed(0);
            actualizarBotonCompra(total);
        }

        function actualizarBotonCompra(total) {
            const boton = document.getElementById('botonCompra');
            if (total >= 5000) {
                boton.classList.add('active');
            } else {
                boton.classList.remove('active');
            }
        }

        function validarCompra(event) {
            const total = parseFloat(document.getElementById('total').textContent);
            if (total < 5000) {
                alert("Compra mínima $5000");
                event.preventDefault(); // Evita el envío del formulario
            }
        }
    </script>
</head>
<body>

<h1>Seleccione sus empanadas</h1>

<form method="POST" action="procesar_pago.php" onsubmit="validarCompra(event);">
    <?php foreach ($gustos_empanadas as $gusto => $precio): ?>
    <div class="row">
        <div class="gusto"><?php echo $gusto; ?></div>
        <div class="precio"><?php echo "$ {$precio}"; ?></div>
        <span>Cant</span>
        <div class="flexEnd">
            <input type="number" name="<?php echo $gusto; ?>" min="0" max="999" value="<?php echo $pedido[$gusto]['cantidad']; ?>" 
                onchange="calcularSubtotal(<?php echo $precio; ?>, this.value, document.getElementById('subtotal-<?php echo $gusto; ?>'))">
            <input type="hidden" name="<?php echo $gusto; ?>_precio" value="<?php echo $precio; ?>">
        </div>
        <div class="subtotal flexEnd" id="subtotal-<?php echo $gusto; ?>"><?php echo $pedido[$gusto]['cantidad'] * $precio; ?></div>
    </div>
    <?php endforeach; ?>

    <div class="total-row flexEnd">
        <strong>Total: $<span id="total"><?php echo $total_precio; ?></span></strong>
    </div>

    <button type="submit" id="botonCompra">Proceder con la compra</button>
</form>


</body>
</html>
