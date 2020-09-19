<?php
  require_once('View/Views/cabezera.php');
  require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">asignar Buses</div>
    </div>
  </div>
</header>
  <!-- BUSES -->
  <section class="page-section" id="buses">
    <div class="container">
       <form id="newBus" class="needs-validation" novalidate method="POST">
        <div class="form-row">
         <div class="col-md-3 mb-3">
          <label  for="placa">Placa</label>
          <input type = "text" class = "form-control"  name="placa" id = "placa" placeholder = "Placa" required>
         </div>
         <div class="col-md-3 mb-3">
          <label for="marca">Marca</label>
             <select class = "form-control" name="marca" id = "marca" required>
                  <option value = null> Seleccione </option>
                  <option value = "Mercedes Benz"> Mercedes Benz </option>
                  <option value = "Volkswagen">Volkswagen</option>
                  <option value = "Hyundai">Hyundai</option>
                  <option value = "Mitsubishi">Mitsubishi</option>
                  <option value = "JAC">JAC</option>
                  <option value = "Chevrolet">Chevrolet</option>
                  <option value = "Joylong">Joylong</option>
                  <option value = "Zhongtong">Zhongtong</option>
                  <option value = "Scania"> Scania</option>
                  <option value = "Foton">Foton</option>
                  <option value = "Golden">Golden</option>
                  <option value = "Ford">Ford</option>
                  <option value = "Volvo">Volvo</option>
                  <option value = "Dodge">Dodge</option>
                  <option value = "Dina">Dina</option>
                  <option value = "Isuzu">Isuzu</option>
                  <option value = "International">International</option>
             </select>
         </div>
         <div class="col-md-3 mb-3">
          <label  for="modelo">Modelo</label>
          <input type = "text" class = "form-control" name="modelo" id = "modelo" placeholder = "Modelo"  required><!--hay modelos de buses que pueden tener nombres y no solo numeros ejemplo  chevrolet grand turismo 2019-->
        </div>
         <div class="col-md-3 mb-3">
          <label  for="tipo">Tipo</label>
          <select class = "form-control" name="tipo" id = "tipo" required>
           <option value = null> Seleccione </option>
           <option value = "1"> Bus </option>
           <option value = "2">Micro-Bus</option>
           <option value ="3">Buseta</option>
          </select>
         </div>
        </div>
        <input class = "btn btn-success btn-block" type = "submit" name="insertarBus" value="Insertar Bus">
       </form>
         <form action="" method="POST">
            <button class="btn btn-block btn-danger my-5" type="submit" name="pdfBus">Generar reporte</button>
        </form>
      </div>
    <!--  busqueda -->
  <form action="" method="POST">
    <div class="col-6 input-group container my-5">
      <input type="search" class="form-control" id="consulta" placeholder="Busqueda por placa, tipo o estado" name="cod">
      <div class="input-group-prepend">
        <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar" value="Buscar buses">
      </div>
    </div>
  </form>
  <!-- Acordeon de los Buses -->
 <div class="container">
  <h2 class="text-center">BUSES</h2>
  <div class="accordion mt-5" id="acordionConductores">
   <?php 
    $v = 1;
    foreach ($bus_general as $f_bus_acor) { 
   ?>
   <div class="card">
    <button class="btn card-header" type="button" data-toggle="collapse" data-target="#infobus<?php echo $v; ?>" aria-expanded="true" aria-controls="infoConductor">
     Placa: <?php echo $f_bus_acor[0]; ?>
    </button>
    <div id="infobus<?php echo $v; ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#acordionConductores">
     <div class="card-body">
      <div class="container">
       <form class="needs-validation" novalidate action = "" method = "POST">
        <div class="form-row">
         <div class="col-md-4 mb-3">
          <label for = "placa_actu<?php echo $v; ?>">Placa</label>
          <input type = "text" class = "form-control" value = "<?php echo $f_bus_acor[0]; ?>" name = "placa_actu" id = "placa_actu<?php echo $v; ?>" readonly>
          </div>
         <div class="col-md-4 mb-3">
          <label for="marca_actu<?php echo $v; ?>">Marca</label>
          <input type = "text" class = "form-control" value = "<?php echo $f_bus_acor[1]; ?>" name = "marca_actu" id = "marca_actu<?php echo $v; ?>" readonly>
         </div>
         <div class="col-md-4 mb-3">
          <label for="modelo_actu<?php echo $v; ?>">Modelo</label>
          <input type = "text" class = "form-control" value = "<?php echo $f_bus_acor[2]; ?>" name = "modelo_actu" id = "modelo_actu<?php echo $v; ?>" readonly>
         </div>
         <div class="col-md-6 mb-3">
          <label for="tipo_actu<?php echo $v; ?>">Tipo</label>
          <input type = "text" class = "form-control" value = "<?php echo $f_bus_acor[3]; ?>" name = "tipo_actu" id = "tipo_actu<?php echo $v; ?>" readonly>
         </div>
         <div class="col-md-6 mb-3">
          <label for="estado_actu<?php echo $v; ?>">Estado</label>
          <select class = "form-control" name = "estado_actu" id = "estado_actu<?php echo $v; ?>">
           <option value = "<?php echo $f_bus_acor[4]; ?>"> <?php echo $f_bus_acor[4]; ?> </option>
           <?php if ($f_bus_acor[4] == "Activo") { ?>
            <option value = "Reparacion"> Reparacion </option>
           <?php } else { ?>
            <option value = "Activo"> Activo </option>
           <?php } ?>
          </select>
         </div>
        </div>
        <input class = "btn btn-warning btn-block" name = "actualizar_bus" type = "submit" value = "ACTUALIZAR">
       </form>
      </div>
     </div>
    </div>
   </div>
   <?php 
     $v++;
    } 
   ?>
  </div>
 </div>
</section> 
<?php
  require_once('View/Views/footer.php');
?>