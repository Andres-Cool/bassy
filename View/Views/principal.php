<?php
require_once('cabezera.php');
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
            <a class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#login">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Bienvenido a nuestra Web</div>
        <div class="intro-heading text-uppercase">Para nosotros es grato tenerte cerca</div>
        <button class="btn bg-success" type="button" data-toggle="modal" data-target="#video" aria-expanded="false" aria-controls="collapseExample"> VER VIDEO </button>
      </div>
    </div>
  </header>


   <div class="portfolio-modal modal fade" id="video" tabindex="-1" role="dialog" aria-hidden="true">
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
                <h2 class="text-uppercase"> VIDEO EXPLICATIVO </h2>
                  <div class="form-row">
                    <!-- otra clase para los pasword  contraseña antigua-->
                    <div class="modal-body">
                     <iframe width="560" height="315" src="https://www.youtube.com/embed/wmkl1lugfoM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Grid -->
  <section class="bg-light page-section" id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Rutas</h2>
          <h3 class="section-subheading text-muted">Poseemos gran cobertura a nivel departamental, destacandonos por nuestro servicio de calidad y sobre todo por nuestra puntualidad.</h3>
        </div>
      </div>
      <div class="card-columns">
        <?php
        $a = 1; //contador para poder llamar a los modales
        foreach ($rutas as $f_ruta) { //sirve para que me recorra el areglo que tiene la consulta de las rutas.
        ?>
          <div class="card portfolio-item">
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
              <p class="text-muted"><?php echo $f_ruta[4]; ?></p>
            </div>
          </div>
        <?php
          $a++; //se incrementa el contador del modal
        }
        ?>
      </div>
    </div>
  </section>



  <!-- Login Modal -->

  <div class="modal-fade">
    <div class="modal" id="login">
      <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
          <!-- modal header -->
          <div class="modal-header">
            <h4 class="modal-title">Iniciar Sesion</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <!-- modal body -->
          <form action="Controler/c_login.php" method="POST">
            <div class="modal-body">
              <label for="user">Correo: </label>
              <input type="email" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu correo" id="user" name="email" required>
              <label for="clave">Password: </label>
              <div class="input-group">
                <input type="password" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu clave" id="clave" name="contrasena" required>
                <div class="input-group-append">
                  <button id="VerPassword" class="btn btn-primary" type="button" onclick="mostrarPassword();"> <span class="fa fa-eye-slash icon"></span> </button>
                </div>
              </div>
            </div>
            <input type="submit" class="btn btn-success btn-lg btn-block" name="ingresar" value="INGRESAR">
          </form>

          <form id = "registerForm" action="" method="POST" enctype="multipart/form-data">
            <p style="font-size:15px;">No estas registrado?
              <a data-toggle="collapse" href="#register" aria-expanded="false" aria-controls="register" style="font-size:15px;">
                Registrate aqui!
              </a>
            </p>
            <div class="collapse" id="register">
              <div class="card card-body">
                <label for="nombre">Nombre * </label>
                <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu nombre" id="newName" name="nombre" pattern="[a-zA-Z]+" required>
                <label for="apellido">Apellido </label>
                <input type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu apellido" id="newLastName" name="apellido">
                <label for="photo">Foto: </label>
                <input type="file" class="form-control" id="newPhoto" name="foto" accept="image/png, image/jpeg">
                <label for="mail">Correo* </label>
                <input type="email" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu correo" id="newEmail" name="mail" required>
                <label for="cla">Clave* </label>
                <div class="input-group">
                  <input type="password" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa tu clave" id="newPassword" name="contrasena" required>
                  <div class="input-group-append">
                    <button id="VerPassword" class="btn btn-primary" type="button" onclick="mostrarPasswordRegistro();"> <span class="fa fa-eye-slash icon"></span> </button>
                  </div>
                </div>
              </div>
              <input type="submit" class="btn btn-outline-primary btn-lg btn-block" name="registrar" id = "sendDataRegister" value="REGISTRAR">
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Portfolio Modals -->


  <!-- Modal 1 -->
  <?php
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
            <div class="modal-header text-center">
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
                  <input class = "radios" id="radio1" type="radio" name="estrellas" disabled><label for="radio1">★</label>
                  <input class = "radios" id="radio2" type="radio" name="estrellas" disabled><label for="radio2">★</label>
                  <input class = "radios" id="radio3" type="radio" name="estrellas" disabled><label for="radio3">★</label>
                  <input class = "radios" id="radio4" type="radio" name="estrellas" disabled><label for="radio4">★</label>
                  <input class = "radios" id="radio5" type="radio" name="estrellas" disabled checked><label for="radio5">★</label>
                  <?php 
                   } else { 
                    if(intval($f_contenido[9]) == 2){
                  ?>
                  <input class = "radios" id="radio1" type="radio" name="estrellas" disabled><label for="radio1">★</label>
                  <input class = "radios" id="radio2" type="radio" name="estrellas" disabled><label for="radio2">★</label>
                  <input class = "radios" id="radio3" type="radio" name="estrellas" disabled><label for="radio3">★</label>
                  <input class = "radios" id="radio4" type="radio" name="estrellas" disabled checked><label for="radio4">★</label>
                  <input class = "radios" id="radio5" type="radio" name="estrellas" disabled><label for="radio5">★</label>
                  <?php 
                    } else { 
                    if(intval($f_contenido[9]) == 3){
                  ?>
                  <input class = "radios" id="radio1" type="radio" name="estrellas" disabled><label for="radio1">★</label>
                  <input class = "radios" id="radio2" type="radio" name="estrellas" disabled><label for="radio2">★</label>
                  <input class = "radios" id="radio3" type="radio" name="estrellas" disabled checked><label for="radio3">★</label>
                  <input class = "radios" id="radio4" type="radio" name="estrellas" disabled><label for="radio4">★</label>
                  <input class = "radios" id="radio5" type="radio" name="estrellas" disabled><label for="radio5">★</label>
                  <?php
                     } else { 
                    if(intval($f_contenido[9]) == 4){
                  ?>
                  <input class = "radios" id="radio1" type="radio" name="estrellas" disabled><label for="radio1">★</label>
                  <input class = "radios" id="radio2" type="radio" name="estrellas" disabled checked><label for="radio2">★</label>
                  <input class = "radios" id="radio3" type="radio" name="estrellas" disabled><label for="radio3">★</label>
                  <input class = "radios" id="radio4" type="radio" name="estrellas" disabled><label for="radio4">★</label>
                  <input class = "radios" id="radio5" type="radio" name="estrellas" disabled><label for="radio5">★</label>
                  <?php
                     } else { 
                    if(intval($f_contenido[9]) == 5){
                  ?>
                  <input class = "radios" id="radio1" type="radio" name="estrellas" disabled checked><label for="radio1">★</label>
                  <input class = "radios" id="radio2" type="radio" name="estrellas" disabled><label for="radio2">★</label>
                  <input class = "radios" id="radio3" type="radio" name="estrellas" disabled><label for="radio3">★</label>
                  <input class = "radios" id="radio4" type="radio" name="estrellas" disabled><label for="radio4">★</label>
                  <input class = "radios" id="radio5" type="radio" name="estrellas" disabled><label for="radio5">★</label>
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
                      <div id="subruta<?php echo $c; ?>" class="collapse hide" aria-labelledby="acavaelnumerodelidllamado" data-parent="#acordeonSubruta">
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
              <button class="btn bg-outline-primary" type="button" data-toggle="collapse" data-target="#comentar<?php echo $b; ?>" aria-expanded="false" aria-controls="collapseExample">
                COMENTARIOS
              </button>

              <div class="collapse" id="comentar<?php echo $b; ?>">
                <div class="accordion" id="acordeonComentario">
                  <div class="card">
                    <div id="empezar_comentar" class="collapse show" aria-labelledby="acavaelnumerodelidllamado" data-parent="#acordeonComentario">

                      <div class="card border-primary">
                        <?php 
                         $mostrar_comentarios = $consulta->comentarios_de_ruta($f_contenido[0]);
                         foreach ($mostrar_comentarios as $coment) { // aca muestro los comentarios ya realizados 
                        ?>
                          <div class="card-header">
                              <img src="View/img/imgUser/<?php echo $coment[2]; ?>"  height = "40" width = "40">
                              <?php echo $coment[0] . " " . $coment[1] . " comentado el " . $coment[6] ?>
                          </div>
                          <div class="card-body text-primary">
                            <p style="color:black;">
                              <?php echo $coment[8]; ?>
                            </p>
                          </div>
                        <?php } ?>
                        <button class="btn btn-group-sm btn-outline-danger" type="button" onclick="comentar();">Comentar</button>
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
  <?php
  require_once('footer.php');
  ?>