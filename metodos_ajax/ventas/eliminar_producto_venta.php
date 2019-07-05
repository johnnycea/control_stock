<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';

// echo "llega";
$Funciones = new Funciones();

$id_detalle_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_detalle_venta']);


$Ventas = new Ventas();
$Ventas->setIdDetalleVenta($id_detalle_venta);

  if($Ventas->eliminarProductoVenta()){
     echo "1";
  }else{
     echo "2";
  }

?>
