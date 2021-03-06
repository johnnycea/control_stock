<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
// require_once './clases/Estado.php';
require_once './clases/ProductoElaborado.php';
require_once './clases/Producto.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

   <title>Ingredientes</title>
   <?php cargarHead(); ?>
   <script src="./js/script_ingredientes.js"></script>

</head>
<body>

        <?php cargarMenuPrincipal(); ?>

<div class="container contenedor-principal" >

          <div class="col-12">
                <div>
                  <h4>Insumos</h4>
                </div>

                <div><hr></div>

                <div class="row">
                  <button type="button" onclick="limpiarFormularioIngrediente();" class="btn btn-info col-12 col-md-4" data-target="#modal_ingrediente" data-toggle="modal" name="button">Crear nuevo ingrediente</button>
                  <input onkeyup="listarIngrediente(this.value)" placeholder="Buscar insumos" class="form-control col-12 col-md-4" type="text" name="txt_texto_buscar_ingredientes" id="txt_texto_buscar_ingredientes" value="">
                </div>

                <div><hr></div>

                <div class="container">
                   <div id="contenedor_ingredientes" class="table-responsive"></div>
                </div>
          </div>

</div>



  <!-- MODAL Producto-->
  <div class="modal fade" id="modal_ingrediente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_ingrediente" class="" action="javascript:guardarIngrediente()" method="post">

           <div class="row border-info" >

                    <div class="form-group col-12 col-sm-6" >
                           <label for="title" class="col-12 control-label">Codigo:</label>
                           <input type="number"  required class="form-control" name="txt_codigo_producto" id="txt_codigo_producto" value="">
                    </div>

                    <div class="form-group col-12 col-sm-6" >
                           <label for="title" class="col-12 control-label">Descripción:</label>
                           <input type="text"  required class="form-control" name="txt_descripcion" id="txt_descripcion" value="">
                    </div>




                    <div class="form-group col-6">
                      <label for="estado">Unidad Medida:</label>
                      <select  class="form-control" required name="cmb_unidad_medida" id="cmb_unidad_medida">
                        <option value="" selected disabled>Seleccione:</option>
                        <?php
                        require_once './clases/UnidadMedida.php';
                        $TipoUnidad= new UnidadMedida();
                        $filasTipoUnidad= $TipoUnidad->obtenerUnidadesMedida();

                        foreach($filasTipoUnidad as $tipo){
                          echo '<option value="'.$tipo['id_unidad_medida'].'" >'.$tipo['descripcion'].'</option>';
                        }
                        ?>
                      </select>
                    </div>

                    <div class="form-group col-6" >
                           <label for="title" class="col-12 control-label">Stock minimo:</label>
                           <input type="text" min="0" onkeypress="return soloLetrasNumeros(event);" required class="form-control" name="txt_stock_minimo" id="txt_stock_minimo" value="">
                    </div>

                    <div class="form-group col-6" >
                      <label for="title" class="col-12 control-label">Marca:</label>
                      <input type="text" class="form-control" name="txt_marca" id="txt_marca" value="">
                    </div>

                    <div class="form-group col-6">
                        <label for="estado">Estado:</label>
                             <select  class="form-control" required name="cmb_estado" id="cmb_estado">
                                <?php
                                    require_once './clases/Estado.php';
                                    $TipoE= new Estado();
                                    $filasTipoC= $TipoE->obtenerEstadosProductosElaborados();

                                    foreach($filasTipoC as $tipo){
                                        echo '<option value="'.$tipo['id_estado'].'" >'.$tipo['descripcion_estado'].'</option>';
                                    }
                                 ?>
                            </select>

                    </div>

            </div>

            <div><hr></div>

            <!-- <div class="row border-info" >

              <div class="form-group col-6" >
                     <label for="title" class="col-6 control-label">Editable:</label>
                     <select class="form-control " onchange="cambiarSelectEditable(this.value)" name="select_editable" id="select_editable">
                        <option value="0">No</option>
                        <option value="1">Si</option>
                     </select>
              </div>

              <div id="contenedor_valor_extra" class="d-none form-group col-6" >
                <label for="title" class="col-12 control-label">Valor Agregado:</label>
                <input type="number" class="form-control" min="0" name="txt_valor_extra" id="txt_valor_extra" value="">
              </div>
            </div> -->

            <div class="form-group" >
              <div class="col-12">
                <button id="btn_guardar_ingrediente" class="btn btn-success btn-block" type="submit" name="button">Guardar</button>
              </div>
            </div>


        </form>
      </div>

    </div>
    </div>
  </div>
<!-- FIN DE MODAL -->

</body>
</html>
