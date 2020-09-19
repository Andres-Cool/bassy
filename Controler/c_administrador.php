<?php
 
 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por motivo de que la contrasena corresponda al usuario
 require_once("Model/metodo_insertar_perfil.php");//sirve para poder crear mas perfiles
 require_once("Model/metodo_pqr.php");//sirve para notificar si se tiene nuevos pqr

 $datos_personales = new consulta_datos_usuarios();
 $datos_actualizar = new metodo_actualizar_datos_usuario();
 $log = new login();
 $insert_perfil = new metodo_insertar_perfil();
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

////////////////////////////////////////////////////////////////////insertar administrador ///////////////////////////////////////////////////////7

//if para insertar administrador

if(isset($_POST["nuevo_admin"])){
 $email = $_POST["correo_admin_insert"];
 $clave = $_POST["contrasena_admin_insert"];
 $rol = "Administrador";
 $estado = "Activo";
 $foto = "adm_defecto.png";
 $nombre = $_POST["nombre_admin_insert"];
 $apellido = $_POST["apellido_admin_insert"];
 $telefono = $_POST["telefono_admin_insert"];
 $envia0 = $datos_personales->usuario($email);
 if(count($envia0) > 0){
  echo "
   <script>
    alert('El correo ya se encuentra registrado');
   </script>
  ";
 } else {
  $envia = $insert_perfil->usuario($email, $clave, $rol, $estado, $foto);
  if($envia > 0){
   $envia2 = $insert_perfil->administrador($email, $nombre, $apellido, $telefono);
   if($envia2 > 0){
    echo "
     <script>
      alert('Administrador registrado');
     </script>
    ";
   } else {
    echo "
     <script>
      alert('Error, administrador no registrado');
     </script>
    ";
   }
  } else {
   echo "
    <script>
     alert('error en insertar usuario');
    </script>
   ";
  }
 }
}

/////////////////////////////////////////////////////////////////7actualizar adminsitradores ///////////////////////////////////////////////////

$general_admins = $datos_personales->general_admins();//sirve para llenar acordeon

if(isset($_POST["actualizar_admins"])){
 
 $nombre = $_POST["nombre_admin_actu"];
 $apellido = $_POST["apellido_admin_actu"];
 $telefono = $_POST["telefono_admin_actu"];
 $rol = $_POST["rol_admin_actu"];
 $estado = $_POST["estado_admin_actu"];
 $correo = $_POST["correo_admin_actu"];
 
 $actu_admins = $datos_actualizar->actu_administradores($nombre, $apellido, $telefono, $rol, $estado, $correo);
 
 if($actu_admins > 0){
  echo "
   <script>
    alert('Los datos han sido actualizados');
    location.href = 'admin.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Error, Los datos no han sido actualizados');
    location.href = 'admin.php';
   </script>
  ";  
 }
    
}

///////////////////////////////////////////////////////////////////// PASAJEROS //////////////////////////////////////7

$general_pas = $datos_personales->general_pasajeros();//sirve para llenar acordeon de clientes

if(isset($_POST["consultar_cli"])){//if para el buscador de clientes
 $para =$_POST["search_cli"];
 if($para == null){
  $general_pas = $datos_personales->general_pasajeros();
 } else {
  $general_pas = $datos_personales->buscar_cliente($para);
 } 
}

if(isset($_POST["actualizar_pasajero"])){
 
 $nombre = $_POST["nombre_actu_pas"];
 $apellido = $_POST["apellido_actu_pas"];
 $rol = $_POST["rol_actu_pas"];
 $estado = $_POST["estado_actu_pas"];
 $correo = $_POST["correo_actu_pas"];
 
 $actu_admins = $datos_actualizar->actu_pasajeros($nombre, $apellido, $rol, $estado, $correo);
 
 if($actu_admins > 0){
  echo "
   <script>
    alert('Los datos han sido actualizados');
    location.href = 'admin.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Error, Los datos no han sido actualizados');
    location.href = 'admin.php';
   </script>
  ";  
 }
    
}

////////////////////////////////////////////////////////// PQR ////////////////////////////////////////////////

$cantidad_pqr = $pqrs->faltan_por_responder();

foreach ($cantidad_pqr as  $c) {
    $cantidad = $c[0];
}




 require_once("View/Views/administrador.php");
?>