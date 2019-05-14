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



  <div class="col-10">

       <div class="col-12">

          <div>
            <button class="btn btn-success btn-block"  data-toggle="modal" data-target="#modal_nuevo_producto" >NUEVO PRODUCTO</button>
          </div>

          <div>
            <h3>Listado Productos Elaborados</h3>
          </div>

          <div id="listado_productos">

             <table class="table table-bordered table-info">
               <thead>
                 <th>Codigo</th>
                 <th>Descripcion</th>
                 <th>Valor</th>
                 <th></th>
               </thead>
               <tbody>

                 <tr>
                   <td>1</td>
                   <td>Pizza Napolitana</td>
                   <td>$10.000</td>
                   <td><button class="btn btn-warning btn-block">Editar</button></td>
                   <td><button class="btn btn-danger btn-block">Eliminar</button></td>
                 </tr>
                 <tr>
                   <td>1</td>
                   <td>Pizza Napolitana</td>
                   <td>$10.000</td>
                   <td><button class="btn btn-warning btn-block">Editar</button></td>
                   <td><button class="btn btn-danger btn-block">Eliminar</button></td>
                 </tr>

               </tbody>
             </table>

          </div>

       </div>

</div>




  <!-- MODAL Proveedor-->
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
    listarFacturas("");
</script>

</body>
</html>
