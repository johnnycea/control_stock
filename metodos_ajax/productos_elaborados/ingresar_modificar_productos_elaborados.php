<?php
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';
require_once '../../clases/Conexion.php';

$Funciones = new Funciones();

$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$txt_valor = $Funciones->limpiarTexto($_REQUEST['txt_valor']);
$txt_valor = str_replace(".","",$txt_valor);
$txt_valor = str_replace("$","",$txt_valor);
$select_estado = $Funciones->limpiarNumeroEntero($_REQUEST['select_estado']);
$select_imagen = $_FILES['select_imagen'];


$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setDescripcion($txt_descripcion);
$ProductoElaborado->setValor($txt_valor);
$ProductoElaborado->setEstado($select_estado);


if ($_REQUEST['txt_id_producto_elaborado_modificar']=="") {//debe crear nuevo producto


  if($select_imagen['name']==""){
      echo "error3";//debe seleccionar imagen

  }else{

      if (move_uploaded_file($select_imagen["tmp_name"], "../../imagenes/productos_elaborados/".$select_imagen['name'])) {
            //SE CREA  EL PRODUCTO SOLO SI LAS IMAGEN SE HA SUBIDO
             $ProductoElaborado->setImagen($select_imagen['name']);
             if($id_creado = $ProductoElaborado->crearProductoElaborado()){
                echo $id_creado;
             }else{
                echo "error2";//error al crear
             }

      } else {
          echo "error4";//ERROR AL SUBIR LA IMAGEN
      }

  }

}else{//modificar producto

  $id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['txt_id_producto_elaborado_modificar']);
  $ProductoElaborado->setIdProductoElaborado($id_producto_elaborado);

  $imagen_correcta = false;

  if($select_imagen['name']==""){
    //no setea la imagen
     $imagen_correcta = true;

  }else{
    $ProductoElaborado->setImagen($select_imagen['name']);

    if (move_uploaded_file($select_imagen["tmp_name"], "../../imagenes/productos_elaborados/".$select_imagen['name'])) {

      $imagen_correcta = true;

    } else {
        echo "error4";//ERROR AL SUBIR LA IMAGEN
    }
  }



if($imagen_correcta==true){

  if($ProductoElaborado->modificarProductoElaborado()){
     echo $_REQUEST['txt_id_producto_elaborado_modificar'];
  }else{
     echo "error2";
  }

}else{
  echo "error5";//la imagen tiene lios tio
}





}





                   // $numeroRandom= rand(5,1000).date("d").date("m").date("Y");
                   // $nombreImagenActual=$numeroRandom.basename($_FILES['select_imagen']['name']);
                   // $nombreImagenActual= str_replace("�","n",$nombreImagenActual);
                   // $nombreImagenActual= str_replace("ñ","n",$nombreImagenActual);
                   // $nombreImagenActual= str_replace("Ñ","N",$nombreImagenActual);
                   //
                   //     $target_path = "./imagenes/productos_elaborados/";
                   //     $target_path = $target_path.$nombreImagenActual;
                   //
                   //
                   //     $target_path= str_replace("�","n",$target_path);
                   //     $target_path= str_replace("ñ","n",$target_path);
                   //     $target_path= str_replace("Ñ","N",$target_path);






?>
