<?php

 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por mo tivo de que la contrasena corresponda al usuario
 require_once("Model/consultas_relleno.php");//sirve para llenar las rutas
 require_once("Model/metodo_datos_rutas.php");//sirve para tarer lo relacionados a las rutas
 require_once("Model/metodo_sub_rutas.php");//sirve para todo lo relacionado a las sub-rutas
 require_once("Model/metodo_paraderos.php");// todo sobre los paraderos

 $datos_personales = new consulta_datos_usuarios();
 $datos_actualizar = new metodo_actualizar_datos_usuario();
 $log = new login();
 $consulta = new consultas_relleno();
 $datos_rutas = new metodo_datos_rutas();
 $sub_rutas = new metodo_sub_rutas();
 $par = new metodo_paraderos();
 
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
 
 ///////////////////////////////////////////////////insertar rutas///////////////////////////////////////////////////////////////////////
  $rutas = $consulta->tblrutas();//para llenar las rutas
  
  if(isset($_POST["consultar_ruta"])){
   $parametro = $_POST["search_ruta"];
   if($parametro == null){
    $rutas = $consulta->tblrutas();
   } else {
    $rutas = $datos_rutas->buscar_rutas($parametro);
   }
  }
  
 //if para insertar rutas
 
 if(isset($_POST["insert_ruta"])){
  $id = $_POST["codigo_rut"];
  $nombre = $_POST["nombre_rut"];
  $salida = $_POST["salida_rut"];
  $llegada = $_POST["llegada_rut"];
  $costo = $_POST["costo_rut"];
  $tiempo = $_POST["tiempo_rut"];
  $imagen = $_FILES["imagen_rut"]["name"];
  $tipo = $_FILES["imagen_rut"]["type"];
  $tamano = $_FILES["imagen_rut"]["size"];
  $map = $_POST["mapa_rut"];
  $repetidos = $datos_rutas->consulta_rutas($id);
  if(count($repetidos) > 0){
   echo "
    <script>
     alert('El codigo de la ruta ya existe');
     location.href = 'rutas.php';
    </script>
   ";
  } else {
   if($tipo == "image/jpeg" || $tipo == "image/png"){
    if($tamano <= 1000000){
     $hoy = date ("dmy");
     $imagen = $hoy."_".$id."_".$imagen;
     $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/portfolio/";
     $envia = $datos_rutas->insert_rutas($id, $llave, $nombre, $salida, $llegada, $costo, $tiempo, $imagen, $map);
     if($envia > 0){
      move_uploaded_file($_FILES["imagen_rut"]["tmp_name"], $carpeta_destino.$imagen);
      echo "
       <script>
        alert('La ruta ha sido registrada');
        location.href = 'rutas.php';
       </script>
      ";
     } else {
      echo "
       <script>
        alert('Error en insertar por favor intente mas tarde');
        location.href = 'rutas.php';
       </script>
      ";
     }
    } else {
     echo "
      <script>
       alert('Imagen demasiado pesada');
       location.href = 'rutas.php';
      </script>
     ";
    }
   } else {
    echo "
    <script>
     alert('La extension del archvo es incorrecta');
     location.href = 'rutas.php';
    </script>
   ";
   }
  }
 }
 
 //if para actualizar rutas
 
 if(isset($_POST["actualizar_ruta"])){
  $imagen_repuesto = $_POST["imagen_repuesto_ruta"];
  $nombre = $_POST["nombre_rut_actu"];
  $salida = $_POST["salida_rut_actu"];
  $llegada = $_POST["llegada_rut_actu"];
  $costo = $_POST["costo_rut_actu"];
  $tiempo = $_POST["tiempo_rut_actu"];
  $imagen = $_FILES["imagen_rut_actu"]["name"];
  $tipo = $_FILES["imagen_rut_actu"]["type"];
  $tamano = $_FILES["imagen_rut_actu"]["size"];
  $map = $_POST["mapa_rut_actu"];
  $id = $_POST["codigo_rut_actu"];
  if($imagen != null){
   if($tipo == "image/jpeg" || $tipo == "image/png"){
    if($tamano <= 1000000){
     unlink("img/portfolio/$imagen_repuesto");
     $hoy = date ("dmy");
     $imagen = $hoy."_".$id."_".$imagen;
     $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/portfolio/";
     $envia = $datos_rutas->actu_ruta($llave, $nombre, $salida, $llegada, $costo, $tiempo, $imagen, $map, $id);
     if($envia > 0){
      move_uploaded_file($_FILES["imagen_rut_actu"]["tmp_name"], $carpeta_destino.$imagen);
      echo "
       <script>
        alert('La ruta ha sido actualizada');
        location.href = 'rutas.php';
       </script>
      ";
     } else {
      echo "
       <script>
        alert('Error, La ruta no ha sido actualizada');
        location.href = 'rutas.php';
       </script>
      ";
     }
    } else {
     echo "
      <script>
       alert('Imagen demasiado pesada');
       location.href = 'rutas.php';
      </script>
     ";  
    }
   } else {
    echo "
     <script>
      alert('La extension de la imagen es incorrecta');
      location.href = 'rutas.php';
     </script>
    ";
   }
  } else {
   $envia = $datos_rutas->actu_ruta($llave, $nombre, $salida, $llegada, $costo, $tiempo, $imagen_repuesto, $map, $id);
   if($envia > 0){
    echo "
     <script>
      alert('La ruta ha sido actualizada');
      location.href = 'rutas.php';
     </script>
    ";
   } else {
    echo "
     <script>
      alert('Error, La ruta no ha sido actualizada');
      location.href = 'rutas.php';
     </script>
    ";
   }
  }
 }

////////////////////////////////////////////////////////////////  SUB-RUTAS /////////////////////////////////////////////////////////////

$sub_ruta_general = $sub_rutas->sub_ruta_general(); //sirve para traer todas las sub-rutas existentes

//if para insertar sub-rutas

if(isset($_POST["subir_sub_ruta"])){
 $nombre = $_POST["nombre_sub"];
 $costo = $_POST["costo_sub"];
 $envia = $sub_rutas->insert_sub_ruta($nombre, $costo);
 if($envia > 0){
  echo "
   <script>
    alert('La sub-ruta ha sido registrada');
    location.href = 'rutas.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Ha ocurrido un error inesperado, por favor intenet mas tarde');
    location.href = 'rutas.php';
   </script>
  ";
 }
}

//if para actualizar sub-rutas

if(isset($_POST["actualizar_sub_ruta"])){
 $id = $_POST["id_sub_ruta"];
 $nombre = $_POST["nombre_sub_actu"];
 $costo = $_POST["costo_sub_actu"];
 $envia = $sub_rutas->actu_sub_rutas($nombre, $costo, $id);
 if($envia > 0){
  echo "
   <script>
    alert('La sub-ruta ha sido actualizada');
    location.href = 'rutas.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Ha ocurrido un error inesperado, por favor intenet mas tarde');
    location.href = 'rutas.php';
   </script>
  ";  
 }
}
////////////////////////////////////////////// consulta de las Sub rutas///////////////////////////////////
if(isset($_POST['consultarSubruta'])){
     $Cod=$_POST["codigo"];
     if($Cod==null){
   $sub_ruta_general = $sub_rutas->sub_ruta_general(); //sirve para traer todas las sub-rutas existentes
  
     }else{
  $sub_ruta_general = $sub_rutas->subruta_especifica ($Cod); //sirve para traer todas las sub-rutas especificamentre or nombre y costo

     }
 }
///////////////////////////////////////////////////////////////// PARADEROS ///////////////////////////////////////////////////////////7

$paradero_general = $par->paradero_general();

//if para insertar paraderos

if(isset($_POST["subir_paradero"])){
 $nombre = $_POST["nombre_par"];
 $envia = $par->insert_paradero($nombre);
 if($envia > 0){
  echo "
   <script>
    alert('El paradero ha sido registrado');
    location.href = 'rutas.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Ha ocurrido un error inesperado, por favor intenet mas tarde');
    location.href = 'rutas.php';
   </script>
  "; 
 }
}

//if para actualizar paraderos

if(isset($_POST["actualizar_paradero"])){
 $nombre = $_POST["nombre_par_actu"];
 $id = $_POST["id_paradero"];
 $envia = $par->actu_paradero($nombre, $id);
 if($envia > 0){
  echo "
   <script>
    alert('El paradero ha sido actualizado');
    location.href = 'rutas.php';
   </script>
  ";
 } else {
  echo "
   <script>
    alert('Ha ocurrido un error inesperado, por favor intenet mas tarde');
    location.href = 'rutas.php';
   </script>
  "; 
 }
}

 ////////////////////////////////////////// consulta de los paraderos //////////////////////////////////////////
 if(isset($_POST['ConsulPara'])){
     $Codigo=$_POST["par"];
      echo"
    alert('$Codigo');
     ";
     if($Codigo==null){
 $paradero_general = $par ->paradero_general();// llena los datos del acordeon 
  
     }else{
   $paradero_general = $par ->consulta_paraderos($Codigo); //sirve para traer todas los paraderos especificamentre por nombre 

     }
 }

require_once("View/Views/v_rutas.php");
