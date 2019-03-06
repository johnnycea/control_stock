<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Estado.php';
require_once './clases/Privilegio.php';
require_once './clases/Subvencion.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Agenda DAEM Subvencion</title>
   <?php cargarHead(); ?>

  <script src="./js/script_subvencion.js"></script>
</head>
<body>

<?php cargarMenuPrincipal(); ?>

<br>



<div class="container-fluid">
  <div class="row">

      <div class="col-12 col-md-3">

          <div class="card text-dark">
            <div class="card-header ">
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
                 <button type="button" onclick="limpiarFormularioSubvencion();" class="btn btn-success" data-target="#modal_subvencion" data-toggle="modal" name="button">Crear nueva subvencion</button>
            </div>
            <div class="container">
              <br>

              <div id='contenedor_listado_subvencion'></div>

            </div>

          </div>

       </div>

  </div>

</div>




  <!-- MODAL USUARIO-->
  <div class="modal fade" id="modal_subvencion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Subvencion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_subvencion" class="" action="javascript:guardarSubvencion()" method="post">

           <input type="hidden" name="txt_id_subvencion" id="txt_id_subvencion" value="">

           <div class="form-group card border-info" >

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Nombre Subvencion:</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_subvencion" id="txt_subvencion" value="">

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
