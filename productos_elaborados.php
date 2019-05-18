<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Funciones.php';
require_once './clases/ProductoElaborado.php';
require_once './clases/Estado.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>



</style>
   <title>Productos elaborados</title>
   <?php cargarHead(); ?>

  <script src="./js/script_productosElaborados.js"></script>
</head>
<body>




<div class="row">

  <?php cargarMenuPrincipal(); ?>



  <div class="col-10">

       <div class="col-12">

          <div>
            <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#modal_nuevo_producto_elaborado" >NUEVO PRODUCTO</button>
          </div>

          <div>
            <h3>Listado Productos Elaborados</h3>
          </div>

          <div class="row" id="contenedor_listado_productos_elaborados">


          </div>




       </div>

</div>


  <!-- MODAL Producto CREAR-->
  <div class="modal fade" id="modal_nuevo_producto_elaborado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Productos Elaborados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_producto_elaborado" class="" action="javascript:guardarProductoElaborado()" method="post">


          <div class="row">

            <div class="form-group col-md-6" >
              <label for="title" class="col-12 control-label">Descripción:</label>
              <input required type="text" class="form-control" name="txt_descripcion" id="txt_descripcion">
            </div>

            <div class="form-group col-md-6" >
              <label for="title" class="col-12 control-label">Valor:</label>
              <input required type="text" class="form-control" name="txt_valor" id="txt_valor">
            </div>

            <div class="form-group col-md-6" >
              <label for="title" class="col-12 control-label">Imagen:</label>
              <input required type="file" class="form-control" name="select_imagen" id="select_imagen">
            </div>

            <div class="form-group col-md-6" >
                <label for="title" class="col-12 control-label">Estado:</label>
                <select required class="form-control" name="select_estado" id="select_estado">
                  <?php
                      $Estado = new Estado();
                      $listarEstado = $Estado->obtenerEstadosProductosElaborados();

                      while($filas = $listarEstado->fetch_array()){
                         echo '<option value="'.$filas['id_estado'].'">'.$filas['descripcion_estado'].'</option>';
                      }
                   ?>
                </select>
            </div>

          </div>



          <div class="form-group col-md-12" >
            <br>
            <input type="submit" id="btn_boton_guardar" name="btn_boton_guardar" class="btn btn-info btn-block" value="Guardar">
          </div>

      </form>


          <div id="contenedor_buscador_ingredientes"  class="d-none">

            <input type="hidden" name="txt_id_producto_elaborado_creado" id="txt_id_producto_elaborado_creado" value="">


                     <div class="card border-info">

                       <h5 class="card-title">Busqueda de ingredientes</h5>

                       <div class="form-group col-md-12" >
                         <label for="title" class="col-12 control-label">Buscar Producto:</label>
                         <div class="row">
                           <input  type="text" onkeyup="buscarIngredientes()" class="form-control col-9" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes">
                           <input class="btn btn-warning col-2" onclick="buscarIngredientes()" type="button" value="Buscar">
                         </div>
                       </div>


                      <div class="" id="contenedor_buscar_ingredientes">

                      </div>

                      <h5 class="card-title">Ingredientes agregados</h5>

                      <div class="" id="contenedor_ingredientes_seleccionando">



                      </div>




                     </div>


          </div>



      </div>


    </div>
    </div>
  </div>












  </div>

<script type="text/javascript">
// listarProductosElaborados("");
</script>

</body>
</html>
