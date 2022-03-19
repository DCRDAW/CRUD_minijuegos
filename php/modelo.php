<?php
class Modelo{
    public function __construct()
    {
      require_once "operacionesBD.php";
      $this->conexion = new  OperacionesBD();
     

    }
    //devuelve el ultimo id insertado
    function devolverId(){
      $consulta="SELECT MAX(idItem) as maximo from reciclaje_items";
      $resultado=$this->conexion->consultas($consulta);
      $fila = $this->conexion->extraerFila($resultado);
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
  //hace un update del un item  
  function modificacionItem($nombre,$id){
    $consulta=" UPDATE reciclaje_items set nombre=$nombre where idItem=$id";
    $this->conexion->consultas($consulta);
    if($this->conexion->filasAfectadas()!=0){
      return true;
    }else{
      return $this->conexion->error();
    }
  } 
  //devuelve todos los items de la base de datos 
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
  //devuelve el numero de error
  function error(){
    return $this->conexion->error();
  }
  //borra un item de la base de datos segun el id que le pases
  function borrar($id){
    $consulta= "DELETE FROM reciclaje_items WHERE idItem= $id";
    $this->conexion->consultas($consulta);
  }
  //saca todos los datos de el item que quieras
  function sacarDatos($idItem){
    $consulta="SELECT idItem,nombre FROM reciclaje_items where idItem= $idItem";
    $resultado=$this->conexion->consultas($consulta);
    return $this->conexion->extraerFila($resultado);
  }
  //devuelve el nombre de las columnas de la tabla
  function titulo(){
    $consulta="
    SELECT `COLUMN_NAME` 
    FROM `INFORMATION_SCHEMA`.`COLUMNS` 
    WHERE `TABLE_SCHEMA`='Minijuegos' 
        AND `TABLE_NAME`='reciclaje_items'  
    ";
    $resultado=$this->conexion->consultas($consulta);
    $titulos=array();
    while ($fila = $this->conexion->extraerFila($resultado)){
      array_push($titulos,
        [
          "COLUMN_NAME" => $fila["COLUMN_NAME"],
        ]
      );
    }
    return $titulos;
  
  }
  //devuelve la info de los campos de las tablas de reciclaje_items
  function contenido(){
    $consulta="SELECT * FROM reciclaje_items ";
   
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
}

