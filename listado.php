
<?php
    require 'php/controlador.php';
    $control=new Controlador();
?>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8" >
        <title>Borrado/Modificacion de items</title> 
    </head>
    <body>
       <header>
           <h1>Borrado/Modificacion de items</h1>
       </header>
        <?php
            $array=$control->listar();
            foreach ($array as $key => $item) {
                echo "<div>";
               
                echo "<p>";
                echo "Nombre del item: ".$item["nombre"];
                echo "</br>";
                echo "<a href='modificacionBorrado.php? id=".$item['idItem']."&accion=Modificar''><button>Modificar</button></a>";
                echo "<a href='modificacionBorrado.php? id=".$item['idItem']."&accion=Borrar'><button>Borrar</button></a>";
                echo "</p>";
                echo "</div>";
            }
        ?>
        <a href="index.php"><button>Volver atras</button></a>
       
      
    </body>
</html>


