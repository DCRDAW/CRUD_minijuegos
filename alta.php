
<?php
    require 'php/controlador.php';
    $control=new Controlador();
    if(isset($_POST['envio'])){
      $nombre= '"'.$_POST["nombre"].'"';
      $control->alta($nombre);
    }
?>
<html lang="es" dir="ltr">
    <head>
        <meta charset="utf-8" >
        <title>Alta de items</title> 
    </head>
    <body>
       <header>
           <h1>Alta de items</h1>
       </header>

       <form method="post"  enctype="multipart/form-data" action="" >
           
            <label for="nombre">Nombre</label><br />
            <input type="text" placeholder="Introduce el nombre" name="nombre" required><br />
        
            <label for="imagen">Imagen</label><br />
            <input type="file" name="imagen[]" multiple="multiple"><br />
        
            <input type="submit" id="enviar" name="envio">
        </form>
      
    </body>
</html>


