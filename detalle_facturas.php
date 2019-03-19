<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Proveedor.php';
require_once './clases/Facturas.php';
require_once './clases/Marca.php';
require_once './clases/Categoria.php';
require_once './clases/Producto.php';
// require_once './clases/DetalleFacturas.php';
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

  <script>
      $(document).ready(function(){

        var date_input=$('input[name="txt_fecha_ingreso"]'); //our date input has the name "date"
        var options={
          format: 'dd-mm-yyyy',
          todayHighlight: true,
          autoclose: true,
          language: 'es',
        };
        date_input.datepicker(options);

      })
    </script>
</head>
<body>

<?php cargarMenuPrincipal(); ?>


<?php

 //echo "hola el id es: ".$_REQUEST['rut_proveedor'];

 $id_factura = $_REQUEST['id_factura'];
echo '<script> var id_factura = '.$id_factura.'; </script>';


 $factura_creada = new Facturas();
 $factura_creada->setIdFactura($id_factura);
 $respuesta = $factura_creada->obtenerFactura();

  $filas = $respuesta->fetch_array();

 ?>


</div>

</div>

<br>


      <div class="container">

        <form id="formulario_detalle_factura" class="" action="javascript:guardarFactura()" method="post">

           <!-- <input type="hidden" name="txt_id_proveedor" id="txt_id_proveedor" value=""> -->

           <div class="form-group card border-info col-12">
             <div class="row">
                <div class="form-group col-md-3">

                       <label for="title" class="control-label">Número factura:</label>
                       <input type="text" required class="form-control" name="txt_numero_factura" id="txt_numero_factura" value="<?php echo $filas['numero_factura']; ?>">
                </div>

                <div class="form-group col-md-4">
                       <label for="title" class="control-label">Fecha de ingreso</label>
                       <input value="<?php echo $filas['fecha_factura']; ?>" class="form-control" type="text" id="txt_fecha_ingreso" name="txt_fecha_ingreso" readonly placeholder="Dia/Mes/Año" >
                </div>

                <div class="form-group col-md-4">
                    <label for="title" class="control-label">Proveedor:</label>
                    <select required class="form-control" name="select_proveedor" id="select_proveedor" >
                      <!-- <option value="" selected disabled>Seleccione:</option> -->
                      <?php
                          $Proveedor = new Proveedor();
                          $listaProveedor = $Proveedor->obtener_cmb_Proveedor();

                          while($filas_proveedor = $listaProveedor->fetch_array()){

                            if($filas_proveedor['rut_proveedor']==$filas['rut_proveedor']){
                              echo '<option selected="selected" value="'.$filas_proveedor['rut_proveedor'].'">'.$filas_proveedor['razon_social'].'</option>';
                            }else{
                              echo '<option value="'.$filas_proveedor['rut_proveedor'].'">'.$filas_proveedor['razon_social'].'</option>';
                            }
                          }
                       ?>
                    </select>
                </div>
          </div>
            </div>

        </form>

      </div>

      <!-- Productos -->

      <div class="container">

        <form id="formulario_detalle_factura_producto" class="" action="javascript:guardarProductoFactura()" method="post">

           <input type="hidden" name="txt_id_estado" id="txt_id_estado" value="1">
           <input type="hidden" name="txt_id_factura" id="txt_id_factura" value="<?php echo $id_factura; ?>">

           <div class="form-group card border-info col-12">
             <div class="row">
                <div class="form-group col-md-4">

                       <label for="title" class="control-label">Codigo Producto:</label>
                       <input type="text" onkeyup="cargarDatosProducto(this.value);" required class="form-control" name="txt_codigo_producto" id="txt_codigo_producto" value="">
                </div>

                <div class="form-group col-md-4">
                    <label for="title" class="control-label">Marca:</label>
                    <select required class="form-control" name="select_marca" id="select_marca" value="">
                      <option value="" selected disabled>Seleccione:</option>
                      <?php
                          $Marca = new Marca();
                          $listaMarca = $Marca->obtenerMarcas();

                          while($filas = $listaMarca->fetch_array()){
                             echo '<option value="'.$filas['id_marca'].'">'.$filas['nombre_marca'].'</option>';
                          }
                       ?>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="title" class="control-label">Categoria:</label>
                    <select required class="form-control" name="select_categoria" id="select_categoria" value="">
                      <option value="" selected disabled>Seleccione:</option>
                      <?php
                          $Categoria = new Categoria();
                          $listaCategoria = $Categoria->obtenerCategoria();

                          while($filas = $listaCategoria->fetch_array()){
                             echo '<option value="'.$filas['id_categoria'].'">'.$filas['descripcion_categoria'].'</option>';
                          }
                       ?>
                    </select>
                </div>
          </div>
             <div class="row">
                <div class="form-group col-md-3">

                       <label for="title" class="control-label">Descripción:</label>
                       <input type="text" required class="form-control" name="txt_descripcion_producto" id="txt_descripcion_producto" value="">
                </div>
                <div class="form-group col-md-3">

                       <label for="title" class="control-label">Stock Minimo:</label>
                       <input type="text" required class="form-control" name="txt_stock_minimo" id="txt_stock_minimo" value="">
                </div>
                <div class="form-group col-md-3">
                       <label for="title" class="control-label">Cantidad:</label>
                       <input value="" class="form-control" type="text" id="txt_cantidad" name="txt_cantidad">
                </div>
                <div class="form-group col-md-3">
                       <label for="title" class="control-label">Valor Unitario:</label>
                       <input type="text" class="form-control" name="txt_valor_unitario" id="txt_valor_unitario" value="">
                </div>


          </div>
          <div class="form-group" >
            <div class="col-12">
              <button class="btn btn-success btn-block" type="submit" name="button">Guardar</button>
            </div>
          </div>
        </div>

        </form>

      </div>


           <div class="container">
                       <div class="form-group card border-info col-12">
                   <br>
                            <div id='contenedor_listado_detalle_facturas' class="container"></div>


                       </div>
           </div>




<script type="text/javascript" src="./js/script_facturas.js"></script>
<script type="text/javascript">
  listarDetalleFacturas();
</script>
</body>
</html>
