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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empanadas</title>
    <style>
        *{
            font-family:  'Roboto', sans-serif;
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

        input[type="number"]{
            width: 70px;
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
        .flexEnd{
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
        }
    </script>
</head>
<body>

<h1>Seleccione sus empanadas</h1>

<form>
    <?php foreach ($gustos_empanadas as $gusto => $precio): ?>
    <div class="row">
        <div class="gusto"><?php echo $gusto; ?></div>
        <div class="flexEnd">
            <input type="number" min="0" max="1000" value="0"
            onchange="calcularSubtotal(<?php echo $precio; ?>, this.value, document.getElementById('subtotal-<?php echo $gusto; ?>'))">
        </div>
        <div class="subtotal flexEnd" id="subtotal-<?php echo $gusto; ?>">0</div>
    </div>
    <?php endforeach; ?>

    <div class="total-row flexEnd">
        <strong>Total: $<span id="total">0.00</span></strong>
    </div>
</form>

</body>
</html>