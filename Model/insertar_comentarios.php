<?php
 require_once ("conexion.php");

 class insertar_comentarios{
 
  //metodo insertar comentarios
  public static function comentarios_y_respuestas($idPasajero, $idRuta, $puntaje ,$comentario) {
           
   try{
    $ps = conexion::bd_bassyapp()->prepare("call insertar_calificacion(?,?,?,?);");
    $ps->bindParam(1, $idPasajero);
    $ps->bindParam(2, $idRuta);
    $ps->bindParam(3, $puntaje);
    $ps->bindParam(4, $comentario);
    $dat = $ps->execute();
   } catch (Exception $e) {
    echo "Error al insertar comentario $e";
   }
   
   return $dat;
  }

 //metodo para ver si el usuario ya califico
 
  public static function ver_si_califico ($ruta, $pasajero) {
 
   try{
    $ps = conexion::bd_bassyapp()->prepare("call pasajero_tiene_calificacion(?,?);");
    $ps->bindParam(1, $ruta);
    $ps->bindParam(2, $pasajero);
    $ps->execute();
    $datos = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en $e";
   }
   
   return $datos;
  }
        
 }
?>