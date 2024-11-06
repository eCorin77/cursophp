<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
    </head>
    <body>
        <form action="#" method="post">
            <input type="text" placeholder="Ej: Juan Rodriguez" name="nombre">
            <input type="password" placeholder="123Ertydf" name="pass">
            <button type="submit">Accept</button>
            <button type="submit">Consultar</button>

        </form>
        
        <?php
            if(isset($_POST["nombre"]) && isset($_POST["pass"])){
                $name = $_POST["nombre"];
                $pass = $_POST["pass"];
                echo  $name;
            }
        ?>
        
    </body>
</html>