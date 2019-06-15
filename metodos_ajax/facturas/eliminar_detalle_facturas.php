<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';

$Funciones = new Funciones();

$id_producto = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto']);
$id_factura = $Funciones->limpiarNumeroEntero($_REQUEST['id_factura']);

$Facturas = new Facturas();
$Facturas->setIdFactura($id_factura);
$Facturas->setIdProducto($id_producto);

  if($Facturas->eliminarDetalleFactura()){
     echo "1";
  }else{
     echo "2";
  }

?>
