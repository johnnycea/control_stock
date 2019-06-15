<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Facturas.php';

$Funciones = new Funciones();

$id_factura = $Funciones->limpiarTexto($_REQUEST['id_factura']);

$Facturas = new Facturas();
$Facturas->setRutProveedor($id_factura);

  if($Facturas->eliminarFactura()){
     echo "1";
  }else{
     echo "2";
  }

?>
