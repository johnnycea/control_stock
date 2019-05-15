<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Facturas.php';
require_once './clases/Funciones.php';
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
            <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#modal_nuevo_producto" >NUEVO PRODUCTO</button>
          </div>

          <div>
            <h3>Listado Productos Elaborados</h3>
          </div>

          <div id="listado_productos">

            <?php
                          echo '<table class="table table-bordered table-info">
                            <thead>
                              <th>Codigo</th>
                              <th>Descripcion</th>
                              <th>Valor</th>
                              <th>Estado</th>
                              <th></th>
                              <th></th>
                            </thead>
                            <tbody>';

                              $Funciones = new Funciones();
                              $texto_buscar = $Funciones->limpiarTexto($_REQUEST['texto_buscar']);

                              $ProductoElaborado = new ProductoElaborado();
                              $listadoProductoElaborado = $ProductoElaborado->obtenerProductoElaborado($texto_buscar," "); //$texto_buscar," where id_estado=1 or id_estado=2 "

                                while($filas = $listadoProductoElaborado->fetch_array()){

                                      echo '<tr>
                                              <td><span id="columna_id_producto__'.$filas['id_producto_elaborado'].'" >'.$filas['id_producto_elaborado'].'</span></td>
                                              <td><span id="columna_descripcionl_'.$filas['id_producto_elaborado'].'" >'.$filas['descripcion'].'</span></td>
                                              <td><span id="columna_valor_'.$filas['id_producto_elaborado'].'" >'.$filas['valor'].'</span></td>
                                              <td><span id="columna_estado_'.$filas['id_producto_elaborado'].'" >'.$filas['estado_producto'].'</span></td>
                                              <td>
                                                    <button onclick="cargarModificarProductoElaborado('.$filas['id_producto_elaborado'].')" data-target="#modal_producto_elaborado" data-toggle="modal" class="col-12 btn btn-warning "> <i class="fa fa-edit"></i> </button>
                                              </td>
                                              <td>
                                                    <button onclick="eliminarProveedor('.$filas['id_producto_elaborado'].')"  class="col-12 btn btn-danger "> <i class="fa fa-trash-alt"></i> </button>
                                              </td>
                                           </tr>';
                                }

                                echo '
                                 </tbody>
                              </table>';
          ?>
          </div>

       </div>

</div>

<!-- Inicio modal productos_Elaborados -->

<!-- MODAL Proveedor-->
<div class="modal fade" id="modal_producto_elaborado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-md" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <h5 class="modal-title" id="myModalLabel">Proveedor</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body">

      <form id="formulario_modal_producto_elaborado" class="" action="javascript:guardarProductoElaborado()" method="post">

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

<!-- Fin modal productos_Elaborados -->




  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_nuevo_producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Productos Elaborados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_factura" class="" action="javascript:guardarFactura()" method="post">


            <div class="form-group col-md-12" >
              <label for="title" class="col-12 control-label">Descripción:</label>
              <input required type="text" class="form-control">
            </div>

          <div class="row">

            <div class="form-group col-md-6" >
              <label for="title" class="col-12 control-label">Valor:</label>
              <input required type="text" class="form-control">
            </div>

            <div class="form-group col-md-6" >
                <label for="title" class="col-12 control-label">Estado:</label>
                <select required class="form-control" name="select_estado" id="select_estado">

                  <option value="" selected >Seleccione:</option>

               </select>
            </div>

          </div>

          <div class="form-group col-md-12" >
            <br>
            <input type="submit" class="btn btn-success btn-block" value="Guardar">
          </div>



<div class="d-none">

           <div class="card border-info">

             <h5 class="card-title">Materia Prima del producto</h5>

             <div class="form-group col-md-12" >
               <label for="title" class="col-12 control-label">Buscar Producto:</label>
               <div class="row">
                 <input required type="text" class="form-control col-9">
                 <input class="btn btn-warning col-2" type="button" value="Buscar">
               </div>
             </div>


            <label for="">Seleccione Ingrediente</label>

                <table class="table table-bordered table-info">
                  <thead>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>U. medida</th>
                    <th>Cantidad</th>
                    <th></th>
                  </thead>
                  <tbody>

                    <tr>
                      <td>1</td>
                      <td>Queso</td>
                      <td>Laminas</td>
                      <td><input type="number" class="form-control"></td>
                      <td><button class="btn btn-warning btn-block">Agregar</button></td>
                    </tr>
                    <tr>
                      <td>1</td>
                      <td>Carne</td>
                      <td>Kilo</td>
                      <td><input type="number" class="form-control"></td>
                      <td><button class="btn btn-warning btn-block">Agregar</button></td>
                    </tr>


                  </tbody>
                </table>





            <label for="">Ingredientes seleccionados</label>

                <table class="table table-bordered table-info">
                  <thead>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>U. medida</th>
                    <th>Cantidad</th>
                    <th></th>
                  </thead>
                  <tbody>

                    <tr>
                      <td>1</td>
                      <td>Queso</td>
                      <td>Laminas</td>
                      <td>3</td>
                      <td><button class="btn btn-danger btn-block">Quitar</button></td>
                    </tr>

                  </tbody>
                </table>

           </div>


</div>



        </form>

      </div>


    </div>
    </div>
  </div>

<script type="text/javascript">

</script>

</body>
</html>
