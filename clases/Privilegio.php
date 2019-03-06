<?php
require_once 'Conexion.php';

class Privilegio{

 private $id_privilegio;
 private $descripcion;

 public function obtenerPrivilegios(){

    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta= "select * from tb_tipo_usuario";
    echo $consulta;

    $resultado= $conexion->query($consulta);
    if($resultado){
       return $resultado;
    }else{
      return false;
    }

 }


}
 ?>
