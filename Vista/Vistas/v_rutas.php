<?php
require_once('View/Views/cabezera.php');
require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">rutas actuales</div>
    </div>
  </div>
</header>
<!-- Portfolio Grid -->
<section class="page-section bg-dark">
  <div class="container">
    <h2 class="text-center text-uppercase">Rutas</h2>
    <h5 class="text-center text-muted"> Aqui podra adminsitrar las rutas </h5>
    <div class="row">
      <form method="POST" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col-md-2 mb-2">
            <label for="codigo">Codigo</label>
            <input type="text" name="codigo_rut" class="form-control" id="codigo" placeholder="Codigo" required pattern="[0-9]+">
          </div>
          <div class="col-md-2 mb-2">
            <label for="validationCustom02">Nombre</label>
            <input type="text" name="nombre_rut" class="form-control" id="validationCustom02" placeholder="Nombre" required>
          </div>
          <div class="col-md-4 mb-4">
            <label for="validationCustom03">Salida</label>
            <input type="text" name="salida_rut" class="form-control" id="validationCustom03" placeholder="Salida" required>
          </div>
          <div class="col-md-4 mb-4">
            <label for="validationCustom04">Llegada</label>
            <input type="text" name="llegada_rut" class="form-control" id="validationCustom04" placeholder="Llegada" required>
          </div>
          <div class="col-md-2 mb-2">
            <label for="validationCustom05">Costo</label>
            <input type="text" name="costo_rut" class="form-control" id="validationCustom05" placeholder="Costo" pattern="[0-9]+" required>
          </div>
          <div class="col-md-2 mb-2">
            <label for="validationCustom07">Tiempo</label>
            <input type="text" name="tiempo_rut" class="form-control" id="validationCustom07" title = "0:00" pattern = "[0-9]:[1-5][0-9]" value="0:00" required="">
          </div>
          <div class="col-md-4 mb-4">
            <label for="validationCustom06">Imagen</label>
            <input type="file" name="imagen_rut" class="form-control" id="validationCustom06" required accept="image/jpeg, image/png">
          </div>
          <div class="col-md-4 mb-4">
            <label for="validationCustom06">Mapa</label>
            <input type="text" name="mapa_rut" class="form-control" id="validationCustom06" placeholder="Mapa" required>
            <a href="https://www.google.co.jp/maps/dir///@36.5626,136.362305,5z?hl=es" target = "_blank"> Elegir mapa </a>
          </div>
        </div>
        <input class="btn btn-success btn-block text-uppercase" name="insert_ruta" type="submit" value="Subir nueva ruta">
      </form>
</section>
<section class="page-section" id="portfolio">
  <!--  busqueda -->
  <form action="" method="POST">
    <div class="col-6 input-group container">
      <input type="search" class="form-control" id="consulta" placeholder="Busqueda por ruta , Nombre , costo   " name="search_ruta" value="">
      <div class="input-group-prepend">
        <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar_ruta" value="Buscar Rutas">
      </div>
    </div>
  </form>
  <!-- inicio de rutas -->
  <div class="card-columns container my-5">
    <?php
    $a = 1; //contador para poder llamar a los modales
    foreach ($rutas as $f_ruta) { //sirve para que me recorra el areglo que tiene la consulta de las rutas.
    ?>
      <div class="card portfolio-item border-dark">
        <a class="portfolio-link" data-toggle="modal" data-target="#datos_ruta<?php echo $a; //imprimo consecutivamente la posicion del modal 
                                                                              ?>">
          <div class="portfolio-hover">
            <div class="portfolio-hover-content">
              <i class="fas fa-plus fa-3x"></i>
            </div>
          </div>
          <img class="img-fluid" src="View/img/portfolio/<?php echo $f_ruta[7]; ?>" alt="" style="width: 367px; height: 220px;">
        </a>
        <div class="card-body portfolio-caption">
          <h4><?php echo $f_ruta[3]; ?> a</h4>
          <h6><?php echo $f_ruta[4]; ?></h6>
        </div>
        <a class="btn btn-warning w-100" data-toggle="modal" data-target="#actu_rutas<?php echo $a; ?>"> ACTUALIZAR</a>
      </div>
    <?php
      $a++; //se incrementa el contador del modal
    }
    ?>
  </div>
</section>

<!-- Previsualizacion de la ruta actual con modal -->
<?php
$b = 1; //sirve para asignar un numero a cada modal
foreach ($rutas as $f_contenido) { //recorre la consulta de rutas
?>
  <div class="modal fade" id="datos_ruta<?php echo $b; //imprimo la psicion de cada modal 
                                        ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <!--Contenido-->
      <div class="modal-content">
        <!--Body-->
        <div class="modal-body mb-0 p-0">
          <div class="modal-header">
            <h2 class="text-uppercase">RUTA</h2>
          </div>
          <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
            <?php echo $f_contenido[8]; //me trae la posiciion del mapa 
            ?>
          </div>
        </div>
        <!--Esta parte es la tarjeta en la cual estaran los datos acerca de la ruta-->
        <div class="modal-body">
          <div class="card border-dark mb-3 ">
            <div class="card-header bg-transparent border-dark"><?php echo $f_contenido[2]; ?></div>
            <div class="card-body text-dark">
              <h5 class="card-title">Pasaje</h5>
              <p class="card-text"><?php echo $f_contenido[5]; ?> $</p>
            </div>
            <div class="card-body text-dark">
              <h5 class="card-title">Tiempo estimado</h5>
              <p class="card-text"><?php echo $f_contenido[6]; ?></p>
            </div>
            <div class="card-body text-dark">
              <h5 class="card-title">Salida</h5>
              <p class="card-text"><?php echo $f_contenido[3]; ?></p>
            </div>
            <div class="card-body text-dark">
              <h5 class="card-title">LLegada</h5>
              <p class="card-text"><?php echo $f_contenido[4]; ?></p>
            </div>
            <button class="btn bg-success" type="button" data-toggle="collapse" data-target="#subrutas" aria-expanded="false" aria-controls="collapseExample">
              SUBRUTAS
            </button>
            <!-- acordeon de las subrutas -->
            <div class="collapse" id="subrutas">
              <div class="accordion" id="acordeonSubruta">
                <?php
                $c = 1;
                $titulos = $consulta->titulo_acordeon($f_contenido[0]);
                foreach ($titulos as $f_titulos) {
                ?>
                  <div class="card">
                    <div class="card-header" id="" data-toggle="collapse" data-target="#subruta<?php echo $c; ?>" aria-expanded="true" aria-controls="collapseOne">
                      <?php echo $f_titulos[1]; ?>, Precio: <?php echo $f_titulos[2]; ?>
                    </div>
                    <div id="subruta<?php echo $c; ?>" class="collapse show" aria-labelledby="acavaelnumerodelidllamado" data-parent="#acordeonSubruta">
                      <div class="card-body">
                        <?php
                        $contenido = $consulta->contenido_acordeon($f_titulos[0]);
                        foreach ($contenido as $f_paraderos) {
                          echo $f_paraderos[0] . ", ";
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                <?php
                  $c++;
                }
                ?>
              </div>
            </div>
            <!-- ///// comentarios ////////////////// -->
            <button class="btn bg-outline-primary" type="button" data-toggle="collapse" data-target="#comentar" aria-expanded="false" aria-controls="collapseExample">
              COMENTARIOS
            </button>
            <div class="collapse" id="comentar">
              <div class="accordion" id="acordeonComentario">
                <div class="card">
                  <div id="empezar_comentar" class="collapse show" aria-labelledby="acavaelnumerodelidllamado" data-parent="#acordeonComentario">

                    <div class="card border-primary">
                      <?php 
                       $mostrar_comentarios = $consulta->comentarios_de_ruta($f_contenido[0]);
                      foreach ($mostrar_comentarios as $coment) { // aca muestro los comentarios ya realizados 
                      ?>
                        <div class="card-header">
                          <header style="font-size: 12px;">
                            <?php echo $coment[1] . " comentado el " . $coment[3] . " a las " . $coment[4]; ?>
                          </header>
                        </div>
                        <div class="card-body text-primary">
                          <p style="color:black;">
                            <?php echo $coment[6]; ?>
                          </p>
                        </div>
                      <?php } ?>
                      <button class="btn btn-group-sm btn-outline-danger" type="button" onmouseover="muestraComentario();">Comentar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-outline-primary btn-rounded btn-block" data-dismiss="modal">cerrar</button>
        </div>
      </div>
    </div>
  </div>
<?php
  $b++; //el numero del modal se autoincrementa
}
?>
<!-- modal para actualizar rutas -->
<?php
$z = 1; //contador para poder llamar a los modales
foreach ($rutas as $f_ruta_actu) { //sirve para que me recorra el areglo que tiene la consulta de las rutas.
?>
  <div class="portfolio-modal modal fade" id="actu_rutas<?php echo $z; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg mx-auto">
              <div class="modal-body">
                <section class="page-section">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-12">
                        <h2 class=" text-uppercase">actualizacion de ruta</h2>
                      </div>
                      <form class="needs-validation mt-5" novalidate action="" method="POST" enctype="multipart/form-data">
                        <div class="form-row">
                          <div class="col-md-1">
                            <label for="codigoActu">Codigo</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[0]; ?>" name="codigo_rut_actu" id="codigoActu" pattern="[0-9]+" readonly>
                          </div>
                          <div class="col-md-3">
                            <label for="nombreActu">Nombre</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[2]; ?>" name="nombre_rut_actu" id="nombreActu" placeholder="Nombre" required>
                          </div>
                          <div class="col-md-4">
                            <label for="salidaActu">Salida</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[3]; ?>" name="salida_rut_actu" id="salidaActu" placeholder="Salida" required>
                          </div>
                          <div class="col-md-4">
                            <label for="llegadaActu">Llegada</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[4]; ?>" name="llegada_rut_actu" id="llegadaActu" placeholder="Llegada" required>
                          </div>
                          <div class="col-md-2">
                            <label for="costoActu">Costo</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[5]; ?>" name="costo_rut_actu" id="costoActu" placeholder="Costo" pattern="[0-9]+" required>
                          </div>
                          <div class="col-md-2">
                            <label for="tiempoActu">Tiempo</label>
                            <input class="form-control" type="text" value="<?php echo $f_ruta_actu[6]; ?>" name="tiempo_rut_actu" id="tiempoActu" title = "0:00" pattern = "[0-9]:[1-5][0-9]" required="">
                          </div>
                          <div class="col-md-4">
                            <label for="imagenActu">Imagen</label>
                            <input class="form-control" type="file" name="imagen_rut_actu" id="imagenActu" accept="image/jpeg, image/png">
                            <input type="hidden" value="<?php echo $f_ruta_actu[7]; ?>" name="imagen_repuesto_ruta">
                          </div>
                          <div class="col-md-4">
                            <label for="mapaActu">Mapa</label>
                            <input class="form-control" type="text" value="<?php echo htmlspecialchars($f_ruta_actu[8]); ?>" name="mapa_rut_actu" id="mapaActu" required>
                           <a href="https://www.google.co.jp/maps/dir///@36.5626,136.362305,5z?hl=es" target = "_blank"> Elegir mapa </a>
                          </div>
                        </div>
                        <input class="btn btn-warning btn-block mt-5" type="submit" name="actualizar_ruta" value="ACTUALIZAR">
                      </form>
                    </div>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  $z++;
}
?>

<!-- seccion de sub-rutas -->
<section class="bg-dark page-section" id="sub_rutas">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="text-uppercase">SUB-RUTAS</h2>
        <h5>Aqui podra administrar las sub-rutas</h5>
      </div>
    </div>
    <form class="mt-5" action="" method="POST">
      <div class="row">
        <div class="col">
          <label for="nombre_sub">Nombre</label>
          <input type="text" name="nombre_sub" class="form-control" id="nombre_sub" placeholder="Nombre" required>
        </div>
        <div class="col">
          <label for="costo_sub">Costo</label>
          <input type="text" name="costo_sub" class="form-control" id="costo_sub" placeholder="Costo" pattern="[0-9]+" required>
        </div>
      </div>
      <input class="btn btn-success btn-block mt-4" type="submit" name="subir_sub_ruta" value="Subir nueva sub-ruta">
    </form>
  </div>
  <!--  busqueda -->
  <form action="" method="POST">
    <div class="col-6 input-group container my-5">
      <input type="search" class="form-control" id="consulta" placeholder="Busqueda por nombre , costo" name="codigo">
      <div class="input-group-prepend">
        <input class="btn btn-outline-success text-uppercase" type="submit" name="consultarSubruta" value="Buscar Sub-Rutas">
      </div>
    </div>
  </form>
  <!-- acordeon de sub-rutas -->
  <div class="container">
    <div class="accordion mt-5" id="acordionConductores">
      <?php
      $z = 1;
      foreach ($sub_ruta_general as $f_subs) {
      ?>
        <div class="card">
          <button class="btn card-header" type="button" data-toggle="collapse" data-target="#infosub<?php echo $z; ?>" aria-expanded="true" aria-controls="infoConductor">
            <?php echo $f_subs[1]; ?>
          </button>
          <div id="infosub<?php echo $z; ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#acordionConductores">
            <div class="card-body">
              <div class="container">
                <form class="needs-validation" novalidate action="" method="POST">
                  <input type="hidden" name="id_sub_ruta" value="<?php echo $f_subs[0]; ?>">
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="nombre_sub_actu">Nombre</label>
                      <input type="text" class="form-control" value="<?php echo $f_subs[1]; ?>" name="nombre_sub_actu" id="nombre_sub_actu">
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="costo_sub_actu">Costo</label>
                      <input type="text" class="form-control" value="<?php echo $f_subs[2]; ?>" pattern="[0-9]+" name="costo_sub_actu" id="costo_sub_actu">
                    </div>
                    <input class="btn btn-warning col-5 mb-3" name="actualizar_sub_ruta" type="submit" value="Actualizar">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php
        $z++;
      }
      ?>
    </div>
  </div>
</section>
<!-- seccion de paraderos -->
<section class="page-section" id="sub_rutas">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="text-uppercase">PARADEROS</h2>
        <h5 class="text-muted">Aqui podra administrar los paraderos</h5>
      </div>
    </div>

    <div class="mt-5">
      <form action="" method="POST">
        <div class="form-row">
          <div class="col-md-8 mb-3">
            <input type="text" name="nombre_par" class="form-control" id="nombre_par" placeholder="Nombre" pattern="[a-zA-Z ]+" required>
          </div>
          <input class="btn btn-success col-4 mb-3" type="submit" name="subir_paradero" value="Subir nuevo paradero">
        </div>
      </form>
    </div>
  </div>
  <!-- ////////////////////////////////////// busqueda Paraderos ///////////////////////////////////////////////// -->
  <form action="" method="POST">
    <div class="col-6 input-group container my-5">
      <input type="search" class="form-control" id="consultaparadero" placeholder="Busqueda por nombre" name="par" value="">
      <div class="input-group-prepend">
        <input class="btn btn-outline-success text-uppercase" type="submit" name="ConsulPara" value="Buscar Paraderos">
      </div>
    </div>
  </form>
  <!-- acordeon de paraderos -->
  <div class="container">
    <div class="accordion mt-5" id="acordionParaderos">
      <?php
      $y = 1;
      foreach ($paradero_general as $f_par) {
      ?>
        <div class="card">
          <button class="btn card-header" type="button" data-toggle="collapse" data-target="#infopar<?php echo $y; ?>" aria-expanded="true" aria-controls="infoConductor">
            <?php echo $f_par[1]; ?>
          </button>
          <div id="infopar<?php echo $y; ?>" class="collapse hide" aria-labelledby="headingOne" data-parent="#acordionParaderos">
            <div class="card-body">
              <div class="container">
                <form class="needs-validation" novalidate action="" method="POST">
                  <input type="hidden" name="id_paradero" value="<?php echo $f_par[0]; ?>">
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="nombre_par_actu">Nombre</label>
                      <input type="text" class="form-control" value="<?php echo $f_par[1]; ?>" name="nombre_par_actu" id="nombre_par_actu">
                    </div>
                  </div>
                  <input class="btn btn-primary" name="actualizar_paradero" type="submit" value="Actualizar">
                </form>
              </div>
            </div>
          </div>
        </div>
      <?php
        $y++;
      }
      ?>
    </div>
  </div>
</section>
<?php
require_once('View/Views/footer.php');
?>