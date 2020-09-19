<?php

 require_once("conexion.php");

 class consulta_datos_usuarios{

  //metodo para ver los datos del usuario

  public static function usuario($email){
   try{
    $ps = conexion::bd_bassyapp()->prepare("call datos_usuario (?);");
    $ps->bindParam(1, $email);
    $ps->execute();
    $usuario = $ps->fetchAll();
   } catch (Exception $e){
    echo "Error en la consulta $e";
   }

   return $usuario;
  }

  //metodo para ver los datos del pasajero

  public static function pasajero($email){
   try{
    $ps = conexion::bd_bassyapp()->prepare("call datos_pasajero (?);");
    $ps->bindParam(1, $email);
    $ps->execute();
    $pasajero = $ps->fetchAll();
   } catch (Exception $e){
    echo "Error en la consulta $e";
   }

   return $pasajero;
  }

  //metodo para ver los datos del administrador

  public static function administrador($email){
   try{
    $ps = conexion::bd_bassyapp()->prepare("call datos_administrador (?);");
    $ps->bindParam(1, $email);
    $ps->execute();
    $administrador = $ps->fetchAll();
   } catch (Exception $e){
    echo "Error en la consulta $e";
   }

   return $administrador;
  }
  
  //metodo para ver los datos del administrador con su usuario
  
  public static function general_admins (){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call consulta_admin_usu;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $admins [] = $fila; 
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $admins;
  }
  
  //metodo para ver los datos del pasajero con su usuario
  
  public static function general_pasajeros (){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call consulta_pasajero_usu;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $pasajeros [] = $fila; 
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $pasajeros;
  }

  public static function buscar_cliente($parametro){
      try{
          $ps = conexion::bd_bassyapp()->prepare("call buscar_pasajero(?);");
          $ps->bindParam(1, $parametro);
          $ps->execute();
          $datos = $ps->fetchAll();
      }catch (Exception $e){
          echo "Error en el buscador $e";
      }
      return $datos;
  }
  
 }
