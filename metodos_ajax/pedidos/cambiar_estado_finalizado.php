<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';


$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id']);
// $tipo_entrega = $Funciones->limpiarNumeroEntero($_REQUEST['tipo_entrega']);

$Ventas = new Ventas();
$Ventas->setIdVenta($id_venta);

if($Ventas->pedidoFinalizado()){
   echo "1";
}else{
   echo "2";
}

?>
