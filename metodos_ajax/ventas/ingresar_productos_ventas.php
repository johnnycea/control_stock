<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$id_producto = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto']);
$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);
$valor_unitario = $Funciones->limpiarNumeroEntero($_REQUEST['valor_unitario']);
$txt_cantidad = $Funciones->limpiarNumeroEntero($_REQUEST['txt_cantidad']);
// $valor_total = $Funciones->limpiarNumeroEntero($_REQUEST['valor_total']);


$Ventas = new Ventas();
$Ventas->setIdProductoElaborado($id_producto);
$Ventas->setIdVenta($id_venta);
$Ventas->setvalorUnitario($valor_unitario);
// $Ventas->setCantidad($txt_cantidad);//se carga por defecto en 1
// $Ventas->setTotal($valor_total);


$comprobar_guardado=false;

 for($c=0; $c<$txt_cantidad; $c++){

   if($Ventas->guardarDetalleVenta()){
     $comprobar_guardado =true;
   }else{
     $comprobar_guardado=false;
   }
 }


  echo ($comprobar_guardado==true) ? "1" : "2";



?>
