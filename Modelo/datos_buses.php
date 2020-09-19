<?php
require_once("conexion.php");

class datos_buses
{

   //metodo para insertar buses

   public static function insert_datos_buses($placa, $marca, $modelo, $tipo, $estado)
   {
      $insertabus = false;
      try {
         $ps = conexion::bd_bassyapp()->prepare('call insertar_bus(?,?,?,?,?);');
         $ps->bindParam(1, $placa);
         $ps->bindParam(2, $marca);
         $ps->bindParam(3, $modelo);
         $ps->bindParam(4, $tipo);
         $ps->bindParam(5, $estado);

         if ($ps->execute()) {
            $insertabus = true;
            echo 'bus insertado';
         } else {
            $insertabus = false;
            echo 'bus error';
         }
      } catch (Exception $e) {
         echo "error en la insercion $e";
      }
      return $insertabus;
   }

   //metodo para consultar buses por placa

   public static function consulta_datos_buses($placa)
   {

      try {
         $ps = conexion::bd_bassyapp()->prepare('call datos_bus(?);');
         $ps->bindParam(1, $placa);
         $ps->execute();
         $bus = $ps->fetchAll();
      } catch (Exception $e) {
         echo "error en la consulta $e";
      }
      return $bus;
   }

   //metodo para consultar todos los buses

   public static function bus_general()
   {

      try {
         $ps = conexion::bd_bassyapp()->prepare("call bus_general();");
         $ps->execute();
         while ($fila = $ps->fetch()) {
            $conductor[] = $fila;
         }
      } catch (Exception $e) {
         echo "Error en consulta $e";
      }

      return $conductor;
   }


    //metodo para mostrar buses activos e inactivos
    public static function bus_activo_reparacion()
   {
      try {
         $ps = conexion::bd_bassyapp()->prepare("call activos_inactivos();");
         $ps->execute();
         while ($fila = $ps->fetch()) {
            $numero[] = $fila;
         }
      } catch (Exception $e) {
         echo "Error en consulta $e";
      }
      return $numero;
   }
   //metodo para actualizar buses

   public static function actu_buses($marca, $modelo, $tipo, $estado, $placa)
   {

      try {
         $ps = conexion::bd_bassyapp()->prepare("call actu_buses (?,?,?,?,?);");
         $ps->bindParam(1, $marca);
         $ps->bindParam(2, $modelo);
         $ps->bindParam(3, $tipo);
         $ps->bindParam(4, $estado);
         $ps->bindParam(5, $placa);
         $datos = $ps->execute() > 0;
      } catch (Exception $e) {
         echo "error en actualizar $e";
      }

      return $datos;
   }
   // consulta bus especificamente ya sea placa, tipo ,estado 
   public function Bus_especifico($Cod)
   {
      try {
         $cta = Conexion::bd_bassyapp()->prepare('call bus_especifico(?);');
         $cta->bindParam(1, $Cod);
         $cta->execute();
         $bus = $cta->fetchAll();
      } catch (Exception $e) {
         echo "error de la consulta " . $e;
      }
      return $bus;
   }
   
 // metodo para ver cuantos buses estan disponibles para asignar
 
 public static function buses_disponibles () {
  
  try{
   $ps = conexion::bd_bassyapp()->prepare("call buses_disponibles;");
   $ps->execute();
   $bus = $ps->fetchAll();
  } catch (Exception $e) {
   echo "Erro en consulta";
  }
  
  return $bus;
 }
   
}

////////////////////////////////////////////////////insertar BUSES ///////////////////////////////////////////////////////////////////////

$insersion_Buses  = new datos_buses(); // instanciar clase

//if para insertar los buses 

if (isset($_POST["placa"])) {

   $placabus  = $_POST['placa'];
   $marcabus  = $_POST['marca'];
   $modelobus = $_POST['modelo'];
   $tipobus   = $_POST['tipo'];
   $estadobus = "Activo";

   $repetido_placa = $insersion_Buses->consulta_datos_buses($placabus);
   if (count($repetido_placa) > 0) {
      echo json_encode('error!!');
   } else {
      $envia = $insersion_Buses->insert_datos_buses($placabus, $marcabus, $modelobus, $tipobus, $estadobus);
      if ($envia > 0) {
         echo json_encode('listo papa');
      }
   }
}
