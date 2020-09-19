<?php

  require_once("Modelo/metodo_pqr.php");//sirve para manejra todo lo relacionado a los pqr
  $pqrs = new metodo_pqr();
  $p =  $_POST["id_pqrs"];
   
  if($p != null){
   $envia = $pqrs->leido_pqr("Si", $p);
   if($envia > 0){
    echo "
    <script>
     alert('actualizado');
    </script>
   ";
   } else {
   	echo "
    <script>
     alert('mal actualizado');
    </script>
   ";
   }
  } else {
  	echo "
    <script>
     alert('mal');
    </script>
   ";
  }

?>