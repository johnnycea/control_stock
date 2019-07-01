<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';

$Funciones = new Funciones();

$id_factura = $Funciones->limpiarNumeroEntero($_REQUEST['id_factura']);

$Facturas = new Facturas();
$Facturas->setIdFactura($id_factura);

  if($Facturas->eliminarFactura()){
     echo "1";
  }else{
     echo "2";
  }

?>
