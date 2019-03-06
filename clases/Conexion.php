<?php

  class Conexion{

    public $con;

    private $servidor;
    private $usuario;
    private $clave;
    private $bd;

    function __construct(){
      // ini_set("session.cookie_lifetime","7200");
      // ini_set("session.gc_maxlifetime","7200");

      // $this->servidor= "146.66.99.89";
      // $this->usuario= "daemmulc_gastos";
      // $this->clave= "gastos_daem";
      // $this->bd= "daemmulc_gastos";

      $this->servidor= "127.0.0.1";
      $this->usuario= "root";
      $this->clave= "johnnyjohnny";
      $this->bd= "control_stock";


    }

    public function set_servidor($arg_servidor){
       $this->servidor= $arg_servidor;
    }
    public function set_usuario($arg_usuario){
       $this->usuario= $arg_usuario;
    }
    public function set_clave($arg_clave){
       $this->clave= $arg_clave;
    }
    public function set_bd($arg_bd){
       $this->bd= $arg_bd;
    }

    public function conectar(){

  		    $con = new mysqli($this->servidor,$this->usuario,$this->clave,$this->bd);//local

      		if ($con === false){
      			  die("ERROR: No se pudo conectar. ". mysqli_connect_error());
      		}else{
              // echo "Conectada";
              mysqli_set_charset($con,"utf8");
              // echo "ejecuta conexion: sevidor:".$this->servidor." usuario: ".$this->usuario." clave: ".$this->clave." bd: ".$this->bd;

              return $con;
          }

  	}

    public function limpiarTexto($arg_texto){
          $texto= filter_var($arg_texto, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
          return $texto;
    }




 }

 ?>
