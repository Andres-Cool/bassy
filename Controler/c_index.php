<?php
 require_once("Model/consultas_relleno.php");
 require_once("Model/metodo_insertar_perfil.php");
 require_once("Model/consulta_datos_usuarios.php");
 require_once("Model/insertar_comentarios.php");
 
 $consulta = new consultas_relleno();
 $insertar = new metodo_insertar_perfil();
 $repetido = new consulta_datos_usuarios();

 $rutas = $consulta->tblrutas();

 $nombre = $_POST["nombre"];
 $clave = $_POST["contrasena"];
 echo('nombre '.$correo);
 echo('clave '.$clave);

//  if(isset($_POST["registrar"])){
//   $correo = $_POST["mail"];
//   $clave = $_POST["contrasena"];
//   $rol = "Pasajero";
//   $estado = "Activo";
//   $foto = $_FILES["foto"]["name"];
//   $tipo = $_FILES["foto"]["type"]; 
//   $tamano = $_FILES["foto"]["size"];
//   $nombre = $_POST["nombre"];
//   $apellido = $_POST["apellido"]; 
//   $envia = $repetido->usuario($correo);
//   if(count($envia) > 0){
//    echo "
//     <script>
//      alert('El correo ya esta registrado');
//     </script>
//    "; 
//   } else {
//    if($foto != null){
//     if($tipo == "image/jpeg" || $tipo == "image/png"){
//      if($tamano <= 1000000){
//       $hoy = date("dmy");
//       $foto = $hoy."_".$correo."_".$foto;
//       $carpeta_destino = $_SERVER["DOCUMENT_ROOT"]."/bassy/View/img/imgUser/";
//       $registra_usu = $insertar->usuario($correo, $clave, $rol, $estado, $foto);
//       if($registra_usu > 0){
//        move_uploaded_file($_FILES["foto"]["tmp_name"], $carpeta_destino.$foto);
//        $registra_pas = $insertar->pasajero($correo, $nombre, $apellido);
//        if($registra_pas > 0){
//         echo "
//          <script>
//           alert('Bienvenido a nuestra familia');
//          </script>
//         ";
//        }
//       }
//      } else {
//     	 echo "
//        <script>
//         alert('imagen demasiado pesada');
//        </script>
//       ";
//      }
//     } else {
//    	 echo "
//       <script>
//        alert('Extencion incorrecta');
//       </script>
//      ";
//     }
//    } else {
       
//     $asunto = "Binevenido a bassy"; 
//     $mensaje = "Bienvenido " . $nombre . " a bassy.";
//     $header = 'From: servicio@buscoment.click' . "\r\n" . 'Reply-To: servicio@buscoment.click' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
      
//     $foto = "pas_defecto.png";
//     $registra_usu = $insertar->usuario($correo, $clave, $rol, $estado, $foto);
//     if($registra_usu > 0){
//      $registra_pas = $insertar->pasajero($correo, $nombre, $apellido);
//      if($registra_pas > 0){
//       if(mail($correo, $asunto, $mensaje, $header)){
//        echo "
//         <script>
//          alert('Bienvenido a nuestra familia');
//         </script>
//        ";
//       } else {
//        echo "
//         <script>
//          alert('Error al registrarse. Por favor verifique su correo');
//         </script>
//        ";
//       }
//      }
//     }
//    }
//   }
//  }

 require_once("View/Views/principal.php");
?>