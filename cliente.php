<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/Cliente.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Cliente</title>
   <?php cargarHead(); ?>

  <script src="./js/script_cliente.js"></script>
  <!-- <script>listarIngrediente();</script> -->
</head>
<body>



<div class="row">


        <?php cargarMenuPrincipal(); ?>

        <div class="container contenedor-principal" >


          <div  style="" class=" col-12">
            <div class="container">
                 <button type="button" onclick="limpiarFormularioIngrediente();" class="btn btn-success" data-target="#modal_cliente" data-toggle="modal" name="button">Crear nuevo cliente</button>
            </div>
            <div class="container">

             <br>
              <div id="contenedorBuscador" class="form-group col-12" >

                     <input onkeyup="listarCliente(this.value)" class="form-control col-9" type="text" name="txt_texto_buscar_cliente" id="txt_texto_buscar_cliente" value="">
              </div>
              <br>

              <div id="contenedor_listado_cliente"></div>

            </div>

          </div>

       </div>

</div>




  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_cliente" class="" action="javascript:crearCliente()" method="post">

           <!-- <input type="hidden" name="txt_codigo_cliente" id="txt_codigo_cliente" value=""> -->

           <div class="form-group card border-info" >

                <div class="form-group col-8" >

                       <label for="title" class="col-12 control-label">Rut:</label>
                       <input type="text"  required class="form-control" name="txt_rut_cliente" id="txt_rut_cliente" value="">
                </div>
                <div class="form-group col-4" >

                       <label for="title" class="col-12 control-label">Dv:</label>
                       <input type="text"  required class="form-control" name="txt_dv" id="txt_dv" value="">
                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Nombre:</label>
                       <input type="text"  required class="form-control" name="txt_nombre" id="txt_nombre" value="">
                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Apellidos:</label>
                       <input type="text" required class="form-control" name="txt_apellidos" id="txt_apellidos" value="">

                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Calle:</label>
                       <input type="text" required class="form-control" name="txt_calle" id="txt_calle" value="">

                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Número:</label>
                       <input type="text" required class="form-control" name="txt_numero" id="txt_numero" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Observacion:</label>
                       <input type="text" required class="form-control" name="txt_observacion" id="txt_observacion" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Telefono:</label>
                       <input type="text" required class="form-control" name="txt_telefono" id="txt_telefono" value="">

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
