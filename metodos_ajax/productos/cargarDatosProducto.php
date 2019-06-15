<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';


$Funciones = new Funciones();
$id_producto = $Funciones->limpiarTexto($_REQUEST['id_producto']);

       $Producto = new Producto();
       $Producto->setIdProducto($id_producto);
       $resultadoProducto = $Producto->obtenerProducto(); //$texto_buscar," where id_estado=1 or id_estado=2 "


if($resultadoProducto->num_rows>0){

    $filas = $resultadoProducto->fetch_array();

   $resultado = '
   {   "descripcion" : "'.$filas['descripcion'].'",
       "marca"       : "'.$filas['marca'].'",
       "unidad_medida"  : "'.$filas['unidad_medida'].'",
       "stock_minimo"  : "'.$filas['stock_minimo'].'" }

   ';

}else{
  $resultado = '
  {   "descripcion" : "",
      "marca"       : "",
      "unidad_medida"  : "",
      "stock_minimo"  : "" }

  ';
}


     echo $resultado;

 ?>
