<?php
require_once 'Conexion.php';

class Producto{

 private $id_producto;
 private $descripcion;
 private $stock_minimo;
 private $id_categoria;
 private $id_marca;
 private $id_estado;
 private $id_producto_elaborado;
 private $id_producto_ingrediente;
 private $cantidad;

 public function setIdProducto($id_producto){
   $this->id_producto = $id_producto;
 }
 public function setDescripcion($descripcion){
   $this->descripcion = $descripcion;
 }
 public function setStockMinimo($stock_minimo){
   $this->stock_minimo = $stock_minimo;
 }
 public function setIdCategoria($id_categoria){
   $this->id_categoria = $id_categoria;
 }
 public function setIdMarca($id_marca){
   $this->id_marca = $id_marca;
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


 function obtenerProductos($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_productos ".$condiciones."";
     }else{
       $consulta= "select * from tb_productos
                   where id_producto like '%".$texto_buscar."%'
                   or descripcion like '%".$texto_buscar."%'
                   or stock_minimo like '%".$texto_buscar."%'
                   or id_categoria like '%".$texto_buscar."%'
                   or id_marca like '%".$texto_buscar."%'
                   or id_estado like '%".$texto_buscar."%'";
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

    $resultado_consulta = $Conexion->query("select p.id_producto, p.descripcion, um.descripcion as unidad_medida
                                          FROM tb_productos p
                                          inner join tb_unidades_medida um on p.unidad_medida=um.id_unidad_medida
                                          where p.id_producto like '%".$texto_buscar."%' or p.descripcion like '%".$texto_buscar."%' ");

    return $resultado_consulta;
 }

 public function crearProducto(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_productos (`id_producto`,`descripcion`,`stock_minimo`,`id_categoria`,`id_marca`,`id_estado`) VALUES ('".$this->id_producto."', '".$this->descripcion."', '".$this->stock_minimo."', '".$this->id_categoria."', '".$this->id_marca."', '".$this->id_estado."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }



 

   public function modificarProducto(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_productos SET
       descripcion = '".$this->descripcion."',
       stock_minimo = '".$this->stock_minimo."',
       id_categoria = '".$this->id_categoria."',
       id_marca = '".$this->id_marca."',
       id_estado = '".$this->id_estado."'
        WHERE (id_producto = '".$this->id_producto."');";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarProveedor(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     //CONSULTA SI EL PROVEEDOR TIENE FACTURAS EN EL SISTEMA
     $consultaFacturasProveedor = $Conexion->query("select * from tb_facturas where id_proveedor=".$this->rut_proveedor);
     if($consultaFacturasProveedor->num_rows==0){
       //entra si el proveedor no tiene facturas, por lo tanto se elimina
           if($Conexion->query("DELETE FROM tb_proveedores where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }else{
       //entra si el proveedor SI TIENE facturas, SE CAMBIA ESTADO A "ELIMINADO"
           if($Conexion->query("Update tb_proveedores set estado_proveedor=3 where rut_proveedor=".$this->rut_proveedor)){
               return true;
           }else{
               return false;
           }
     }

   }


}
 ?>
