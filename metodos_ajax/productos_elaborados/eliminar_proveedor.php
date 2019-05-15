<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Proveedor.php';

$Funciones = new Funciones();

$rut_proveedor = $Funciones->limpiarTexto($_REQUEST['id']);

$Proveedor = new Proveedor();
$Proveedor->setRutProveedor($rut_proveedor);

  if($Proveedor->eliminarProveedor()){
     echo "1";
  }else{
     echo "2";
  }

?>
