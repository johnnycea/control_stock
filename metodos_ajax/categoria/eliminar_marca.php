<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/Marca.php';

$Funciones = new Funciones();

$id_marca = $Funciones->limpiarTexto($_REQUEST['id']);

$Marca = new Marca();
$Marca->setIdMarca($id_marca);

  if($Marca->eliminarMarca()){
     echo "1";
  }else{
     echo "2";
  }

?>
