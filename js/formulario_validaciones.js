// DEFINICION DE VARIABLES VALIDADORAS DE CADA DATO_FORMUULARIO
var mostrarResultadoValidacion = true;
var nombreOK = false;
var apellidoOK = false;
// var edadOK = false;
// var fechaOK = false;
var emailOK = false;
// var edadMinima = 18;
// var edadMaxima = 100;
var telefonoOK = false;
// var generoOK = false;
// var tipotelefonoOK = false;
var mensajeOK = false;
var longitudMinimaTelefono = 7;
var longitudMaximaMensaje = 1000;
var checktratamientodatosOK=false;


// EXPRESIONES REGURLARES DEFINIDAS PARA LA RESPECTIVA VALIDACION
var expRegNumeroEntero = /^-?[0-9]*$/;
var expRegNumeroEnteroPositivo = /^[0-9]*$/;
var expRegFecha = /^\d{1,2}\/\d{1,2}\/(\d{2}|\d{4})$/;
var expRegTxtNombre = /^[A-Z~-�]{1}[~-�\s\w\.\'-]{1,}$/i;
var expRegTxtEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;


//DEFINIMPS LAS FUNCIONES ENCARGADAS PARA ACTIVAR EL ESTILO SEGUN LA INTERACCION DE USUARIO
function estiloINGRESO(){
  this.style.backgroundColor = "cyan";
}


//DEFINCION PARA EL ESTILO CORRECTO
function estiloCORRECTO(inputElement, imagen){
  inputElement.style.backgroundColor='green';
  if (imagen == undefined)
  {   inputElement.nextSibling.src="IMG/tick_ok_sign_4190.jpg"; 
      inputElement.nextSibling.style.visibility = 'visible';
  }
  else { 
      imagen.src="IMG/tick_ok_sign_4190.jpg"; 
      imagen.style.visibility = 'visible';
  }
}



//DEFINCION PARA ESTILO INCORRECTO
function estiloINCORRECTO(inputElement, imagen){
  inputElement.style.backgroundColor="red";
  if (imagen == undefined)
  {
      inputElement.nextSibling.src="IMG/wrong.png"; 
      inputElement.nextSibling.style.visibility = 'visible';
  }
  else {
      imagen.src="IMG/wrong.png";      
      imagen.style.visibility = 'visible';
  }
}


// -- Activa Imagen de dato Correcto o Incorrecto
function ActivaImagenValidacion(inputElement, validacion){
  if (validacion != undefined){ 
      inputElement.style.visibility = 'visible';
      if (validacion == true)
          inputElement.src="IMG/tick_ok_sign_4190.jpg";          
      else 
          inputElement.src="IMG/wrong.png";
  } else {
      inputElement.style.visibility = 'hidden';
      inputElement.src="";
    }

}


//COMENZAMOS A VALIDAR EL CAMPO DE CADA DATO SEA INGRESADO CORRECTAMENTE O QUE NO TENGA VACIOS O DEFINICIONES NO EXPRESAR EN LAS EXPRESIONES REGULARES DE ARRIBA
function validarNombre(){
  var objetoNombre = document.getElementById("nombre");
  if ((expRegTxtNombre.test(objetoNombre.value)) == true){
    nombreOK = true;
    estiloCORRECTO(objetoNombre);
  } else{
    nombreOK = false;
    estiloINCORRECTO(objetoNombre);
  }
}


//COMENZAMOS A VALIDAR EL CAMPO DE CADA DATO SEA INGRESADO CORRECTAMENTE O QUE NO TENGA VACIOS O DEFINICIONES NO EXPRESAR EN LAS EXPRESIONES REGULARES DE ARRIBA
function validarApellido(){
  var objetoApellido = document.getElementById("apellido");
  if ((expRegTxtNombre.test(objetoApellido.value)) == true){
    apellidoOK = true;
    estiloCORRECTO(objetoApellido);
  } else{
    apellidoOK = false;
    estiloINCORRECTO(objetoApellido);
  }
}


//COMENZAMOS A VALIDAR EL CAMPO DE CADA DATO SEA INGRESADO CORRECTAMENTE O QUE NO TENGA VACIOS O DEFINICIONES NO EXPRESAR EN LAS EXPRESIONES REGULARES DE ARRIBA
// function validarEdad(){
//   var objetoEdad = document.getElementById("edad");
//   if ((objetoEdad.value>=edadMinima) && (objetoEdad.value<edadMaxima) && expRegNumeroEnteroPositivo.test(objetoEdad.value)){
//     edadOK = true;
//     estiloCORRECTO(objetoEdad);
//   } else{
//     edadOK = false;
//     estiloINCORRECTO(objetoEdad);
//   }
// }


//COMENZAMOS A VALIDAR EL CAMPO DE CADA DATO SEA INGRESADO CORRECTAMENTE O QUE NO TENGA VACIOS O DEFINICIONES NO EXPRESAR EN LAS EXPRESIONES REGULARES DE ARRIBA
function validarEmail(){
  var objetoEmail = document.getElementById("email");
  var email = objetoEmail.value.toLowerCase();
  email = comprobarAtEmail(email);
  if ((expRegTxtEmail.test(email)) ==true){
    emailOK = true;
    objetoEmail.value = email;
    estiloCORRECTO(objetoEmail);
  } else{
    emailOK = false;
    estiloINCORRECTO(objetoEmail);
  }
}
//convierte texto con caracteristicas del sistema AT&T
function comprobarAtEmail(email){
  var expresion = /\sat\s/g;
  return email.replace(expresion,'@');
}


//COMENZAMOS A VALIDAR EL CAMPO DE CADA DATO SEA INGRESADO CORRECTAMENTE O QUE NO TENGA VACIOS O DEFINICIONES NO EXPRESAR EN LAS EXPRESIONES REGULARES DE ARRIBA
// function validarFecha(){
//   var objetoFecha=document.getElementById("fecha");
//   if ((objetoFecha.value!='') &&   objetoFecha.value.match(expRegFecha) && existeFecha(objetoFecha.value)){
//     fechaOK=true;
//     estiloCORRECTO(objetoFecha); 
//   } else {
//     fechaOK=false;
//     estiloINCORRECTO(objetoFecha);   
//   }
// }
// //  --- funci�n auxiliar para verificar que la fecha sea v�lida es decir, ue esta exista en el calendario segun la  cantidad de d�as de cada mes
// function existeFecha(fecha){
//   var fechaf = fecha.split("/");
//   var day = fechaf[0];
//   var month = fechaf[1];
//   var year = fechaf[2];
// // si el mes  es menor que 1 � mayor de 12, retorna error
//   if (month < 1 || month > 12  ) return false; 
//     else {
// // verificamos que el d�a no supere el m�ximo del mes
//   var date = new Date(year,month,'0');
            
//   if(day < 1 || (day-0)>(date.getDate()-0)){
// //-- el d�a es menor que 1 o mayor que el d�a m�ximo 
//   return false;  
//   } else return true; //-- la fecha es correcta
//     }
// }

function validarTelefono(){
  var objetoTelefono=document.getElementById("telefono");
    if ((objetoTelefono.value!='') && 
      (objetoTelefono.value.length>=longitudMinimaTelefono) &&
      expRegNumeroEnteroPositivo.test(objetoTelefono.value)){
      telefonoOK=true;
      estiloCORRECTO(objetoTelefono);
     } else {
            telefonoOK=false;
             estiloINCORRECTO(objetoTelefono);   
      }
}


// Validamos que el campo MENSAJE esté correctamente ingresado
// y que Cumpla con el formato y las restricciones establecidas
  function validarMensaje(){     
    var objetoMensaje=  document.miniformulario.mensaje;
      if ((objetoMensaje.value!='') && 
      (objetoMensaje.value.length<=longitudMaximaMensaje))
        {
          mensajeOK =true;  
          estiloCORRECTO(objetoMensaje, document.getElementById("img_valida_mensaje"));
        }   else {
              mensajeOK=false;
              estiloINCORRECTO(objetoMensaje, document.getElementById("img_valida_mensaje"));   
            }
  } 

//   function validarOpcionGenero(){
//     generoOK = false; //variable para  comprobación
//     var objetoGenero = document.miniformulario.genero;  //array de elementos
//     var elegido = -1; //número del elemento elegido en el array
//     for (i=0;i<objetoGenero.length;i++) //bucle de comprobación
//     {  
//        if (objetoGenero[i].checked == true) 
//        {
//             generoOK = true ;
//             elegido = i ; //número del elemento elegido en el array
//        }
//      }
//     if (generoOK == true) //mensaje de formulario válido
//     { 
//        OpcionElegida = objetoGenero[elegido].value;
//        ActivaImagenValidacion(document.getElementById("img_valida_genero"),true);
//     }
//     else { //no ha selecionado ninguna de las opciones.
//         ActivaImagenValidacion(document.getElementById("img_valida_genero"),false);
//     }
    
// } 

//   function validarSelectTipoTelefono() {
//     var listaOpciones = document.getElementById("tipo_telefono")
//     if (listaOpciones.selectedIndex == null || listaOpciones.selectedIndex == 0) { 
//       // No ha seleccionado ningún dato de las opciones predefinidas 
//       tipotelefonoOK=false; 
//       estiloINCORRECTO(listaOpciones, document.getElementById("img_valida_tipo_telefono" ));                 
//       }
//     else { 
//       tipotelefonoOK=true; 
//       estiloCORRECTO(listaOpciones, document.getElementById("img_valida_tipo_telefono")); 
//       }		
//     }
// Validamos que el campo de AUTORIZACIÓN tratamiento de datos para contacto
 // El CheckBox debe estar seleccionado para permitir el envío del formulario.   
 function validarCheckBoxAutorizacion() {
  var opcion = document.miniformulario.autoriza_tratamiento_datos; //accede al botón
  if (opcion.checked == true) { //botón seleccionado
      checktratamientodatosOK = true ;
      ActivaImagenValidacion(document.getElementById("img_valida_Autorizacion_tratamiento_datos"),true);
            
  }  else {  //botón no seleccionado
          alert("El formulario no podrá enviarse. \n Debe aceptar las condiciones para poder enviar el formulario");
          checktratamientodatosOK = false ;
          ActivaImagenValidacion(document.getElementById("img_valida_Autorizacion_tratamiento_datos"),false);
            
          }
} 




//FUNCION PARA REALIZAR LA VALIDACION DE LOS DATOS
    function validarDatos(){
      var msgAlerta; 
      
      validarNombre();
      validarApellido();
      // validarEdad();
      // validarFecha();
      validarEmail();
      // validarOpcionGenero();
      validarTelefono();
      // validarSelectTipoTelefono();
      validarMensaje();
      validarCheckBoxAutorizacion();

      if (nombreOK && apellidoOK && telefonoOK && emailOK
       && mensajeOK && checktratamientodatosOK){
        msgAlerta = "Los datos ingresados han sido validados y est�n todos correctos. \nSu formulario ya podr� ser procesado....\n";
        if(mostrarResultadoValidacion) alert (msgAlerta);   
        return true;
      } else {   
        msgAlerta = "Presenta ERRORES en el registro de informaci�n.\n" +
        "Los datos que debe rectificar son: \n" +
        "---------------------------------------\n" +
        "  - Nombre        :  " + (nombreOK ? "OK" : "error") + "\n" +
        "  - Apellido      :  " + (apellidoOK ? "OK" : "error") + "\n" +
        // "  - Edad          :  " + (edadOK ? "OK" : "error") + "\n" +
        // "  - Fecha Nac     :  " + (fechaOK ? "OK" : "error") + "\n" +
        // "  - Género        :  " + (generoOK ? "OK" : "error") + "\n" + 
        "  - e-mail        :  " + (emailOK ? "OK" : "error") + "\n" +   
        "  - Teléfono      :  " + (telefonoOK ? "OK" : "error") + "\n" +   
        // "  - Tipo Teléfono :  " + (tipotelefonoOK ? "OK" : "error") + "\n" +   
        "  - Mensaje       :  " + (mensajeOK ? "OK" : "error") + "\n" +
        "  - Autoriza Tratamiento de Datos:  " + (checktratamientodatosOK ? "OK" : "error") ;         
            
        if(mostrarResultadoValidacion) alert (msgAlerta);
        return false;
        }
    }

    // -- Aplica estilo al validar dato INCORRECTO
    function estiloORIGINAL(IdElemento, IdImagen){
      var objetoInput=document.getElementById(IdElemento);
      objetoInput.style.backgroundColor="cyan";   
      if (IdImagen == undefined) 
      {
          objetoInput.nextSibling.src=""; 
          objetoInput.nextSibling.style.visibility = 'hidden';
    //                     alert("revisamos.5..." + IdElemento); 
      }
      else {
          document.getElementById(IdImagen).src=""; 
          document.getElementById(IdImagen).style.visibility = 'hidden';
      } 
    }



    //------------------------------------------------------------
    //  Función Resetear el contenido de un formulario
    //  teniendo en cuenta en dejar los estilos definidos por defecto
    //------------------------------------------------------------
    function resetearDatos(){
    // var msgAlerta;  
      if (confirm("Desea Limpiar el Formulario?"))
      {
      //--  restablecemos los formatos de inicio
      estiloORIGINAL("nombre");
      estiloORIGINAL("apellido");
      // estiloORIGINAL("edad");
      // estiloORIGINAL("fecha");
      estiloORIGINAL("email");
      estiloORIGINAL("telefono");
      // estiloORIGINAL("tipo_telefono", "img_valida_tipo_telefono");
      estiloORIGINAL("mensaje", "img_valida_mensaje");
      ActivaImagenValidacion(document.getElementById("img_valida_genero"));
      ActivaImagenValidacion(document.getElementById("img_valida_Autorizacion_tratamiento_datos"));

      //document.getElementById("miniformulario").reset();
      document.miniformulario.reset();

      }
    }

