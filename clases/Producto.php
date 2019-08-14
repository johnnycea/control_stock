<?php
require_once 'Conexion.php';

class Producto{

 private $id_producto;
 private $descripcion;
 private $stock_minimo;
 private $id_unidad_medida;
 private $marca;
 private $id_estado;
 private $id_producto_elaborado;
 private $id_producto_ingrediente;
 private $cantidad;

 private $editable;
 private $valor_extra;

 public function setIdProducto($id_producto){
   $this->id_producto = $id_producto;
 }
 public function setDescripcion($descripcion){
   $this->descripcion = $descripcion;
 }
 public function setStockMinimo($stock_minimo){
   $this->stock_minimo = $stock_minimo;
 }
 public function setIdUnidadMedida($parametro){
   $this->id_unidad_medida = $parametro;
 }
 public function setMarca($parametro){
   $this->marca = $parametro;
 }
 public function setIdEstado($id_estado){
   $this->id_estado = $id_estado;
 }
 public function setIdProductoElaborado($id_producto_elaborado){
   $this->id_producto_elaborado = $id_producto_elaborado;
 }
 public function setCantidad($cantidad){
   $this->cantidad = $cantidad;
 }
 public function setEditable($parametro){
   $this->editable = $parametro;
 }
 public function setValorExtra($parametro){
   $this->valor_extra = $parametro;
 }


 function obtenerProductos($texto_buscar){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();
     $consulta="";

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select p.id_producto, p.editable, p.valor_extra, p.unidad_medida as id_unidad_medida, p.descripcion, p.marca, um.descripcion as unidad_medida, p.stock_minimo
                                             FROM tb_productos p
                                             inner join tb_unidades_medida um on p.unidad_medida=um.id_unidad_medida
                                             where p.id_producto like '%".$texto_buscar."%' or p.descripcion like '%".$texto_buscar."%' order by p.id_producto asc";
     }else{
       $consulta= "select p.id_producto, p.editable, p.valor_extra, p.unidad_medida as id_unidad_medida, p.descripcion, p.marca, um.descripcion as unidad_medida, p.stock_minimo
                   FROM tb_productos p
                   inner join tb_unidades_medida um on p.unidad_medida=um.id_unidad_medida
                   where id_producto like '%".$texto_buscar."%'
                   or descripcion like '%".$texto_buscar."%'
                   or stock_minimo like '%".$texto_buscar."%'
                   or marca like '%".$texto_buscar."%'
                   or id_estado like '%".$texto_buscar."%'
                   order by p.id_producto asc ";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerProducto(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_productos where id_producto=".$this->id_producto);

    return $resultado_consulta;
 }


 public function obtenerProductosParaIngredientes($texto_buscar){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select p.id_producto, p.unidad_medida as id_unidad_medida, p.descripcion, p.marca, um.descripcion as unidad_medida, p.stock_minimo
                                          FROM tb_productos p
                                          inner join tb_unidades_medida um on p.unidad_medida=um.id_unidad_medida
                                          where p.id_producto like '%".$texto_buscar."%' or p.descripcion like '%".$texto_buscar."%' order by p.id_producto asc");


    return $resultado_consulta;
 }

 public function crearProducto(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_productos (`id_producto`,`descripcion`,`stock_minimo`,`marca`,`id_estado`) VALUES ('".$this->id_producto."', '".$this->descripcion."', '".$this->stock_minimo."',  '".$this->marca."', '".$this->id_estado."')";
   echo $consulta;
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

 public function crearIngrediente(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_productos (id_producto,descripcion,stock_minimo,marca,id_estado,unidad_medida,editable,valor_extra)
               VALUES ('".$this->id_producto."', '".$this->descripcion."', '".$this->stock_minimo."',  '".$this->marca."', '".$this->id_estado."', '".$this->id_unidad_medida."',".$this->editable.",".$this->valor_extra.")";
   // echo $consulta;
   $resultado= $conexion->query($consulta);
   return $resultado;
 }


   public function modificarIngrediente(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_productos SET
       descripcion = '".$this->descripcion."',
       stock_minimo = '".$this->stock_minimo."',
       marca = '".$this->marca."',
       id_estado = '".$this->id_estado."',
       editable = ".$this->editable.",
       valor_extra = ".$this->valor_extra."
        WHERE (id_producto = '".$this->id_producto."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarIngrediente(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="delete from tb_productos
        WHERE (id_producto = '".$this->id_producto."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }






}
 ?>
