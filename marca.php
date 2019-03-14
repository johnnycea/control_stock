<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Marca.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Marcas</title>
   <?php cargarHead(); ?>

  <script src="./js/script_marca.js"></script>
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
                 <button type="button" onclick="limpiarFormularioMarca();" class="btn btn-success" data-target="#modal_marca" data-toggle="modal" name="button">Crear nueva marca</button>
            </div>
            <div class="container">

             <br>
              <div id="contenedorBuscador" class="form-group col-12" >

                     <input onkeyup="listarMarca(this.value)" class="form-control col-9" type="text" name="txt_buscar_marca" id="txt_buscar_marca" value="">
                     <!-- <button type="button" class="btn btn-info col-3" name="button">Buscar</button> -->
              </div>
              <br>

              <div id='contenedor_listado_marca'></div>

            </div>

          </div>

       </div>

  </div>

</div>




  <!-- MODAL Proveedor-->
  <div class="modal fade" id="modal_marca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_marca" class="" action="javascript:guardarMarca()" method="post">

           <!-- <input type="hidden" name="txt_id_proveedor" id="txt_id_proveedor" value=""> -->

           <div class="form-group card border-info" >


                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Nombre marca:</label>
                       <input type="text" onkeypress="return soloLetrasNumeros(event);" required class="form-control" name="txt_nombre_marca" id="txt_nombre_marca" value="">
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
