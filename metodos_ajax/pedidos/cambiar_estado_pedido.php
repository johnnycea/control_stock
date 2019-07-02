<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';

// echo "llega eliminarIngrediente";
$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$tipo_entrega = $Funciones->limpiarNumeroEntero($_REQUEST['tipo_entrega']);
//
// echo "Producto Elaborado: " . $id_producto_elaborado;
// echo "Ingrediente: " . $id_ingrediente;

$Ventas = new Ventas();
$Ventas->setIdVenta($id_venta);

if($tipo_entrega==1){
   $Ventas->setIdEstado(4);
}else if($tipo_entrega==2){
  $Ventas->setIdEstado(3);
}

  if($Ventas->cambiarEstadoPedido()){
     echo "1";
  }else{
     echo "2";
  }

?>
