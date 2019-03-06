<?php
@session_start();
require_once 'comun.php';
require_once './clases/Departamento.php';
require_once './clases/Usuario.php';
comprobarSession();
$usuario= new Usuario();
$usuario= $usuario->obtenerUsuarioActual();
?>

<!DOCTYPE html>
<html lang="en">
<head>

<style>


</style>
   <title>Agenda DAEM</title>
   <?php cargarHead(); ?>

  <script src="./js/script_usuarios.js"></script>
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

              <div id='contenedor_listado_usuarios' style="" class=" card col-12"></div>

       </div>

  </div>

</div>



</body>
</html>
