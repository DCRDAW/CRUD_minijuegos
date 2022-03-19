<?php
class Modelo{
    public function __construct()
    {
      require_once "operacionesBD.php";
      $this->conexion = new  OperacionesBD();
     

    }
    function devolverId(){
      $consulta="SELECT MAX(idItem) as maximo from reciclaje_items";
      echo $consulta;
      $resultado=$this->conexion->consultas($consulta);
      $fila = $this->conexion->extraerFila($resultado);
      print_r($fila);
      return $fila["maximo"];
     }
  //funcion que hace el alta en la base de datos de las etapas 
  function altaItem($nombre){
        $consulta= "INSERT INTO reciclaje_items(nombre) VALUES($nombre)";
        $this->conexion->consultas($consulta);
        if($this->conexion->filasAfectadas()!=0){
          return true;
        }else{
          return $this->conexion->error();
        }
    }
  function modificacionItem($nombre,$id){
    $consulta=" UPDATE reciclaje_items set nombre=$nombre where idItem=$id";
    $this->conexion->consultas($consulta);
    if($this->conexion->filasAfectadas()!=0){
      return true;
    }else{
      return $this->conexion->error();
    }
  }  
  function listar(){
    $consulta= "SELECT idItem,nombre FROM reciclaje_items";
    $resultado=$this->conexion->consultas($consulta);
    $items=array();
    while ($fila = $this->conexion->extraerFila($resultado)){
      array_push($items,
        [
          "idItem" => $fila["idItem"],
          "nombre" =>$fila["nombre"]
        ]
      );
    }
    return $items;
  }
  function error(){
    return $this->conexion->error();
  }
  function borrar($id){
    $consulta= "DELETE FROM reciclaje_items WHERE idItem= $id";
    $this->conexion->consultas($consulta);
  }
  function sacarDatos($idItem){
    $consulta="SELECT idItem,nombre FROM reciclaje_items where idItem= $idItem";
    $resultado=$this->conexion->consultas($consulta);
    return $this->conexion->extraerFila($resultado);
  }
  function titulo(){
    $consulta="
    SELECT `COLUMN_NAME` 
    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    WHERE `TABLE_SCHEMA`='Minijuegos' 
        AND `TABLE_NAME`='reciclaje_items'  
    ";
    $resultado=$this->conexion->consultas($consulta);
    return $this->conexion->extraerFila($resultado);
  }
  function contenido(){
    $consulta="SELECT * FROM reciclaje_items ";
    $resultado=$this->conexion->consultas($consulta);
  }
}

