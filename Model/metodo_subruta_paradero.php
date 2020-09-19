<?php

 require_once("conexion.php");
 
 class metodo_subruta_paradero {
     
  //metodo para ver cuantos paraderos existen
  
  public static function cantidad_paraderos () {
   try{
    $ps = conexion::bd_bassyapp()->prepare("call cantidad_paraderos;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $paraderos [] = $fila;
    }
   } catch (Exception $e) {
    echo "Error en consukta $e";
   }
   
   return $paraderos;
  }
     
  //metodo para ver que no se repita el paradero en la sub_ruta
  
  public static function repetido_paradero ($sub, $para){
   try{
    $ps = conexion::bd_bassyapp()->prepare("call repetido_subruta_paradero(?,?);");
    $ps->bindParam(1, $sub);
    $ps->bindParam(2, $para);
    $ps->execute();
    $rep = $ps->fetchAll();
   } catch (Exception $e) {
    echo "error en consulta $e";
   }
   
   return $rep;
  }
    
  //metodo para insertar paradero a sub-ruta
  
  public static function inser_paradero_subruta ($subruta, $para) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_sub_ruta_paraadero(?,?);");
    $ps->bindParam(1, $subruta);
    $ps->bindParam(2, $para);
    $in = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "error en consulta $e";
   }   
   
   return $in;
  }  
  
  //metodo para ver los paraderos que estan asignados a una subruta

  public static function paradero_con_subruta($sub){

   try{
    $ps = conexion::bd_bassyapp()->prepare("call paradero_de_subruta(?);");
    $ps->bindParam(1, $sub);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error $e";
   }

   return $datos;
  }

  //metodo para ver los paraderos que no estan asignados a una subruta

  public static function paradero_sin_subruta($sub){

   try{
    $ps = conexion::bd_bassyapp()->prepare("call paradero_no_subruta(?);");
    $ps->bindParam(1, $sub);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error $e";
   }

   return $datos;
  }

  //metodo para borrar paraderos asignados a una sub_ruta

  public static function borrar_paradero_de_subruta ($subruta, $para) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call borrar_paradero_de_subruta(?,?);");
    $ps->bindParam(1, $subruta);
    $ps->bindParam(2, $para);
    $delete = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "error en consulta $e";
   }   
   
   return $delete;
  }  

 }
