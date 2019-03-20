<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_id_marca = $Funciones->limpiarTexto($_REQUEST['txt_id_marca']);
$txt_nombre_marca = $Funciones->limpiarTexto($_REQUEST['txt_nombre_marca']);


$Marca = new Marca();
$Marca->setIdMarca($txt_id_marca);
$Marca->setNombreMarca($txt_nombre_marca);

if($txt_id_marca=="" || $txt_id_marca==" "){
//Si no tiene id de marca se debe crear nuevo marca
   if($Marca->crearMarca()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si tiene id se modifca
  if($Marca->modificarMarca()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
