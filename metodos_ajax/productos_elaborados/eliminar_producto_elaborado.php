<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';

$Funciones = new Funciones();

$id_producto_elaborado = $Funciones->limpiarTexto($_REQUEST['id']);

$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setIdProductoElaborado($id_producto_elaborado);

  if($ProductoElaborado->eliminarProductoElaborado()){
     echo "1";
  }else{
     echo "2";
  }

?>
