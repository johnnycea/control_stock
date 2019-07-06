<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Ventas.php';
require_once './clases/ProductoElaborado.php';
require_once './clases/TipoVenta.php';
require_once './clases/MedioPago.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Informes</title>
   <?php cargarHead(); ?>

   <script src="./js/script_informes.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>


  <div><hr></div>

  <div class="container contenedor-principal" >
    <div class="row">

        <div class="col-12 col-md-3 ">
            <div class="card ">
              <div class="card-header bg-dark text-white">
                  <label class="card-title bold">Informe de ingresos y gastos</label>
              </div>
              <div class="card-body">
                <form class="" id="formulario_informe" action="javascript:generarInforme()">

                  <div class="row">

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Tipo de informe:</label>
                          <select class="form-control" onchange="mostrarOcultarOpciones(this.value)" name="select_tipo_informe" id="select_tipo_informe">
                            <option value="1">Resumen</option>
                            <option value="2">Detallado</option>
                          </select>
                       </div>

                       <?php
                          $Venta = new Ventas();
                          $fechas = $Venta->obtenerFechaPrimeraUltimaVenta();
                        ?>

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Fecha Inicio:</label>
                           <input type="date" value="<?php echo $fechas['fecha_primera_venta']; ?>" required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_inicio">
                       </div>
                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">Fecha Fin:</label>
                          <input type="date" value="<?php echo $fechas['fecha_ultima_venta']; ?>"  required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_fin">

                       </div>


                       <div id="contenedor_opciones_informe_detallado" class="d-none">

                               <div class="form-group col-12">
                                  <label for="title" class="col-12 control-label">Tipo de venta:</label>
                                  <select class="form-control" name="select_tipo_venta" id="select_tipo_venta">
                                    <option value="">TODO</option>
                                      <?php
                                          $TipoVenta = new TipoVenta();
                                          $listadoTiposVenta = $TipoVenta->obtenerTiposVenta();

                                          while($filas_tipo_venta = $listadoTiposVenta->fetch_array()){
                                             echo '<option value="'.$filas_tipo_venta['id_tipo_venta'].'">'.$filas_tipo_venta['descripcion_tipo_venta'].'</option>';
                                          }
                                       ?>
                                  </select>
                               </div>

                               <div class="form-group col-12">
                                  <label for="title" class="col-12 control-label">Medio de Pago:</label>
                                  <select class="form-control" name="select_medio_pago" id="select_medio_pago">
                                    <option value="">TODO</option>
                                      <?php
                                          $MedioPago = new MedioPago();
                                          $listadoMediosPago = $MedioPago->obtenerMediosPago();

                                          while($filas_medio_pago = $listadoMediosPago->fetch_array()){
                                             echo '<option value="'.$filas_medio_pago['id_medio_pago'].'">'.$filas_medio_pago['descripcion_medio_pago'].'</option>';
                                          }
                                       ?>
                                  </select>
                               </div>

                      </div>

                       <div class="form-group col-12">
                          <label for="title" class="col-12 control-label">&nbsp;</label>
                          <input type="submit"  class="btn btn-info btn-block" value="Generar">

                       </div>

                   </div>

                </form>
              </div>

            </div>
        </div>


          <div class="col-12 col-md-9 ">
              <div class="card ">
                <div class="card-header bg-dark text-white">
                    <label class="card-title bold">Resultado informe</label>
                </div>
                <div class="card-body">

                  <div id="contenedor_informe"></div>

                </div>
              </div>
          </div>


   </div>
</div>


</body>
</html>
