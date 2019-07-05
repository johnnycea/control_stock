<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';


@session_start();

$Funciones = new Funciones();
$id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['id_producto_elaborado']);
$id_ingrediente = $Funciones->limpiarNumeroEntero($_REQUEST['id_ingrediente']);
$accion = $Funciones->limpiarNumeroEntero($_REQUEST['accion']);
$id_detalle_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_detalle_venta']);

$array_listado_ingredientes_producto = $_SESSION['listado_ingredientes_productos'];
$cantidad_ingrediente;



       foreach($array_listado_ingredientes_producto as $ingrediente => $valores){
          if( ($id_producto_elaborado == $valores['id_producto_elaborado']) and ($id_ingrediente == $valores['id_producto']) and ($id_detalle_venta == $valores['id_detalle_venta']) ){


                 $cantidad_ingrediente = $valores['cantidad'];

              if($accion == 1){//sumar un ingrediente
                 $cantidad_ingrediente++;

              }else if($accion == 2 and $cantidad_ingrediente>0){//resta un ingrediente
                $cantidad_ingrediente--;
              }

              $array_listado_ingredientes_producto[$ingrediente]['cantidad'] = $cantidad_ingrediente;
              break;

          }
       }


  $_SESSION['listado_ingredientes_productos'] = $array_listado_ingredientes_producto;


?>
