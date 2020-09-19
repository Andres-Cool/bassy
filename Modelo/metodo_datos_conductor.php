<?php
 require_once("conexion.php");
 
 class metodo_datos_conductor {

  //metodo para consultar conductor por cc
  
  public static function conductor_cc ($cc){

   try{
    $ps = conexion::bd_bassyapp()->prepare("call conductor_cc (?);");
    $ps->bindParam(1, $cc);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $datos;
  }
// metodo consulta conductor por licencia y cedula 
public static function conductor_especifico ($cod){

   try{
    $ps = conexion::bd_bassyapp()->prepare("call consultconductor(?);");
    $ps->bindParam(1, $cod);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $datos;
  }
     
  //metodo para insertar conductor
     
  public static function insert_conductor ($cedula, $nombre, $apellido, $bus, $licencia, $certificado, $telefono, $edad) {

   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_conductor (?,?,?,?,?,?,?,?);");
    $ps->bindParam(1, $cedula);
    $ps->bindParam(2, $nombre);
    $ps->bindParam(3, $apellido);
    $ps->bindParam(4, $bus);
    $ps->bindParam(5, $licencia);
    $ps->bindParam(6, $certificado);
    $ps->bindParam(7, $telefono);
    $ps->bindParam(8, $edad);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
     
  //metodo para mostrar todos los condcutores
  
  public static function conductor_general () {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call conductores_general;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $conductores [] = $fila;
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $conductores;
  }
    
  //metodo para actualizar conductores
  
  public static function actu_conductor ($nombre, $apellido, $bus, $licencia, $certificado, $telefono, $edad, $cedula) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call actu_conductors (?,?,?,?,?,?,?,?);");
    $ps->bindParam(1, $nombre);
    $ps->bindParam(2, $apellido);
    $ps->bindParam(3, $bus);
    $ps->bindParam(4, $licencia);
    $ps->bindParam(5, $certificado);
    $ps->bindParam(6, $telefono);
    $ps->bindParam(7, $edad);
    $ps->bindParam(8, $cedula);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en actualizar $e";
   }
   
   return $datos;
  }
  
 }

?>