<?php
require_once '../clases/Conexion.php';

$rut= $_REQUEST['rut'];
$clave= $_REQUEST['clave'];
echo "rut: ".$rut;
echo "clave: ".$clave;
// Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
$salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
// A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
$salt = strtr($salt, array('+' => '.'));
// Generamos el hash
$clave_encriptada = crypt($clave, '$2y$10$' . $salt);

$conexion = new Conexion();
$conexion= $conexion->conectar();
if($conexion->query("update tb_usuarios set clave='".$clave_encriptada."' where rut=".$rut)){
  echo "1";
}else{
  echo "2";
}


 ?>
