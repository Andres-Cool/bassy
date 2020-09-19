<?php

require_once("conexion.php");

class consultas_buses{
 //consulta de buses activos y en reparacion}

 public static function bus_activo_reparacion()
 {
    try {
       $ps = conexion::bd_bassyapp()->prepare("call activos_inactivos();");
       $ps->execute();
       while ($fila = $ps->fetch()) {
          $buses[] = $fila;
       }
    } catch (Exception $e) {
       echo "Error en consulta $e";
    }
    return $buses;
 }

// consulta para ver años disponibles
public static function fechas_disponibles() {
    try{
        $ps = conexion::bd_bassyapp()->prepare("call fechas_disponibles;");
        $ps->execute();
        while($fila = $ps->fetch()){
            $fechas[] = $fila;
        }
    }catch (Exception $e){
        echo "Error en la consulta $e";
    }
    return $fechas;
}

//metodo para ver id, ruta, y puntaje avg
public function promedio_puntajes($Cod)
{
   try {
      $rut = Conexion::bd_bassyapp()->prepare('call promedio_rutas(?);');
      $rut->bindParam(1, $Cod);
      $rut->execute();
      $promedio = $rut->fetchAll();
   } catch (Exception $e) {
      echo "error de la consulta " . $e;
   }
   return $promedio;
}

 //metodo para ver buses de las rutas
public static function buses_de_ruta(){
    try{
        $ps = conexion::bd_bassyapp()->prepare("call buses_de_ruta;");
        $ps->execute();
        while ($fila = $ps->fetch()) {
            $bdr[] = $fila;
        }
    }catch(Exception $e){
        echo "Error en la consulta $e";
    }
    return $bdr;
}

}

?>