<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/UnidadMedida.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Unidades de medida</title>
   <?php cargarHead(); ?>

  <script src="./js/script_unidad_medida.js"></script>

</head>
<body>

<?php cargarMenuPrincipal(); ?>



<div class="container contenedor-principal">
  <div class="row">

      <div class="col-12 col-md-3">
            <div class="card text-dark">
              <div class="card-header bg-dark text-white">
                  OPCIONES
              </div>
              <div class="card-body">
                   <?php cargarMenuConfiguraciones(); ?>
              </div>
            </div>
      </div>

      <div class="col-12 col-md-9">

            <div  style="" class=" card col-12">
              <div class="container">
                    <div class="row">
                         <button type="button" onclick="limpiarFormularioUnidadMedida();" class="btn btn-success col-12 col-md-4" data-target="#modal_unidad" data-toggle="modal" name="button">Crear nueva Unidad de medida</button>
                         <!-- <input onkeyup="listarUnidadMedida(this.value)" class="form-control col-12 col-md-4" type="text" name="txt_buscar_unidad" id="txt_buscar_unidad" value=""> -->
                    </div>

                    <div id='contenedor_listado_unidad_medida' class="table-responsive"></div>

              </div>
            </div>

       </div>

  </div>
</div>




  <!-- MODAL UnidadMedida-->
<div class="modal fade" id="modal_unidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_unidad_medida" class="" action="javascript:guardarUnidadMedida()" method="post">

               <input type="hidden" name="txt_id_unidad_medida" id="txt_id_unidad_medida" value="">
               <div class="form-group card border-info" >
                    <div class="form-group col-12" >
                           <label for="title" class="col-12 control-label">Unidad de medida:</label>
                           <input type="text" onkeypress="return soloLetrasNumeros(event);" required class="form-control" name="txt_descripcion" id="txt_descripcion" value="">
                    </div>
               </div>

               <div class="form-group" >
                    <div class="col-12">
                      <button class="btn btn-success btn-block" type="submit" name="button">Guardar</button>
                    </div>
               </div>

        </form>

      </div>


    </div>
    </div>
  </div>


</body>
</html>
