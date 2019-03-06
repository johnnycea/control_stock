<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Subvencion.php';
require_once './clases/Colegio.php';
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

  <script src="./js/scripts_informes.js"></script>
    <!-- <script src="./js/scripts_informes_resumen.js"></script> -->
      <script src="./js/script_movimientos.js"></script>
</head>
<body>

<?php cargarMenuPrincipal(); ?>

<br>



<div class="container-fluid">
  <div class="row">


       <div class="col-12 col-md-12">

              <div id='contenedor_informe_subvencion' style="" class=" card col-12 ">

                <div class="card-header ">
                    INFORMES POR SUBVENCIÓN
                </div>

                   <form action="javascript:generarInformeSubvencion()" id="formulario_informe_subvencion" >

                       <div class="row">

                         <div class="form-group col-md-2" >
                             <label for="title" class="col-12 control-label">Año</label>
                             <?php
                                  $fecha_actual = getdate();
                                  echo '<input type="number" value="'.$fecha_actual['year'].'" class="form-control" name="txt_anio" placeholder="Año">';
                              ?>
                         </div>

                         <div class="form-group col-md-3" >

                             <label for="title" class="col-12 control-label">Subvencion</label>
                             <select required onChange="cambiaSubvencion(this.value)" class="form-control" name="select_subvencion" id="select_subvencion">
                               <option value="" selected disabled>Seleccione:</option>
                               <?php
                                   $Subvencion = new Subvencion();
                                   $listaSubvenciones = $Subvencion->obtenerSubvencion();

                                   while($filas = $listaSubvenciones->fetch_array()){
                                       echo '<option value="'.$filas['id_subvencion'].'">'.$filas['subvencion'].'</option>';
                                   }
                                 ?>
                             </select>

                         </div>

                         <div class="form-group col-md-3" >

                             <label for="title" class="col-12 control-label">Tipo de informe</label>
                             <select required onChange="cambiarTipoInforme(this.value)" class="form-control" name="select_tipo_informe" id="select_tipo_informe">
                               <option value="" selected disabled>Seleccione:</option>
                               <option value="1">Resumen</option>
                               <option value="2">Por Establecimiento</option>
                             </select>

                         </div>

                         <div id="contenedor_campo_colegio" class="form-group col-md-3 d-none" >

                             <label for="title" class="col-12 control-label">Colegio</label>
                             <select class="form-control" name="select_colegio" id="select_colegio">
                               <!-- <option value="" selected disabled>Seleccione:</option> -->
                               <?php
                                   $Colegio = new Colegio();
                                   $listaColegios = $Colegio->obtenerColegios();

                                   while($filas = $listaColegios->fetch_array()){
                                       echo '<option value="'.$filas['rbd_colegio'].'">'.$filas['rbd_colegio'].': '.$filas['nombre_colegio'].'</option>';
                                   }
                                 ?>
                             </select>

                         </div>

                       </div>

                       <div class="form-group">
                            <button class="btn btn-primary btn-block">GENERAR INFORME</button>
                       </div>

                   </form>

              </div>


              <div id='' style="" class=" card col-12">
                <div id="contenedor_resultado_informe"></div>
              </div>

            </div>


       </div>

  </div>

</div>




</body>
</html>
