<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/Proveedor.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Proveedores</title>
   <?php cargarHead(); ?>
   <script src="./js/script_proveedores.js"></script>

</head>
<body>


  <?php cargarMenuPrincipal(); ?>

  <div class="container contenedor-principal" >
      <div  style="" class=" col-12">

              <div>
                <h4>Proveedores</h4>
              </div>

              <div><hr></div>

              <div class="row">
                   <button type="button" onclick="limpiarFormularioProveedor();" class="btn btn-info col-12 col-md-4" data-target="#modal_proveedor" data-toggle="modal" name="button">Crear nuevo proveedor</button>
                   <input onkeyup="listarProveedor(this.value)" class="form-control col-12 col-md-4" type="text" name="txt_buscar_proveedores" id="txt_buscar_proveedores" value="">
              </div>

              <div class="container">
                <div id='contenedor_listado_proveedores' class="table-responsive"></div>
              </div>

      </div>
  </div>



  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_proveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_proveedor" class="" action="javascript:guardarProveedor()" method="post">

           <!-- <input type="hidden" name="txt_id_proveedor" id="txt_id_proveedor" value=""> -->

           <div class="form-group card border-info" >

                  <div class="container" >
                      <div class="row" >
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Rut Proveedor:</label>
                                 <input type="text"  required class="form-control" name="txt_rut_proveedor" id="txt_rut_proveedor" value="">
                          </div>

                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Razón Social:</label>
                                 <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_razon_social" id="txt_razon_social" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Dirección:</label>
                                 <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_direccion" id="txt_direccion" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Teléfono:</label>
                                 <input type="text" onkeypress="return soloNumeros(event);" required class="form-control" name="txt_telefono" id="txt_telefono" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Giro:</label>
                                 <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_giro" id="txt_giro" value="">

                          </div>
                          <div class="form-group col-12 col-md-6" >

                                 <label for="title" class="col-12 control-label">Correo:</label>
                                 <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_correo" id="txt_correo" value="">

                          </div>
                      </div>
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
