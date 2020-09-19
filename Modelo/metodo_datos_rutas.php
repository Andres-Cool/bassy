<?php

 require_once("conexion.php");
 
 class metodo_datos_rutas {
  
  //metodo para insertar rutas
  public static function insert_rutas($id, $admin, $nombre, $salida, $llegada, $costo, $tiempo, $imagen, $mapa){
  
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_Rutas (?,?,?,?,?,?,?,?,?);");
    $ps->bindParam(1, $id);
    $ps->bindParam(2, $admin);
    $ps->bindParam(3, $nombre);
    $ps->bindParam(4, $salida);
    $ps->bindParam(5, $llegada);
    $ps->bindParam(6, $costo);
    $ps->bindParam(7, $tiempo);
    $ps->bindParam(8, $imagen);
    $ps->bindParam(9, $mapa);
    $datos = $ps->execute();
   } catch (Exception $e) {
    echo "rror en insersion";
   }
  
   return $datos;
  } 
  
  //metodo para consultar rutas por id
  
  public static function consulta_rutas ($id){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call consulta_rutas_llave (?);");
    $ps->bindParam(1, $id);
    $ps->execute();
    $rutas = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $rutas;
  }
  

  //metodo para actualizar rutas
  
  public static function actu_ruta ($admin, $nombre, $salida, $llegada, $costo, $tiempo, $imagen, $mapa, $id) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_ruta (?,?,?,?,?,?,?,?,?);");
    $ps->bindParam(1, $admin);
    $ps->bindParam(2, $nombre);
    $ps->bindParam(3, $salida);
    $ps->bindParam(4, $llegada);
    $ps->bindParam(5, $costo);
    $ps->bindParam(6, $tiempo);
    $ps->bindParam(7, $imagen);
    $ps->bindParam(8, $mapa);
    $ps->bindParam(9, $id);
    $datos = $ps->execute();
   } catch (Exception $e) {
    echo "Error en actualizar $e";
   }
   
   return $datos;
  }
  
  //metodo para buscar rutas
  
  public static function buscar_rutas ($id){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call consultarrutas (?);");
    $ps->bindParam(1, $id);
    $ps->execute();
    $rutas = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $rutas;
  }

 }
