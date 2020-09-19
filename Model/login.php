<?php

 require_once("conexion.php");

 class login{

  //metodo para el login

  public static function logeo($correo, $clave){
  	try{
    $log = conexion::bd_bassyapp()->prepare("call login (?,?);");
    $log->bindParam(1, $correo);
    $log->bindParam(2, $clave);
    $log->execute();
    $logeo = $log->fetchAll();
  	} catch (Exception $e) {
    echo "Error de logeo $e";
  	}

  	return $logeo;
  }
 }

?>