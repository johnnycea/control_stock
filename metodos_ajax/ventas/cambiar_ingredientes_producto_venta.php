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

$valor_acual = $Funciones->limpiarNumeroEntero($_REQUEST['valor_actual']);

$array_listado_ingredientes_producto = $_SESSION['listado_ingredientes_productos'];
$cantidad_ingrediente;
$extra;

$respuesta = array();

       foreach($array_listado_ingredientes_producto as $ingrediente => $valores){
          if( ($id_producto_elaborado == $valores['id_producto_elaborado']) and ($id_ingrediente == $valores['id_producto']) and ($id_detalle_venta == $valores['id_detalle_venta']) ){


                 $cantidad_ingrediente = $valores['cantidad'];
                 $extra = $valores['extra'];

              if($accion == 1){//sumar un ingrediente
                 $extra = ($extra==0) ? 2 : $extra+1;
                 $respuesta['descripcion'] = $valores['descripcion_producto_elaborado'].": ".$valores['descripcion']." X".$extra;
                 $respuesta['nuevo_valor'] = ($valor_acual+($valores['valor_extra']*($extra-1)));

              }else if($accion == 2 and $extra>0){//resta un ingrediente
                $extra = ($extra==2) ? 0 : $extra-1;
                $respuesta['descripcion'] = ($extra==0) ? $valores['descripcion_producto_elaborado'] : $valores['descripcion_producto_elaborado'].": ".$valores['descripcion']." X".$extra;
                $respuesta['nuevo_valor'] = ($extra==0) ? $valor_acual : ($valor_acual+($valores['valor_extra']*($extra-1)));

              }

              $array_listado_ingredientes_producto[$ingrediente]['extra'] = $extra;
              break;

          }
       }

  //actuliza el valor del producto en base de Datos
  $Conexion = new Conexion();
  $Conexion = $Conexion->conectar();
  if($Conexion->query("update detalle_venta
                      set valor_unitario = ".$respuesta['nuevo_valor'].",
                      valor_total = ".$respuesta['nuevo_valor']."
                      where id_detalle_venta = ".$id_detalle_venta)){
                        
      $respuesta['consulta'] = "si actualiza";
  }else{
      $respuesta['consulta'] = "no actualiza";
  }


  $_SESSION['listado_ingredientes_productos'] = $array_listado_ingredientes_producto;

 $respuesta['nuevo_valor'] = "$".number_format($respuesta['nuevo_valor'],0,",",".");
 echo json_encode($respuesta);

?>
