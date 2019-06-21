<?php
require_once 'Conexion.php';

class UnidadMedida{

 private $id_unidad_medida;
 private $descripcion_unidad_medida;

 public function setIdUnidadMedida($parametro){
   $this->id_unidad_medida = $parametro;
 }
 public function setDescripcionUnidadMedida($parametro){
   $this->descripcion_unidad_medida = $parametro;
 }

 function obtenerUnidadesMedida(){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

       $consulta= "select * from tb_unidades_medida";

     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function crearUnidad(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert into tb_unidades_medida (`descripcion`) VALUES ('".$this->descripcion_unidad_medida."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarUnidad(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_unidades_medida SET
       descripcion = '".$this->descripcion_unidad_medida."'
        WHERE (id_unidad_medida = '".$this->id_unidad_medida."')";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarUnidad_medida(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_unidades_medida where id_unidad_medida=".$this->id_unidad_medida;

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }


}
 ?>
