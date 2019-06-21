<?php

require_once '../../clases/Funciones.php';
require_once '../../clases/UnidadMedida.php';

$Funciones = new Funciones();

$id_unidad_medida = $Funciones->limpiarTexto($_REQUEST['id']);

$Unidad_Medida = new UnidadMedida();
$Unidad_Medida->setIdUnidadMedida($id_unidad_medida);

  if($Unidad_Medida->eliminarUnidad_medida()){
     echo "1";
  }else{
     echo "2";
  }

?>
