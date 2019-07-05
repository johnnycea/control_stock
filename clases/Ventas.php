<?php
require_once 'Conexion.php';

class Ventas{

 private $id_producto_elaborado;
 private $id_venta;
 private $valor_unitario;
 private $cantidad;
 private $total;
 private $fecha;
 private $id_estado;
 private $tipo_venta;
 private $tipo_entrega;
 private $medio_pago;
 private $rut_cliente;
 private $id_detalle_venta;


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

 public function setIdEstado($parametro){
   $this->id_estado = $parametro;
 }
 public function setTipoVenta($parametro){
   $this->tipo_venta = $parametro;
 }
 public function setMedioPago($parametro){
   $this->medio_pago = $parametro;
 }
 public function setRutCliente($parametro){
   $this->rut_cliente = $parametro;
 }
 public function setTipoEntrega($parametro){
   $this->tipo_entrega = $parametro;
 }
 public function setIdDetalleVenta($parametro){
   $this->id_detalle_venta = $parametro;
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

 public function obtenerCantidadIngredienteVenta($ingrediente){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta ="select sum(cantidad) as cantidad from tb_ingredientes_venta  where id_ingrediente = ".$ingrediente." group by id_ingrediente";
    $resultado_consulta = $Conexion->query($consulta);

    if($resultado_consulta->num_rows > 0){
        $resultado_consulta = $resultado_consulta->fetch_array();
        $resultado_consulta = $resultado_consulta['cantidad'];
    }else{
        $resultado_consulta = 0;
    }

    return $resultado_consulta;
 }

 public function registrarIngredienteVenta($ingrediente,$cantidad_ingrediente){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("insert into tb_ingredientes_venta values(".$this->id_detalle_venta.",".$this->id_venta.",".$this->id_producto_elaborado.",".$ingrediente.",".$cantidad_ingrediente.");");
    return $resultado_consulta;
 }

 public function consultarUltimaVentaPendiente(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_ventas where id_estado = 1 order by fecha desc limit 1");
    return $resultado_consulta;
 }

 public function obtenerVenta(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_ventas");
    return $resultado_consulta;
 }

 public function cambiarEstadoPedido(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("update tb_ventas set id_estado=".$this->id_estado." where id_venta = ".$this->id_venta);
    return $resultado_consulta;
 }

 public function pedidoFinalizado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("update tb_ventas set `id_estado` = '4' WHERE (`id_venta` = '".$this->id_venta."')");
    return $resultado_consulta;
 }

 public function listadoPedidos(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from vista_ventas where estado=".$this->id_estado);
    // echo $resultado_consulta;
    return $resultado_consulta;
 }

 public function vistaDetalleVenta(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta ="select * from vista_detalle_venta where id_venta=".$this->id_venta;
    // echo $consulta;
    $resultado_consulta = $Conexion->query($consulta);
    // $resultado_consulta = $Conexion->query("select * from vista_detalle_venta");

    // echo $resultado_consulta;
    return $resultado_consulta;
 }


public function crearVenta(){
   $Conexion = new Conexion();
   $Conexion = $Conexion->conectar();

   $consulta = "insert INTO tb_ventas () VALUES ()";

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

public function obtenerFechaPrimeraUltimaVenta(){
   $Conexion = new Conexion();
   $Conexion = $Conexion->conectar();

   $consulta = "select min(date(fecha)) as fecha_primera_venta, max(date(fecha)) as fecha_ultima_venta from tb_ventas";
   $resultado = $Conexion->query($consulta);

   $fechas = array();

   $fechas['fecha_primera_venta'] = '0000-00-00';
   $fechas['fecha_ultima_venta'] = '0000-00-00';

   if($resultado->num_rows>0){

        $resultado = $resultado->fetch_array();
        $fechas['fecha_primera_venta'] = $resultado['fecha_primera_venta'];
        $fechas['fecha_ultima_venta'] = $resultado['fecha_ultima_venta'];
        return $fechas;

   }else{
     return $fechas;
   }

 }





 //
 // public function guardarDetalleVenta(){
 //   $Conexion = new Conexion();
 //   $Conexion = $Conexion->conectar();
 //   $consulta = "insert into detalle_venta (`id_producto`, `id_venta`, `valor_unitario`, `cantidad`, `valor_total`) VALUES ('".$this->id_producto_elaborado."', '".$this->id_venta."', '".$this->valor_unitario."', '".$this->cantidad ."', '".$this->total."')";
 //   // echo $consulta;
 //   $resultado= $Conexion->query($consulta);
 //   return $resultado;
 //
 // }


 public function guardarDetalleVenta(){
   $Conexion = new Conexion();
   $Conexion = $Conexion->conectar();

   $consulta ="";

//   // PREGUNTAR SI EL EL PRODUCTO QUE SE QUIERE INGRESAR SE ECUENTRA EN LA VENTA A LA QUE SE QUIERE INGRESAR EL Producto
//    $consultaVentaProducto = $Conexion->query("select cantidad,valor_unitario from detalle_venta where id_venta=".$this->id_venta." and id_producto=".$this->id_producto_elaborado);
//
//
//      if($consultaVentaProducto->num_rows>0){
//            // SI EL PRODUCTO YA SE INGRESO SE DEBE: CONSULTAR LA CANTIDAD QE ESTABA INGRESADA Y SUMARLE LA CANTIDAD QUE SE QUIERE ingresar y actualizar
//
//           $consultaVentaProducto = $consultaVentaProducto->fetch_array();
//           $cantidad = $consultaVentaProducto['cantidad'];  //DENTRO DE LOS PRIMEROS CORCHETES SE INGRESA A QUE FILA DE LA CONSULTA QUIERE ACCEDER
//
// // echo $cantidad;
//           $cantidad += $this->cantidad;
//           $valor_total = $cantidad*$consultaVentaProducto['valor_unitario'];
//
//           $consulta = "UPDATE detalle_venta SET `cantidad` = ".$cantidad .", valor_total=".$valor_total." WHERE (`id_producto` = '".$this->id_producto_elaborado."') and (`id_venta` = '".$this->id_venta."')";
//
//    }else{
     //SI EL PRODCUTO NO ESTABA INGRESADO, SIMPLEMENTE SE INGRESA
       $consulta = "insert into detalle_venta (`id_producto`, `id_venta`, `valor_unitario`, `valor_total`) VALUES ('".$this->id_producto_elaborado."', '".$this->id_venta."', '".$this->valor_unitario."', '".$this->valor_unitario."')";
   // }

   if($Conexion->query($consulta)){
     return true;
   }else{
     return false;
   }


 }



   public function finalizarVenta(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "update tb_ventas set id_estado=".$this->id_estado.",
                  fecha=NULL,
                  tipo_venta=".$this->tipo_venta.",
                  medio_pago=".$this->medio_pago.",
                  tipo_entrega=".$this->tipo_entrega.",
                  rut_cliente=".$this->rut_cliente."
                  where id_venta=".$this->id_venta;

// echo $consulta;
     if($Conexion->query($consulta)){
         return true;
     }else{
         echo $consulta;
     }

   }


   public function eliminarProductoVenta(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from detalle_venta where id_detalle_venta = ".$this->id_detalle_venta;

     if($Conexion->query($consulta)){
         return true;
     }else{
         echo $consulta;
         // return false;
     }

   }


}
 ?>
