<?php

@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/TipoMovimiento.php';
require_once './clases/TipoGasto.php';
require_once './clases/Subvencion.php';
require_once './clases/Colegio.php';
require_once './clases/Cuenta.php';
require_once './clases/Estado.php';

comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Control Gastos</title>
   <?php cargarHead(); ?>

  <script src="./js/script_movimientos.js"></script>

  <script>
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_ingreso"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_creacion"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
  </script>

</head>
<body>

<?php cargarMenuPrincipal(); ?>

<br>

<!-- MODAL INGRESAR CORRESPONDENCIA-->
<div class="container-fluid">
<div id="contenedor_formulario_movimientos" class="card">
  <h5 class="card-header">Formulario Movimientos</h5>
  <input onclick="limpiarFormulario()" class="btn btn-warning btn-block" type="button" value="Limpiar Formulario" >
  <div class="card-body">

      <form id="formulario_modal_movimientos" class="" action="javascript:registrarModificarMovimiento()" method="post">


             <div class="form-group  border-info" >



                 <div class="row">
                  <div class="col-8">

                    <div class="row">

                      <div class="form-group col-2" >
                             <label for="title" class="col-12 control-label">N Registro</label>
                             <input class="form-control" type="text" readonly name="txt_numero_certificado" id="txt_numero_certificado">
                             <input class="form-control" type="hidden" readonly name="txt_id_movimiento" id="txt_id_movimiento">
                      </div>

                      <div class="form-group col-4" >
                             <label for="title" class="col-12 control-label">Fecha de ingreso</label>
                             <input value="<?php echo date('d-m-Y'); ?>" class="form-control" type="text" id="txt_fecha_ingreso" name="txt_fecha_ingreso" min="2018-01-01"  readonly placeholder="Dia/Mes/Año" >
                      </div>

                      <div class="form-group col-md-4" >

                          <label for="title" class="col-12 control-label">Tipo movimiento</label>
                          <select onchange="cambiarTipoMovmiento(this.value)" required class="form-control" name="select_tipo_movimiento" id="select_tipo_movimiento">
                            <option value="" selected disabled>Seleccione:</option>
                            <?php
                                $TipoMovimiento = new TipoMovimiento();
                                $listaTiposMovimientos = $TipoMovimiento->obtenerTiposMovimientos();

                                while($filas = $listaTiposMovimientos->fetch_array()){
                                   echo '<option value="'.$filas['id_tipo_movimiento'].'">'.$filas['descripcion_tipo_movimiento'].'</option>';
                                }
                             ?>
                          </select>

                      </div>

                      <div id="contenedor_tipo_gasto" class="form-group col-md-2 d-none" >

                          <label for="title" class="col-12 control-label">Tipo gasto</label>
                          <select class="form-control" name="select_tipo_gasto" id="select_tipo_gasto">
                            <option value="" selected disabled>Seleccione:</option>
                            <?php
                                $TipoGasto = new TipoGasto();
                                $listaTiposGasto = $TipoGasto->obtenerTiposGasto();

                                while($filas = $listaTiposGasto->fetch_array()){
                                   echo '<option value="'.$filas['id_tipo_gasto'].'">'.$filas['descripcion_tipo_gasto'].'</option>';
                                }
                             ?>
                          </select>

                      </div>

                      <div class="form-group col-md-6" >

                          <label for="title" class="col-12 control-label">Colegio</label>
                          <select required onchange="muestraTotalesColegioSubvencion()" class="form-control" name="select_colegio" id="select_colegio">
                            <!-- <option value="0"  selected disabled>Seleccione:</option> -->
                            <?php
                                $Colegio = new Colegio();
                                $listaColegios = $Colegio->obtenerColegios();

                                while($filas = $listaColegios->fetch_array()){
                                    echo '<option value="'.$filas['rbd_colegio'].'">'.$filas['rbd_colegio'].': '.$filas['nombre_colegio'].'</option>';
                                }
                              ?>
                          </select>

                      </div>

                        <div class="form-group col-md-6" >

                            <label for="title" class="col-12 control-label">Subvencion</label>
                            <select required onChange="cambiaSubvencion()" class="form-control" name="select_subvencion" id="select_subvencion">
                              <option value="0" selected disabled>Seleccione:</option>
                              <?php
                                  $Subvencion = new Subvencion();
                                  $listaSubvenciones = $Subvencion->obtenerSubvencion();

                                  while($filas = $listaSubvenciones->fetch_array()){
                                      echo '<option value="'.$filas['id_subvencion'].'">'.$filas['subvencion'].'</option>';
                                  }
                                ?>
                            </select>

                        </div>

                        <div class="form-group col-md-6" >
                            <label for="title" class="col-12 control-label">Cuenta Presupuesto</label>
                            <select required class="form-control" name="select_cuenta" id="select_cuenta">
                              <option value="" selected disabled>Seleccione:</option>
                              <?php
                                  $Cuenta = new Cuenta();
                                  $listaCuentas = $Cuenta->obtenerCuentas();

                                  while($filas = $listaCuentas->fetch_array()){
                                     echo '<option value="'.$filas['numero_cuenta'].'">'.$filas['numero_cuenta'].': '.$filas['nombre_cuenta'].'</option>';
                                  }
                               ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6" >
                            <label for="title" class="col-12 control-label">Orden de compra</label>
                            <input type="text" class="form-control" value="<?php echo $filas['orden_compra'];?>" id="txt_orden_compra" name="txt_orden_compra" placeholder="Orden de compra">
                        </div>

                        <div id="contenedor_selector_estado" class="form-group col-6" >
                            <label for="title" class="col-12 control-label">Estado</label>
                            <select class="form-control" name="select_estado" id="select_estado">
                                <?php
                                    $Estado = new Estado();
                                    $Estado->setTabla("tb_estado_movimiento");
                                    $listaEstados = $Estado->obtenerEstados(" where id_estado=1 or id_estado=2");

                                    while($filas = $listaEstados->fetch_array()){
                                       echo '<option value="'.$filas['id_estado'].'">'.$filas['descripcion_estado'].'</option>';
                                    }
                                  ?>
                            </select>
                        </div>

                       <div class="form-group col-md-6" >
                           <label for="title" class="col-12 control-label">Monto</label>
                           <input type="text" class="form-control" onkeyup="valorCampoMonto(this.value);" value="<?php echo $filas['monto'];?>" id="txt_monto" name="txt_monto" placeholder="Ingrese Monto">
                       </div>
                    </div>
                  </div>

                  <div class="col-4">
                      <!-- CONTENEDOR DE CAMPOS A MOSTRAR CUANDO LA SUBVENCION ES SEP -->
                      <div class="card bg-light mb-12 " >
                        <div class="card-header">
                           <h5 class="card-title">Información</h5>
                        </div>
                        <div class="card-body bg-white">

                              <div id="contenedor_informacion_resumen">

                                  <table class="table table-bordered table-striped">
                                    <tbody>
                                      <tr>
                                        <td><label for="">Total Ingresos: </label></td>
                                        <td>Seleccione subvencion</td>
                                      </tr>
                                      <tr>
                                        <td><label for="">Total Gastos: </label></td>
                                        <td>Seleccione subvencion</td>
                                      </tr>
                                    </tbody>
                                  </table>

                              </div>

                        </div>
                      </div>

                  </div>

              </div>

              <!-- CONTENEDOR DE CAMPOS A MOSTRAR CUANDO LA SUBVENCION ES SEP -->
              <div id="contenedor_campos_sep" class="card bg-light col-md-8 d-none" >
                <div class="card-header">
                   <h5 class="card-title">Campos SEP</h5>
                </div>
                <div class="card-body bg-white">

                   <div class="row" >
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Preferente</label>
                          <input type="text" onkeyup="sumarCamposSep()" class="form-control" id="sep_preferente" name="sep_preferente" placeholder="$">
                      </div>
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Preferencial</label>
                          <input type="text" onkeyup="sumarCamposSep()" class="form-control" id="sep_preferencia" name="sep_preferencia" placeholder="$">
                      </div>
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Concentracion</label>
                          <input type="text" onkeyup="sumarCamposSep()" class="form-control" id="sep_concentracion" name="sep_concentracion" placeholder="$">
                      </div>
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Articulo 19</label>
                          <input type="text" onkeyup="sumarCamposSep()" class="form-control" id="sep_articulo_19" name="sep_articulo_19" placeholder="$">
                      </div>
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Ajustes</label>
                          <input type="text" onkeyup="sumarCamposSep()" class="form-control" id="sep_ajustes" name="sep_ajustes" placeholder="$">
                      </div>
                      <!-- <div class="form-group col-md-6 d-none" >
                          <label for="title" class="col-12 control-label">Total</label>
                          <input type="text" class="form-control" name="sep_total" placeholder="$">
                      </div> -->
                  </div>

                </div>
              </div>

              <!-- CONTENEDOR DE CAMPOS A MOSTRAR CUANDO LA SUBVENCION ES Sc-vtf -->
              <div id="contenedor_campos_Sc-vtf" class="card bg-light col-md-8 d-none" >
                <div class="card-header">
                   <h5 class="card-title">Campos Sc-vtf</h5>
                </div>
                <div class="card-body bg-white">

                   <div class="row" >
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Subvencion Normal:</label>
                          <input type="text" onkeyup="sumarCamposScvtf()" class="form-control" id="scvtf_normal" name="scvtf_normal" placeholder="$">
                      </div>
                      <div class="form-group col-md-6" >
                          <label for="title" class="col-12 control-label">Subvencion de Nivelacion:</label>
                          <input type="text" onkeyup="sumarCamposScvtf()" class="form-control" id="scvtf_nivelacion" name="scvtf_nivelacion" placeholder="$">
                      </div>

                  </div>

                </div>
              </div>



                  <div class="col-8">
                    <div class="row ">

                          <div class="form-group col-6" >
                              <label for="title" class="col-12 control-label">Descripción</label>
                              <textarea value="<?php echo $filas['descripcion_tipo_movimiento'];?>" name="txt_descripcion" id="txt_descripcion" class="form-control " rows="2"></textarea>
                          </div>

                          <div class="col-6">
                            <label for="title" class="col-12 control-label">&nbsp;</label>

                            <button class="btn btn-info btn-lg btn-block" type="submit" name="button">Guardar</button>
                          </div>

                    </div>
                  </div>







            </div>



            </form>
</div>
</div>
</div>


<div class="container">
  <hr>
</div>

<div class="container">
  <button id="boton_mostrar_ocultar_registros" onclick="mostrarListadoMovimientos('')" class="btn btn-info btn-block">Mostrar Registro de Movimientos</button>
</div>



<div class="container-fluid ">

    <div id='' style="" class="card  col-12 ">

        <div class="card-header  text-info">Registro de movimientos</div>
        <div class="card-body">

          <div class="col-12 col-md-10">

              <div id='' style="" class=" card col-12 ">

                      <div class="card-header  text-info">Buscar </div>
                      <div class="card-body">
                        <input type="text" onkeyup="mostrarListadoMovimientos(this.value)" class="border-info form-control" name="txt_buscar_correspondencia" value="" placeholder="Ingrese Numero Certificado, subvencion, rbd, estado, etc.">
                      </div>

                  </div>

              </div>

              <div class="row" id="contenedor_registro_movimientos">

          </div>

        </div>

    </div>

</div>



</body>
</html>
