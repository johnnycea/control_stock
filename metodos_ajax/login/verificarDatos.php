<?php
require_once '../../clases/Usuario.php';
require_once '../../clases/Funciones.php';




$Usuario = new Usuario();
$Funciones = new Funciones();

$usuario = $_REQUEST["u"];
$contrasena = $_REQUEST["c"];

$usuario= $Funciones->limpiarTexto($usuario);
// $usuario= $Funciones->limpiarNumeroEntero($usuario);

        if(!$Usuario->validarRut($usuario)){
              echo "3"; //rut no valido
        }else{


            $posicionGuion = strpos($usuario,'-');
            $soloRunConPuntos = substr($usuario,0,$posicionGuion);
            $soloRun=str_replace(".", "", $soloRunConPuntos);

              if(is_numeric($soloRun)){

                      $Usuario->setRun($soloRun);
                      $Usuario->setClave($contrasena);

                      if($Usuario->comprobarUsuario()){
                            echo "1";//correcto
                      }else{
                            echo "2";//incorrecto
                      }
              }else{
                echo "3";//NO ES UN NUMERO, HAY LETRAS
              }

          }

 ?>
