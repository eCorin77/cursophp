<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href=""> -->
    </head>
    <body>
        <form action="#" method="post">
            <input type="text" placeholder="Ej: Juan Rodriguez" name="nombre">
            <button>Accept</button>

        </form>
        
        <?php
            if(isset($_POST["nombre"])){
                $name = $_POST["nombre"];
                echo  $name;
            }
        ?>
        <!-- <script src="" async defer></script> -->
    </body>
</html>