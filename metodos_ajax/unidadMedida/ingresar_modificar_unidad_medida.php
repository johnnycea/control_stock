<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Conexion.php';
require_once '../../clases/UnidadMedida.php';

$Funciones = new Funciones();

$txt_id_unidad_medida = $Funciones->limpiarTexto($_REQUEST['txt_id_unidad_medida']);
$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);


$UnidadMedida = new UnidadMedida();
$UnidadMedida->setIdUnidadMedida($txt_id_unidad_medida);
$UnidadMedida->setDescripcionUnidadMedida($txt_descripcion);

if($txt_id_unidad_medida=="" || $txt_id_unidad_medida==" "){
//Si no tiene id de marca se debe crear nuevo marca
   if($UnidadMedida->crearUnidad()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si tiene id se modifca
  if($UnidadMedida->modificarUnidad()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
