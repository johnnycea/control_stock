<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Estado_colegio.php';
require_once './clases/Privilegio.php';
require_once './clases/Colegio.php';
require_once './clases/Tipo_establecimiento.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Agenda DAEM Colegios</title>
   <?php cargarHead(); ?>

  <script src="./js/script_colegios.js"></script>
</head>
<body>

<?php cargarMenuPrincipal(); ?>

<br>



<div class="container-fluid">
  <div class="row">

      <div class="col-12 col-md-3">

          <div class="card text-dark">
            <div class="card-header ">
                OPCIONES
            </div>
            <div class="card-body">
                 <?php cargarMenuConfiguraciones(); ?>
            </div>
          </div>

      </div>
       <div class="col-12 col-md-9">

          <div  style="" class=" card col-12">
            <div class="container">
                 <button type="button" onclick="limpiarFormularioColegio();" class="btn btn-success" data-target="#modal_colegio" data-toggle="modal" name="button">Crear nuevo colegio</button>
            </div>
            <div class="container">
              <br>

              <div id='contenedor_listado_colegios'></div>

            </div>

          </div>

       </div>

  </div>

</div>




  <!-- MODAL USUARIO-->
  <div class="modal fade" id="modal_colegio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Colegio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">

        <form id="formulario_modal_colegio" class="" action="javascript:guardarColegio()" method="post">


           <div class="form-group card border-info" >

                <div class="row container">
                    <div class="col-8">
                              <label for="title" class=" control-label">Rbd - Colegio</label>
                              <input required onkeypress="return soloLetrasNumeros(event);" maxlength="50" type="text" class=" form-control" name="txt_rbd_colegio" id="txt_rbd_colegio" value="">
                    </div>
                </div>

                <div class="form-group col-12" >

                       <label for="title" class="col-12 control-label">Nombre Colegio</label>
                       <input type="text" onkeypress="return soloLetras(event);" required class="form-control" name="txt_nombre_colegio" id="txt_nombre_colegio" value="">

                </div>

                <div id="contenedor_selector_estado" class="form-group col-6" >
                    <label for="title" class="col-12 control-label">Estado</label>
                    <select class="form-control" name="select_estado" id="select_estado">
                        <?php
                            $Estado = new Estado_colegio();
                            $Estado->setTabla("tb_estado_colegio");
                            $listaEstados = $Estado->obtenerEstados(" where id_estado=1 or id_estado=2 or id_estado=3");

                            while($filas = $listaEstados->fetch_array()){
                               echo '<option value="'.$filas['id_estado'].'">'.$filas['descripcion_estado'].'</option>';
                            }
                          ?>
                    </select>
                </div>

                <div class="form-group col-md-6" >
                    <label for="title" class="col-12 control-label">Tipo establecimiento</label>
                    <select required class="form-control" name="cmb_tipo_establecimiento" id="cmb_tipo_establecimiento">
                      <option value="" selected disabled>Seleccione:</option>
                      <?php
                          $Tipo_Establecimiento = new Tipo_establecimiento();
                          $listaEstablecimiento = $Tipo_Establecimiento->obtenerTipoEstablecimiento();

                          while($filas = $listaEstablecimiento->fetch_array()){
                             echo '<option value="'.$filas['id_tipo_establecimiento'].'">'.$filas['descripcion_tipo_establecimiento'].'</option>';
                          }
                       ?>
                    </select>
                </div>

                <div class="form-group" >
                  <div class="col-12">
                    <button class="btn btn-success btn-block" type="submit" name="button">Guardar</button>
                  </div>
                </div>
          </div>






        </form>

      </div>


    </div>
    </div>
  </div>


</body>
</html>
