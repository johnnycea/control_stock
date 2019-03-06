<?php
require_once 'Conexion.php';

class Colegio{

 private $rbd_colegio;
 private $nombre_colegio;
 private $estado;
 private $tipo_establecimiento;

 public function setColegio($rbd_colegio){
   $this->rbd_colegio = $rbd_colegio;
 }
 public function setNombre($nombre_colegio){
   $this->nombre_colegio = $nombre_colegio;
 }
 public function setEstado($estado){
   $this->estado = $estado;
 }
 public function setTipoEstablecimiento($parametro){
   $this->tipo_establecimiento = $parametro;
 }

 public function obtenerColegios(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_colegios");
    return $resultado_consulta;
 }

 public function obtenerEstados($condiciones){

    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta= "select * from ".$this->tabla." ".$condiciones;
    echo $consulta;

    $resultado= $conexion->query($consulta);
    if($resultado){
       return $resultado;
    }else{
      return false;
    }

 }

 public function consultarUnColegio(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_colegios where rbd_colegio=".$this->rbd_colegio);
    return $resultado_consulta;
 }

 public function crearColegio(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_colegios (`rbd_colegio`, `nombre_colegio`, `estado`, `tipo_establecimiento`) VALUES ('".$this->rbd_colegio."', '".$this->nombre_colegio."', '".$this->estado."', '".$this->tipo_establecimiento."')";
   $resultado= $conexion->query($consulta);
   return $resultado;

 }

   public function modificarColegio(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_colegios set
                 nombre_colegio = '".$this->nombre_colegio."',
                 estado = ".$this->estado.",
                 tipo_establecimiento = ".$this->tipo_establecimiento."
                 where rbd_colegio=".$this->rbd_colegio;

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarColegio(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     // $consulta;
     //
     // $resultado= $conexion->query("select colegio from tb_movimientos where colegio=".$this->colegio);
     // //consulta si el usuario tiene actividades registradas
     //   if($resultado->num_rows>0){
     //       //si entra aqui, se cambia el estado a eliminado
     //       $consulta = "update tb_usuarios set estado=3 where rut=".$this->run;
     //   }else{
     //       //si entra aqui se puede eliminar
     //       $consulta = "delete FROM tb_colegios WHERE (rbd_colegio = '".$this->rbd_colegio."' ) ";
     //   }

       $consulta = "update tb_colegios set estado=3 where rbd_colegio=".$this->rbd_colegio;

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }

}
 ?>
