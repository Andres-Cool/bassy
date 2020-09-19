$(document).ready(function(){
 $(".deci").click(function(){
  var posicion = $(".deci").index(this);
  var dni = $(".llave_pqr").eq(posicion);
  var elec = $(".deci");
  val_dni = dni.val();
  val_elec = elec.val();
  
  alert('respuesta: ' + val_elec + ' llave: ' + val_dni);
 
 $.ajax({
   type: "POST",
   url: "prueba_pqr.php",
   data:{id_pqrs: val_dni},
    success: function(res){
     alert(res);
    }
  });
  
 });
});