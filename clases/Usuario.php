<?php
require_once 'Conexion.php';

class Usuario{

  private $run;
  private $dv;
  private $nombre;
  private $correo;
  private $estado;
  private $privilegio;
  private $clave;

  public function __construct(){

  }

  public function setRun($parametro){
      $this->run= $parametro;
  }
  public function setDv($parametro){
      $this->dv= $parametro;
  }
  public function setNombre($parametro){
      $this->nombre= $parametro;
  }
  public function setCorreo($parametro){
      $this->correo= $parametro;
  }
  public function setEstado($parametro){
    $this->estado= $parametro;
  }
  public function setPrivilegio($parametro){
     $this->privilegio= $parametro;
  }
  public function setClave($parametro){
    $this->clave= $parametro;
  }


  public function crearUsuario(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $claveEncriptada = $this->encriptarClave($this->clave);

    $consulta="insert INTO tb_usuarios(rut,digito_verificador,nombre,clave,estado,tipo_usuario,correo)
     VALUES ('".$this->run."','".$this->dv."','".$this->nombre."','".$claveEncriptada."','".$this->estado."','".$this->privilegio."','".$this->correo."');";

    $resultado= $conexion->query($consulta);
    return $resultado;
  }

  public function modificarUsuario(){
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

      $consulta="update tb_usuarios set
                nombre = '".$this->nombre."',
                estado = ".$this->estado.",
                tipo_usuario=".$this->privilegio.",
                correo= '".$this->correo."'
                where rut=".$this->run;

      $resultado= $conexion->query($consulta);
      return $resultado;
  }

  public function cambiarClave(){
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

      $claveEncriptada = $this->encriptarClave($this->clave);

      $consulta="update tb_usuarios set
                clave='".$claveEncriptada."'
                where rut=".$this->run;

      $resultado= $conexion->query($consulta);
      return $resultado;
  }

  public function eliminarUsuario(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta;

    $resultado= $conexion->query("select * from tb_actividad where rut_usuario=".$this->run);
    //consulta si el usuario tiene actividades registradas
      if($resultado->num_rows>0){
          //si entra aqui, se cambia el estado a eliminado
          $consulta = "update tb_usuarios set estado=3 where rut=".$this->run;
      }else{
          //si entra aqui se puede eliminar
          $consulta = "delete from tb_usuarios where rut=".$this->run;
      }

      if($conexion->query($consulta)){
        return $resultado;
      }else{
        return false;
      }

  }

  public function listarUsuariosActivosInactivos(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta="select * from vista_usuario where estado<>3 order by nombre";

    $resultado= $conexion->query($consulta);
    return $resultado;
  }

 public function obtenerUsuarioActual(){
   @session_start();
   $conexion = new Conexion();
   $conexion = $conexion->conectar();

   $consulta="select * from vista_usuario where rut=".$_SESSION['run'];
   $resultado= $conexion->query($consulta);
   $filas= $resultado->fetch_array();

       return $filas;
 }

  public function consultaUnUsuario(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta="select * from tb_usuarios where rut=".$this->run;

    $resultado= $conexion->query($consulta);
    return $resultado;
  }

  public function consultaUsuariosPorColegio(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta="select * from tb_usuarios where colegio = ".$this->colegio;

    $resultado= $conexion->query($consulta);
    return $resultado;
  }

  public function consultaUsuariosPorInstitucion(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta="select * from tb_usuarios where institucion = ".$this->institucion;

    $resultado= $conexion->query($consulta);
    return $resultado;
  }

  //
  public function validarRut($rut){
      if (!preg_match("/^[0-9.]+[-]?+[0-9kK]{1}/", $rut)) {
          return false;
      }
      $rut = preg_replace('/[\.\-]/i', '', $rut);
      $dv = substr($rut, -1);
      $numero = substr($rut, 0, strlen($rut) - 1);
      $i = 2;
      $suma = 0;
      foreach (array_reverse(str_split($numero)) as $v){
          if ($i == 8)
              $i = 2;
          $suma += $v * $i;
          ++$i;
      }
      $dvr = 11 - ($suma % 11);
      if ($dvr == 11)
          $dvr = 0;
      if ($dvr == 10)
          $dvr = 'K';
      if ($dvr == strtoupper($dv))
          return true;
      else
          return false;
  }

  public function comprobarExisteRun(){
     $consulta="select rut from tb_usuarios where rut=".$this->run;

     $resultado= $this->consultaExistencia($consulta);
     return $resultado;
  }


  function obtenerIpReal(){

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
       if($_SERVER['REMOTE_ADDR']=="::1"){
          $ip="127.0.0.1";
       }else{
         $ip = $_SERVER['REMOTE_ADDR'];
       }
    }
    return $ip;

 }

 public function registrarLogIngreso($rut,$estado){

   $conexion = new Conexion();
   $conexion= $conexion->conectar();
   $conexion->query("insert into tb_log_ingreso(rut,ip,estado) values('".$rut."','".$this->obtenerIpReal()."','".$estado."');");

 }

 public function encriptarClave($clave){
   // Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
   $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
   // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
   $salt = strtr($salt, array('+' => '.'));
   // Generamos el hash
   $clave_encriptada = crypt($clave, '$2y$10$' . $salt);

   return $clave_encriptada;
 }



  public function comprobarUsuario(){
    // // Generamos un salt aleatoreo, de 22 caracteres para Bcrypt
    // $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
    // // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
    // $salt = strtr($salt, array('+' => '.'));
    // // Generamos el hash
    // $clave_encriptada = crypt($this->clave, '$2y$10$' . $salt);
    //
    // $conexion = new Conexion();
    // $conexion= $conexion->conectar();
    // $conexion->query("update tb_usuarios set clave='".$clave_encriptada."' where rut=".$this->run);
    // echo "update tb_usuarios set clave='".$clave_encriptada."' where rut=".$this->run;

      $conexion = new Conexion();
      $conexion= $conexion->conectar();

      $resultado= $conexion->query("CALL comprobar_usuario('".$this->run."')");
      if($resultado->num_rows!=0){
          $columnas= $resultado->fetch_array();

          $claveBD=$columnas['clave'];
          $claveRecibida=$this->clave;
          // echo "c bd: ".$claveBD."  c recibida: ".crypt($this->clave, $claveRecibida);
            if(crypt($this->clave, $claveBD) == $claveBD){

                    session_start();
                    $_SESSION['run']=$this->run;
                    $_SESSION['nombre']=$columnas['nombre'];

                    // ABRO NUEVA CONEXION E INGRESO EL ESTADO DEL INICIO DE SESION
                    $this->registrarLogIngreso($this->run,"ingreso_correcto");
                    return true;

              }else{

                // ABRO NUEVA CONEXION E INGRESO EL ESTADO DEL INICIO DE SESION
                $this->registrarLogIngreso($this->run,"clave_incorrecta");

                 return false;
              }

      }else{
            // ABRO NUEVA CONEXION E INGRESO EL ESTADO DEL INICIO DE SESION
            $this->registrarLogIngreso($this->run,"usuario_incorrecto");

            return false;
      }
  }

  public function verificarSesion(){

    @session_start();

    if(!isset($_SESSION['run'])){
        header("location: ../index.php");
    }
  }
  public function cerrarSesion($rutaInicial){
      session_start();

      // Destruir todas las variables de sesión.
      $_SESSION = array();

      //borra también la cookie de sesión.
      if (ini_get("session.use_cookies")) {
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],
              $params["secure"], $params["httponly"]
          );
      }

      // Finalmente, destruir la sesión.
      session_destroy();
      header('location: '.$rutaInicial);
  }




   function validar_clave($clave,$error_clave){
    if(strlen($clave) < 6){
       $error_clave = "La clave debe tener al menos 6 caracteres";
       return false;
    }
    if (!preg_match('`[a-z]`',$clave)){
       $error_clave = "La clave debe tener al menos una letra minúscula";
       return false;
    }
    if (!preg_match('`[A-Z]`',$clave)){
       $error_clave = "La clave debe tener al menos una letra mayúscula";
       return false;
    }
    if (!preg_match('`[0-9]`',$clave)){
       $error_clave = "La clave debe tener al menos un caracter numérico";
       return false;
    }
    $error_clave = "";
    return true;
 }



}

?>
