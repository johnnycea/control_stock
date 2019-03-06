<?php
require_once 'Conexion.php';

class Estado_movimiento{

 private $tabla;
 private $id_estado;
 private $descripcion;

 public function setTabla($parametro){
   $this->tabla = $parametro;
 }
 public function idEstado($parametro){
   $this->id_estado = $parametro;
 }
 public function setDescripcion($parametro){
   $this->descripcion = $parametro;
 }

 // public function obtenerEstados($condiciones){
 //
 //    $conexion = new Conexion();
 //    $conexion = $conexion->conectar();
 //
 //    $consulta= "select * from ".$this->tabla." ".$condiciones;
 //    echo $consulta;
 //
 //    $resultado= $conexion->query($consulta);
 //    if($resultado){
 //       return $resultado;
 //    }else{
 //      return false;
 //    }
 //
 // }

 public function obtenerEstados(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_estado_movimiento");
    return $resultado_consulta;

 }



}
 ?>
