<?php
require_once 'Conexion.php';

class Ventas{

 private $id_producto_elaborado;
 private $id_venta;
 private $valor_unitario;
 private $cantidad;
 private $total;
 private $fecha;


 public function setIdProductoElaborado($id_producto_elaborado){
   $this->id_producto_elaborado = $id_producto_elaborado;
 }
 public function setIdVenta($id_venta){
   $this->id_venta = $id_venta;
 }
 public function setvalorUnitario($valor_unitario){
   $this->valor_unitario = $valor_unitario;
 }
 public function setCantidad($cantidad){
   $this->cantidad = $cantidad;
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

 public function vistaDetalleVenta(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from vista_detalle_venta where id_venta=".$this->id_venta);
    // $resultado_consulta = $Conexion->query("select * from vista_detalle_venta");

    // echo $resultado_consulta;
    return $resultado_consulta;
 }


public function crearVenta(){
   $Conexion = new Conexion();
   $Conexion = $Conexion->conectar();

   $consulta = "insert INTO tb_ventas (`total`,`fecha`) VALUES ('".$this->total."', '".$this->fecha."')";

   if($resultado = $Conexion->query($consulta)){

         $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id_creado");
         $resultadoNuevoId = $resultadoNuevoId->fetch_array();

         return $resultadoNuevoId['id_creado'];
// echo $consulta;
   }
   else{
     return false;
   }

 }

 public function guardarDetalleVenta(){
   $Conexion = new Conexion();
   $Conexion = $Conexion->conectar();

  //PREGUNTAR SI EL EL PRODUCTO QUE SE QUIERE INGRESAR SE ECUENTRA EN LA VENTA A LA QUE SE QUIERE INGRESAR EL Producto

  //SI EL PRODUCTO YA SE INGRESO SE DEBE: CONSULTAR LA CANTIDAD QE ESTABA INGRESADA Y SUMARLE LA CANTIDAD QUE SE QUIERE ingresar y actualizar 


  //SI EL PRODCUTO NO ESTABA INGRESADO, SIMPLEMENTE SE INGRESA

   $consulta = "insert into detalle_venta (`id_producto`, `id_venta`, `valor_unitario`, `cantidad`, `valor_total`) VALUES ('".$this->id_producto_elaborado."', '".$this->id_venta."', '".$this->valor_unitario."', '".$this->cantidad ."', '".$this->total."')";
   // echo $consulta;


   $resultado= $Conexion->query($consulta);
   return $resultado;

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


   public function eliminarProductoVenta(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from detalle_venta where (`id_producto` = ".$this->id_producto_elaborado.") and (`id_venta` = ".$this->id_venta.")";
                  // DELETE FROM detalle_venta WHERE (`id_producto` = '') and (`id_venta` = '');
      // echo $consulta;
     if($Conexion->query($consulta)){
         return true;
     }else{
         echo $consulta;
         // return false;
     }

   }


}
 ?>
