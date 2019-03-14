<?php
require_once 'Conexion.php';

class Producto{

 private $id_producto;
 private $descripcion;
 private $stock_minimo;
 private $id_categoria;
 private $id_marca;
 private $id_estado;

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

 public function crearProducto(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_productos (`id_producto`,`descripcion`,`stock_minimo`,`id_categoria`,`id_marca`,`id_estado`) VALUES ('".$this->id_producto."', '".$this->descripcion."', '".$this->stock_minimo."', '".$this->id_categoria."', '".$this->id_marca."', '".$this->id_estado."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarProveedor(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_proveedores SET
       razon_social = '".$this->razon_social."',
       direccion = '".$this->direccion."',
       telefono = '".$this->telefono."',
       giro = '".$this->giro."',
       correo = '".$this->correo."'
        WHERE (rut_proveedor = '".$this->rut_proveedor."');";

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
