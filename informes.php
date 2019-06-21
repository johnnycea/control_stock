<?php
@session_start();
require_once 'comun.php';
require_once './clases/Usuario.php';
require_once './clases/Ventas.php';
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
   <title>Informes</title>
   <?php cargarHead(); ?>

  <script src="./js/script_informes.js"></script>

  <script>
      // $(document).ready(function(){
      //
      //   var date_input=$('input[name="txt_fecha_inicio"]'); //our date input has the name "date"
      //   var options={
      //     format: 'dd-mm-yyyy',
      //     todayHighlight: true,
      //     autoclose: true,
      //     language: 'es',
      //   };
      //   date_input.datepicker(options);
      //
      // });
      // $(document).ready(function(){
      //
      //   var date_input=$('input[name="txt_fecha_fin"]'); //our date input has the name "date"
      //   var options={
      //     format: 'dd-mm-yyyy',
      //     todayHighlight: true,
      //     autoclose: true,
      //     language: 'es',
      //   };
      //   date_input.datepicker(options);
      //
      // });
    </script>


</head>
<body>



<div class="row">

  <?php cargarMenuPrincipal(); ?>


 <div><hr></div>

  <div class="container contenedor-principal" >


    <div class="card ">
      <div class="card-header bg-dark text-white">
          <label class="card-title bold">Informe de ingresos y gastos</label>
      </div>
      <div class="card-body">
        <form class="" id="formulario_informe" action="javascript:generarInforme()">

          <div class="row">

               <div class="form-group col-3">
                  <label for="title" class="col-12 control-label">Tipo de informe:</label>
                  <select class="form-control" name="select_tipo_informe" id="select_tipo_informe">
                    <option value="1">Resumen</option>
                    <option value="1">Detallado</option>
                  </select>
               </div>

               <div class="form-group col-3">
                  <label for="title" class="col-12 control-label">Fecha Inicio:</label>
                  <input type="date" required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_inicio">
               </div>
               <div class="form-group col-3">
                  <label for="title" class="col-12 control-label">Fecha Fin:</label>
                  <input type="date" required class="form-control"  placeholder="Seleccionar fecha" name="txt_fecha_fin">

               </div>
               <div class="form-group col-3">
                  <label for="title" class="col-12 control-label">&nbsp;</label>
                  <input type="submit"  class="btn btn-success btn-block" value="Generar">

               </div>

           </div>

        </form>
      </div>

    </div>

</br>
</br>

    <div class="card ">
      <div class="card-header bg-dark text-white">
          <label class="card-title bold">Resultado informe</label>
      </div>
      <div class="card-body">

        <div id="contenedor_informe"></div>

      </div>
    </div>


</div>



  </div>

</div>


</body>
</html>
