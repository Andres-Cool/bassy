<?php

 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por motivo de que la contrasena corresponda al usuario
 require_once("Model/consultas_relleno.php");//para llenar los datos de las rutas
 require_once("Model/metodo_pqr.php");//sirve para manejra todo lo relacionado a los pqr
 require_once("Model/insertar_comentarios.php");//para insertar los comentarios
 
 $datos_personales = new consulta_datos_usuarios();
 $actu_datos_personales = new metodo_actualizar_datos_usuario();
 $log = new login();
 $consulta = new consultas_relleno();
 $pqrs = new metodo_pqr();
 $comentarios = new insertar_comentarios();
 
 $rutas = $consulta->tblrutas(); //sirve para rellenar las rutas
 
 ///////////////////////////////variables de sesion/////////////////////////////////////////
 session_start();
 if($_SESSION){
  $llave = $_SESSION["llave_pasajero"];//solo traigo la llave primaria para que se demuestre la actualizacion
 } else {
 	echo "
   <script>
    alert('usuario no autenticado');
    location.href = 'index.php';
   </script>
  ";
 }
 
 
 // insercion  de un comentario
 if (isset($_POST['comentar'])) {
  $idRuta = $_POST["ruta_coment"];
  $puntaje = $_POST["estrellas"];
  $comentario = $_POST['comentario'];
  
  if($puntaje == null){
   $registra_comentario = $comentarios->comentarios_y_respuestas($llave, $idRuta, null, $comentario);
   if ($registra_comentario > 0) {
    echo "
     <script> 
      alert('se registro el comentario'); 
      location.href = 'user.php';
     </script> 
    ";
   } else {
    echo "
     <script>
      alert('No registrado el comentario');
      location.href = 'user.php';
     </script> 
    ";
   }
  } else {
   $registra_comentario = $comentarios->comentarios_y_respuestas($llave, $idRuta, $puntaje, $comentario);
   if ($registra_comentario > 0) {
    echo "
     <script> 
      alert('se registro el comentario'); 
      location.href = 'user.php';
     </script> 
    ";
   } else {
    echo "
     <script>
      alert('No registrado el comentario'); 
      location.href = 'user.php';
     </script> 
    ";
   } 
  }
}


//$mostrar_respuestas = $consulta->respuesta_comentarios();//aca traigo las respuestas a comentarios que estan en la bd


 ////////////////////////////////////////////////////////////////////////////////
 
 $datos_pasajero = $datos_personales->pasajero($llave);//esto es para llenar el formulario del perfil
 
 //if para actualizar los datos personales
 
 if(isset($_POST["actualizar_datos_personales"])){
  $repuesto_foto = $_POST["foto_repuesto"];
  $correo = $_POST["correo_pas"];
  $nombre = $_POST["nombre_pas"];
  $apellido = $_POST["apellido_pas"];
  $foto = $_FILES["foto_pas"]["name"];
  $tipo = $_FILES["foto_pas"]["type"];
  $tamaño = $_FILES["foto_pas"]["size"];
  if($foto != null){
   if($tipo == "image/jpeg" || $tipo == "image/png"){
    if($tamaño <= 1000000){
     if($repuesto_foto == "pas_defecto.png"){
      $hoy = date("dmy");
      $foto = $hoy."_".$correo."_".$foto;
      $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/imgUser/";
      $actualizar = $actu_datos_personales->actu_datos_pasajero($nombre, $apellido, $foto, $correo);
      if($actualizar > 0){
       move_uploaded_file($_FILES["foto_pas"]["tmp_name"], $carpeta_destino.$foto);
       echo "
        <script>
         alert('Sus datos han sido actualizados');
         location.href = 'user.php';
        </script>
       ";
      } else {
     	 echo "
        <script>
         alert('ERROR, Sus datos no han sido actualizados');
         location.href = 'user.php';
        </script>
       ";
      }
     } else {
      unlink("View/img/imgUser/$repuesto_foto"); //elimino la anterior foto del usuario
      $hoy = date("dmy");
      $foto = $hoy."_".$correo."_".$foto;
      $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/imgUser/";
      $actualizar = $actu_datos_personales->actu_datos_pasajero($nombre, $apellido, $foto, $correo);
      if($actualizar > 0){
       move_uploaded_file($_FILES["foto_pas"]["tmp_name"], $carpeta_destino.$foto);
       echo "
        <script>
         alert('Sus datos han sido actualizados');
         location.href = 'user.php';
        </script>
       ";
      } else {
     	 echo "
        <script>
         alert('ERROR, Sus datos no han sido actualizados');
         location.href = 'user.php';
        </script>
       ";
      }
     }
    } else {
     echo "
     <script>
      alert('La foto excede el limite del tamaño');
      location.href = 'user.php';
     </script>
    ";
    }
   } else {
    echo "
     <script>
      alert('La extension de la foto es incorrecta');
      location.href = 'user.php';
     </script>
    ";
   }
  } else {
   $envia = $actu_datos_personales->actu_datos_pasajero($nombre, $apellido, $repuesto_foto, $correo);
   if($envia > 0){
    echo "
     <script>
      alert('Sus datos han sido actulizados');
      location.href = 'user.php';
     </script>
    ";
   } else {
    echo "
     <script>
      alert('ERROR, Sus datos no han sido actulizados');
      location.href = 'user.php';
     </script>
    ";
   }
  }
 }
 
  //if para actualizar contrasena
 
 if(isset($_POST["actualizar_clave"])){
  $actual = $_POST["actual"];
  $nueva = $_POST["nueva"];
  $confirma = $_POST["confirm"];
  $exist = $log->logeo($llave, $actual);
  if(count($exist) > 0){
   if($nueva == $confirma){
    $update_clave = $actu_datos_personales->actu_contrasena($confirma, $llave);
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
 
 ////////////////////////////////////////////////////////////// PQRS ////////////////////////////////////////////////////
 
 //ver la cantidad de pqr por leer
 
 $cantidad_leer = $pqrs->pqr_por_leer($llave);
 
 foreach ($cantidad_leer as  $c) {
  $cantidad = $c[0];
 }
 
 //if para insertar pqr
 
 if(isset($_POST["generar_pqr"])){
  $administrador = null;
  $asunto = $_POST["asunto_pqr"];
  $contenido = $_POST["contenido_pqr"];
  $tipo = $_POST["tipo_pqr"];
  $respuesta = null;
  $fecha_respuesta = null;
  $estado = "Enviado";
  $leido = "No";
  $comprobante = $_FILES["comprobante_pqr"]["name"];
  $c_tipo = $_FILES["comprobante_pqr"]["type"];
  $c_tamano = $_FILES["comprobante_pqr"]["size"];

  if($comprobante != null){
   if($c_tipo == "image/png" || $c_tipo == "image/jpeg" || $c_tipo == "video/x-msvideo" || $c_tipo == "video/mpeg" || $c_tipo == "video/quicktime" || $c_tipo == "application/vnd.rn-realmedia" || $c_tipo == "video/x-ms-wmv" || $c_tipo == "video/mp4" || $c_tipo == "application/x-shockwave-flash"){
    if($c_tamano < 90000000){
     $hoy = date("dmy");
     $comprobante = $hoy."_".$llave."_".$comprobante;
     $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/comprobantes_pqr/";
     $envia = $pqrs->insert_pqr($llave, $administrador, $asunto, $contenido, $tipo, $respuesta, $fecha_respuesta, $estado, $leido, $comprobante);
     if($envia > 0){
      move_uploaded_file($_FILES["comprobante_pqr"]["tmp_name"], $carpeta_destino.$comprobante);
      echo "
       <script>
        alert('Su pqr ha sido enviado');
        location.href = 'user.php';
       </script>
      ";
     } else {
      echo "
       <script>
        alert('Error, Su pqr no ha sido enviado');
        location.href = 'user.php';
       </script>
      ";
     }
    } else {
     echo "
      <script>
       alert('El archivo debe pesar menos de 10 mb (su archivo esta pesando $c_tamano bytes)');
      </script>
     ";
    }
   } else {
    echo "
     <script>
      alert('La extension debe ser video o imagen (png, jpg)');
     </script>
    ";
   }
  } else {
   $envia = $pqrs->insert_pqr($llave, $administrador, $asunto, $contenido, $tipo, $respuesta, $fecha_respuesta, $estado, $leido, null);
  
   if($envia > 0){
    echo "
     <script>
      alert('Su pqr ha sido enviado');
      location.href = 'user.php';
     </script>
    ";
   } else {
    echo "
     <script>
      alert('Error, Su pqr no ha sido enviado');
      location.href = 'user.php';
     </script>
    ";
   }
  }
 }
 
 $general_pqrs = $pqrs->pqr_pasajero($llave); //sirve para ver los pqr del pasajero

  if(isset($_POST['consultar'])){
     $Cod=$_POST["cod"];
     if($Cod==null){
    $general_pqrs = $pqrs->pqr_pasajero($llave);
     }else{
   $general_pqrs = $pqrs->pqr_de_usuario($llave, $Cod);// muestra los datos del arreglo por pqr 
     }
 }
 
 
 require_once("View/Views/usuario.php");
?>