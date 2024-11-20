<?php

 echo "<form action='consultar_clientes.php'>

<button type='submit'>Consultar Todos los Clientes</button>

</form><br><br>";

echo "<form action='consultar_clientes_por_mail.php' method='POST'>
<strong>Consultar por dominio de mail</strong><br>
<label for='dom_mail' >Introduzca dominio del correo</label>
<input type='text' name='dom_mail' placeholder='Ej: yahoo'><br>

<button type='submit' value='por_mail'>Consultar</button>

</form><br><br>";

echo "<form action='consultar_pedidos.php'>

<button type='submit'>Consultar Pedidos</button>

</form><br><br>";


?>