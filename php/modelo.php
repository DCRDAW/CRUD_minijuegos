<?php
class Modelo{
    public function __construct()
    {
      require_once "operacionesBD.php";
      $this->conexion = new  OperacionesBD();
     

    }
    function devolverId(){
      return $this->conexion->ultimoInsert_id();
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
  
  
}

