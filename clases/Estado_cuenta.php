<?php
require_once 'Conexion.php';

class Estado_cuenta{

 private $tabla;
 private $descripcion;
 private $estado;


 public function setTabla($parametro){
   $this->tabla = $parametro;
 }
 public function setEstado($parametro){
   $this->estado = $parametro;
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

    $resultado_consulta = $Conexion->query("select * from tb_estado_cuenta");
    return $resultado_consulta;

 }



}
 ?>
