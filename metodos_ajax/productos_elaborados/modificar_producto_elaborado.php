<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/ProductoElaborado.php';

$Funciones = new Funciones();

//SE DEFINEN VARIABLES
//SE ASIGNAN LOS VALORES RECIBIDOS
//SE LIMPIAN LOS DATOS RECIBIDOS DE CARACTERES EXTRAÑOS
$txt_id_producto_elaborado = $Funciones->limpiarNumeroEntero($_REQUEST['txt_id_producto_elaborado']);
$txt_descripcion = $Funciones->limpiarTexto($_REQUEST['txt_descripcion']);
$txt_valor = $Funciones->limpiarNumeroEntero($_REQUEST['txt_valor']);
$select_estado = $Funciones->limpiarNumeroEntero($_REQUEST['select_estado']);

// $estado = $Funciones->limpiarNumeroEntero($_REQUEST['select_estado_usuario']);

//Creamos objeto de la clase empresa y seteamos sus valores
$ProductoElaborado = new ProductoElaborado();
$ProductoElaborado->setIdProductoElaborado($txt_id_producto_elaborado);
$ProductoElaborado->setDescripcion($txt_descripcion);
$ProductoElaborado->setValor($txt_valor);
$ProductoElaborado->setEstado($select_estado);

if($ProductoElaborado->modificarProductoElaborado()){
   echo "1";
}else{
   echo "2";
}

//
// $numeroRandom= rand(5,1000).date("d").date("m").date("Y");
// $nombreImagenActual=$numeroRandom.basename( $_FILES[$campo]['name']);
// // $nombreImagenActual= str_replace("�","n",$nombreImagenActual);
// // $nombreImagenActual= str_replace("ñ","n",$nombreImagenActual);
// // $nombreImagenActual= str_replace("Ñ","N",$nombreImagenActual);
//
//     $target_path = "./imagenes/empresas/";
//     $target_path = $target_path.$nombreImagenActual;
//     $file = $_FILES[$campo];
//
//           if(move_uploaded_file($file['tmp_name'],"../../imagenes/empresas/".$file['name'])){
//                // echo " Ha sido subido satisfactoriamente";
//                echo "se subio la imagen";
//           }else{
//             echo "no se subio";
//           }
//
//
//           $conexion = new Conexion();
//           $conexion = $conexion->conectar();
//
//          $consultaFotos="insert into tb_imagenes_empresa(ruta_foto,id_empresa,tipo_imagen) values('".$nombreImagenActual."',".$id_empresa.",".$tipoImagenFinal.")";
//
//          if($conexion->query($consultaFotos)){
//            echo "agrega foto";
//          }else{
//            echo "error al agregar foto";
//          }

 ?>
