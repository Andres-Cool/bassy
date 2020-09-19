<?php

require_once("conexion.php");

 class metodo_insertar_perfil{
 
  //metodo para insertar usuario

  public static function usuario($correo, $clave, $rol, $estado, $foto){
   $datos = false;
   $dat = 0;
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_usuario (?,?,?,?,?)");
    $ps->bindParam(1, $correo);
    $ps->bindParam(2, $clave);
    $ps->bindParam(3, $rol);
    $ps->bindParam(4, $estado);
    $ps->bindParam(5, $foto);
    $dat = $ps->execute();
    $datos = $dat > 0;
   } catch (Exception $e) {
    echo "Error en la insercion $e";
   }

   return $datos;
  }

  //metodo para insertar pasajero

  public static function pasajero($correo, $nombre, $apellido){
   $datos = false;
   $dat = 0;
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_pasajero (?,?,?)");
    $ps->bindParam(1, $correo);
    $ps->bindParam(2, $nombre);
    $ps->bindParam(3, $apellido);
    $dat = $ps->execute();
    $datos = $dat > 0;
   } catch (Exception $e) {
    echo "Error en la insercion $e";
   }

   return $datos;
  }
  
  //metodo para insertar administrador
  
  public static function administrador ($correo, $nombre, $apellido, $telefono) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_Administrador (?,?,?,?);");
    $ps->bindParam(1, $correo);
    $ps->bindParam(2, $nombre);
    $ps->bindParam(3, $apellido);
    $ps->bindParam(4, $telefono);
    $datos = $ps->execute();
   } catch (Exception $e) {
    echo "Error en insersion $e";
   }
   
   return $datos;
  }

 }

?>