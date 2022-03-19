<?php
    require 'php/controlador.php';
    $control=new Controlador();
    $id=$_GET["id"];
    $accion=$_GET["accion"];
    if(isset($_POST['envio'])){
        $nombre= '"'.$_POST["nombre"].'"';
        $control->modificacion($nombre,$id);
      }
    if ($accion=="Borrar") {
        echo $accion;
       $control->borrar($id);
       header("Refresh:0; url=listado.php");
    }else{
        $array=$control->sacarDatos($id);
        echo "
        <form method='post'  enctype='multipart/form-data' action='' >
            
             <label for='nombre'>Nombre</label><br />
             <input type='text' placeholder='Introduce el nombre' name='nombre' value='".$array["nombre"]."' required><br />
         
             <label for='imagen'>Imagen</label><br />
             <input type='file' name='imagen[]' multiple='multiple'><br />
         
             <input type='submit' id='enviar' name='envio'>
         </form>
         <a href='index.php'><button>Volver atras</button></a>
         ";
    }
?>

