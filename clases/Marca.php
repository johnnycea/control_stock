<?php
require_once 'Conexion.php';

class Marca{

 private $id_marca;
 private $nombre_marca;

 public function setIdMarca($id_marca){
   $this->id_marca = $id_marca;
 }
 public function setNombreMarca($nombre_marca){
   $this->nombre_marca = $nombre_marca;
 }

 function obtenerMarca($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_marca ".$condiciones."";
     }else{
       $consulta= "select * from tb_marca
                   where id_marca like '%".$texto_buscar."%'
                   or nombre_marca like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerMarcas(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_marca");
    return $resultado_consulta;
 }


 public function crearMarca(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();
   $consulta = "insert into tb_marca (nombre_marca) VALUES ('".$this->nombre_marca."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarMarca(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_marca SET
       nombre_marca = '".$this->nombre_marca."'
        WHERE (id_marca = '".$this->id_marca."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarMarca(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_marca where id_marca=".$this->id_marca;

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }

}
 ?>
