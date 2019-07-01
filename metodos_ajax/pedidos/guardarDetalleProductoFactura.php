<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';
require_once '../../clases/Facturas.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_id_factura = $Funciones->limpiarTexto($_REQUEST['txt_id_factura']);
$txt_codigo_producto = $Funciones->limpiarTexto($_REQUEST['txt_codigo_producto']);
$txt_cantidad = $Funciones->limpiarTexto($_REQUEST['txt_cantidad']);
$txt_valor_unitario = $Funciones->limpiarTexto($_REQUEST['txt_valor_unitario']);


$Facturas = new Facturas();
$Facturas->setIdFactura($txt_id_factura);
$Facturas->setIdProducto($txt_codigo_producto);
$Facturas->setCantidad($txt_cantidad);
$Facturas->setValor($txt_valor_unitario);

$consultaExisteProductoEnDetalleFactura = $Facturas->obtenerProductoDetallefactura();

//CONSULTA SI EL PRODCUTO QUE SE VA A INGRESAR YA ESTA REGISTRADO EN EL DETALLE DE FACTURA
if($consultaExisteProductoEnDetalleFactura->num_rows==0){
  //SI NO ESTABA LO INGRESA
   if($Facturas->crearDetalleFactura()){
      echo "1";
   }else{
      echo "2";
   }
}else{
//SI YA ESTABA, LO MODIFICA
    if($Facturas->modificarDetalleFactura()){
       echo "1";
    }else{
       echo "2";
    }
}



?>
