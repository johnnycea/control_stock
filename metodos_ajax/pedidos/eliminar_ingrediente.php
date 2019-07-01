<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';

// echo "llega eliminarIngrediente";
$Funciones = new Funciones();

$id_ingrediente = $Funciones->limpiarNumeroEntero($_REQUEST['id_ingrediente']);
$id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);
//
// echo "Producto Elaborado: " . $id_producto_elaborado;
// echo "Ingrediente: " . $id_ingrediente;

$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setIdIngrediente($id_ingrediente);
$ProductoElaborado->setIdProductoElaborado($id_producto_elaborado);

  if($ProductoElaborado->eliminarIngrediente()){
     echo "1";
  }else{
     echo "2";
  }

?>
