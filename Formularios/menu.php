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

$pedido = [         // gusto y cantidad pedida
    'Carne' => 0,
    'Pollo' => 0,
    'Jamón y queso' => 0,
    'Humita' => 0,
    'Roquefort' => 0,
    'Verdura' => 0
];

// Procesar el formulario cuando se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($gustos_empanadas as $gusto => $precio) {
        // Obtener la cantidad de empanadas seleccionadas
        $cantidad = isset($_POST[$gusto]) ? (int)$_POST[$gusto] : 0;
        // Actualizar el pedido
        $pedido[$gusto] += $cantidad;
    }
}

$total_empanadas = array_sum($pedido);
$total_precio = array_sum(array_map(function($gusto) use ($pedido, $gustos_empanadas) {
    return $pedido[$gusto] * $gustos_empanadas[$gusto];
}, array_keys($gustos_empanadas)));
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empanadas</title>
    <style>
        * {
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }
        .row {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 500px;
            background-color: #c4c4ff;
            font-size: large;
        }
        input[type="number"] {
            width: 60px;
            border: none;
            background-color: transparent;
            font-size: large;
            font-weight: 700;
            text-align: end;
            padding-right: 5px;
        }
        .gusto {
            flex: 1;
            padding: 5px;
        }
        .precio {
            padding-right: 50px;
        }
        .flexEnd {
            justify-content: flex-end;
        }
        .subtotal, .total {
            text-align: right;
            width: 70px;
            padding: 5px;
        }
        .total-row {
            display: flex;
            margin-top: 20px;
            width: 500px;
            font-size: x-large;
        }
        button {
            padding: 10px 20px;
            background-color: gray;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button.active {
            background-color: green;
        }
    </style>
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
            <input type="number" name="<?php echo $gusto; ?>" min="0" max="999" value="<?php echo $pedido[$gusto]; ?>" 
                onchange="calcularSubtotal(<?php echo $precio; ?>, this.value, document.getElementById('subtotal-<?php echo $gusto; ?>'))">
        </div>
        <div class="subtotal flexEnd" id="subtotal-<?php echo $gusto; ?>"><?php echo $pedido[$gusto] * $precio; ?></div>
    </div>
    <?php endforeach; ?>

    <div class="total-row flexEnd">
        <strong>Total: $<span id="total"><?php echo $total_precio; ?></span></strong>
    </div>

    <button type="submit" id="botonCompra" class="active">Proceder con la compra</button>
    </form>

</body>
</html>
