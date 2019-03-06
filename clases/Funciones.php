<?php

class Funciones{

  public function limpiarTexto($arg_campoTexto){
      $resultado= filter_var($arg_campoTexto, FILTER_SANITIZE_STRING);
      return $resultado;
  }
  public function escaparComillas($arg_campoTexto){
      $resultado= addslashes($arg_campoTexto);
      return $resultado;
  }
  public function limpiarNumeroEntero($arg_numero){
    $resultado= filter_var($arg_numero, FILTER_SANITIZE_NUMBER_INT);
    return $resultado;
  }
  public function limpiarCorreo($arg_correo){
    $resultado= filter_var($arg_correo,FILTER_SANITIZE_EMAIL);
    return $resultado;
  }

}

 ?>
