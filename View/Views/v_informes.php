<?php
require_once('View/Views/cabezera.php');
require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">Informes</div>
    </div>
  </div>
</header>
<!-- informes -->
<section class="page-section" id="buses">
  <div class="container">



  <div class="row">
   <div class="col-lg-4 col-md-6 col-sm-12 my-3">
    <div class="card bg-dark text-light">
     <div class="card-body text-light">
      <div class="text-center">Conteo de Buses en Mantenimiento y Activos</div>
      <form action = "" method="POST">
          <button class = "btn btn-outline-primary col-12 mt-3" type = "submit" name = "pdfBus">Total Buses     <i class="fas fa-bus"></i></button>
     </form>
     </div>
    </div>
   </div>
    
   <!-- informe de promedio -->

   <div class="col-lg-4 col-md-6 col-sm-12 my-3">
    <div class="card bg-dark text-light">
     <div class="card-body text-light">
      <div class="text-center">Muestra la puntacion promedio de cada ruta</div>
      <form action = "" method="POST">
      <label> Año </label>
      <select class="form-control" name = "year_promedio">
       <?php
        foreach($rutas as $r){
       ?>
       <option value = "<?php echo $r[0] ?>"> <?php echo $r[0] ?></option>
       <?php } ?>
      </select>
      <label> Mes </label>
      <select class="form-control" name = "mes_promedio">
       <option value = "01"> Enero </option>
       <option value = "02"> Febrero </option>
       <option value = "03"> Marzo </option>
       <option value = "04"> Abril </option>
       <option value = "05"> Mayo </option>
       <option value = "06"> Junio </option>
       <option value = "07"> Julio </option>
       <option value = "08"> Agosto </option>
       <option value = "09"> Septiembre </option>
       <option value = "10"> Octubre </option>
       <option value = "11"> Noviembre </option>
       <option value = "12"> Diciembre </option>
      </select>
      <button class = "btn btn-outline-primary col-12 mt-3" type = "submit" name = "pdfRuta">Promedio Puntajes   <i class="fas fa-star"></i></button>
     </form>
     </div>
    </div>
   </div>
    
  <!-- informe de bus con ruta -->
   <div class="col-lg-4 col-md-6 col-sm-12 my-3">
    <div class="card bg-dark text-light">
     <div class="card-body text-light">
      <form action = "" method="POST">
        <div class="text-center">Muestra Buses de cada ruta</div>
        <button class = "btn btn-outline-primary col-12 mt-3" type = "submit" name = "pdfOtro">Buses Rutas <i class="fas fa-road"></i></button>
     </form>
     </div>
    </div>
   </div>
  </div>  
</div>

</div>

  
</section>

<?php
require_once('View/Views/footer.php');
?>