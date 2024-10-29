<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
        
        </style>
    </head>
    <body>


        <?php
            $nombre = $_REQUEST["name"];
            $email = $_REQUEST["email"];
            $password = $_REQUEST["password"];
            $pass_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

            if ($nombre && filter_var($email, FILTER_VALIDATE_EMAIL) && (preg_match($pass_pattern, $password))) {
                echo "<div class='success'>
                        Bienvenido: <strong>{$nombre}</strong><br><br>
                        La dirección de correo registrada es: <strong> {$email}</strong><br><br>
                        <a href='menu.php'><button class='boton'>Ir al Menú</button></a>
                    </div>";
            }elseif(empty($nombre)){
                echo "<div class='error'>
                    <h2>Error</h2> <br>
                    <h3>El campo <strong>Nombre</strong> es obligatorio</h3>
                     </div> <br>";
            }elseif(!(preg_match($pass_pattern, $password))){
                echo "<div class='error'>
                    <h2>Error</h2> <br>
                    <h3>La contraseña no es válida</h3><br>
                    <ul class='list'>
                        <li>La contraseña debe tener 8 caracteres mínimo,</li><br>
                        <li>al menos una letra mayúscula,</li><br>
                        <li>al menos una letra minúscula,</li><br>
                        <li>al menos un número.</li><br>
                    </ul>
                    <form  method='post' action='formulario.html'>
                        <input class='boton' type='submit' value='Volver al formulario'>
                    </form>
                    </div><br>";
            }else{
                echo "<div class='error'>
                    <h2>Error</h2> 
                    <h3>La dirección de correo: <strong>{$email}</strong> no es válida</h3>
                    <form  method='post' action='formulario.html'>
                        <input class='boton' type='submit' value='Volver al formulario'>
                    </form>
                    </div><br>";
                
                
                 
            }

        ?>

    </body>
</html>
