<!DOCTYPE html>
<html>
    <head>
        <title>Welcome</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
        <style>
            /* Aquí puedes agregar tu estilo si es necesario */
        </style>
    </head>
    <body>

        <?php
        // Incluimos la conexión a la base de datos
        include 'conexiondb.php';

        // Recibimos los datos del formulario
        $nombre = $_REQUEST["name"];
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $pass_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';

        // Validaciones del formulario
        if ($nombre && filter_var($email, FILTER_VALIDATE_EMAIL) && (preg_match($pass_pattern, $password))) {

            // Conectar a la base de datos
            $enlace = conectardb("empanadas");

            // Verificar si el nombre o correo ya existen
            $query = "SELECT * FROM clientes WHERE nombre = '$nombre' OR correo = '$email'";
            $result = mysqli_query($enlace, $query);

            if (mysqli_num_rows($result) > 0) {
                // Si ya existe el nombre o correo
                echo "<div class='error'>
                        <h2>Error</h2>
                        <h3>El nombre o el correo ya están registrados. Por favor, intente con otro.</h3><br>
                        <form method='post' action='registrarse_cliente.html'>
                            <input class='boton' type='submit' value='Volver al formulario'>
                        </form>
                      </div>";
            } else {
                // Si todo está bien, insertamos los datos en la base de datos
                $insert_query = "INSERT INTO clientes (nombre, correo, password) VALUES ('$nombre', '$email', '$password')";
                $insert_result = mysqli_query($enlace, $insert_query);

                if ($insert_result) {
                    // Si la inserción fue exitosa
                    echo "<div class='success'>
                            Bienvenido: <strong>{$nombre}</strong><br><br>
                            La dirección de correo registrada es: <strong> {$email}</strong><br><br>
                            <a href='menu.php'><button class='boton'>Ir al Menú</button></a>
                          </div>";
                } else {
                    // Si hubo un error al insertar en la base de datos
                    echo "<div class='error'>
                            <h2>Error al registrar los datos.</h2>
                            <h3>Hubo un problema al guardar los datos en la base de datos. Intente nuevamente.</h3>
                            <form method='post' action='registrarse_cliente.html'>
                                <input class='boton' type='submit' value='Volver al formulario'>
                            </form>
                          </div>";
                }
            }

            // Cerrar la conexión a la base de datos
            desconectar($enlace);

        } elseif (empty($nombre)) {
            echo "<div class='error'>
                    <h2>Error</h2> <br>
                    <h3>El campo <strong>Nombre</strong> es obligatorio</h3>
                 </div> <br>";
        } elseif (!(preg_match($pass_pattern, $password))) {
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
        } else {
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
