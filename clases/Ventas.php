<?php
require_once 'Conexion.php';

class Ventas{

 private $id_venta;
 private $total;
 private $fecha;

 public function setIdVenta($id_venta){
   $this->id_venta = $id_venta;
 }
 public function setTotal($total){
   $this->total = $total;
 }
 public function setFecha($fecha){
   $this->fecha = $fecha;
 }


 function obtenerVentas($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_ventas ".$condiciones."";
     }else{
       $consulta= "select * from tb_ventas
                   where id_venta like '%".$texto_buscar."%'
                   or total like '%".$texto_buscar."%'
                   or fecha like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerVenta(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_ventas");
    return $resultado_consulta;
 }


 public function crearVenta(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_ventas (`total`,`fecha`) VALUES ('".$this->total."', '".$this->fecha."')";
   // echo $consulta;

   $resultado= $conexion->query($consulta);
   return $resultado;
 }

 public function vistaDetalleFactura(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from vista_factura where id_factura=".$this->id_factura);

    return $resultado_consulta;
 }

   public function modificarFactura(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_facturas SET
       rut_proveedor = '".$this->rut_proveedor."',
       numero_factura = '".$this->numero_factura."',
       fecha = '".$this->fecha."'
        WHERE (id_factura = '".$this->id_factura."');";

// echo $consulta;
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
