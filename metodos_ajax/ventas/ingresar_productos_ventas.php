<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$id_producto = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto']);
$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$valor_unitario = $Funciones->limpiarNumeroEntero($_REQUEST['valor_unitario']);
$txt_cantidad = $Funciones->limpiarNumeroEntero($_REQUEST['txt_cantidad']);
$valor_total = $Funciones->limpiarNumeroEntero($_REQUEST['valor_total']);


$Ventas = new Ventas();
$Ventas->setIdProductoElaborado($id_producto);
$Ventas->setIdVenta($id_venta);
$Ventas->setvalorUnitario($valor_unitario);
$Ventas->setCantidad($txt_cantidad);
$Ventas->setTotal($valor_total);


  if($Ventas->guardarDetalleVenta()){
     echo "1";
  }else{
     echo "2";
  }


?>
