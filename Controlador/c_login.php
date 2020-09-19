<?php
 require_once("../Model/login.php");
 require_once("../Model/consulta_datos_usuarios.php");

 $log = new login();
 $consulta = new consulta_datos_usuarios();

 if(isset($_POST["ingresar"])){
  $correo = $_POST["email"];
  $clave = $_POST["contrasena"];
  $envia_usu = $log->logeo($correo, $clave); //se envian los datos del login al metooo
  if(count($envia_usu) > 0){
   foreach($envia_usu as $f_usu){ //se recorre los datos que trae el login
    if($f_usu[3] == "Activo" && $f_usu[2] == "Administrador"){//se comprueba el estado y el rol
     session_start();
     $_SESSION["llave_admin"] = $f_usu[0]; 
     header("location:../admin.php");
    } else {
     if($f_usu[3] == "Activo" && $f_usu[2] == "Pasajero"){
      session_start();
      $_SESSION["llave_pasajero"] = $f_usu[0]; 
      header("location:../user.php"); 
     } else {
      echo "
       <script>
         alert('Su usuario se encuentra suspendido, por favor contactese con el administrador');
         self.location = '../index.php';
       </script>
      ";
     }
    }
   }
  } else {
  	echo "
    <script>
     alert('Correo y/o contraseña invalidos');
     self.location = '../index.php';
    </script>
   ";
  }
 }

 if(isset($_POST["cerrar"])){
 session_start();
 if($_SESSION){
  session_destroy();
  echo "
   <script>
    alert('sesion cerrada');
    self.location = '../index.php';
   </script>
  ";
 }
}

?>