<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Marca.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

// $id_marca = $Funciones->limpiarTexto($_REQUEST['txt_id_marca']);
$nombre_marca = $Funciones->limpiarTexto($_REQUEST['txt_nombre_marca']);


$Marca = new Marca();
// $Marca->setIdMarca($id_marca);
$Marca->setNombreMarca($nombre_marca);

$consultaExisteMarca = $Marca->obtenerMarca("");

if($consultaExisteMarca->num_rows==0){
//Si no devuelve nada, se debe crear nueva marca
   if($Marca->crearMarca()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si deveulve filas, la marca existe en bd, por lo tato se modifca
  if($Marca->modificarMarca()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
