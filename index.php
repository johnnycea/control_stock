<!DOCTYPE html>
<html lang="es">
     <head>

       <meta http-equiv="Content-Type" content="text/html"; charset="utf-8"/>
       <title>Control Gastos</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='./css/fullcalendar.min.css' rel='stylesheet' />
        <link href='./css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/estilos.css">


        <script src='./js/jquery-3.1.0.min.js'></script>
        <script src='./js/moment.min.js'></script>
        <script src='./js/fullcalendar.min.js'></script>
        <script src='./js/bootstrap.min.js'></script>
        <script src="./js/funciones_calendario.js"></script>
        <script src="./js/scriptLogin.js"></script>
        <script src="./js/validaciones.js"></script>
     </head>
<body>

  <style>
        body{
        	background-image: url("./img/fondo.jpg");
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-size: cover;
         	margin:0;
        }

        .card{
            background-color:rgba(50, 46, 42, 0.73);
            padding:10px;
            border-radius: 4px;
            border-style: solid;
            border-color:rgb(12, 135, 152);
            border-width: 1px;

        }
  </style>


 <div class="container-fluid">
   <div class="row">





       <div class="col-md-4 offset-md-4">

    		<div class="container card card-info" style="" id="login">

                <div class="card-head">
                     <div clas="col-10">
                           <img class="card-img" src="./img/logo_cochento.jpg" alt="">
                     </div>
                </div>

                <div class="card-body">
              			<form class="form vertical" id="formulario">


                       <div class="input-group">
                         <!-- <div class="input-group-prepend">
                          <span class="input-group-text" id="addon_rut"><span class="glyphicon glyphicon-user">Rut&nbsp;&nbsp;&nbsp;</span></span>
                        </div> -->
                         <input placeholder="Rut" aria-label="Rut" aria-describedby="addon_rut" class="form-control" type="text" id="rut" required autofocus onkeypress="return soloNumerosyK(event);" maxlength="12" onBlur="formatearRut(this.value)" placeholder="Ingrese su rut"/>
                       </div>

                       <div class="input-group">
                         <!-- <div class="input-group-prepend">
                           <span class="input-group-text" id="addon_clave">Clave</span>
                         </div> -->
                         <input placeholder="Clave" aria-label="Clave" aria-describedby="addon_clave" class="form-control" type="password" id="contrasena" required onkeypress="entrar(event);" placeholder="Contraseña"/>
                       </div>

                       <div class="form-group">
                         <button class="btn btn-info btn-block" id="botonIngreso" type="submit" >Entrar</button>
                       </div>
                       <div class="form-group">
                         <div class="input-group">
                                 <span class="text-danger info-"></span>
                         </div>
                       </div>

              			</form>
                </div>
    		</div>

      </div>
      <style>
        .btn{
          border-radius: 0;
        }
        .form-control{
          border-radius: 0;
        }
        .titulos{
          font-size: 30px;
          font-weight: lighter;
          color:white;
        }
        .titulos2{
          font-size: 30px;
          font-weight: lighter;
          color:white;
          padding:5px;
          background: rgba(42, 181, 200, 0.76);
        }
      </style>


    </div>


 </div>

<!-- <div class="container-fluid">
  <div class="col-md-4 offset-md-8">
    <br>

      <div class="text-center">
        <label class="titulos"><strong>Dirección de Educación Municipal</strong></label>
        <br>
        <label class="titulos2">Agenda DAEM</label>
      </div>


  </div>
</div> -->

		<script type="text/javascript">

// $("#").fadeIn();

function entrar(){
				  document.onkeypress=function(e){
					var esIE=(document.all);
					var esNS=(document.layers);
					tecla=(esIE) ? event.keyCode : e.which;
					if(tecla==13){
						$("#formulario").submit();
					  }
					}
}


$("#formulario").submit(function(event){
    event.preventDefault();

    var usuario = document.getElementById("rut").value;
    var contrasena =document.getElementById("contrasena").value;

  <?php
    require_once 'clases/Funciones.php';
    $funciones = new Funciones();

    $int;
    if(isset($_REQUEST['int'])){
       $int = $funciones->limpiarNumeroEntero($_REQUEST['int']);
       echo 'sessionStorage.int = '.$int.';';
    }


   ?>


    $('#botonIngreso').removeClass("btn-primary");
    $('#botonIngreso').addClass("btn-warning");
    $('#botonIngreso').html('<span class="giro glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Validando...');

      $.ajax({
        url:"./metodos_ajax/login/verificarDatos.php?u="+usuario+"&c="+contrasena,
        success:function(respuesta){
          // alert(respuesta);
            if(respuesta==1){
              $('#botonIngreso').removeClass("btn-warning");
              $('#botonIngreso').addClass("btn-success");
              $('#botonIngreso').html('<span class="glyphicon glyphicon-ok"> </span>  Redireccionando...');
              setTimeout(function(){
                window.location="./inicio.php";
              },2000);

            }else if(respuesta==2){
              $('#botonIngreso').addClass("btn-danger");
              $('#botonIngreso').removeClass("btn-warning");
              $('.info-login').text("Rut o contraseña incorrecta");
              $('#botonIngreso').html('Incorrecto');
              setTimeout(function(){
                $('.info-login').text("");
              },3000);

            }else if(respuesta==3){
              $('#botonIngreso').addClass("btn-danger");
              $('#botonIngreso').removeClass("btn-warning");
              $('.info-login').text("Rut no válido");
              $('#botonIngreso').html('Incorrecto');
              setTimeout(function(){
                $('.info-login').text("");
              },3000);
            }else{
              alert("Ocurrio un error desconocido, recargue la pagina e intente nuevamente.");
            }
        }
      });
});



		</script>
		<footer>

		</footer>
	</body>
</html>
