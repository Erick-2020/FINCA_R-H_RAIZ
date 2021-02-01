<!DOCTYPE HTML>
  <html>
  <head>
      <!-- definimos la tabla de caracteres UTF-8 para admitir tildes y eñes -->
      <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">

      <!-- definimos datos de AUTOR DE PÁGINA, DESCRIPCIÓN, PALABRAS CLAVE (Para Buscadores) y TÍTULO DE LA PÁGINA -->
      <!-- REEMPLACE O AJUSTE ESTAS LÍNEAS SEGUN LOS DATOS Y CONTENIDOS DE SU PÁGINA WEB -->
      <meta name="Autor_Editor" content="Erick Leonardo Ramirez Hernandez">
      <meta name="description" content="Pagina WEB_Modelo Formulario integrado con JS y PHP para lograr realizar 
      mejor respuesta a travez de un gmail.">
    
      <meta name="keywords" content="Aasesoría informática, Hardware, Software,  Diseño web">
      <title>PHP EMPRESA IT</title> 
      <link href="css/style_contactanos.css" rel="stylesheet">


  </head>
  <body>
        <!-- iniciamos las instrucciones en PHP para:                -->
        <!-- validar datos, construir y enviar el mensaje de correo  -->
        <?php 
    
    $Nombre = $_GET['nombre'];
    $Apellido = $_GET['apellido'];
    $Email = $_GET['email'];
    $Telefono = $_GET['telefono'];
    $Mensaje = $_GET['mensaje'];
   
    //  en caso de no estar seleccionado el check_Box de enviar respuesta, el sistema no transfiere la variable
  //  por lo tanto se asigna directamente CON LA INSTRUCCIÓN:   $SolicitaRespuesta = "off";

    if (isset($_GET['solicitudderespuesta']))
    {
     $SolicitaRespuesta = $_GET['solicitudderespuesta'];
    }
  else {
     $SolicitaRespuesta = "off";
    }

//**************************************************************************
  //****** SEGUNDO: Validamos que el usuario haya ingresados los datos mínimos 
  //                requeridos para el envío del mensaje.
  //                si LLEGA a faltar un campo por llenar, EL Proceso se cancela y
  //                SISTEMA devuelve error mostrando el mensaje correspondiente.
  //                EN CASO CONTRARIO, contrario continúa el proceso con el PASO TRES
  //**************************************************************************    

    if (!$Nombre || !$Apellido || !$Email || !$Telefono || !$Mensaje )
  {
  $MensajeResultadoEnvio =  "No has completado todos los campos obligatorios.<br>" .
                            "Por favor vuelve a intentarlo nuevamente. " .
                            "&nbsp;&nbsp;&nbsp;...[<span class='a:link'><a href='javascript:history.back()'>Volver</a></span>]";
  $ControlErrorMailing = FALSE;
  //   exit;
  }
  else{
      // TERCERO:Construimos y enviamos el mensaje
  //                 Si hay datos para enviar, entonces se arma la estructura del
  //                 mensaje y luego se ejecuta el envío, en el siguiente orden:
  //    
  //      3.1 Definimos los parámetros la zona horaria del país de origen
  //      3.2 Definimos los parámetros básicos para identificar destinatarios
  //      3.3 Definimos los parámetros para identificar el remitente del correo    
  //      3.4 Definimos los parámetros del servidor de correos y protocolo de envío
  //      3.5 Definimos variables para controlar el resultado del envío. 
  //      3.6 Finalmente Armamos el cuerpo del mensaje a transmitir, juntando los 
  //          diferentes campos ingresados en el formulario de entrada de datos.
  //----- 3.7 En forma alternativa para los casos en que se requiera el mensaje en 
  //          formato HTML, se pueden incorporar imágenes y estilos. 
  // 
  //      IMPORTANTE *******   
  //      Asegurarse de definir correctamente los correos destinatarios y los datos
  //      del servidor de correos SMTP para que el proceso opere correctamente
  //      y para que los correos sean enviado al buzón correcto     
  //      en caso contrario podría saturar correos que no correspondan a su proyecto
  //---------------------------------------------------   
  
//3.1: Zona horaria del pais de origen
date_default_timezone_set('America/Bogota');
$FechaHoraActual = date('Y-m-d H:i:s',time());
date_default_timezone_set('America/Bogota');
$FechaHoraActual = date('Y-m-d H:i:s',time());

  //3.2: Destinatarios del mensaje
$Email_Destino ='ramirezhernandez.fincaraiz@gmail.com';
$Nombre_Destino = 'Correo de la  gerente de la empresa R&H';

$Asunto_Mensaje = 'Información contacto de usuario. FINCA RAIZ R&H ';
//opcional:
// $Copia_Destino = 'leonardoraerick20@gmail.com';          
$CopiaOculta_Destino = 'haribonn52@hotmail.com';

//3.3: Remitente del mensaje

      
$Email_Origen = 'contacto@adsi.cundi.co';
$Password_Email_Origen = 'adsi2067915';       
//---------------      
//$Email_Origen = 'correoserviciosadsi1@gmail.com'; 
//$Password_Email_Origen = 'adsi2067915A'; 
$NombreEmail_Origen = 'SERVIDOR CORREOS CONTACTENOS';

//3.4:Definimos los parámetros del servidor de correos y protocolo de envío y cuenta origen del correo. 
//Utilizaremos El servidor gratuito de correo GMAIL

$Formato_mensaje_HTML = true;
$ProtocoloSMTP_Uso= true;
$ProtocoloSMTP_Automatico =true;
$ProtocoloSMTP_Seguridad= "ssl"; // para seguridad tls el puerto es 465 
//$ServidorCorreo_Host = "smtp.gmail.com";
$ServidorCorreo_Host = 'adsi.cundi.co';
$ServidorCorreo_Port = 465;

//3.5: Resultado del envío
$MensajeResultadoEnvio =  "";
$ControlErrorMailing = FALSE;

//3.6: El mensaje que va a llegar
$TextMensajeCompleto = "Enviado por: $Nombre $Apellido \r\n Email: $Email \r\n";
$TextMensajeCompleto .= "Telefono: $Telefono \r\n";
if ($SolicitaRespuesta == "on") {
    $TextMensajeCompleto .= "Solicitó respuesta: SI \r\n";
}
    else{
    $TextMensajeCompleto .="Solicitó respuesta: NO \r\n";
}
$TextMensajeCompleto .= "Fecha y hora de envío: $FechaHoraActual \r\n \r\n";
$TextMensajeCompleto .= "Asunto: ". $Asunto_Mensaje . " (" . $Nombre . " " . $Apellido .")" . "\r\n";
$TextMensajeCompleto .= "Mensaje: $Mensaje";

//3.7: Cuerpo del mensaje con html

$Msg_HTML  = '';
$Msg_HTML .= "<table id='cuerpomensaje' width='450px' cellpadding='2' border='0'>";
$Msg_HTML .= "<tr><td align='center' colspan='2'>";
$Msg_HTML .= "<br>&nbsp;<h2 id='titulotabla'>NUEVO USUARIO INTERESADO</h2>&nbsp;</td></tr>";
$Msg_HTML .= "<tr><td colspan='2'>";
$Msg_HTML .= "<table id='tabla' cellspacing='1' cellpadding='1' width='100%' height='100%' border='1'>";
$Msg_HTML .= "<tr><th style='color: #059D81 ;' align='center' scope='row'>Dato: </th>";
$Msg_HTML .= "<th style='color: #059D81 ;'>Valor</th></tr>";
$Msg_HTML .= "<tr><th style='color: #059D81 ;' align='center'>Nombre</th>";
$Msg_HTML .= "<td style='color: #FB8508 ;'>".trim($Nombre,"\r\n")." ".trim($Apellido,"\r\n")."</td></tr>";  
$Msg_HTML .= "<tr><th style='color: #059D81 ;' align='center'>Email</th>";
$Msg_HTML .= "<td style='color: #FB8508 ;'>".trim($Email,"\r\n")."</td></tr>";  
$Msg_HTML .= "<tr><th style='color: #059D81 ;' align='center'>Teléfono</th>";
$Msg_HTML .= "<td style='color: #FB8508 ;'>".trim($Telefono,"\r\n")."</td></tr>";  
$Msg_HTML .= "<tr><th style='color: #059D81 ;' align='center'>Mensaje</th>";
$Msg_HTML .= "<td style='color: #FB8508 ;'>".nl2br($Mensaje)."</td></tr>";                
$Msg_HTML .= "</table>";
$Msg_HTML .= "</td></tr>";
$Msg_HTML .= "<tr><td>";
$Msg_HTML .= "<img style='width: 75px; height: 75px;' alt='correo enviado'  src='http://cundi.co/imagenes/correo1a.jpg'></td>";
$Msg_HTML .= "<td align='right'><img style='width: 75px; height: 75px;' alt='correo enviado'  src='http://cundi.co/imagenes/imagen_Sistemas_01.jpg'>";
$Msg_HTML .= "</td></tr>";
$Msg_HTML .= "</table>";

// ****** CUARTO:  Carga la CLASE [class.phpmailer.php] 
// esta es especial para envío de correos. Creamos la variable $mail, esta se utilizará para CONSTRUIR y ENVIAR el mensaje.

require 'phpmailer/class.phpmailer.php'; // instrucción alterna para incorporar la librería phpmailer.php
$mail = new PHPMailer();
$mail->IsHTML($Formato_mensaje_HTML); // --- identifica la ruta donde se encuentra el archivo del LENGUAJE español
$mail->setLanguage('es', 'phpmailer/');  // --- Establecemos la tabla de caracteres para el idioma español 
//con estas dos líneas aseguramos que los acentos (TILDES) y eñes se vean correctos.
$mail->CharSet = 'UTF-8';
$mail->Encoding = "quoted-printable";
// --- Establecemos datos protocolo, Servidor y Cuenta de correo origen

if ($ProtocoloSMTP_Uso) {
  $mail->IsSMTP(); //$mail->Mailer = "smtp"; //inst.Alterna protocolo para envío de correos
}
$mail->SMTPAuth = $ProtocoloSMTP_Automatico;
$mail->SMTPSecure = $ProtocoloSMTP_Seguridad;
$mail->Host = $ServidorCorreo_Host;
$mail->Port = $ServidorCorreo_Port;
$mail->Username = $Email_Origen;
$mail->Password = $Password_Email_Origen;
$mail->From = $Email_Origen;
$mail->FromName = $NombreEmail_Origen;    

       
$mail->addAddress($Email_Destino, $Nombre_Destino);//use esta para añadir
//Establece los destinatario con copia y con copia oculta y redireccionamiento para respuesta

      
//$mail->addCC($Copia_Destino);  
$mail->addBCC($CopiaOculta_Destino);

// --- Asunto del email - le unimos el nombre del remitente para diferenciarlo en el buzón de llegada
$mail->Subject = $Asunto_Mensaje . " (" . $Nombre . " " . $Apellido . ")";

// --- Transferimos el contenido del mensaje.  Se usa la función nl2br() para que no se pierdan los saltos de línea
$mail->Body    = nl2br($TextMensajeCompleto)."<br><hr>\r\n".$Msg_HTML;

// --- definimos la prioridad:  1 = High, 3 = Normal, 5 = low
$mail->set('X-Priority', '1'); 

// ****** QUINTO:  Se realiza el proceso de ENVÍO del mensaje con [phpmailer] //Se controla la ocurrencia de ERRORES
//Se muestran los mensajes resultante del proceso

try {
  // ******* AQUÍ realizamos el envío del correo ******
  $mail->Send();
  $ControlErrorMailing = FALSE;
  $MensajeResultadoEnvio = "Tu mensaje ha sido enviado satisfactoriamente.".
      "&nbsp;&nbsp;&nbsp;<span  class='a:link'><a id='volver' href='javascript:history.back()'><b>[VOLVER]</b></a></span>";
    
  }

  //En caso de un error generado por PHPMailer
  catch (phpmailerException $e) { 
    $ControlErrorMailing = TRUE;
    $MensajeResultadoEnvio = $e->errorMessage().
        "&nbsp;&nbsp;&nbsp;<span class='a:link'><a id='volver' href='javascript:history.back()'><b>[VOLVER]</b></a></span>";
}
// Genera el error cuando ocurre cualquier otra falla
catch (Exception $e) {  
    $ControlErrorMailing = TRUE;
    $MensajeResultadoenvio = $e->getMessage().
        "&nbsp;&nbsp;&nbsp;<span class='a:link'><a id='volver' href='javascript:history.back()'><b>[VOLVER]</b></a></span>";
}
  }
  ?> <!-- Aquí finaliza la primera estructura en lenguaje PHP. Ahora construimos la página en HTML para mostrar resultados
      <!-- Aquí finaliza la primara estructura en lenguaje PHP
          <!-- Ahora construimos la página en HTML para mostrar resultados

  <!-- **************************************************************** -->
  <!-- ******* SEXTO:  Utilizamos código HTML para construir la página donde mostraremos los resultados y de confirmación del mensaje enviado -->
      <p align="center"><H3>Resultados del envío del mensaje;</H3></p>
  <table align="center" width="960">
      <tbody>
      <tr>
        <td rowspan="3" width="200">
        </td>
        <td width="525">&nbsp;<?php echo $MensajeResultadoEnvio;
      ?> </td>
        <td rowspan="3" width="200">
        </td>
      </tr>
      <tr>
        <td align="center"><?php echo "<textarea name='mensaje' cols='60' rows='8' readonly='readonly'>";
          echo $TextMensajeCompleto; 
          echo "</textarea>";
          echo "<hr>"; 
          echo $Msg_HTML; 
          echo "<hr>"; 
          ?>
        <br>
        </td>
      </tr>
      <tr>
        <td>&nbsp;<?php if (!$ControlErrorMailing) {
                  echo "Gracias por contactarnos, pronto te daremos respuesta....";
            }
          else {
      echo "Lo sentimos! Tu mensaje no pudo ser recibido y procesado, por favor verifica los datos e intenta más tarde...";
            }
      ?>
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      </tbody>
  </table>

  </body>
</html>

