<?php
require_once '../../clases/Conexion.php';
require_once '../../clases/Funciones.php';
require_once '../../clases/Usuario.php';

$Funciones = new Funciones();

$rut = $Funciones->limpiarNumeroEntero($_REQUEST['txt_rut_usuario']);
$nombre = $Funciones->limpiarTexto($_REQUEST['txt_nombre_usuario']);
$correo = $Funciones->limpiarTexto($_REQUEST['txt_correo_usuario']);

$estado = $Funciones->limpiarTexto($_REQUEST['select_estado_usuario']);
$privilegio = $Funciones->limpiarTexto($_REQUEST['select_privilegio_usuario']);

$Usuario = new Usuario();
$Usuario->setRun($rut);
$Usuario->setNombre($nombre);
$Usuario->setCorreo($correo);
$Usuario->setEstado($estado);
$Usuario->setPrivilegio($privilegio);

if($Usuario->modificarUsuario()){

    if(isset($_REQUEST['txt_contrasenia_usuario'])){
        //ENTRA CUANDO LLENÓ FORMULARIO PARA CAMBIAR CONTRASEÑA
        $clave = $_REQUEST['txt_contrasenia_usuario'];
        $clave2 = $_REQUEST['txt_confirme_contrasenia_usuario'];

        if($clave==$clave2){
             $Usuario->setClave($_REQUEST['txt_contrasenia_usuario']);
             if($Usuario->cambiarClave()){
               echo "1";
             }else{
               echo "2";
             }
        }else{
          echo "3"; //la claves no coinciden
        }

    }else{
      echo "1";
    }

}else{
   echo "2";
}

 ?>
