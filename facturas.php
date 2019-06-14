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
   <title>Facturas</title>
   <?php cargarHead(); ?>

  <script src="./js/script_facturas.js"></script>
</head>
<body>




<div class="row">

  <?php cargarMenuPrincipal(); ?>



  <div class="container contenedor-principal" >


       <div class="col-12">

          <div  style="" class="  col-12">
            <div class="container">
                 <button type="button" onclick="limpiarFormularioFactura();" class="btn boton-morado" data-target="#modal_factura" data-toggle="modal" name="button">Crear nueva factura</button>
            </div>
            <div class="container">

             <br>
              <div id="contenedorBuscador" class="form-group col-12" >

                     <input onkeyup="listarFacturas(this.value)" class="form-control col-9" type="text" name="txt_buscar_facturas" id="txt_buscar_facturas" value="">
                     <!-- <button type="button" class="btn btn-info col-3" name="button">Buscar</button> -->
              </div>
              <br>

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

           <div class="form-group card border-info" >

             <div class="form-group col-md-6" >
                 <label for="title" class="col-12 control-label">Proveedor:</label>
                 <select required class="form-control" name="select_proveedor" id="select_proveedor">
                   <option value="" selected >Seleccione:</option>
                   <?php
                       $Proveedor = new Proveedor();
                       $listaProveedor = $Proveedor->obtener_cmb_Proveedor();

                       while($filas = $listaProveedor->fetch_array()){
                          echo '<option value="'.$filas['rut_proveedor'].'">'.$filas['razon_social'].'</option>';
                       }
                    ?>
                 </select>
             </div>

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
