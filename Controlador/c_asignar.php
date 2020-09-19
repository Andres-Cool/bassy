<?php

 require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
 require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
 require_once("Model/login.php");//se llama por motivo de que la contrasena corresponda al usuario
 require_once("Model/consultas_relleno.php");//sirve para llenar las rutas
 require_once("Model/datos_buses.php");//modelo ,consulta,inserta,actualiza Buses.
 require_once("Model/metodo_ruta_bus.php");//sirve para todo lo realicionado a la tabla de ruta con bus
 require_once("Model/metodo_datos_rutas.php");//sirve para tarer lo relacionados a las rutas
 require_once("Model/metodo_sub_rutas.php");//sirve para ver las subrutas disponibles
 require_once("Model/metodo_subruta_ruta.php");//sirve para asignar la subruta a la ruta
 require_once("Model/metodo_paraderos.php");//sirve para todo lo relacionado a los paraderos
 require_once("Model/metodo_subruta_paradero.php");//sirve para los relacionado a la sub ruta con paradero
 
 $datos_personales = new consulta_datos_usuarios();
 $datos_actualizar = new metodo_actualizar_datos_usuario();
 $log = new login();
 $rut = new consultas_relleno();
 $bus  = new datos_buses();
 $rutbus = new metodo_ruta_bus();
 $subrut = new metodo_sub_rutas();
 $sub_rut_ruta = new metodo_subruta_ruta();
 $para = new metodo_paraderos();
 $sub_para = new metodo_subruta_paradero();
 $datos_rutas = new metodo_datos_rutas();

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

 //////////////////////////////////////////////////////////////////// RELLENO //////////////////////////////////////////////////7
 
 $rutas = $rut->tblrutas();//para llenar las rutas
 $bus_general = $bus->bus_general();//sire para llenar los buses

 //para buscar por ruta

 if(isset($_POST["consultar_ruta"])){
  $parametro = $_POST["search_ruta"];
  if($parametro == null){
   $rutas = $rut->tblrutas();
  } else {
   $rutas = $datos_rutas->buscar_rutas($parametro);
  }
 }
 
 //////////////////////////////////////////////////////////////7 RUTAS CON BUS /////////////////////////////////////////////////

 if(isset($_POST["confirm_horario"])){
  
  $array_fecha = [];
  $array_turno = [];
  
  $bus = $_POST["bus_in"];
  $ruta = $_POST["ruta_in"];
  
  $c = 1;
  $i = 0;
  $var = 0;
  
  do{
   $array_fecha [$i] = $_POST["fecha_h".$c];
   $array_turno [$i] = $_POST["turno_h".$c];
   $c++;
   $repeti = $rutbus->repetido_bus_ruta($bus, $array_fecha[$i], $array_turno[$i]);
   if(count($repeti) > 0){
    $var++;
   }
   $i++;
  } while($i <= 6);
  
  if($var > 0){
   echo "
    <script>
     alert('No se puede generar el cronograma debido a que esta intentando repetir un dia');
    </script>
   ";
  } else {
   $a = 0;
   $b = 0;
   
   do{
    $enviar = $rutbus->insert_bus_ruta($ruta, $bus, $array_fecha[$a], $array_turno[$a]);
    if($enviar > 0){
     $b++;
    }
    $a++;
   } while($a <= 6);
   
   if($b == 7){
    echo "
     <script>
      alert('El auto-bus ha sido asignado');
      location.href = 'asignar.php';
     </script>
    ";
   } else {
    echo "
     <script>
      alert('Ha ocurrido un error inesperado, por favor intenet mas tarde');
      location.href = 'asignar.php';
     </script>
    ";
   }
  }
  
 }

/////////////////////////////////////////////////////////////subrutas con rutas //////////////////////////////////////////////////

 $subrutas_general = $subrut->sub_ruta_general();//sirve para llenar el modal de subrutas

 if(isset($_POST["anadir_subruta"])){
  $ruta = $_POST["ruta_id_sub"]; 
  $total_subs = $sub_rut_ruta->subruta_disponible($ruta);
  
  $array_sub = [];
  $cantidad = count($total_subs);//la cantidada de sub_rutas
  $b = 0;
  $a = 0;
  $c = 0;
 
  for($i = 1; $i <= $cantidad; $i++){
   if(isset($_POST["agregar_sub".$a]) != null){//verifico cuales subrutas fueron escogidas
    $array_sub [$b] = $_POST["agregar_sub".$a];//guardo en un arreglo las sub_rutas escogidas
    $b++;
    $c++;
   }
   $a++;
  }
  
  $f = 0;
  $g = 0;
   
  do{
   $envia_subs = $sub_rut_ruta->inser_subruta_ruta($ruta, $array_sub[$f]);//se envian los datos
   if($envia_subs > 0){
    $g++;//se incrementa encaso de que el registro sea exitoso 
   }
   $f++;
  } while ($f < $c);
   
  if($g == $c){ //el contador de las inserciones debe ser igual al contador de las elecciones
   echo "
    <script>
     alert('Las sub-rutas han sido anadidas');
     location.href = 'asignar.php';
    </script>
   ";   
  } else {
   echo "
    <script>
     alert('Ha ocurrido un error inesperado, por favor intente mas tarde');
     location.href = 'asignar.php';
    </script>
   ";   
  }
 }
/////////////////////////////////////////7 quitar sub_ruta ///////////////////////7
 if(isset($_POST["fuera"])){
  $ruta = $_POST["ruta_dni_sub"];
  $existentes_subs = $sub_rut_ruta->subruta_de_ruta($ruta);

  $array_sub = [];
  $cantidad = count($existentes_subs);//la cantidada de sub_rutas
  $b = 0;
  $a = 0;
  $c = 0;

  for($i = 1; $i <= $cantidad; $i++){
   if(isset($_POST["quitar_sub".$a]) != null){//verifico cuales subrutas fueron escogidas
    $array_sub [$b] = $_POST["quitar_sub".$a];//guardo en un arreglo las sub_rutas escogidas
    $b++;
    $c++;
   }
   $a++;
  }

  $f = 0;
  $g = 0;
   
  do{
   $envia_subs = $sub_rut_ruta->borrar_subruta_de_ruta($ruta, $array_sub[$f]);//se envian los datos
   if($envia_subs > 0){
    $g++;//se incrementa encaso de que el registro sea exitoso 
   }
   $f++;
  } while ($f < $c);

  if($g == $c){ //el contador de las inserciones debe ser igual al contador de las elecciones
   echo "
    <script>
     alert('Las sub-rutas han sido borradas');
     location.href = 'asignar.php';
    </script>
   ";   
  } else {
   echo "
    <script>
     alert('Ha ocurrido un error inesperado, por favor intente mas tarde');
     location.href = 'asignar.php';
    </script>
   ";   
  }
 }

////////////////////////////////////////////////////////////7 subrutas con paraderos /////////////////////////////////////////////////

 $para_general = $para->paradero_general();//sirve para llamar a todos los paraderos

 if(isset($_POST['consultar_subruta'])){
  $Cod=$_POST["search_subruta"];
  if($Cod==null){
  $subrutas_general = $subrut->sub_ruta_general(); //sirve para traer todas las sub-rutas existentes
  }else{
   $subrutas_general = $subrut->subruta_especifica ($Cod); //sirve para traer todas las sub-rutas especificamentre por nombre y costo
  }
 }

 //if para borrar paraderos de sub-ruta

 if(isset($_POST["borrar_par"])){
  $subruta = $_POST["subruta_id"];
  $conteo_par = $sub_para->paradero_con_subruta($subruta);

  $array_par = [];
  $cantidad = count($conteo_par);//la cantidada de sub_rutas
  $b = 0;
  $a = 0;
  $c = 0;

  for($i = 1; $i <= $cantidad; $i++){
   if(isset($_POST["quitar_par".$a]) != null){//verifico cuales subrutas fueron escogidas
    $array_par [$b] = $_POST["quitar_par".$a];//guardo en un arreglo las sub_rutas escogidas
    $b++;
    $c++;
   }
   $a++;
  }

  $f = 0;
  $g = 0;
   
  do{
   $envia_par = $sub_para->borrar_paradero_de_subruta($subruta, $array_par[$f]);//se envian los datos
   if($envia_par > 0){
    $g++;//se incrementa encaso de que el registro sea exitoso 
   }
   $f++;
  } while ($f < $c);

  if($g == $c){ //el contador de las eliminaciones debe ser igual al contador de las elecciones
   echo "
    <script>
     alert('Los paraderos han sido borrados');
     location.href = 'asignar.php';
    </script>
   ";   
  } else {
   echo "
    <script>
     alert('Ha ocurrido un error inesperado, por favor intente mas tarde');
     location.href = 'asignar.php';
    </script>
   ";   
  }

 }

 //if para agregar paraderos a subruta

 if(isset($_POST["agregar_par"])){
  $subruta = $_POST["subruta_dni"];
  $conteo_sin = $sub_para->paradero_sin_subruta($subruta);

  $array_par = [];
  $cantidad = count($conteo_sin);//la cantidada de sub_rutas
  $b = 0;
  $a = 0;
  $c = 0;

  for($i = 1; $i <= $cantidad; $i++){
   if(isset($_POST["capturar_par".$a]) != null){//verifico cuales subrutas fueron escogidas
    $array_par [$b] = $_POST["capturar_par".$a];//guardo en un arreglo las sub_rutas escogidas 
    $b++;
    $c++;
   }
   $a++;
  }

  $f = 0;
  $g = 0;
   
  do{
   $envia_par = $sub_para->inser_paradero_subruta($subruta, $array_par[$f]);//se envian los datos
   if($envia_par > 0){
    $g++;//se incrementa encaso de que el registro sea exitoso 
   }
   $f++;
  } while ($f < $c);

  if($g == $c){ //el contador de las eliminaciones debe ser igual al contador de las elecciones
   echo "
    <script>
     alert('Los paraderos han sido asignados');
     location.href = 'asignar.php';
    </script>
   ";   
  } else {
   echo "
    <script>
     alert('Ha ocurrido un error inesperado, por favor intente mas tarde');
     location.href = 'asignar.php';
    </script>
   ";   
  }

 }

 require_once("View/Views/v_asignar.php");
?>