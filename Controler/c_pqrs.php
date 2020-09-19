<?php

 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por motivo de que la contrasena corresponda al usuario
 require_once("Model/metodo_pqr.php");//se llama para todo lo relacionado a los pqr

 $datos_personales = new consulta_datos_usuarios();
 $datos_actualizar = new metodo_actualizar_datos_usuario();
 $log = new login();
 $pqrs = new metodo_pqr();
 
 //if para actualizar los datos del usuario
 
 if(isset($_POST["actualizar_admin"]) != null){
  $imagen_respuesto = $_POST["foto_repuesto"];
  $correo = $_POST["correo_admin"];
  $nombre = $_POST["nombre_admin"];
  $apellido = $_POST["apellido_admin"];
  $telefono = $_POST["telefono_admin"];
  $foto = $_FILES["foto_admin"]["name"];
  $tipo = $_FILES["foto_admin"]["type"];
  $tamano = $_FILES["foto_admin"]["size"];
  if($foto != null){
   if($tipo == "image/jpeg" || $tipo == "image/png"){
    if($tamano <= 1000000){
     if($imagen_respuesto == "adm_defecto.png"){
      $hoy = date("dmy");
      $foto = $hoy."_".$correo."_".$foto;
      $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/imgAdmin/";
      $actualizar = $datos_actualizar->actu_datos_administrador($nombre, $apellido, $telefono, $foto, $correo);
      if($actualizar > 0){
       move_uploaded_file($_FILES["foto_admin"]["tmp_name"], $carpeta_destino.$foto);
       echo "
        <script>
         alert('Sus datos han sido actualizados');
        </script>
       ";
      } else {
     	 echo "
        <script>
         alert('ERROR Sus datos no han sido actualizados');
        </script>
       ";
      }
     } else {
      unlink("View/img/imgAdmin/$imagen_respuesto"); //elimino la anterior foto del usuario
      $hoy = date("dmy");
      $foto = $hoy."_".$correo."_".$foto;
      $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/imgAdmin/";
      $actualizar = $datos_actualizar->actu_datos_administrador($nombre, $apellido, $telefono, $foto, $correo);
      if($actualizar > 0){
       move_uploaded_file($_FILES["foto_admin"]["tmp_name"], $carpeta_destino.$foto);
       echo "
        <script>
         alert('Sus datos han sido actualizados');
        </script>
       ";
      } else {
     	 echo "
        <script>
         alert('ERROR Sus datos no han sido actualizados');
        </script>
       ";
      }
     }
    } else {
    	echo "
      <script>
       alert('ERROR imagen demasiado pesada');
      </script>
     ";
    }
   } else {
   	echo "
     <script>
      alert('ERROR EL ARCHIVO NO ES UNA IMAGEN');
     </script>
    ";
   }
  } else {
   $foto = $imagen_respuesto;
   $actualizar = $datos_actualizar->actu_datos_administrador($nombre, $apellido, $telefono, $foto, $correo);
   if($actualizar > 0){
    echo "
        <script>
         alert('Sus datos han sido actualizados');
        </script>
       ";
      } else {
     	 echo "
        <script>
         alert('ERROR Sus datos no han sido actualizados');
        </script>
       ";
      }
  }
 }

 ///////////////////////////////variables de sesion/////////////////////////////////////////7
 session_start();
 if($_SESSION){
  $llave = $_SESSION["llave_admin"];//solo traigo la llave primaria para que se demuestre la actualizacion
 } else {
 	echo "
   <script>
    alert('usuario no autenticado');
    location.href = 'index.php';
   </script>
  ";
 }

 ////////////////////////////////////////////////////////////////////////////////

 $datos_administrador = $datos_personales->administrador($llave);//sirve para llenar los datos del formulario para actualizar datos personales
 
 //if para actualizar contrasena
 
 if(isset($_POST["actualizar_clave"])){
  $actual = $_POST["actual"];
  $nueva = $_POST["nueva"];
  $confirma = $_POST["confirm"];
  $exist = $log->logeo($llave, $actual);
  if(count($exist) > 0){
   if($nueva == $confirma){
    $update_clave = $datos_actualizar->actu_contrasena($confirma, $llave);
    if($update_clave > 0){
     echo "
      <script>
       alert('Su contrasena ha sido actualizada');
      </script>
     ";
    } else {
     echo "
      <script>
       alert('Error su contrasena no ha sido actualizada');
      </script>
     ";
    }
   } else {
    echo "
     <script>
      alert('Por favor confirme la nueva contrasena');
     </script>
    ";
   }
  } else {
   echo "
    <script>
     alert('Por favor verifique que su contrasena actual sea la correcta');
    </script>
   ";
  }
 }
 
 /////////////////////////////////////////////////////////// PQR ////////////////////////////////////////////////////////////////////////
 
 $general_pqr = $pqrs->pqr_general();
 
 if(isset($_POST["responder"])){
  $respuesta = $_POST["respuesta_pqr"];
  $estado = "Respondido";
  $id = $_POST["id_pqr"];
  $tipo = $_POST["tipo_pqr"];
  $asunto_pqr = $_POST["asunto_pqr"];
  $correo_usu = $_POST["pasajero"];
  $contenido_pqr = $_POST["content"];
  
  $asunto_mail = "Respuesta a su " . $tipo . " sobre " . $asunto_pqr;
  $mensaje  = "Apreciado cliente con respecto a su comunicado '" . $contenido_pqr . "' nos place informarle que " . $respuesta;
  $header = 'From: servicio@buscoment.click' . "\r\n" . 'Reply-To: servicio@buscoment.click' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
  
 $envia = $pqrs->respuesta_pqr($llave, $respuesta, $estado, $id);
  if($envia > 0){
   if(mail($correo_usu, $asunto_mail, $mensaje, $header)){
    echo "
     <script>
      alert('El pqr ha sido respondido');
      location.href = 'pqrs.php';
     </script>
    ";
   } else {
    echo "
     <script>
      alert('Error, el pqr no ha sido respondido');
      location.href = 'pqrs.php';
     </script>
    ";
   }
  } else {
   echo "
    <script>
     alert('Error, el pqr no ha sido respondido');
     location.href = 'pqrs.php';
    </script>
   ";
  }
 }
 if(isset($_POST['search_pqr'])){
     $para=$_POST["para_pqr"];
     if($para==null){
    $general_pqr = $pqrs->pqr_general();
     }else{
   $general_pqr = $pqrs->pqr_especifico($para);// muestra los datos del arreglo por pqr 
     }
 }
 
  
 require_once("View/Views/v_pqr.php");
?>