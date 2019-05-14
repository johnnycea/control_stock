<?php
require_once 'Conexion.php';

class Categoria{

 private $id_categoria;
 private $descripcion_categoria;

 public function setIdCategoria($id_categoria){
   $this->id_categoria = $id_categoria;
 }
 public function setDescripcionCategoria($descripcion_categoria){
   $this->descripcion_categoria = $descripcion_categoria;
 }

 function obtenerCategorias($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_categoria ".$condiciones."";
     }else{
       $consulta= "select * from tb_categoria
                   where id_categoria like '%".$texto_buscar."%'
                   or descripcion_categoria like '%".$texto_buscar."%'";
     }
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
