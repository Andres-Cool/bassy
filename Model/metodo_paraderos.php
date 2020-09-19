<?php

 require_once("conexion.php");

 class metodo_paraderos {
     
  //metodo para ver todos los paraderos
  
  public static function paradero_general () {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call paradero_general;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $paraderos [] = $fila;
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $paraderos;
  }
    //metodo para consultar paradero por nombre 
 public static function consulta_paraderos($Cod){
        
  try{
   $ps=conexion::bd_bassyapp()->prepare('call paraderoConsulta(?);');
   $ps->bindParam(1,$Cod);
   $ps->execute();
   $parader = $ps->fetchAll();
  }catch(Exception $e){
   echo"error en la consulta $e";
  }
   
   return $parader;
  }
  //metodo para insertar paradero
  
  public static function insert_paradero ($nombre) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_paradero(?);");
    $ps->bindParam(1, $nombre);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
  
  //metodo para actualizar paradero
  
  public static function actu_paradero ($nombre, $id) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_paradero(?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $id);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
  
 }
