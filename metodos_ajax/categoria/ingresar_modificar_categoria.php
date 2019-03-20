<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/Categoria.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_id_categoria = $Funciones->limpiarTexto($_REQUEST['txt_id_categoria']);
$txt_descripcion_categoria = $Funciones->limpiarTexto($_REQUEST['txt_descripcion_categoria']);


$Categoria = new Categoria();
$Categoria->setIdCategoria($txt_id_categoria);
$Categoria->setDescripcionCategoria($txt_descripcion_categoria);

if($txt_id_categoria=="" || $txt_id_categoria==" "){
//Si no tiene id de marca se debe crear nuevo marca
   if($Categoria->crearCategoria()){
      echo "1";
   }else{
     echo "2";
   }
}else{
//si tiene id se modifca
  if($Categoria->modificarCategoria()){
    echo "1";
  }else{
    echo "2";
  }

}


?>
