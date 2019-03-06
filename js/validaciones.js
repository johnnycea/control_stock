function mostrarCargando(contenedor){

  var resultado= "<style>.loader,.loader:before,.loader:after {background: #b63333;-webkit-animation: load1 1s infinite ease-in-out;animation: load1 1s infinite ease-in-out;width: 1em;height: 4em;}.loader:before,.loader:after {position: absolute;top: 0;content: '';}.loader:before {left: -1.5em;}.loader {text-indent: -9999em;margin: 10% auto;position: relative;font-size: 11px;-webkit-animation-delay: 0.16s;animation-delay: 0.16s;}.loader:after {left: 1.5em;-webkit-animation-delay: 0.32s;animation-delay: 0.32s;}@-webkit-keyframes load1 {0%,80%,100% {box-shadow: 0 0 #b63333;height: 4em;}40% {box-shadow: 0 -2em #b63333;height: 5em;}}@keyframes load1 {0%,80%,100% {box-shadow: 0 0 #b63333;height: 4em;}40% {box-shadow: 0 -2em #b63333;height: 5em;}}</style>";

  resultado+='<div id="contenedor"><div class="loader" id="loader">Loading...</div></div>';

  $("#"+contenedor).html(resultado);
}


 function soloLetras(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }

function soloNumerosyK(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;

     if ((keynum == 8) || (keynum ==107)|| (keynum ==75)){
            return true;
     }else{

        return /\d/.test(String.fromCharCode(keynum));
    }
}
function soloNumeros(e)
{
    var keynum = window.event ? window.event.keyCode : e.which;

     if ((keynum == 8)){
            return true;
     }else{

        return /\d/.test(String.fromCharCode(keynum));
    }
}
 function soloLetrasNumeros(e){
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " áéíóúabcdefghijklmnñopqrstuvwxyz1234567890";
       especiales = "8-37-39-46";

       tecla_especial = false
       for(var i in especiales){
            if(key == especiales[i]){
                tecla_especial = true;
                break;
            }
        }

        if(letras.indexOf(tecla)==-1 && !tecla_especial){
            return false;
        }
    }
  function validarFecha(str){
      var stringToValidate = str;
      var rgexp = /(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/;
      var isValidDate = rgexp.test(stringToValidate);

    }

//VALIDACION DE CAMPO RUT
function formatearRut(str)
{

     var temp = str.replace(/\./gi,"");//quita los puntos al rut
     temp = temp.replace(/\-/gi,"");    //quita el guion al rut
     var sRut1=temp;


                    var nPos = 0; //Guarda el rut invertido con los puntos y el guión agregado
                    var sInvertido = ""; //Guarda el resultado final del rut como debe ser
                    var sRut = "";

                     for(var i=sRut1.length-1; i>= 0; i-- )
                    {
                        sInvertido += sRut1.charAt(i);
                        if (i==sRut1.length-1){

                            sInvertido += "-";
                        }else if (nPos == 3){

                            sInvertido += ".";
                            nPos = 0;
                        }
                        nPos++;
                    }
                    for(var j = sInvertido.length - 1; j>= 0; j-- )
                    {
                        if (j != sInvertido.length ){
                            sRut += sInvertido.charAt(j);
                        }
                    }


    document.getElementById("rut").value=sRut;
    validaRut(sRut);
}

function validaRutAgenda(campo){


    if(validaRut(campo.value)){
        return true;
    }else{
        if(campo.value.indexOf('-')>=0){
          $(document).ready( function(){
               swal("Advertencia!", "El Rut ingresado no es válido", "warning");
               campo.focus();

         });
        }else{
            swal("Advertencia!", "El Rut debe contener guión", "warning");
            campo.focus();

        }
    }
}

function validaRut(str)
{
    var rut = str.replace(/\./gi, "");

    //Valor acumulado para el calculo de la formula
    var nAcumula = 0;
    //Factor por el cual se debe multiplicar el valor de la posicion
    var nFactor = 2;
    //Dígito verificador
    var nDv = 0;

    //extraemos el digito verificador (La K corresponde a 10)
    if(rut.charAt(rut.length-1).toUpperCase()=='K'){
        nDvReal = 10;
    //el 0 corresponde a 11
    }else{
            if(rut.charAt(rut.length-1)==0){
                nDvReal = 11;
            }else{
                nDvReal = rut.charAt(rut.length-1);
            }
    }

           for(nPos=rut.length-2; nPos>0; nPos--){

                    var numero = rut.charAt(nPos-1).valueOf();
                    nAcumula =nAcumula+( numero*nFactor);

                    nFactor= nFactor+1;
                    if (nFactor==8){
                         nFactor = 2;
                    }

            }

   nDv = 11-(nAcumula%11);

    if (nDv == nDvReal){
            return true;
    }else{
        return false;
    }

}



//
// function mostrarCargando(){
//     document.getElementById("divCargando").innerHTML ='<div id="over" class="adelante"><p id="textoCargando">CARGANDO</p></div><div id="fade" class="atras">&nbsp;</div>';
// }
// function ocultarCargando(){
//     document.getElementById("divCargando").innerHTML ='';
// }
