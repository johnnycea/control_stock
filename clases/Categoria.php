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

   public function modificarProveedor(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_proveedores SET
       razon_social = '".$this->razon_social."',
       direccion = '".$this->direccion."',
       telefono = '".$this->telefono."',
       giro = '".$this->giro."',
       correo = '".$this->correo."'
        WHERE (rut_proveedor = '".$this->rut_proveedor."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarProveedor(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     //CONSULTA SI EL PROVEEDOR TIENE FACTURAS EN EL SISTEMA
     $consultaFacturasProveedor = $Conexion->query("select * from tb_facturas where id_proveedor=".$this->rut_proveedor);
     if($consultaFacturasProveedor->num_rows==0){
       //entra si el proveedor no tiene facturas, por lo tanto se elimina
           if($Conexion->query("DELETE FROM tb_proveedores where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }else{
       //entra si el proveedor SI TIENE facturas, SE CAMBIA ESTADO A "ELIMINADO"
           if($Conexion->query("Update tb_proveedores set estado_proveedor=3 where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }

   }


}
 ?>
