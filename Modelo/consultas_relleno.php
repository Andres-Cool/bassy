<?php

require_once("conexion.php");

class consultas_relleno
{

  //consulta para ver los datos de las rutas

  public static function tblrutas()
  {
    try {
      $ps = conexion::bd_bassyapp()->prepare("call consulta_rutas;");
      $ps->execute();
      while ($fila = $ps->fetch()) {
        $rutas[] = $fila;
      }
    } catch (Exception $e) {
      echo "Error en la consulta $e";
    }

    return $rutas;
  }

  //consulta para ver los titulos de acordeon

  public static function titulo_acordeon($dni)
  {
    try {
      $ps = conexion::bd_bassyapp()->prepare("call titulo_acordeon(?);");
      $ps->bindParam(1, $dni);
      $ps->execute();
      $titulo = $ps->fetchAll();
    } catch (Exception $e) {
      echo "Error en la consulta $e";
    }

    return $titulo;
  }

  //consulta para ver los paraderos del acordeon

  public static function contenido_acordeon($dni)
  {
    try {
      $ps = conexion::bd_bassyapp()->prepare("call contenido_acordeon(?);");
      $ps->bindParam(1, $dni);
      $ps->execute();
      $titulo = $ps->fetchAll();
    } catch (Exception $e) {
      echo "Error en la consulta $e";
    }

    return $titulo;
  }

  //Consultas para mostrar comentarios de la ruta

  public static function comentarios_de_ruta($ruta) {
   try {
    $ps = conexion::bd_bassyapp()->prepare("call comentarios_de_ruta(?);");
    $ps->bindParam(1, $ruta);
    $ps->execute();
    $comentarios = $ps->fetchAll();
   } catch (Exception $e) {
    echo "Error en consulta tabla comentarios  " . $e;
   }
   
   return $comentarios;
  }

  public static function comentarios()
  {
    try {
      $ps = conexion::bd_bassyapp()->prepare("call todos_comentarios();");
      $ps->execute();
      while ($fila = $ps->fetch()) {
        $comentarios[] = $fila;
      }
    } catch (Exception $e) {
      echo "Error en la consulta comentarios  " . $e;
    }
    return $comentarios;
  }


  // public static function respuesta_comentarios(){
  //   try{
  //     $ps = conexion::bd_bassyapp()->prepare("call todas_respuestas();");
  //     $ps -> execute();
  //     while ($fila = $ps->fetch()) {
  //       $respuestas [] = $fila;
  //     }
  //   } catch (Exception $e) {
  //     echo "Error en la consulta respuestas  ".$e;
  //   }
  //   return $respuestas;
  // }

}
