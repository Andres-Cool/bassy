<?php

 require_once("conexion.php");

 class metodo_sub_rutas {
     
  //metodo para ver todas las sub_rutas
  
  public static function sub_ruta_general () {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call sub_ruta_general;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $subs [] = $fila;
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $subs;
  }
   // metodo consulta especifica sub rutas
     public static function subruta_especifica ($Cod) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call subruta_especifica(?);");
    $ps->bindParam(1, $Cod);
    $ps->execute();
   $subruta = $ps->fetchAll();
  }catch(Exception $e){
   echo"error en la consulta $e";
  }
   return $subruta;
  }
   
   
  //metodo para insertar sub-rutas
  
  public static function insert_sub_ruta ($nombre, $costo) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_sub_ruta(?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $costo);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
 
  //metodo para acualizar las sub-rutas
  
  public static function actu_sub_rutas ($nombre, $costo, $id) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_sub_ruta(?,?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $costo);
    $ps->bindParam(3, $id);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en actualizacion $e";
   }
      
   return $datos;
  }
 
 }
