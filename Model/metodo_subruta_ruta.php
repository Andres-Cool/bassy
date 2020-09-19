<?php

 require_once("conexion.php");
 
 class metodo_subruta_ruta{
  
  //metodo para insertar subruta a ruta
  
  public static function inser_subruta_ruta ($ruta, $sub) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_ruta_sub_ruta(?,?);");
    $ps->bindParam(1, $ruta);
    $ps->bindParam(2, $sub);
    $in = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "error en consulta $e";
   }   
   
   return $in;
  }
  
  //metodo para ver las subrutas de la ruta

  public static function subruta_de_ruta ($ruta){
    
   try{
    $ps = conexion::bd_bassyapp()->prepare("call subrutas_de_ruta(?);");
    $ps->bindParam(1, $ruta);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
  
   return $datos;
  }

  //metodo para ver las subrutas disponibles

  public static function subruta_disponible ($ruta){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call subruta_no_ruta(?);");
    $ps->bindParam(1, $ruta);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }

   return $datos;
  }

 //metodo para eliminar subruta de una ruta

  public static function borrar_subruta_de_ruta ($ruta, $sub) {
   $datos = false;

   try{
    $ps = conexion::bd_bassyapp()->prepare("call eliminar_subruta_de_ruta(?,?);");
    $ps->bindParam(1, $ruta);
    $ps->bindParam(2, $sub);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }

   return $datos;
  }

 }
