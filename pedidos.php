<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Facturas.php';
require_once './clases/Proveedor.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Pedidos</title>
   <?php cargarHead(); ?>

  <script src="./js/script_facturas.js"></script>
</head>
<body>




<div class="row">

  <?php cargarMenuPrincipal(); ?>



  <div class="container contenedor-principal" >


       <div class="col-12">

          <div  class="col-12">




              <div>
                <h4>Ingreso Facturas</h4>
              </div>
              <div><hr></div>

              <div>
                <button type="button" onclick="limpiarFormularioFactura();" class="btn boton-morado" data-target="#modal_factura" data-toggle="modal" name="button">Crear nueva factura</button>

              </div>
              <div><hr></div>

              <div id="contenedorBuscador" class="form-group col-4" >

                     Buscar: <input onkeyup="listarFacturas(this.value)" class="form-control col-9" type="text" name="txt_buscar_facturas" id="txt_buscar_facturas" value="">
                     <!-- <button type="button" class="btn btn-info col-3" name="button">Buscar</button> -->
              </div>


              <div id='contenedor_listado_facturas'></div>

            </div>

          </div>

       </div>

  </div>

</div>




  <!-- MODAL Proveedor-->
  <div class="modal fade" id="modal_factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Facturas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_factura" class="" action="javascript:guardarFactura()" method="post">

           <input type="hidden" name="txt_id_factura" id="txt_id_factura" value="">

           <div class=" " >


            <div class="row">

                       <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Rut proveedor:</label>
                          <input type="text" placeholder="Ej: 11222333-0" max="10" onkeyup="cargarInformacionProveedor(this.value)" class="form-control" id="txt_rut_proveedor" name="txt_rut_proveedor">
                       </div>

                       <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Razon social:</label>
                          <input type="text" class="form-control" id="txt_razon_social_proveedor" name="txt_razon_social_proveedor">
                       </div>


                       <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Giro:</label>
                          <input type="text" placeholder="opcional" class="form-control" id="txt_giro_proveedor" name="txt_giro_proveedor">
                       </div>

                       <div class="col-md-4" >
                         <label for="title" class="col-12 control-label">Direccion:</label>
                         <input type="text" class="form-control" id="txt_direccion_proveedor" name="txt_direccion_proveedor">
                       </div>

                       <div class="col-md-4" >
                         <label for="title" class="col-12 control-label">Telefono:</label>
                         <input type="text" class="form-control" id="txt_telefono_proveedor" name="txt_telefono_proveedor">
                       </div>

                       <div class="col-md-4" >
                           <label for="title" class="col-12 control-label">Correo:</label>
                          <input type="text" class="form-control" id="txt_correo_proveedor" name="txt_correo_proveedor">
                       </div>

           </div>


<div><hr></div>

             <div class="form-group col-12" >

                    <label for="title" class="col-12 control-label">Numero Factura:</label>
                    <input type="text"  required class="form-control" name="txt_numero_factura" id="txt_numero_factura" value="">
             </div>

                          <div class="form-group col-12" >

                                 <label for="title" class="col-12 control-label">Fecha:</label>
                                 <input type="date" required class="form-control" name="txt_fecha_factura" id="txt_fecha_factura" value="">

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

<script type="text/javascript">
    listarFacturas("");
</script>

</body>
</html>
