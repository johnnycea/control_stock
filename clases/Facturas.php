<?php
require_once 'Conexion.php';

class Facturas{

 private $id_factura;
 private $id_producto;
 private $rut_proveedor;
 private $numero_factura;
 private $fecha;
 private $cantidad;
 private $valor;

 public function setIdFactura($id_factura){
   $this->id_factura = $id_factura;
 }
 public function setRutProveedor($rut_proveedor){
   $this->rut_proveedor = $rut_proveedor;
 }
 public function setNumeroFactura($numero_factura){
   $this->numero_factura = $numero_factura;
 }
 public function setFecha($fecha){
   $this->fecha = $fecha;
 }
 public function setCantidad($cantidad){
   $this->cantidad = $cantidad;
 }
 public function setValor($valor){
   $this->valor = $valor;
 }
 public function setIdProducto($id_producto){
   $this->id_producto = $id_producto;
 }


 function obtenerFacturas($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_facturas ".$condiciones."";
     }else{
       $consulta= "select * from tb_facturas
                   where id_factura like '%".$texto_buscar."%'
                   or rut_proveedor like '%".$texto_buscar."%'
                   or numero_factura like '%".$texto_buscar."%'
                   or fecha_factura like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerFactura(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_facturas where id_factura=".$this->id_factura );
    return $resultado_consulta;
 }
 public function obtenerProductoDetallefactura(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_detalle_factura where id_producto=".$this->id_producto." and id_factura=".$this->id_factura );
    return $resultado_consulta;
 }

 public function crearFactura(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_facturas (`rut_proveedor`,`numero_factura`,`fecha_factura`) VALUES ('".$this->rut_proveedor."', '".$this->numero_factura."', '".$this->fecha."')";
   // echo $consulta;

   $resultado= $conexion->query($consulta);
   return $resultado;
 }
 public function crearDetalleFactura(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_detalle_factura (`id_factura`,`id_producto`,`cantidad`,`valor`) VALUES ('".$this->id_factura."', '".$this->id_producto."', '".$this->cantidad."', '".$this->valor."')";
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

   public function modificarDetalleFactura(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_detalle_factura SET
       cantidad = '".$this->cantidad."',
       valor = '".$this->valor."'
        WHERE (id_factura = '".$this->id_factura."' and id_producto=".$this->id_producto.");";

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
