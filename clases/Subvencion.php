<?php
require_once 'Conexion.php';

class Subvencion{

 private $id_subvencion;
 private $subvencion;

 public function setIdSubvencion($id_subvencion){
   $this->id_subvencion = $id_subvencion;
 }
 public function setSubvencion($subvencion){
   $this->subvencion = $subvencion;
 }

 public function obtenerSubvencion(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_subvenciones");
    return $resultado_consulta;
 }

 public function consultarUnaSubvencion(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_subvenciones where id_subvencion=".$this->id_subvencion);
    return $resultado_consulta;
 }

 public function crearSubvencion(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_subvenciones (subvencion) VALUES ('".$this->subvencion."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
   // if($Conexion->query($consulta)){
   //       $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id");
   //       $resultadoNuevoId = $resultadoNuevoId->fetch_array();
   //       return $resultadoNuevoId['id'];
   // }else{
   //     // echo $consulta;
   //     return false;
   // }
 }

   public function modificarSubvencion(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_subvenciones set
                 subvencion = '".$this->subvencion."'
                 where id_subvencion=".$this->id_subvencion;

       if($conexion->query($consulta)){
           return true;
       }else{
           echo $consulta;
           return false;
       }
   }

   public function eliminarSubvencion(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "DELETE FROM tb_subvenciones WHERE (id_subvencion = ".$this->id_subvencion.") ";

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }

}
 ?>
