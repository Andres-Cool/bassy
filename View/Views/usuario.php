<?php
  require_once('View/Views/cabezera.php');
?>
<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src="View/img/logo.png"></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav text-uppercase ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#portfolio">Servicios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#pqr">PQR</a>
          </li>
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user-cog"></i> AJUSTES
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <button class="dropdown-item" data-toggle="modal" data-target="#ajustecontrasena"><i class="fas fa-key"></i> Cambiar Clave</button>
              <button class="dropdown-item" data-toggle="modal" data-target="#ajusteperfil"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Perfil</button>
              <form action="Controler/c_login.php" method="POST">
                <button class="dropdown-item" href="<?php print $config['callback'] . "?logout={$name}"; ?>" data-toggle="modal" data-target="#logoutModal" type="submit" name="cerrar">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Salir
                </button>
              </form>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <h3 class="">Bienvenido a nuestra WEB</h3>
        <div class="intro-heading text-uppercase">Para nosotros es grato tenerte cerca</div>
      </div>
    </div>
  </header>


  <!-- Portfolio Grid -->
  <section class="page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="text-uppercase">rutas</h2>
          <h5>Poseemos gran cobertura a nivel departamental, destacandonos por nuestro servicio de calidad y sobre todo por nuestra puntualidad.</h5>
        </div>
      </div>
      <div class="row mt-5">
        <?php
        $a = 1; //contador para poder llamar a los modales
        foreach ($rutas as $f_ruta) { //sirve para que me recorra el areglo que tiene la consulta de las rutas.
        ?>
          <div class="col-md-4 col-sm-6 portfolio-item">
            <a class="portfolio-link" data-toggle="modal" data-target="#datos_ruta<?php echo $a; //imprimo consecutivamente la posicion del modal 
                                                                                  ?>">
              <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                  <i class="fas fa-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="View/img/portfolio/<?php echo $f_ruta[7]; ?>" alt="">
            </a>
            <div class="portfolio-caption">
              <h4><?php echo $f_ruta[3]; ?> a</h4>
              <p class="text-muted"><?php echo $f_ruta[4]; ?></p>
            </div>
          </div>
        <?php
          $a++; //se incrementa el contador del modal
        }
        ?>
      </div>
    </div>
    <!-- pqrs -->
    <div id="pqr" class="contenedorpqr">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <form action="" method="POST">
              <div class="input-group my-5">
                <input type="search" class="form-control" id="consulta" placeholder="Busqueda por fecha y tipo " name="cod" value="">
                <button class="btn btn-success" type="submit" name="consultar"><i class="fa fa-search" aria-hidden="true"></i></button>
              </div>
            </form>
            <div class="modal-body">
              <a class="btn btn-warning " data-toggle="modal" href="#pqrs">Generar PQR
                <i class='fas fa-edit'></i>
              </a>
              <div class="container">
                <?php
                $v = 1;
                foreach ($general_pqrs as $f_pqr) {
                ?>
                  <div class="row">
                    <div class="col-lg-12 text-center">
                      <div class="form-row">
                        <!--   asunto de la  solicitud -->
                        <div class="col-md-6 mb-3">
                          <label>Asunto</label>
                          <input type="text" value="<?php echo $f_pqr[3]; ?>" class="form-control" id="asunto" readonly>
                        </div>
                        <!--  Estado de la  solicitud -->
                        <div class="col-md-6 mb-3">
                          <label>Estado:</label>
                          <input type="text" class="form-control" value="<?php echo $f_pqr[9]; ?>" id="estado" readonly>
                        </div>
                        <!-- text area del pqr Generado -->
                        <?php if($f_pqr[11] != null){ ?>
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <label>PQR Generado:</label>
                            <textarea class="form-control" id="message" readonly> <?php echo $f_pqr[4]; ?> </textarea>
                          </div>
                        </div>
                        <?php
                         $comprobacion = substr($f_pqr[11], -5); 
                         if (strlen(strstr($comprobacion,'mp4')) > 0 || strlen(strstr($comprobacion,'mkv')) > 0 || strlen(strstr($comprobacion,'flv')) > 0) {
                        ?>
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#comprobanteVideo<?php echo $v; ?>" aria-expanded="false" aria-controls="comprobanteVideo">Ver comprobante</button>
                        <div class="collapse my-4 w-100" id="comprobanteVideo<?php echo $v; ?>">
                            <div class="card card-body">
                                <h4>Video:</h4>
                                <video class="w-100" src = "View/img/comprobantes_pqr/<?php echo $f_pqr[11]; ?>" controls></video>        
                            </div>
                        </div>
                        <?php } else { ?>
                        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#comprobanteImagen<?php echo $v; ?>" aria-expanded="false" aria-controls="comprobanteImagen">Ver comprobante</button>
                        <div class="collapse my-4 w-100" id="comprobanteImagen<?php echo $v; ?>">
                            <div class="card card-body">
                                <h4>Comprobante</h4>
                                <img class="img-fluid w-100" src = "View/img/comprobantes_pqr/<?php echo $f_pqr[11]; ?>"/>
                            </div>
                        </div>
                        <?php } ?>
                        <?php } else { ?>
                        <div class="col-md-12 mb-3">
                          <div class="form-group">
                            <label>PQR Generado:</label>
                            <textarea class="form-control" id="message" readonly> <?php echo $f_pqr[4]; ?> </textarea>
                          </div>
                        </div>
                        <?php } ?>
                        <!--  text area respuesta pqr-->
                        <?php
                        if ($f_pqr[7] != null) {
                        ?>
                          <div class="col-md-12 mb-3">
                            <div class="form-group">
                              <label>Respuesta:</label>
                              <textarea class="form-control" id="message" readonly> <?php echo $f_pqr[7]; ?> </textarea>
                              <label> Leido: </label>
                              <input type="hidden" value="<?php echo $f_pqr[0]; ?>" class="llave_pqr">
                              <?php if ($f_pqr[10] == "No") { ?>
                             
                                  <input type="radio" class="deci" name="eleccion<?php echo $v; ?>" value="Si">
                               
                              <?php } else { ?>
                                
                                  <input type="radio" class="deci" name="eleccion<?php echo $v; ?>" value="Si" checked>
                                
                              <?php } ?>
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div>
                <?php
                  $v++;
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Modales -->
  <!-- PQR Modal -->

  <div class="portfolio-modal modal fade" id="pqrs" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <div class="row">
                  <div class="col-lg-12 text-center">
                    <h2 class=" text-uppercase">PQR</h2>
                    <h5>¿Desea Generar alguna Solicitud ?</h5>
                  </div>
                </div>
                <form class="needs-validation" action="" method="POST" novalidate enctype = "multipart/form-data">
                  <div class="form-row mt-5">
                    <div class="col-md-6 mb-3">
                      <label for="tipo">Tipo de Solicitud:</label>
                      <select class="form-control" name="tipo_pqr" id="tipo">
                        <option>Peticion</option>
                        <option>Queja</option>
                        <option>Reclamo</option>
                        <option>Felicitaciones</option>
                        <option>Sugerencia</option>
                      </select>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="asunto_pqr">Asunto:</label>
                      <input type="text" class="form-control" name="asunto_pqr" id="asunto_pqr" placeholder="Asunto" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="comprobante_pqr">Adjunto:</label>
                      <input type = "file" size="150" maxlength="150" class="form-control" name="comprobante_pqr" id="comprobante_pqr">
                    </div>
                    <div class="col-md-12 mb-3">
                      <div class="form-group">
                        <label for="contenido_pqr">Contenido</label>
                        <textarea class="form-control" name="contenido_pqr" id="contenido_pqr" placeholder="Escriba una Breve descripcion de la Solicitud*" required></textarea>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 text-center">
                      <div id="success"></div>
                      <input class="btn btn-success btn-block" type="submit" name="generar_pqr" value="ENVIAR PQR">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Actualizar Perfil -->
  <div class="portfolio-modal modal fade" id="ajusteperfil" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- detalles de la ventana modal para actualizar datos -->
                <h2 class="text-uppercase">Actualizar Datos Personales</h2>
                <?php foreach ($datos_pasajero as $f_pas) { ?>
                  <div>
                    <img id="imagenes" class="img-fluid d-block mx-auto" src="View/img/imgUser/<?php echo $f_pas[7]; ?>" alt="">
                  </div>
                  <form class="needs-validation" method="POST" enctype="multipart/form-data">
                    <input type="file" name="foto_pas" accept="image/jpeg, image/png">
                    <input type="hidden" name="foto_repuesto" value="<?php echo $f_pas[7]; ?>">
                    <div class="form-row">
                      <!-- formulario para el correo electronico-->
                      <div class="form-group col-md-12">
                        <label for="validationCustomUsername">Email</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                          </div>
                          <input type="email" name="correo_pas" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $f_pas[0]; ?>" readonly="">
                        </div>
                      </div>

                      <!--  Nombre pasajero -->
                      <div class="col-md-12">
                        <label for="validationCustom01"> Nombre: </label>
                        <input type="text" name="nombre_pas" class="form-control" id="validationCustom01" pattern="[a-zA-Z]+" value="<?php echo $f_pas[1]; ?>">
                      </div>
                      <!--Apellido pasajero -->
                      <div class="col-md-12">
                        <label for="validationCustom01"> Apellido:</label>
                        <input type="text" name="apellido_pas" class="form-control" id="validationCustom01" pattern="[a-zA-Z]+" value="<?php echo $f_pas[2]; ?>">
                        <div class="invalid-feedback">
                          Ingrese Su Apellido Por Favor.
                        </div>
                      </div>

                    </div>
              </div>
              <input class="btn btn-primary btn-block" name="actualizar_datos_personales" type="submit" value="Actualizar Datos">
              </form>
            <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ajustes para el cambio de contraseña -->
  <div class="portfolio-modal modal fade" id="ajustecontrasena" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- detalles de la ventana modal para actualizar password -->
                <h2 class="text-uppercase">Cambiar La Contraseña</h2>

                <form class="needs-validation" method="POST" novalidate>
                  <div class="form-row">

                    <!-- otra clase para los pasword  contraseña antigua-->
                    <div class="form-group col-md-12">
                      <label for="validationCustom02"> Contraseña Actual</label>
                      <input type="text" name="actual" class="form-control" id="validationCustom02" placeholder="Escriba su contraseña" required="">
                      <div class="invalid-feedback">
                        Ingrese su contraseña por favor.
                      </div>
                    </div>
                    <!-- validacion de la nueva contraseña -->
                    <div class="form-group col-md-12">
                      <label for="validationCustom02">Nueva Contraseña</label>
                      <input type="text" name="nueva" class="form-control" id="validationCustom02" placeholder="Ingrese su Nueva Contraseña" required="">
                      <div class="invalid-feedback">
                        Ingrese una nueva contraseña por favor.
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="validationCustom02">Confirme su Nueva Contraseña</label>
                      <input type="text" name="confirm" class="form-control" id="validationCustom02" placeholder="Confirme su Nueva Contraseña" required="">
                      <div class="invalid-feedback">
                        Confirme su nueva contraseña por favor.
                      </div>
                    </div>
                  </div>
                  <input class="btn btn-primary btn-block" name="actualizar_clave" type="submit" value="Actualizar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal Rutas -->
  <?php
  $conti1 = 1;
  $conti2 = 1;
  $conti3 = 1;
  $b = 1; //sirve para asignar un numero a cada modal
  foreach ($rutas as $f_contenido) { //recorre la consulta de rutas
  ?>
    <div class="modal fade" id="datos_ruta<?php echo $b; //imprimo la psicion de cada modal 
                                          ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
          <!--Body-->
          <div class="modal-body mb-0 p-0">
            <div class="modal-header">
              <h2 class="text-uppercase">RUTA <?php echo $f_contenido[2]; ?></h2>
            </div>
            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
              <?php echo $f_contenido[8]; //me trae la posiciion del mapa 
              ?>
            </div>
          </div>
          <!--Esta parte es la tarjeta en la cual estaran los datos acerca de la ruta-->
          <div class="modal-body">
            <div class="card border-dark mb-3 ">
              <div class="card-header bg-transparent border-dark text-center">
                  <form>
                 <p class="clasificacion">
                  <?php 
                   if(intval($f_contenido[9]) == 1) {
                  ?>
                  <input class = "radios" id="radioa" type="radio" name="estrellas" disabled><label for="radioa">★</label>
                  <input class = "radios" id="radiob" type="radio" name="estrellas" disabled><label for="radiob">★</label>
                  <input class = "radios" id="radioc" type="radio" name="estrellas" disabled><label for="radioc">★</label>
                  <input class = "radios" id="radiod" type="radio" name="estrellas" disabled><label for="radiod">★</label>
                  <input class = "radios"id="radioe" type="radio" name="estrellas" disabled checked><label for="radioe">★</label>
                  <?php 
                   } else { 
                    if(intval($f_contenido[9]) == 2){
                  ?>
                  <input class = "radios" id="radioa" type="radio" name="estrellas" disabled><label for="radioa">★</label>
                  <input class = "radios" id="radiob" type="radio" name="estrellas" disabled><label for="radiob">★</label>
                  <input class = "radios" id="radioc" type="radio" name="estrellas" disabled><label for="radioc">★</label>
                  <input class = "radios" id="radiod" type="radio" name="estrellas" disabled checked><label for="radiod">★</label>
                  <input class = "radios" id="radioe" type="radio" name="estrellas" disabled><label for="radioe">★</label>
                  <?php 
                    } else { 
                    if(intval($f_contenido[9]) == 3){
                  ?>
                  <input class = "radios" id="radioa" type="radio" name="estrellas" disabled><label for="radioa">★</label>
                  <input class = "radios" id="radiob" type="radio" name="estrellas" disabled><label for="radiob">★</label>
                  <input class = "radios" id="radioc" type="radio" name="estrellas" disabled checked><label for="radioc">★</label>
                  <input class = "radios" id="radiod" type="radio" name="estrellas" disabled><label for="radiod">★</label>
                  <input class = "radios" id="radioe" type="radio" name="estrellas" disabled><label for="radioe">★</label>
                  <?php
                     } else { 
                    if(intval($f_contenido[9]) == 4){
                  ?>
                  <input class = "radios" id="radioa" type="radio" name="estrellas" disabled><label for="radioa">★</label>
                  <input class = "radios" id="radiob" type="radio" name="estrellas" disabled checked><label for="radiob">★</label>
                  <input class = "radios" id="radioc" type="radio" name="estrellas" disabled><label for="radioc">★</label>
                  <input class = "radios" id="radiod" type="radio" name="estrellas" disabled><label for="radiod">★</label>
                  <input class = "radios" id="radioe" type="radio" name="estrellas" disabled><label for="radioe">★</label>
                  <?php
                     } else { 
                    if(intval($f_contenido[9]) == 5){
                  ?>
                  <input class = "radios" id="radioa" type="radio" name="estrellas" disabled checked><label for="radioa">★</label>
                  <input class = "radios" id="radiob" type="radio" name="estrellas" disabled><label for="radiob">★</label>
                  <input class = "radios" id="radioc" type="radio" name="estrellas" disabled><label for="radioc">★</label>
                  <input class = "radios" id="radiod" type="radio" name="estrellas" disabled><label for="radiod">★</label>
                  <input class = "radios" id="radioe" type="radio" name="estrellas" disabled><label for="radioe">★</label>
                  <?php
                      }
                     }
                    }
                   } 
                   }
                  ?>
                 </p>
                </form>
                <small>Calificacion promedio de los usuarios</small>
              </div>
              <div class="card-body text-dark">
                <h5 class="card-title">Pasaje</h5>
                <p class="card-text"><?php echo $f_contenido[5]; ?> $</p>
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
              <!-- ////////////////////////////////////////////////////////////////// -->
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
              <button class="btn bg-outline-primary" type="button" data-toggle="collapse" data-target="#comentar<?php echo $b; ?>" aria-expanded="false" aria-controls="collapseExample">
                COMENTARIOS
              </button>
              <div class="collapse" id="comentar<?php echo $b; ?>">
                <div class="accordion" id="acordeonComentario">
                  <div class="card">
                    <div id="empezar_comentar" class="collapse show" aria-labelledby="acavaelnumerodelidllamado" data-parent="#acordeonComentario">
                      <form action="" method="POST">
                         <?php 
                          $envia_comenti = $comentarios->ver_si_califico($f_contenido[0], $llave);
                          if(count($envia_comenti) == 0){
                         ?>
                          <p class = "text-center">
                          <?php 
                           do{ 
                            
                          ?>
                           <input class = "radios" id="radio<?php echo $conti2; ?>" type="radio" name="estrellas" value = "<?php echo $conti1; ?>"><label for="radio<?php echo $conti2; ?>">★</label>
                          <?php 
                           $conti1++;
                           $conti2++;
                           } while($conti1 < 6); 
                           $conti1 = 1;
                           $conti3++;
                          ?>
                          <br>
                          <small>Por favor califique la ruta</small>
                          </p>
                          <?php } ?>
                          <input type = "hidden" name = "ruta_coment" value = "<?php echo $f_contenido[0]; ?>">
                        <textarea id="newComentario" class="form-control" name="comentario" style="height: 100px;" placeholder="Escribe aqui tu comentario..."></textarea>

                        <input class="btn btn-success btn-block text-uppercase" type="submit" name="comentar" value="enviar">
                      </form>
                      <div class="card border-primary">
                        <?php 
                         $mostrar_comentarios = $consulta->comentarios_de_ruta($f_contenido[0]);
                         foreach ($mostrar_comentarios as $coment) { // aca muestro los comentarios ya realizados 
                        ?>
                          <div class="card-header">
                            <header style="font-size: 12px;">
                              <?php echo $coment[0] . ": comentado el " . $coment[6]; ?>
                            </header>
                          </div>
                          <div class="card-body text-primary">
                            <p style="color:black;">
                              <?php echo $coment[8]; // aca se muestra el comentario que esta en la bd
                              ?>
                            </p>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ///// Fin comentarios ////////////////// -->

          </div>
          <button type="button" class="btn btn-outline-primary btn-rounded btn-block" data-dismiss="modal">cerrar</button>
        </div>
      </div>
    </div>
    </div>
  <?php
    $b++; //el numero del modal se autincrementa
  }
  ?>

 <!-- estos hipervinculos son especiales para la iniciacion del toast !!!NO TOCAR¡¡¡ -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////// -->

    <?php

    if ($cantidad > 0) {
      echo "
      <script type='text/javascript'>
       toastr.info('Tiene $cantidad PQR por leer', 'PQR',{
        'progressBar': true,
        'positionClass': 'toast-top-left',
        'timeOut': '5000'
       });
      </script>
     ";
    }

    ?>
<?php
   require_once('View/Views/footer.php');
?>