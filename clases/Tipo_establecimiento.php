<?php
require_once 'Conexion.php';

class Tipo_establecimiento{


 private $id_tipo_establecimiento;
 private $descripcion_tipo_establecimiento;

 public function setId_tipo_establecimiento($parametro){
   $this->id_tipo_establecimiento = $parametro;
 }
 public function setTipoEstablecimiento($parametro){
   $this->descripcion_tipo_establecimiento = $parametro;
 }



 public function obtenerTipoEstablecimiento(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_tipo_establecimiento");
    return $resultado_consulta;

 }



}
 ?>
