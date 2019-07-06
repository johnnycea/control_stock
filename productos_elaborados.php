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

   <title>Productos</title>
   <?php cargarHead(); ?>
   <script src="./js/script_productosElaborados.js"></script>

</head>
<body>

  <?php cargarMenuPrincipal(); ?>

  <div class="container contenedor-principal" >

       <div class="col-12">
          <div>
            <h4>Productos Elaborados</h4>
          </div>

          <div><hr></div>

          <div>
            <button class="btn btn-info col-12 col-md-4"  onclick="limpiarModalProductosElaborados();" data-toggle="modal" data-target="#modal_nuevo_producto_elaborado" >Agregar producto</button>
          </div>

          <div><hr></div>

          <div class="row" id="contenedor_listado_productos_elaborados"></div>
       </div>

  </div>


     <!-- MODAL Producto CREAR-->
     <div class="modal fade" id="modal_nuevo_producto_elaborado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
       <div class="modal-dialog modal-md" role="document">
       <div class="modal-content">

         <div class="modal-header">
           <h5 class="modal-title" id="myModalLabel">Productos Elaborados</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>

         <div class="modal-body">

           <form id="formulario_modal_producto_elaborado" class="" action="javascript:guardarModificarProductoElaborado()" method="post" enctype="multipart/form-data">

             <input type="hidden" id="txt_id_producto_elaborado_modificar" name="txt_id_producto_elaborado_modificar" value="">

              <div class="row">

                   <div class="form-group col-md-6" >
                     <label for="title" class="col-12 control-label">Nombre:</label>
                     <input required type="text" class="form-control" name="txt_descripcion" id="txt_descripcion">
                   </div>

                   <div class="form-group col-md-6" >
                     <label for="title" class="col-12 control-label">Valor:</label>
                     <input required type="number" min="0" class="form-control" name="txt_valor" id="txt_valor">
                   </div>

                   <div class="form-group col-md-6" >
                       <label for="title" class="col-12 control-label">Estado:</label>
                       <select required class="form-control" name="select_estado" id="select_estado">
                         <!-- <option value="" selected >Seleccione:</option> -->
                         <?php
                             $Estado = new Estado();
                             $listarEstado = $Estado->obtenerEstadosProductosElaborados();

                             while($filas = $listarEstado->fetch_array()){
                                echo '<option value="'.$filas['id_estado'].'">'.$filas['descripcion_estado'].'</option>';
                             }
                          ?>
                       </select>
                   </div>

                   <div class="form-group col-12 col-md-6">
                     <label for="">Imagen:</label>
                     <input class="form-control "  type="file" name="select_imagen" id="select_imagen" value="">
                   </div>

              </div>

               <div class="form-group col-md-12" >
                 <br>
                 <input type="submit" id="btn_boton_guardar" name="btn_boton_guardar" class="btn btn-info btn-block" value="Guardar">
               </div>

         </form>


         <div id="contenedor_buscador_ingredientes"  class="d-none">

                    <input type="hidden" name="txt_id_producto_elaborado_creado" id="txt_id_producto_elaborado_creado" value="">

                    <div class="card ">
                        <div class="card-header bg-dark text-white">
                          <h5 class="card-title"><center>Ingredientes</center></h5>
                        </div>
                        <div class="card-body bg-dark">
                          <div class="" id="contenedor_ingredientes_seleccionando"></div>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header bg-dark text-white">
                          <h5 class="card-title"><center>Agregar ingredientes</center></h5>
                        </div>
                        <div class="card-body bg-dark">

                          <div class="form-group col-md-12" >
                            <div class="row">
                              <input  type="text" placeholder="Buscar ingredientes"  onkeyup="buscarIngredientes()" class="form-control col-12" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes">
                            </div>
                          </div>

                          <div class="" id="contenedor_buscar_ingredientes"></div>

                        </div>
                    </div>

           </div>

         </div>
       </div>
       </div>
    </div>


</body>
</html>
