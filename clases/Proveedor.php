<?php
require_once 'Conexion.php';

class Proveedor{

 private $rut_proveedor;
 private $dv;
 private $razon_social;
 private $direccion;
 private $telefono;
 private $giro;
 private $correo;

 public function setRutProveedor($rut_proveedor){
   $this->rut_proveedor = $rut_proveedor;
 }
 public function setDV($dv){
   $this->dv = $dv;
 }
 public function setRazon_social($razon_social){
   $this->razon_social = $razon_social;
 }
 public function setDireccion($direccion){
   $this->direccion = $direccion;
 }
 public function setTelefono($telefono){
   $this->telefono = $telefono;
 }
 public function setGiro($giro){
   $this->giro = $giro;
 }
 public function setCorreo($correo){
   $this->correo = $correo;
 }


 function obtenerProveedores($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_proveedores ".$condiciones."";
     }else{
       $consulta= "select * from tb_proveedores
                   where rut_proveedor like '%".$texto_buscar."%'
                   or razon_social like '%".$texto_buscar."%'
                   or direccion like '%".$texto_buscar."%'
                   or telefono like '%".$texto_buscar."%'
                   or giro like '%".$texto_buscar."%'
                   or correo like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerProveedor(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_proveedores where rut_proveedor=".$this->rut_proveedor);
    return $resultado_consulta;
 }

 public function obtener_cmb_Proveedor(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_proveedores".$this->rut_proveedor);
    return $resultado_consulta;
 }

 public function crearProveedor(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_proveedores (`rut_proveedor`,`dv`,`razon_social`,`direccion`,`telefono`,`giro`,`correo`) VALUES ('".$this->rut_proveedor."', '".$this->dv."', '".$this->razon_social."', '".$this->direccion."', '".$this->telefono."', '".$this->giro."', '".$this->correo."')";
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
