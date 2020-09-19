<?php

 require_once("conexion.php");
  
 class metodo_actualizar_datos_usuario{

  //metodo para actualizar datos del administrador
  
  public static function actu_datos_administrador($nombre, $apellido, $telefono, $foto, $email){
   $datos = False;
   $dat = 0;

   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_admin (?,?,?,?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $apellido);
    $ps->bindParam(3, $telefono);
    $ps->bindParam(4, $foto);
    $ps->bindParam(5, $email);
    $dat = $ps->execute();
    $datos = $dat > 0;
   } catch (Exception $e) {
    echo "Error en insertar $e";
   }

   return $datos;
  }
  
  //metodo para actualizar datos del pasajero
  
  public static function actu_datos_pasajero($nombre, $apellido, $foto, $correo){
   $datos = False;
   $dat = 0;
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_pasajero(?,?,?,?)");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $apellido);
    $ps->bindParam(3, $foto);
    $ps->bindParam(4, $correo);
    $dat = $ps->execute();
    $datos = $dat > 0;
   } catch (Exception $e) {
    echo "Error en actualizar $e";
   }
   
   return $datos;
  }
  
  //metodo para actualizar la contrasena
  
  public static function actu_contrasena ($clave, $correo) {
   $datos = False;
   $dat = 0;
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_clave (?,?);");
    $ps->bindParam(1, $clave);
    $ps->bindParam(2, $correo);
    $dat = $ps->execute();
    $datos = $dat > 0;
   } catch (Exception $e) {
    echo "Error en la consulta $e";
   }
   
   return $datos;
  }

  //metodo para actualizar a los administradores
  
  public static function actu_administradores($nombre, $apellido, $telefono, $rol, $estado, $correo){
   $datos = False;

   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_admins (?,?,?,?,?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $apellido);
    $ps->bindParam(3, $telefono);
    $ps->bindParam(4, $rol);
    $ps->bindParam(5, $estado);
    $ps->bindParam(6, $correo);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en actualizar $e";
   }

   return $datos;
  }

  //metodo para actualizar a los pasajeros
  
  public static function actu_pasajeros($nombre, $apellido, $rol, $estado, $correo){
   $datos = False;

   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_pasajeros (?,?,?,?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $apellido);
    $ps->bindParam(3, $rol);
    $ps->bindParam(4, $estado);
    $ps->bindParam(5, $correo);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en actualizar $e";
   }

   return $datos;
  }

 }
