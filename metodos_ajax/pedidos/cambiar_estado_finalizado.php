<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';


$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$tipo_entrega = $Funciones->limpiarNumeroEntero($_REQUEST['tipo_entrega']);

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
