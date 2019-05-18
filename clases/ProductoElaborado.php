<?php
require_once 'Conexion.php';

class ProductoElaborado{

  private $id_producto_elaborado;
  private $descripcion;
  private $valor;
  private $estado_producto;
  private $id_ingrediente;
  private $cantidad_ingrediente;

  public function setIdProductoElaborado($id_producto_elaborado){
    $this->id_producto_elaborado = $id_producto_elaborado;
  }
  public function setIdIngrediente($parametro){
    $this->id_ingrediente = $parametro;
  }
  public function setCantidadIngrediente($parametro){
    $this->cantidad_ingrediente = $parametro;
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


  public function obtener_ingredientes_producto(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "select * from vista_ingrediente_producto_elaborado where id_producto_elaborado=".$this->id_producto_elaborado;
    $resultado= $conexion->query($consulta);
    return $resultado;
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

  public function obtenerProducto_Elaborado(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $resultado_consulta = $Conexion->query("select * from tb_productos_elaborados where id_producto_elaborado=".$this->id_producto_elaborado);
     return $resultado_consulta;
  }

  function crearProductoElaborado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta = "insert INTO tb_productos_elaborados (`descripcion`, `valor`, `estado_producto`) VALUES ('".$this->descripcion."', '".$this->valor."', '".$this->estado."')";

    if($resultado = $Conexion->query($consulta)){

          $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id_creado");
          $resultadoNuevoId = $resultadoNuevoId->fetch_array();

          return $resultadoNuevoId['id_creado'];

    }
    else{
      return false;
    }

  }

  public function guardarIngredientesProducto(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "insert INTO tb_ingredientes_producto_elaborado (`id_producto_elaborado`, `id_producto_ingrediente`, `cantidad`) VALUES ('".$this->id_producto_elaborado."', '".$this->id_ingrediente."', '".$this->cantidad_ingrediente."')";
    $resultado= $conexion->query($consulta);
    return $resultado;
  }


  public function eliminarProductoElaborado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta = "delete from tb_productos_elaborados WHERE (id_producto_elaborado = ".$this->id_producto_elaborado.")";

    if($Conexion->query($consulta)){
        return true;
    }else{
        echo $consulta;
        // return false;
    }

  }




}
 ?>
