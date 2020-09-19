<?php
require_once('View/Views/cabezera.php');
require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">Peticiones, quejas y reclamos</div>
    </div>
  </div>
</header>
<!-- pqrs -->

<section class="page-section" id="pqr">
  <!--  busqueda -->
<form action="" method="POST">
    <div class="col-6 input-group container">
      <input type="search" class="form-control" id="consulta" placeholder="Busqueda de los pqr por fecha y tipo" name="para_pqr">
      <div class="input-group-prepend"> 
        <input class="btn btn-outline-success text-uppercase" type="submit" name="search_pqr" value="Buscar pqr's">
      </div>
    </div>
  </form>
  <div id="pqr" class="contenedorpqr mt-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="modal-body">
            <div class="container">
              <?php foreach ($general_pqr as $f_pqr) { ?>
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <form action="" method="POST">
                      <input type="hidden" name="id_pqr" value="<?php echo $f_pqr[0]; ?>">
                      <div class="form-row">
                        <!--   asunto de la  solicitud -->
                        <div class="col-md-6 mb-3">
                          <label>Asunto</label>
                          <input type="text" name = "asunto_pqr" value="<?php echo $f_pqr[3]; ?>" class="form-control" id="asunto" readonly>
                        </div>
                        <!--  Estado de la  solicitud -->
                        <div class="col-md-6 mb-3">
                          <label>Estado:</label>
                          <input type = "hidden" name = "pasajero" value = "<?php echo $f_pqr[1]; ?>">
                          <input type = "hidden" name = "tipo_pqr" value = "<?php echo $f_pqr[5]; ?>">
                          <input type="text" class="form-control" value="<?php echo $f_pqr[9]; ?>" id="estado" readonly>
                        </div>
                        <!-- text area del pqr Generado -->
                        <div class="col-md-6 mb-3">
                          <div class="form-group">
                            <label>PQR Generado:</label>
                            <textarea class="form-control" name = "content" id="generado" readonly> <?php echo $f_pqr[4]; ?> </textarea>
                          </div>
                        </div>
                        <!--  text area respuesta pqr-->
                        <?php if ($f_pqr[7] != null) { ?>
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <textarea class="form-control" name="respuesta_pqr" id="respuesta" readonly> <?php echo $f_pqr[7]; ?></textarea>
                            </div>
                          </div>
                        <?php } else { 
                         if($f_pqr[11] != null){  
                          $comprobacion = substr($f_pqr[11], -5); 
                          if(strlen(strstr($comprobacion,'mp4')) > 0 || strlen(strstr($comprobacion,'mkv')) > 0 || strlen(strstr($comprobacion,'flv')) > 0){ ?>
                          <div class="col-md-3 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <textarea class="form-control" name="respuesta_pqr" id="respuesta2"></textarea>
                                <input class="btn btn-warning btn-block mt-1" type="submit" value="RESPONDER" name="responder">
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <video class="w-100" src = "View/img/comprobantes_pqr/<?php echo $f_pqr[11]; ?>" controls></video>
                            </div>
                          </div>
                          <?php 
                          } else { ?>
                          <div class="col-md-3 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <textarea class="form-control" name="respuesta_pqr" id="respuesta2"></textarea>
                                <input class="btn btn-warning btn-block mt-1" type="submit" value="RESPONDER" name="responder">
                            </div>
                          </div>
                          <div class="col-md-3 mb-3">
                            <div class="form-group">
                              <label>Comprobante:</label>
                              <img class="img-fluid w-100" src = "View/img/comprobantes_pqr/<?php echo $f_pqr[11]; ?>"/>
                            </div>
                          </div>
                          <?php }
                         }else {
                          ?>
                          <div class="col-md-6 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <textarea class="form-control" name="respuesta_pqr" id="respuesta2"></textarea>
                                <input class="btn btn-warning btn-block mt-1" type="submit" value="RESPONDER" name="responder">
                            </div>
                          </div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                    </form>
                  </div>
                </div>
              <?php } ?>
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