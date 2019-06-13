<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';

// echo "llega";
$Funciones = new Funciones();

$id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto']);
$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
//
// echo "Producto Elaborado: " . $id_producto_elaborado;
 // echo "Venta: " . $id_venta;

$Ventas = new Ventas();
$Ventas->setIdProductoElaborado($id_producto_elaborado);
$Ventas->setIdVenta($id_venta);

  if($Ventas->eliminarProductoVenta()){
     echo "1";
  }else{
     echo "2";
  }

?>
