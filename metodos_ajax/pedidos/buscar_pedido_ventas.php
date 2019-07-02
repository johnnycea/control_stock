<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Venta.php';


$Funciones = new Funciones();
$texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);


$Ventas = new Ventas();
$Ventas->setIdVenta();
$listadoVenta = $Ventas->vistaDetalleVenta();


$venta_encontrada = array();

  while($filas = $listadoVenta->fetch_array()){
     $venta_encontrada['id_producto'] = $filas['id_producto'];
     // $venta_encontrada['id_venta'] = $filas['id_venta'];
     $venta_encontrada['valor_unitario'] = $filas['valor_unitario'];
     $venta_encontrada['cantidad'] = $filas['cantidad'];
     $venta_encontrada['valor_total'] = $filas['valor_total'];
  }


 echo json_encode($venta_encontrada);

 ?>
