<?php
require_once("Model/consulta_datos_usuarios.php");//se llama al modelo donde estan las consultas de los usuarios
require_once("Model/metodo_actualizar_datos_usuario.php");// se llama al modelo para poder actualizar los datos del usuario.
require_once("Model/login.php");//se llama por mo tivo de que la contrasena corresponda al usuario
require_once("Model/datos_buses.php");//modelo ,consulta,inserta,actualiza Buses.
require_once("Model/metodo_informes.php");//modelo ,consulta,inserta,actualiza Buses.
require_once("fpdf/clasepdf.php");

$datos_personales = new consulta_datos_usuarios();
$datos_actualizar = new metodo_actualizar_datos_usuario();
$metod  = new consultas_buses();
$log = new login();
$rutas = $metod->fechas_disponibles();

 
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

///////////////////////////////variables de sesion/////////////////////////////////////////
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




if (isset($_POST['pdfBus'])) {
    // Creacion del objeto de la clase heredada
    $bus_general = $insersion_Buses->bus_general();
    $bus_activo_reparacion = $insersion_Buses->bus_activo_reparacion();
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(73, 174, 225);
    $pdf->Cell(20);
    $pdf->Cell(55, 10, 'Informe de buses registrados en el sistema a peticion del usuario:', 0, 0, 'L'); //en c es l izquierda, r derecha y c centrado
    $pdf->Ln(15);
    $pdf->Cell(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'PLACA', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'MARCA', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'MODELO', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'TIPO', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'ESTADO', 1, 0, 'C', true);
    $pdf->Ln(10);
    foreach ($bus_general as $f) {
      $pdf->SetFont('Arial', '', 11);
      $pdf->Cell(10);
      $pdf->Cell(35, 10, $f[0], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[1], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[2], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[3], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[4], 1, 0, 'C', 0);
      $pdf->Ln(10);
    }
    $pdf->Ln(20);
    $pdf->Cell(30);
    $pdf->Cell(35, 10, 'Buses Activos', 1, 0, 'C', 0);
    foreach ($bus_activo_reparacion as $a) {
      $pdf->Cell(15, 10, $a[0], 1, 0, 'C', 0);
    }
  
    $pdf->Cell(20);
    $pdf->Cell(45, 10, 'Buses en Reparacion', 1, 0, 'C', 0);
    foreach ($bus_activo_reparacion as $a) {
      $pdf->Cell(15, 10, $a[1], 1, 0, 'C', 0);
    }
    foreach($datos_administrador as $adm){
      $pdf->Ln(30);
      $pdf->Cell(20, 10, 'Nombre: '.$adm[1].' '.$adm[2], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(20, 10, 'Correo: '.$adm[0], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(20, 10, 'Telefono: '.$adm[3], 0,0 ,'L',0);
      $pdf->Ln(20);
      $pdf->Cell(0,0, '________________________',0,0,'L',0);
      $pdf->Ln();
      $pdf->Cell(20, 10, 'Gerencia Administrativa');
    }
    $pdf->Output('reporte_buses.pdf', 'I');
  }



  if (isset($_POST['pdfRuta'])) {
    // Creacion del objeto de la clase heredada
    $rutas = $metod->fechas_disponibles();

    $anio = $_POST["year_promedio"];
    $mes = $_POST["mes_promedio"];
    $fechaF = $anio."-".$mes;
    $rutbus = $metod->promedio_puntajes($fechaF);


    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(73, 174, 225);
    $pdf->Cell(20);
    $pdf->Cell(55, 10, 'Este informe muestra informacion relacionada con los puntajes promedio de cada ruta.', 0, 0, 'L'); //en c es l izquierda, r derecha y c centrado
    $pdf->Ln(15);
    $pdf->Cell(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'CODIGO', 1, 0, 'C', true);
    $pdf->Cell(75, 10, 'NOMBRE', 1, 0, 'C', true);
    $pdf->Cell(60, 10, 'PROMEDIO', 1, 0, 'C', true);
    $pdf->Ln(10);
    foreach ($rutbus as $rb ){
      $pdf->SetFont('Arial', '', 11);
      $pdf->Cell(10);
      $pdf->Cell(40, 10, $rb[0], 1, 0, 'C', 0);
      $pdf->Cell(75, 10, $rb[1], 1, 0, 'C', 0);
      $pdf->Cell(60, 10, $rb[2], 1, 0, 'C', 0);
      $pdf->Ln(10);
    }
    foreach($datos_administrador as $adm){
      $pdf->Ln(30);
      $pdf->Cell(20, 10, 'Nombre: '.$adm[1].' '.$adm[2], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(20, 10, 'Correo: '.$adm[0], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(20, 10, 'Telefono: '.$adm[3], 0,0 ,'L',0);
      $pdf->Ln(20);
      $pdf->Cell(0,0, '________________________',0,0,'L',0);
      $pdf->Ln();
      $pdf->Cell(20, 10, 'Gerencia Administrativa');
    }
    $pdf->Output('reporte_Calificacion.pdf', 'I');
  }
  
  if (isset($_POST['pdfOtro'])) {
    // Creacion del objeto de la clase heredada
    $bus_ruta = $metod->buses_de_ruta();
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'Letter');
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(73, 174, 225);
    $pdf->Cell(20);
    $pdf->Cell(55, 10, 'Este informe contiene informacion relacionada con las rutas y los buses asignados:', 0, 0, 'L'); //en c es l izquierda, r derecha y c centrado
    $pdf->Ln(15);
    $pdf->Cell(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(35, 10, 'CODIGO', 1, 0, 'C', true);
    $pdf->Cell(70, 10, 'NOMBRE', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'BUS', 1, 0, 'C', true);
    $pdf->Cell(35, 10, 'CONDUCTOR', 1, 0, 'C', true);
    $pdf->Ln(10);
    foreach ($bus_ruta as $f) {
      $pdf->SetFont('Arial', '', 11);
      $pdf->Cell(10);
      $pdf->Cell(35, 10, $f[0], 1, 0, 'C', 0);
      $pdf->Cell(70, 10, $f[1], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[2], 1, 0, 'C', 0);
      $pdf->Cell(35, 10, $f[3], 1, 0, 'C', 0);
      $pdf->Ln(10);
    }
    foreach($datos_administrador as $adm){
      $pdf->Ln(20);
      $pdf->Cell(35, 10, 'Nombre: '.$adm[1].' '.$adm[2], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(35, 10, 'Correo: '.$adm[0], 0,0 ,'L',0);
      $pdf->Ln(5);
      $pdf->Cell(35, 10, 'Telefono: '.$adm[3], 0,0 ,'L',0);
      $pdf->Ln(20);
      $pdf->Cell(35, 10, '________________________',0,0,'L',0);
      $pdf->Ln();
      $pdf->Cell(35, 10, 'Gerencia Administrativa');
    }
    $pdf->Output('reporte_bus_ruta.pdf', 'I');
  }

  require_once("View/Views/v_informes.php");

?>