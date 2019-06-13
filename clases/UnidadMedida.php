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

 public function obtenerCategoria(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_categoria");
    return $resultado_consulta;
 }

 public function crearCategoria(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_categoria (`descripcion_categoria`) VALUES ('".$this->descripcion_categoria."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarCategoria(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_categoria SET
       descripcion_categoria = '".$this->descripcion_categoria."'
        WHERE (id_categoria = '".$this->id_categoria."')";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarCategoria(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_categoria where id_categoria=".$this->id_categoria;

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }


}
 ?>
