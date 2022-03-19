
<?php

class Controlador{
    public function __construct()
    {
      require_once "modelo.php";
      $this->modelo = new Modelo();
    }
  function alta($nombre){
     if($this->comprobarextension()){
        $this->guardarFichero();
      }else{
        echo "error en la extension de la imagen";
        return;
      }
      if($this->modelo->altaItem($nombre)){
        echo "introducido correctamente";
      }else {
        echo $this->modelo->error();
      }
     
     
    }
  function modificacion($nombre,$id){
    if($this->comprobarextension()){
      $this->actualizarFichero($id);
    }else{
      echo "error en la extension de la imagen";
      return;
    }
    if($this->modelo->modificacionItem($nombre,$id)){
      echo "modicado correctamente";
    }else {
      echo $this->modelo->error();
    }
  } 
  function sacarDatos($id){
    return $this->modelo->sacarDatos($id);
  }
  function actualizarFichero($id){
    $ruta= 'archivos/'.$id.'/';
    
    $this->comprobar($id);
    $total = count($_FILES['imagen']['name']);
    for( $i=0 ; $i < $total ; $i++ ) {
    $tmpFilePath = $_FILES['imagen']['tmp_name'][$i];
    if ($tmpFilePath != ""){
        
        $newFilePath = $ruta.$_FILES['imagen']['name'][$i];
        
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

        }
    }
    }
  }
  function guardarFichero(){
    $idItem=$this->modelo->devolverId();
    if($idItem==0){
      $idItem=1;
    }
    $ruta= 'archivos/'.$idItem.'/';
    mkdir('archivos/'.$idItem,0777,true);
    $this->comprobar($idItem);
    $total = count($_FILES['imagen']['name']);
    for( $i=0 ; $i < $total ; $i++ ) {
    $tmpFilePath = $_FILES['imagen']['tmp_name'][$i];
    if ($tmpFilePath != ""){
        
        $newFilePath = $ruta.$_FILES['imagen']['name'][$i];
        
        if(move_uploaded_file($tmpFilePath, $newFilePath)) {

        }
    }
    }
    
  }
  function comprobarextension(){
    $allowed = array('gif', 'png', 'jpg');
    $total = count($_FILES['imagen']['name']);
    for( $i=0 ; $i < $total ; $i++ ) {
      $filename = $_FILES['imagen']['name'][$i];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      if (!in_array($ext, $allowed)) {
          echo pathinfo($filename, PATHINFO_EXTENSION);
          return false;
      }
      }
   return true;
  }
  function comprobar($idItem){
      $array=array_diff(scandir("archivos/"), array('..', '.'));
      foreach ($array as $indice => $nombre) {
              // Count # of uploaded files in array
      $total = count($_FILES['imagen']['name']);

      // Loop through each file
      for( $i=0 ; $i < $total ; $i++ ) {
          if(trim($nombre)==trim(basename($_FILES["imagen"]["name"][$i]))){
              $_FILES["imagen"]["name"][$i]=$nombre.$idItem;
          }
      }
          
      }  
  }
  function borrar($id){
    $this->modelo->borrar($id);
  }
  function listar(){
    return($this->modelo->listar());
  }
  function sacarEtapa(){
    $this->modelo->sacarIdEtapa();
  }
  function titulo(){
    return $this->modelo->titulo();
  }
  function contenido(){
    return $this->modelo->contenido();
  }
}

