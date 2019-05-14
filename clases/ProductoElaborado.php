<?php
require_once 'Conexion.php';

class Producto{




  function crearProductoElaborado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta ="insert a la tabla";

    if($resultado = $Conexion->query($consulta)){

          $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id");
          $resultadoNuevoId = $resultadoNuevoId->fetch_array();

          echo "BIEN JOHNN, HAS LLEGADO A TU DESTINO, LLAMAME PORFAVOR, BESOS¡ EL ID CREADO ES: ".$resultadoNuevoId['id_creado'];

          return $resultadoNuevoId['id_creado'];


    }else{
      return false;
    }

  }




}
 ?>
