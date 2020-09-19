<?php
require_once('View/Views/cabezera.php');
require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">conductores</div>
    </div>
  </div>
</header>
<!-- Conductores -->
<section class="page-section" id="conductores">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="text-uppercase">Conductores</h2>
        <h5> Aqui podra administrar los coductores <h5>
      </div>
    </div>

    <form class="needs-validation" novalidate method="POST" enctype="multipart/form-data">
      <div class="form-row">
        <div class="col-md-3 mb-3">
          <label for="cedula">Cedula</label>
          <input type="text" class="form-control" name="cedula_con" id="cedula" placeholder="Cedula" required>
        </div>
        <div class="col-md-3 mb-3">
          <label for="nombre_con">Nombre</label>
          <input type="text" class="form-control" name="nombre_con" id="nombre_con" placeholder="Nombre" pattern="[a-zA-Z ]+" required>
        </div>
        <div class="col-md-3 mb-3">
          <label for="apellido_con">Apellido</label>
          <input type="text" class="form-control" name="apellido_con" id="apellido_con" placeholder="Apellido" pattern="[a-zA-Z ]+" required>
        </div>
        <div class="col-md-3 mb-3">
          <label for="bus">Bus</label>
          <select class="form-control" id="bus" name="bus_con">
            <?php foreach ($bus as $f_bus) { ?>
              <option value="<?php echo $f_bus[0]; ?>"> <?php echo $f_bus[0]; ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-3 mb-3">
          <label for="licencia">Licencia</label>
          <select class="form-control" id="licencia" name="licencia_con">
            <option value="B1"> B1 </option>
            <option value="B1"> B2 </option>
            <option value="B1"> B3 </option>
            <option value="B1"> C1 </option>
            <option value="B1"> C2 </option>
            <option value="B1"> C3 </option>
          </select>
        </div>
        <div class="col-md-3 mb-3">
          <label for="comprobante">Adjunte pdf licencia</label>
          <input type="file" class="form-control" name="certificado_con" id="comprobante" accept="application/pdf" required>
        </div>
        <div class="col-md-3 mb-3">
          <label for="telefono">Telefono</label>
          <input type="tel" class="form-control" name="telefono_con" id="telefono" placeholder="Telefono" required>
        </div>
        <div class="col-md-3 mb-3">
          <label for="edad">Edad</label>
          <input type="text" class="form-control" name="edad_con" id="edad" pattern="[0-9]+" placeholder="Edad" required>
        </div>
      </div>
      <input class="btn btn-success btn-block" type="submit" name="subir_autobus" value="Agregar Conductor">
    </form>
  </div>
  <!--  busqueda -->
  <form action="" method="POST">
    <div class="col-6 input-group container my-5">
      <input type="search" class="form-control" id="consulta" placeholder="Busqueda por cedula y licencia" name="cod">
      <div class="input-group-prepend">
        <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar" value="Buscar conductores">
      </div>
    </div>
  </form>

  <div class="container">
    <h2 class="text-center">CONDUCTORES</h2>
    <div class="accordion mt-5" id="acordionConductores">
      <?php
      $w = 1;
      foreach ($cond_general as $f_cond_gen) {
      ?>
        <div class="card">
          <button class="btn card-header" type="button" data-toggle="collapse" data-target="#infoConductor<?php echo $w; ?>" aria-expanded="true" aria-controls="infoConductor">
            <?php echo "$f_cond_gen[1] $f_cond_gen[2]"; ?>
          </button>
          <div id="infoConductor<?php echo $w; ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#acordionConductores">
            <div class="card-body">
              <div class="container">
                <form class="needs-validation" novalidate action="" method="POST" enctype="multipart/form-data">
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="cedula_actu_con<?php echo $w; ?>">Cedula</label>
                      <input type="number" class="form-control" name="cedula_actu_con" value="<?php echo $f_cond_gen[0]; ?>" id="cedula_actu_con<?php echo $w; ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="nombre_actu_con<?php echo $w; ?>">Nombre</label>
                      <input type="text" class="form-control" name="nombre_actu_con" value="<?php echo $f_cond_gen[1]; ?>" id="nombre_actu_con<?php echo $w; ?>" pattern="[a-zA-Z ]+" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="apellido_actu_con<?php echo $w; ?>">Apellido</label>
                      <input type="text" class="form-control" name="apellido_actu_con" value="<?php echo $f_cond_gen[2]; ?>" id="apellido_actu_con<?php echo $w; ?>" pattern="[a-zA-Z ]+" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="bus_actu_con<?php echo $w; ?>">Bus</label>
                      <select class="form-control" name="bus_actu_con" id="bus_actu_con<?php echo $w; ?>">
                        <option value="<?php echo $f_cond_gen[3]; ?>"> <?php echo $f_cond_gen[3]; ?> </option>
                        <?php foreach ($bus as $f_bus_actu) { ?>
                          <option value="<?php echo $f_bus_actu[0]; ?>"> <?php echo $f_bus_actu[0]; ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="licencia_actu_con<?php echo $w; ?>">Licencia</label>
                      <input type = "hidden" name = "licencia_cambiable" value = "<?php echo $f_cond_gen[4]; ?>">
                      <select class="form-control" name="licencia_actu_con" id="licencia_actu_con<?php echo $w; ?>">
                        <option value="<?php echo $f_cond_gen[4]; ?>"> <?php echo $f_cond_gen[4]; ?> </option>
                        <option value="B1"> B1 </option>
                        <option value="B2"> B2 </option>
                        <option value="B3"> B3 </option>
                        <option value="C1"> C1 </option>
                        <option value="C2"> C2 </option>
                        <option value="C3"> C3 </option>
                      </select>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="comprobante_actu_con<?php echo $w; ?>">Adjunte licencia pdf</label>
                      <input type="file" class="form-control" name="comprobante_actu_con" id="comprobante_actu_con<?php echo $w; ?>" accept="application/pdf">
                      <input type="hidden" value="<?php echo $f_cond_gen[5]; ?>" name="comprobante_repuesto">
                      <a href="View/img/Certificados/<?php echo $f_cond_gen[5]; ?>" target = "_blank"> Ver certificado </a>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="telefono_actu_con<?php echo $w; ?>">Telefono</label>
                      <input type="tel" class="form-control" value="<?php echo $f_cond_gen[6]; ?>" name="telefono_actu_con" id="telefono_actu_con<?php echo $w; ?>" required>
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="edad_actu_con<?php echo $w; ?>">Edad</label>
                      <input type="number" class="form-control" name="edad_actu_con" value="<?php echo $f_cond_gen[7]; ?>" id="edad_actu_con<?php echo $w; ?>" pattern="[0-9]+" required>
                    </div>
                  </div>
                  <input class="btn btn-warning btn-block" type="submit" name="actualizar_conductor" value="Actualizar Datos">
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php
        $w++;
      }
      ?>
    </div>
  </div>
</section>
<?php
require_once('View/Views/footer.php');
?>