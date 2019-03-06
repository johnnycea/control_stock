<?php
require_once 'Conexion.php';

class TipoGasto{

 private $id_tipo_gasto;
 private $descripcion_tipo_gasto;


 public function obtenerTiposGasto(){

    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta= "select * from tb_tipo_gasto";

    $resultado= $conexion->query($consulta);
    if($resultado){
       return $resultado;
    }else{
      return false;
    }

 }


}
 ?>
