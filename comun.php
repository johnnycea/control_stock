<?php
function comprobarSession(){
  @session_start();
  if(isset($_SESSION['run']) and isset($_SESSION['nombre'])){

  }else{
     header("location: index.php");
  }
}

function cargarHead(){
?>
  <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/estilos.css">
  <link rel="stylesheet" href="./sweetalert/sweet-alert.css">
  <link rel="stylesheet" href='./css/bootstrap-datepicker.min.css' />
  <link rel="stylesheet" href='./fonts/css/fontawesome.min.css' />

  <script src='./js/jquery-3.1.0.min.js'></script>
  <script src='./js/bootstrap.min.js'></script>
  <script src="./js/validaciones.js"></script>
  <script src="./sweetalert/sweet-alert.min.js"></script>
  <script src='./js/moment.min.js'></script>
  <script src="./js/bootstrap-datepicker.min.js"></script>
  <script src="./js/fontawesome-all.min.js"></script>
  <script src="./js/validaciones.js"></script>


  <?php
}


function VentanaCargando(){
  ?>
<style>
.loader,
.loader:before,
.loader:after {
  background: #b63333;
  -webkit-animation: load1 1s infinite ease-in-out;
  animation: load1 1s infinite ease-in-out;
  width: 1em;
  height: 4em;
}
.loader:before,
.loader:after {
  position: absolute;
  top: 0;
  content: '';
}
.loader:before {
  left: -1.5em;
}
.loader {
  text-indent: -9999em;
  margin: 40% auto;
  position: relative;
  font-size: 11px;
  -webkit-animation-delay: 0.16s;
  animation-delay: 0.16s;
}
.loader:after {
  left: 1.5em;
  -webkit-animation-delay: 0.32s;
  animation-delay: 0.32s;
}
@-webkit-keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 #b63333;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em #b63333;
    height: 5em;
  }
}
@keyframes load1 {
  0%,
  80%,
  100% {
    box-shadow: 0 0 #b63333;
    height: 4em;
  }
  40% {
    box-shadow: 0 -2em #b63333;
    height: 5em;
  }
}
</style>
  <div id="contenedor">
      <div class="loader" id="loader">Loading...</div>
   </div>

  <?php
}


function cargarMenuConfiguraciones(){
  $url= basename($_SERVER['PHP_SELF']);

  if($url=="usuarios.php"){
      echo '<a href="./usuarios.php" class="active btn btn-info col-12">Usuarios </a>';
  }else{
      echo '<a href="./usuarios.php" class="btn btn-info col-12">Usuarios </a>';
  }

     echo'<hr>';

  if($url=="marca.php"){
      echo '<a href="./marca.php" class="active btn btn-info col-12">Marca </a>';
  }else{
      echo '<a href="./marca.php" class="btn btn-info col-12">Marca </a>';
  }

     echo'<hr>';

  if($url=="categoria.php"){
      echo '<a href="./categoria.php" class="active btn btn-info col-12">Categoria </a>';
  }else{
      echo '<a href="./categoria.php" class="btn btn-info col-12">Categoria </a>';
  }

  //    echo'<hr>';
  //
  // if($url=="subvenciones.php"){
  //     echo '<a href="./subvenciones.php" class="active btn btn-info col-12">Subvenciones </a>';
  // }else{
  //     echo '<a href="./subvenciones.php" class="btn btn-info col-12">Subvenciones </a>';
  // }

  ?>


  <?php
}

function cargarMenuProveedor(){
  $url= basename($_SERVER['PHP_SELF']);

  if($url=="usuarios.php"){
      echo '<a href="./proveedores.php" class="active btn btn-info col-12">Proveedor </a>';
  }else{
      echo '<a href="./proveedores.php" class="btn btn-info col-12">Proveedor </a>';
  }

     echo'<hr>';


  ?>


  <?php
}
//
// function cargarMenuInformes(){
//   $url= basename($_SERVER['PHP_SELF']);
//
//   if($url=="usuarios.php"){
//       echo '<a href="./usuarios.php" class="active btn btn-info col-12">Por subvencion </a>';
//   }else{
//       echo '<a href="./usuarios.php" class="btn btn-info col-12">Por subvencion </a>';
//   }
//
//      echo'<hr>';
//
//   if($url=="colegios.php"){
//       echo '<a href="./colegios.php" class="active btn btn-info col-12">Resumen </a>';
//   }else{
//       echo '<a href="./colegios.php" class="btn btn-info col-12">Resumen </a>';
//   }
//
//
//
//
//
//
// }

function cargarMenuPrincipal(){
?>

<style>
   .menu{
     background: #10424f;
     padding: 5px;
     margin-left: 10px;
   }
   .menu a{
     text-decoration: none;
     color: black;
   }

   #icono_menu{
     width: 80%;
     margin-left: 10%;
     margin-top: 10px;
     margin-bottom: 5px;
     padding:0px;
   }
   .botones_menu{
     width: 80%;
     margin-left: 10%;
     margin-top: 10px;
     margin-bottom: 5px;
     padding:0px;
     height: 70px;
     background: ;
     color: #ffffff;
     background: #000000;
   }
   .lista_iconos{
     font-size: 40px;
   }
</style>

<div class="col-1 menu">

  <div class="card" id="icono_menu" >
    <img class="card-img" src="./img/logo_cochento.jpg" >
  </div>

<a href="./ventas.php">
    <div class="card botones_menu">
    	 <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img " src="" style="width:50%;" >

        <label for="">Ventas</label>
      </center>
    </div>
</a>

<a href="./facturas.php">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Ingresos</label>
      </center>
    </div>
</a>

<a href="./productos_elaborados.php">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Productos Elab.</label>
      </center>
    </div>
</a>

<a href="">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Stock</label>
      </center>
    </div>
</a>

<a href="./proveedores.php">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Proveedor</label>
      </center>
    </div>
</a>

<a href="./informes.php">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Informes</label>
      </center>
    </div>
</a>

<a href="./configuraciones.php">
    <div class="card botones_menu">
      <center>
        <!-- <i class="fa fa-list-ul lista_iconos"></i> -->
        <img class="card-img" src="" style="width:50%;" >

        <label for="">Configurar</label>
      </center>
    </div>
</a>




</div>

<?php
// $url= basename($_SERVER['PHP_SELF']);
//
// require_once './clases/Usuario.php';
// $usuario= new Usuario();
// $usuario= $usuario->obtenerUsuarioActual();
//
//
//
//
//       if($usuario['tipo_usuario']==1){
//
//              //UN LINK
//              echo '<li class="nav-item">';
//                    if($url=="configuraciones.php" ){
//                      echo '<a class="nav-link active" href="./configuraciones.php">Configuraciones</span></a>';
//                    }else{
//                      echo '<a class="nav-link" href="./configuraciones.php">Configuraciones</span></a>';
//                    }
//              echo '</li>';
//        }
//
//        if($usuario['tipo_usuario']==1){
//
//               //UN LINK
//               echo '<li class="nav-item">';
//                     if($url=="proveedores.php" ){
//                       echo '<a class="nav-link active" href="./proveedores.php">Proveedores</span></a>';
//                     }else{
//                       echo '<a class="nav-link" href="./proveedores.php">Proveedores</span></a>';
//                     }
//               echo '</li>';
//         }
//        if($usuario['tipo_usuario']==1){
//
//               //UN LINK
//               echo '<li class="nav-item">';
//                     if($url=="facturas.php"){
//                       echo '<a class="nav-link active" href="./facturas.php">Facturas</span></a>';
//                     }else{
//                       echo '<a class="nav-link" href="./facturas.php">Facturas</span></a>';
//                     }
//               echo '</li>';
//         }
//
//
     ?>



     <!-- <label class="text-white"><?php //echo $usuario['nombre'].' &nbsp;'; ?></label>
     <a href="./cerrarSesion.php" class="btn btn-danger my-2 my-sm-0" >Salir</a>


  </div> -->

<!-- <div>Icons made by <a href="https://www.flaticon.es/autores/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.es/" 		    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 		    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div> -->

<?php
}

 ?>
