<?php

 require_once("conexion.php");

 class metodo_pqr {
     
  //metodo para insertar pqr
  
  public static function insert_pqr ($pasajero, $administrador, $asunto, $contenido, $tipo, $respuesta, $fecha_respuesta, $estado, $leido, $comprobante) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_pqr (?,?,?,?,?,?,?,?,?,?);");
    $ps->bindParam(1, $pasajero);
    $ps->bindParam(2, $administrador);
    $ps->bindParam(3, $asunto);
    $ps->bindParam(4, $contenido);
    $ps->bindParam(5, $tipo);
    $ps->bindParam(6, $respuesta);
    $ps->bindParam(7, $fecha_respuesta);
    $ps->bindParam(8, $estado);
    $ps->bindParam(9, $leido);
    $ps->bindParam(10, $comprobante);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en insercion $e";
   }
   
   return $datos;
  }
  
  //metodo para ver los pqr que tiene el pasajero
  
  public static function pqr_pasajero ($pasajero) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqr_pasajero (?);");
    $ps->bindParam(1, $pasajero);
    $ps->execute();
    $pqrs = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $pqrs;
  }
  
  //metodo para ver todos los pqr (minimo 10)
  
  public static function pqr_general () {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqr_general;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $pqr [] = $fila;
    }
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $pqr;
  }
  
  //metodo para la actualizacion (respuesta) del pqr
  
  public static function respuesta_pqr ($admin, $respuesta, $estado, $id) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call respuesta_pqr (?,?,?,?);");
    $ps->bindParam(1, $admin);
    $ps->bindParam(2, $respuesta);
    $ps->bindParam(3, $estado);
    $ps->bindParam(4, $id);
    $datos = $ps->execute() > 0;
   } catch (Exception $e) {
    echo "Error en acualizacion $e";
   }
   
   return $datos;
  }
  // metodo para consultar por fecha y tipo
   
  public static function pqr_especifico ($Cod) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqrespecifico (?);");
    $ps->bindParam(1, $Cod);
    $ps->execute();
    $pqr = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta $e";
   }
   
   return $pqr;
  }
  
  //metodo para buscar los pqr de un usuario
  
  public static function pqr_de_usuario($pas, $para){
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqr_de_usuario(?,?);");
    $ps->bindParam(1, $pas);
    $ps->bindParam(2, $para);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "error en consulta $e";
   }
   
   return $datos;
  }
  
  //metodo para ver cuantos pqr faltan por responder
  
  public static function faltan_por_responder () {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqr_por_responder;");
    $ps->execute();
    while($fila = $ps->fetch()){
     $pqr [] = $fila;
    }
   } catch (Exception $e) {
    echo "error en consulta $e"; 
   }
   
   return $pqr;
  }
  
  //metodo para ver cuantos pqr faltan por leer
  
  public static function pqr_por_leer ($pasajero) {
   
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pqr_por_leer(?);");
    $ps->bindParam(1, $pasajero);
    $ps->execute();
    $pqr = $ps->fetchAll();
   } catch (Exception $e) {
    echo "error en consulta $e"; 
   }
   
   return $pqr;
  }
  
  //metodo para porder maracar comoelido el pqr
  
 public static function leido_pqr($leido, $id){
  $datos = false;

    try{
     $ps = conexion::bd_bassyapp()->prepare("call leido_pqr(?,?);");
     $ps->bindParam(1, $leido);
     $ps->bindParam(2, $id);
     $datos = $ps->execute() > 0;
    } catch (Exception $e) {
     echo "error en la actualizacion $e"; 
    }

   return $datos;
  }
  
 }

?>