<?php
require_once 'Conexion.php';

class ProductoElaborado{

  private $id_producto_elaborado;
  private $descripcion;
  private $valor;
  private $estado_producto;
  private $id_ingrediente;
  private $cantidad_ingrediente;
  private $imagen;


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
  public function setIdImagen ($id_imagen){
    $this->id_imagen=$id_imagen;
  }
  function setImagen($imagen){
    $this->imagen = $imagen;
  }

  public function obtener_ingredientes_producto(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "select * from vista_ingrediente_producto_elaborado where id_producto_elaborado=".$this->id_producto_elaborado;
    // echo $consulta;
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

    $consulta = "insert INTO tb_productos_elaborados (`descripcion`, `valor`, `estado_producto`,imagen) VALUES ('".$this->descripcion."', '".$this->valor."', '".$this->estado."','".$this->imagen."')";

    if($resultado = $Conexion->query($consulta)){

          $resultadoNuevoId = $Conexion->query("SELECT LAST_INSERT_ID() as id_creado");
          $resultadoNuevoId = $resultadoNuevoId->fetch_array();

          return $resultadoNuevoId['id_creado'];
echo $consulta;
    }
    else{
      return false;
    }

  }

  public function guardarIngredientesProducto(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "insert INTO tb_ingredientes_producto_elaborado (`id_producto_elaborado`, `id_producto_ingrediente`, `cantidad`) VALUES (".$this->id_producto_elaborado.", ".$this->id_ingrediente.", ".$this->cantidad_ingrediente.")";
    $resultado= $conexion->query($consulta);
    // echo $consulta;
    return $resultado;
  }


  function modificarProductoElaborado(){
      $Conexion = new Conexion();
      $Conexion = $Conexion->conectar();

      $consulta="";

     if($this->imagen == ""){

        $consulta = "update tb_productos_elaborados
                  set
                  descripcion = '".$this->descripcion."',
                  valor = '".$this->valor."',
                  estado_producto = '".$this->estado."'
                  WHERE (id_producto_elaborado = '".$this->id_producto_elaborado."')";

     }else{

      $consulta = "update tb_productos_elaborados
                set

                descripcion = '".$this->descripcion."',
                valor = '".$this->valor."',
                estado_producto = '".$this->estado."',
                imagen = '".$this->imagen."'
                 WHERE (id_producto_elaborado = '".$this->id_producto_elaborado."')";

     }

    // echo $consulta;

      if($Conexion->query($consulta)){
          return true;
      }else{
          return false;
      }
  }

  public function eliminarProductoElaborado(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta = "delete from tb_productos_elaborados WHERE (id_producto_elaborado = ".$this->id_producto_elaborado.")";


    //IMPORTANTE: REALIZAR COMPROBACION SI EXISTE EL PRODUCT_ELABORADO EN TABLA DETALLE_VENTA

    if($Conexion->query($consulta)){
        return true;
    }else{
        echo $consulta;
        // return false;
    }

  }

  public function eliminarIngrediente(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $consulta = "delete from tb_ingredientes_producto_elaborado where (`id_producto_elaborado` = ".$this->id_producto_elaborado.") and (`id_producto_ingrediente` = ".$this->id_ingrediente.")";
    // echo $consulta;
    if($Conexion->query($consulta)){
        return true;
    }else{
        echo $consulta;
        // return false;
    }

  }


}
 ?>
