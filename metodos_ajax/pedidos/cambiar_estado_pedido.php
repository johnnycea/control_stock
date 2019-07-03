<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';


$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$tipo_entrega = $Funciones->limpiarNumeroEntero($_REQUEST['tipo_entrega']);
$estado_actual = $Funciones->limpiarNumeroEntero($_REQUEST['estado_actual']);


$Ventas = new Ventas();
$Ventas->setIdVenta($id_venta);

if($tipo_entrega==1){//si es retiro en local

   $Ventas->setIdEstado(4);

}else if($tipo_entrega==2){//si es a domicilio

  if($estado_actual==2){
    $Ventas->setIdEstado(3);
  }else if($estado_actual==3){
    $Ventas->setIdEstado(4);
  }

}

  if($Ventas->cambiarEstadoPedido()){
     echo "1";
  }else{
     echo "2";
  }

?>
