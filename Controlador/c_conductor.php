<?php

 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por mo tivo de que la contrasena corresponda al usuario
 require_once("Model/datos_buses.php");//se llama para poder llenar el select de los buses
 require_once("Model/metodo_datos_conductor.php");//se llama para poder hacer las operaciones correspondientes a conuctor

 $datos_personales = new consulta_datos_usuarios();
 $datos_actualizar = new metodo_actualizar_datos_usuario();
 $log = new login();
 $buses = new datos_buses();
 $condu = new metodo_datos_conductor();
 
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
 
 //////////////////////////////////////////////////// insertar conductor ///////////////////////////////////////////////////////////////////////

 $bus = $buses->buses_disponibles();  //sirve para llenar el select del bus
 
 $cond_general = $condu->conductor_general(); //sirev para llenar el acordeon de conductores
 
 
 //if para insertar conductor
 
 if(isset($_POST["subir_autobus"])){
  $cedula = $_POST["cedula_con"];
  $nombre = $_POST["nombre_con"];
  $apellido = $_POST["apellido_con"];
  $bus = $_POST["bus_con"];
  $licencia = $_POST["licencia_con"];
  $certificado = $_FILES["certificado_con"]["name"];
  $tipo = $_FILES["certificado_con"]["type"];
  $tamano = $_FILES["certificado_con"]["size"];
  $telefono = $_POST["telefono_con"];
  $edad = $_POST["edad_con"];
  
  $repetido = $condu->conductor_cc($cedula);
  
  if(count($repetido) > 0){
   echo "
    <script>
     alert('El conductor ya se encuentra registrado');
     location.href = 'conductor.php';
    </script>
   ";
  } else {
   if($tipo == "application/pdf"){
    if($tamano <= 9000000){
     $hoy = date("dmy");
     $certificado = $hoy."_".$cedula."_".$certificado;
     $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/Certificados/";
     $envia_cond = $condu->insert_conductor($cedula, $nombre, $apellido, $bus, $licencia, $certificado, $telefono, $edad);
     if($envia_cond > 0){
      move_uploaded_file($_FILES["certificado_con"]["tmp_name"], $carpeta_destino.$certificado);
      echo "
       <script>
       Swal.fire({
        icon: 'success',
        title: 'example',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
      });
        // location.href = 'conductor.php';
       </script>
      ";
     } else {
      echo "
       <script>
        //alert('Error, El conductor no ha sido registrado');
        Swal.fire({
          icon: 'error',
          title: 'Error, El conductor no ha sido registrado',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true
        });
        //location.href = 'conductor.php';
       </script>
      ";
     }
    } else {
     echo "
      <script>
       //alert('El certificado no puede exceder de 1 mega');
       Swal.fire({
        icon: 'success',
        title: 'El certificado no puede exceder de 1 mega',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
      });
       //location.href = 'conductor.php';
      </script>
     ";
    }
   } else {
    echo "
     <script>
      //alert('El archivo no tiene extension pdf');
      Swal.fire({
        icon: 'success',
        title: 'El archivo no tiene extension pdf',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
      });
      //location.href = 'conductor.php';
     </script>
    ";
   }
  }
  
 }
 
 //////////////////////////////////////////////////////// actualizar conductores ////////////////////////////////////////////////////////////////
 
 if(isset($_POST["actualizar_conductor"])){
  $repuesto = $_POST["comprobante_repuesto"];
  $cedula = $_POST["cedula_actu_con"];
  $nombre = $_POST["nombre_actu_con"];
  $apellido = $_POST["apellido_actu_con"];
  $bus = $_POST["bus_actu_con"];
  $licencia = $_POST["licencia_actu_con"];
  $licencia_cambia = $_POST["licencia_cambiable"];
  $certificado = $_FILES["comprobante_actu_con"]["name"];
  $tipo = $_FILES["comprobante_actu_con"]["type"];
  $tamano = $_FILES["comprobante_actu_con"]["size"];
  $telefono = $_POST["telefono_actu_con"];
  $edad = $_POST["edad_actu_con"];
  
  if($certificado != null){
   if($tipo == "application/pdf"){
    if($tamano <= 1000000){
     unlink("View/img/Certificados/$repuesto");
     $hoy = date("dmy");
     $certificado = $hoy."_".$cedula."_".$certificado;
     $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/Certificados/";
     $envia = $condu->actu_conductor($nombre, $apellido, $bus, $licencia, $certificado, $telefono, $edad, $cedula);
     if($envia > 0){
      move_uploaded_file($_FILES["comprobante_actu_con"]["tmp_name"], $carpeta_destino.$certificado);
      echo "
       <script>
        alert('El conductor ha sido actualizado');
        location.href = 'conductor.php';
       </script>
      ";  
     } else {
      echo "
       <script>
        alert('Ha ocurrido un error inesperado por fvor intente mas tarde');
        location.href = 'conductor.php';
       </script>
      ";     
     }
    } else {
     echo "
      <script>
       alert('el archivo debe pesar menos de una mega');
      </script>
     ";
    }
   } else {
    echo "
     <script>
      alert('El archivo no es pdf');
     </script>
    ";
   }
  } else {
   if($licencia == $licencia_cambia){
    $envia = $condu->actu_conductor($nombre, $apellido, $bus, $licencia, $repuesto, $telefono, $edad, $cedula);
    if($envia > 0){
     echo "
      <script>
       alert('Los datos han sido actualizados');
       location.href = 'conductor.php';
      </script>
     ";
    } else {
     echo "
      <script>
       alert('Error, los datos no han sido actualizados');
       location.href = 'conductor.php';
      </script>
     ";
    }
   } else {
    echo "
     <script>
      alert('Esta intentando modificar la licencia por favor tambien modifique el certificado');
      location.href = 'conductor.php';
     </script>
    ";
   }
  }
 }
 if(isset($_POST['consultar'])){
     $Cod=$_POST["cod"];
     if($Cod==null){
    $cond_general = $condu->conductor_general();    
     }else{
  $cond_general = $condu-> conductor_especifico($Cod);// muestra los datos del arreglo por licencia y cedula 
     }
 }
 
 require_once("View/Views/v_conductor.php");
?>