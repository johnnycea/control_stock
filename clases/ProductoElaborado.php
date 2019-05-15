<?php
require_once 'Conexion.php';

class ProductoElaborado{

  private $id_producto_elaborado;
  private $descripcion;
  private $valor;
  private $estado_producto;

  public function setIdProductoElaborado($id_producto_elaborado){
    $this->id_producto_elaborado = $id_producto_elaborado;
  }
  public function setDescripcion($descripcion){
    $this->descripcion = $descripcion;
  }
  public function setValor($valor){
    $this->valor = $valor;
  }
  public function setEstado($estado){
    $this->estado = $estado;
  }

  function obtenerProductoElaborado($texto_buscar,$condiciones){
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

      if($texto_buscar=="" || $texto_buscar==" "){
        $consulta= "select * from tb_productos_elaborados ".$condiciones."";
      }else{
        $consulta= "select * from tb_productos_elaborados
                    where id_producto_elaborado like '%".$texto_buscar."%'
                    or descripcion like '%".$texto_buscar."%'
                    or valor like '%".$texto_buscar."%'
                    or estado_producto like '%".$texto_buscar."%'";
      }
      $resultado= $conexion->query($consulta);
      if($resultado){
         return $resultado;
      }else{
        return false;
      }
  }

  function crearProductoElaborado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta = "insert INTO tb_productos_elaborados (`id_producto_elaborado`, `descripcion`, `valor`, `estado_producto`) VALUES ('".$this->id_producto_elaborado."', '".$this->descripcion."', '".$this->valor."', '".$this->estado."')";
    // INSERT INTO `daemmulc_stock`.`tb_productos_elaborados` (`id_producto_elaborado`, `descripcion`, `valor`, `estado_producto`) VALUES ('2', 'sasas', '222', '1');

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
