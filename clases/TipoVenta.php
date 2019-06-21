<?php
require_once 'Conexion.php';

class TipoVenta{

 private $id_tipo_venta;
 private $descripcion_tipo_venta;

 public function setIdTipoVenta($parametro){
   $this->$id_tipo_venta = $parametro;
 }
 public function setDescripcionTipoVenta($parametro){
   $this->descripcion_tipo_venta = $parametro;
 }


 public function obtenerTiposVenta(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_tipos_venta");
    return $resultado_consulta;
 }


}
 ?>
