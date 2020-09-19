<?php

 require_once("conexion.php");
 
 class metodo_ruta_bus {
     
  //metodo pra ver que no se repitan la ruta con el bus
  
  public static function repetido_bus_ruta ($placa, $fecha, $turno) {
      
   try{
    $ps = conexion::bd_bassyapp()->prepare("call repetido_bus_ruta(?,?,?);");
    $ps->bindParam(1, $placa);
    $ps->bindParam(2, $fecha);
    $ps->bindParam(3, $turno);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $datos;
  }
  
  //metodo para insertar ruta_bus
  
  public static function insert_bus_ruta ($ruta, $bus, $fecha, $turno){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_bus_ruta(?,?,?,?);");  
    $ps->bindParam(1, $ruta);
    $ps->bindParam(2, $bus);
    $ps->bindParam(3, $fecha);
    $ps->bindParam(4, $turno);
    $datos = $ps->execute();
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
  
 }
