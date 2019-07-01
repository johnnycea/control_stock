<?php
require_once 'Conexion.php';

class Pedido{

 private $id_pedido;
 private $id_venta;
 private $rut_cliente;
 private $estado;
 private $repartidor;

 public function setIdPedido($id_pedido){
   $this->id_pedido = $id_pedido;
 }
 public function setIdVenta($id_venta){
   $this->id_venta = $id_venta;
 }
 public function setRutCliente($rut_cliente){
   $this->rut_cliente = $rut_cliente;
 }
 public function setEstadoPedido($estado){
   $this->estado = $estado;
 }
 public function setIdRepartidor($repartidor){
   $this->repartidor = $repartidor;
 }


 function obtenerPedido($texto_buscar,$condiciones){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

     if($texto_buscar=="" || $texto_buscar==" "){
       $consulta= "select * from tb_pedidos ".$condiciones."";
     }else{
       $consulta= "select * from tb_pedidos
                   where id_pedido like '%".$texto_buscar."%'
                   or id_venta like '%".$texto_buscar."%'
                   or rut_cliente like '%".$texto_buscar."%'
                   or estado_pedido like '%".$texto_buscar."%'
                   or id_usuario_repartidor like '%".$texto_buscar."%'";
     }
     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }

 public function obtenerPedidos(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_pedidos where id_pedido=".$this->id_pedido."and id_venta=".$this->id_venta);
    return $resultado_consulta;
 }

 public function obtener_cmb_Proveedor(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_proveedores".$this->rut_proveedor);
    return $resultado_consulta;
 }

 public function crearProveedor(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert INTO tb_proveedores (`rut_proveedor`,`dv`,`razon_social`,`direccion`,`telefono`,`giro`,`correo`) VALUES ('".$this->rut_proveedor."', '".$this->dv."', '".$this->razon_social."', '".$this->direccion."', '".$this->telefono."', '".$this->giro."', '".$this->correo."')";
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
