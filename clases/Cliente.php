<?php
require_once 'Conexion.php';

class Cliente{

 private $rut_cliente;
 private $dv;
 private $nombre;
 private $apellidos;
 private $calle;
 private $numero_calle;
 private $observacion;
 private $telefono;

 public function setRutCliente($rut_cliente){
   $this->rut_cliente = $rut_cliente;
 }
 public function setDv($dv){
   $this->dv = $dv;
 }
 public function setNombre($parametro){
   $this->nombre = $parametro;
 }
 public function setApellidos($parametro){
   $this->apellidos = $parametro;
 }
 public function setCalle($parametro){
   $this->calle = $parametro;
 }
 public function setNumeroCalle($numero_calle){
   $this->numero_calle = $numero_calle;
 }
 public function setObservacion($observacion){
   $this->observacion = $observacion;
 }
 public function setTelefono($telefono){
   $this->telefono = $telefono;
 }

 function obtenerClientes(){
     $conexion = new Conexion();
     $conexion = $conexion->conectar();

       $consulta= "select * from tb_clientes";

     $resultado= $conexion->query($consulta);
     if($resultado){
        return $resultado;
     }else{
       return false;
     }
 }
 public function obtenerClienteRegistrados(){
    $Conexion = new Conexion();
    $Conexion = $Conexion->conectar();

    $resultado_consulta = $Conexion->query("select * from tb_clientes where rut_cliente=".$this->rut_cliente);
    return $resultado_consulta;
 }

 public function crearCliente(){
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta = "insert into tb_clientes (`rut_cliente`, `dv`, `nombre`, `apellidos`, `calle`, `numero_calle`, `observacion_direccion`, `telefono`) VALUES ('".$this->rut_cliente."', '".$this->dv."', '".$this->nombre."', '".$this->apellidos."', '".$this->calle."', '".$this->numero_calle."', '".$this->observacion."', '".$this->telefono."')";
   $resultado= $conexion->query($consulta);
   return $resultado;
 }

   public function modificarCliente(){
       $conexion = new Conexion();
       $conexion = $conexion->conectar();

       $consulta="update tb_clientes SET
       nombre = '".$this->nombre."',
       apellidos = '".$this->apellidos."',
       calle = '".$this->calle."',
       numero_calle = '".$this->numero_calle."',
       observacion_direccion = '".$this->observacion."',
       telefono = '".$this->telefono."'
        WHERE (rut_cliente = '".$this->rut_cliente."')";

       $resultado= $conexion->query($consulta);
       return $resultado;
   }

   public function eliminarCliente(){
     $Conexion = new Conexion();
     $Conexion = $Conexion->conectar();

     $consulta = "delete from tb_clientes where rut_cliente=".$this->rut_cliente;

     if($Conexion->query($consulta)){
         return true;
     }else{
         // echo $consulta;
         return false;
     }

   }


}
 ?>
