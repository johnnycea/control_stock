function mostrarMenu(respuesta){
    $(document).ready(function(){

              if(respuesta==false){
                document.getElementById("etiquetaMensaje").innerHTML="Los datos ingresados son incorrectos";            
             }else{
                document.getElementById("login").innerHTML = respuesta;
             }

    });
}


function ingresar(){

    var usuario= document.getElementById("rut").value;
    usuario=usuario.replace(/\./gi,"");
    var contrasena= document.getElementById("contrasena").value;


      $(document).ready( function() { 
                    var usuario = document.getElementById("rut").value;
                    var contrasena =document.getElementById("contrasena").value;
       
                      location="./metodosAjax/login/verificarDatos.php?u="+usuario+"&c="+contrasena;     
            }); 
}

/*function entrar(e) {//ahora es llamada desde la pantalla login
  tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==13){
     ingresar();
  }
} */

