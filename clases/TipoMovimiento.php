<?php
require_once 'Conexion.php';

class TipoMovimiento{

 private $id_tipo_movimiento;
 private $descripcion_tipo_movimiento;


 public function obtenerTiposMovimientos(){

    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta= "select * from tb_tipo_movimiento";

    $resultado= $conexion->query($consulta);
    if($resultado){
       return $resultado;
    }else{
      return false;
    }

 }


}
 ?>
