<?php
require_once 'Conexion.php';

class MedioPago{

 private $id_medio_pago;
 private $descripcion_medio_pago;

 public function setIdMedioPago($parametro){
   $this->$id_medio_pago = $parametro;
 }
 public function setDescripcionMedioPago($parametro){
   $this->descripcion_medio_pago = $parametro;
 }


 public function obtenerMediosPago(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_medios_pago");
    return $resultado_consulta;
 }


}
 ?>
