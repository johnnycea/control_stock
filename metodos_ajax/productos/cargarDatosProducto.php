<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Producto.php';


$Funciones = new Funciones();
$id_producto = $Funciones->limpiarTexto($_REQUEST['id_producto']);

       $Producto = new Producto();
       $Producto->setIdProducto($id_producto);
       $resultadoProducto = $Producto->obtenerProducto(); //$texto_buscar," where id_estado=1 or id_estado=2 "

      $filas = $resultadoProducto->fetch_array();

     $resultado = '
     {   "descripcion" : "'.$filas['descripcion'].'",
         "marca"       : "'.$filas['id_marca'].'",
         "categoria"  : "'.$filas['id_categoria'].'",
         "stock_minimo"  : "'.$filas['stock_minimo'].'"}

     ';

     echo $resultado;

 ?>
