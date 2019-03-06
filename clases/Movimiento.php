<?php
require_once 'Conexion.php';

class Movimiento{

  private $id_movimiento;
  private $numero_certificado;
  private $tipo_movimiento;
  private $tipo_gasto;
  private $colegio;
  private $subvencion;
  private $cuenta_presupuesto;
  private $estado;
  private $descripcion;
  private $fecha_ingreso;
  private $orden_compra;
  private $monto;

  private $sep_preferente;
  private $sep_preferencial;
  private $sep_concentracion;
  private $sep_articulo_19;
  private $sep_ajustes;
  // private $sep_total;
  private $scvtf_normal;
  private $scvtf_nivelacion;


  function setIdMovimiento($parametro){
    $this->id_movimiento = $parametro;
  }
  function setNumeroCertificado($parametro){
    $this->numero_certificado = $parametro;
  }
  function setTipoMovimiento($parametro){
    $this->tipo_movimiento = $parametro;
  }
  function setTipoGasto($parametro){
    $this->tipo_gasto = $parametro;
  }
  function setColegio($parametro){
    $this->colegio = $parametro;
  }
  function setSubvencion($parametro){
    $this->subvencion = $parametro;
  }
  function setCuentaPresupuesto($parametro){
    $this->cuenta_presupuesto = $parametro;
  }
  function setEstado($parametro){
    $this->estado = $parametro;
  }
  function setDescripcion($parametro){
    $this->descripcion = $parametro;
  }
  function setFechaIngreso($parametro){
    $this->fecha_ingreso = $parametro;
  }
  function setOrdenCompra($parametro){
    $this->orden_compra = $parametro;
  }
  function setMonto($parametro){
    $this->monto = $parametro;
  }

  function setSepPreferente($parametro){
    $this->sep_preferente = $parametro;
  }
  function setSepPreferencial($parametro){
    $this->sep_preferencial = $parametro;
  }
  function setSepConcentracion($parametro){
    $this->sep_concentracion = $parametro;
  }
  function setSepArticulo19($parametro){
    $this->sep_articulo_19 = $parametro;
  }
  function setSepAjustes($parametro){
    $this->sep_ajustes = $parametro;
  }
  function setSepTotal($parametro){
    $this->sep_total = $parametro;
  }
  function setScvtfNormal($parametro){
    if($parametro==""){
       $parametro=0;
    }
    $this->scvtf_normal = $parametro;
  }
  function setScvtfNivelacion($parametro){
    if($parametro==""){
       $parametro=0;
    }
    $this->scvtf_nivelacion = $parametro;
  }


  function eliminarMovimiento(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "update tb_movimientos set estado=".$this->estado.", numero_certificado=NULL where id_movimiento=".$this->id_movimiento;
    // echo $consulta;

      if($conexion->query($consulta)){
         return true;
      }else{
         return false;
      }
  }

  function modificarMovimiento(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();

    $consulta = "UPDATE tb_movimientos
                  SET
                  tipo_movimiento = ".$this->tipo_movimiento.",
                  tipo_gasto = ".$this->tipo_gasto.",
                  colegio = ".$this->colegio.",
                  subvencion = ".$this->subvencion.",
                  cuenta_presupuesto = '".$this->cuenta_presupuesto."',
                  estado = ".$this->estado.",
                  descripcion = '".$this->descripcion."',
                  fecha_ingreso = '".$this->fecha_ingreso."',
                  orden_compra = '".$this->orden_compra."',
                  monto = ".$this->monto.",
                  sep_preferente = ".$this->sep_preferente.",
                  sep_preferencial = ".$this->sep_preferencial.",
                  sep_concentracion = ".$this->sep_concentracion.",
                  sep_articulo_19 = ".$this->sep_articulo_19.",
                  sep_ajustes = ".$this->sep_ajustes.",
                  scvtf_normal = ".$this->scvtf_normal.",
                  scvtf_nivelacion = ".$this->scvtf_nivelacion."
                  WHERE id_movimiento = ".$this->id_movimiento." ";

    if($conexion->query($consulta)){
      return true;
    }else{
      echo $consulta;
      return false;
    }

  }

  function ingresarMovimiento(){
    $conexion = new Conexion();
    $conexion = $conexion->conectar();


    $consulta ="insert INTO tb_movimientos
              (`numero_certificado`,
              `tipo_movimiento`,
              `tipo_gasto`,
              `colegio`,
              `subvencion`,
              `cuenta_presupuesto`,
              `estado`,
              `descripcion`,
              `fecha_ingreso`,
              `orden_compra`,
              `monto`,
              `sep_preferente`,
              `sep_preferencial`,
              `sep_concentracion`,
              `sep_articulo_19`,
              `sep_ajustes`,
              `scvtf_normal`,
              `scvtf_nivelacion`)
              VALUES
              (".$this->numero_certificado.",
               '".$this->tipo_movimiento."',
               ".$this->tipo_gasto.",
               '".$this->colegio."',
               '".$this->subvencion."',
               '".$this->cuenta_presupuesto."',
               '".$this->estado."',
               '".$this->descripcion."',
               '".$this->fecha_ingreso."',
               '".$this->orden_compra."',
               '".$this->monto."',
               '".$this->sep_preferente."',
               '".$this->sep_preferencial."',
               '".$this->sep_concentracion."',
               '".$this->sep_articulo_19."',
               '".$this->sep_ajustes."',
               '".$this->scvtf_normal."',
               '".$this->scvtf_nivelacion."');";

    if($conexion->query($consulta)){
       return true;
    }else{
      echo $consulta;
      return false;
    }
  }

  function mostrarListadoMovimientos($texto_buscar,$condiciones){
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

      if($texto_buscar=="" || $texto_buscar==" "){
        $consulta= "select * from vista_movimientos ".$condiciones." order by numero_certificado asc";
      }else{
        $consulta= "select * from vista_movimientos
                    where id_movimiento like '%".$texto_buscar."%'
                    or descripcion like '%".$texto_buscar."%'
                    or orden_compra like '%".$texto_buscar."%'
                    or rbd_colegio like '%".$texto_buscar."%'
                    or subvencion like '%".$texto_buscar."%'
                    or numero_cuenta like '%".$texto_buscar."%'
                    or nombre_cuenta like '%".$texto_buscar."%'
                    or descripcion_estado like '%".$texto_buscar."%'
                    or descripcion_tipo_movimiento like '%".$texto_buscar."%'";
      }
      $resultado= $conexion->query($consulta);
      if($resultado){
         return $resultado;
      }else{
        return false;
      }
  }

  function mostrarTotalesColegio($anio){
      $conexion = new Conexion();
      $conexion = $conexion->conectar();

        $consulta= "call procedimiento_totales(".$anio.",".$this->subvencion.",'".$this->colegio."');";

      $resultado= $conexion->query($consulta);
      if($resultado){
         return $resultado;
      }else{
        return false;
      }
  }




}

 ?>
