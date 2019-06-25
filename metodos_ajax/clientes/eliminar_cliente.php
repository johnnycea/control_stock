<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Cliente.php';

// echo "llega eliminarIngrediente";
$Funciones = new Funciones();

$rut_cliente = $Funciones->limpiarNumeroEntero($_REQUEST['id']);
//
// echo "Producto Elaborado: " . $id_producto_elaborado;
// echo "Ingrediente: " . $id_ingrediente;

$Cliente = new Cliente();
$Cliente->setRutCliente($rut_cliente);

  if($Cliente->eliminarCliente()){
     echo "1";
  }else{
     echo "2";
  }

?>
