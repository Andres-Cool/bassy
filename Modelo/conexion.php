<?php

 class conexion{

  public static function bd_bassyapp(){
   try{
    $cnn = new PDO("mysql:host=localhost;dbname=buscomen_bassyapp_java", "root", "");
    $cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   } catch (Exception $e){
    die("Error en la conexion ".$e->GetMessage());
    echo "Linea de error " . $e->getLine();
   }
   return $cnn;
  }  
 }
 conexion::bd_bassyapp();

?>