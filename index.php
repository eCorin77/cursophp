<!DOCTYPE html>
<html>
    
    <body>
        <?php
         $platoDelDia = "Pollo al verdeo";
         $precioEco = 4500;
         $precioPlatoDelDia = 600;
         $menuEco = [$platoDelDia, $precioEco, $precioPlatoDelDia];
                         echo $precioPlatoDelDia;
                         echo"<br>";
                         echo "Plato del día: ". $menuEco[0];
                         echo"<br>";
                          echo "Precio plato del día $".$menuEco[2];
                         echo"<br>";
         
                         echo "Menú Econónimco $". $menuEco[1];
                        
                         
                                         echo "<br>";
                                         echo "---------------------------------------------";
                                         echo "<br>";
         
                         
                         
                         
                          arsort($menuEco);
                         
                         foreach($menuEco as $item){
                         echo "$item";
                         echo "<br>";
                         };
                         
                         include "footer.php";
        ?>
        
        
    </body>
</html>