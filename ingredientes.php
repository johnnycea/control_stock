<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/ProductoElaborado.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Ingredientes</title>
   <?php cargarHead(); ?>

  <script src="./js/script_ingredientes.js"></script>
  <script>listarIngrediente();</script>
</head>
<body>



<div class="row">


        <?php cargarMenuPrincipal(); ?>

       <div class="col-10">
         <br>
         <br>
         <br>
         <br>
         <br>
         <br>
          <div  style="" class=" col-12">
            <div class="container">
                 <button type="button" onclick="limpiarFormularioIngrediente();" class="btn btn-success" data-target="#modal_ingrediente" data-toggle="modal" name="button">Crear nuevo ingrediente</button>
            </div>
            <div class="container">

             <br>
              <div id="contenedorBuscador" class="form-group col-12" >

                     <input onkeyup="listarIngrediente(this.value)" class="form-control col-9" type="text" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes" value="">
              </div>
              <br>

              <div id="contenedor_ingredientes"></div>

            </div>

          </div>

       </div>

</div>




  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_ingrediente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Ingrediente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_ingrediente" class="" action="javascript:guardarIngrediente()" method="post">

           <!-- <input type="hidden" name="txt_id_proveedor" id="txt_id_proveedor" value=""> -->

           <div class="form-group card border-info" >

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Rut Proveedor:</label>
                       <input type="text"  required class="form-control" name="txt_rut_proveedor" id="txt_rut_proveedor" value="">
                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Razón Social:</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_razon_social" id="txt_razon_social" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Dirección:</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_direccion" id="txt_direccion" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Teléfono:</label>
                       <input type="text" onkeypress="return soloNumeros(event);" required class="form-control" name="txt_telefono" id="txt_telefono" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Giro:</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_giro" id="txt_giro" value="">

                </div>
                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Correo:</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_correo" id="txt_correo" value="">

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
