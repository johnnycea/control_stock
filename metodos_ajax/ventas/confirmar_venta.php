<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Ventas.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$id_venta = $Funciones->limpiarNumeroEntero($_REQUEST['id_venta']);

// echo "id venta es: ".$id_venta;

//buscar los productos de la venta
$Venta = new Ventas();
$Venta->setIdVenta($id_venta);
$productos_venta = $Venta->vistaDetalleVenta();


$ProductoElaborado = new ProductoElaborado();

$comprueba_agrega_correctamente;

while($filas_productos = $productos_venta->fetch_array()){

   //BUSCA INGREDIENTES DEL PRODUCTO ELABORADO
   $ProductoElaborado->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
   $ingredientes_producto = $ProductoElaborado->obtener_ingredientes_producto();

   // echo "el prdoucto ".$filas_productos['descripcion']." tiene los siguientes ingredientes </br>";
   while($filas_ingredientes = $ingredientes_producto->fetch_array()){

        $Venta->setIdProductoElaborado($filas_productos['id_producto_elaborado']);
        // echo "ingrediente: ".$filas_ingredientes['descripcion']." cantidad: ".$filas_ingredientes['cantidad']." ".$filas_ingredientes['unidad_medida'];

           for($i = 0; $i<$filas_productos['cantidad']; $i++){
                if($Venta->registrarIngredienteVenta($filas_ingredientes['id_producto'],$filas_ingredientes['cantidad'])){
                     $comprueba_agrega_correctamente = true;
                }else{
                     $comprueba_agrega_correctamente = false;
                }
           }

   }


   if($comprueba_agrega_correctamente){

        $Venta->setIdEstado(2);
      if($Venta->cambiarEstadoVenta()){
         echo '1';
      }else{
        echo '3';//error al cambiar estado de venta
      }
   }else{
      echo '2';
   }

}


?>
