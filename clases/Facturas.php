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
 private $total_factura;

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
 public function setTotalFactura($parametro){
   $this->total_factura = $parametro;
 }


 function obtenerFacturas($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from vista_facturas ".$condiciones." order by fecha_factura desc";
     }else{
       $consulta= "select * from vista_facturas
                   where id_factura like '%".$texto_buscar."%'
                   or rut_proveedor like '%".$texto_buscar."%'
                   or numero_factura like '%".$texto_buscar."%'
                   or fecha_factura like '%".$texto_buscar."%'
                   order by fecha_factura desc";
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


 public function modificarFactura(){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     $consulta="update tb_facturas set
      rut_proveedor = '".$this->rut_proveedor."',
      numero_factura = '".$this->numero_factura."',
      fecha_factura = '".$this->fecha."'
        WHERE (id_factura = '".$this->id_factura."')";

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

   public function eliminarDetalleFactura(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_detalle_factura where id_factura=".$this->id_factura." and id_producto=".$this->id_producto;

// echo $consulta;
     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
          return false;
     }

   }

   public function eliminarFactura(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_facturas WHERE (id_factura = ".$this->id_factura.")";

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
          return false;
     }

   }

   public function mostrarStockIngresos(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $resultado_consulta = $Conexion->query("select * from vista_stock_ingresos order by stock asc" );
     return $resultado_consulta;
   }

}
 ?>
