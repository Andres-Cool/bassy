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
            <a class="nav-link js-scroll-trigger" href="admin.php">Principal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="rutas.php">Rutas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="asignar.php">Asignar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="buses.php">Buses</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="conductor.php">Conductores</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="informes.php">Informes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="pqrs.php">PQR'S</a>
          </li>
          <!-- lista de los ajustes del perfil -->
          <div class="dropdown">
            <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-fw fa-cog"></i>
              Ajustes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item " class="portfolio-link" data-toggle="modal" href="#ajusteperfil"><i class="fas fa-user-edit"></i> Actualizar Perfil </a>
              <a class="dropdown-item" class="portfolio-link" data-toggle="modal" href="#ajustecontraseña"><i class="fas fa-key"></i> Cambiar Contraseña</a>
              <form action="Controler/c_login.php" method="POST">
                <button class="dropdown-item" type="submit" name="cerrar"><i class="fas fa-sign-out-alt"></i> CERRAR SESION</button>
              </form>
            </div>
          </div>
        </ul>
      </div>
    </div>
  </nav>
  <!-- AJustes ventana modal desplegada Actualizar Datos -->
  <!-- Modal ajuste de perfil -->
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
                <?php foreach ($datos_administrador as $f_adm) { ?>
                  <div>
                    <img id="imagenes" class="img-fluid d-block mx-auto" src="View/img/imgAdmin/<?php echo $f_adm[8]; ?>" alt="">
                  </div>
                  <form class="needs-validation" novalidate enctype="multipart/form-data" method="POST">
                    <input type="file" accept="image/jpeg, image/png" name="foto_admin">
                    <input type="hidden" name="foto_repuesto" value="<?php echo $f_adm[8]; ?>">
                    <div class="form-row">
                      <!-- formulario para el correo electronico-->
                      <div class="form-group col-md-12">
                        <label for="validationCustomUsername">Email</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                          </div>
                          <input type="email" class="form-control" id="validationCustomUsername" placeholder="Email" aria-describedby="inputGroupPrepend" name="correo_admin" value="<?php echo $f_adm[0]; ?>" readonly="">
                        </div>
                      </div>
                      <!--  Nombre administrador -->
                      <div class="col-md-12">
                        <label for="nombre"> Nombre: </label>
                        <input type="text" class="form-control" id="nombre" pattern="[a-zA-Z]+" name="nombre_admin" value="<?php echo $f_adm[1]; ?>">
                      </div>
                      <!--Apellido administrador -->
                      <div class="col-md-12">
                        <label for="apellido"> Apellido:</label>
                        <input type="text" class="form-control" id="apellido" pattern="[a-zA-Z]+" name="apellido_admin" value="<?php echo $f_adm[2]; ?>">
                      </div>
                      <!-- Telefono-->
                      <div class="col-md-12">
                        <label for="telefono"> Telefono:</label>
                        <input type="tel" class="form-control" id="telefono" pattern="[0-9]+" name="telefono_admin" value="<?php echo $f_adm[3]; ?>">
                      </div>
                    <?php } ?>
                    </div>
              </div>
              <input class="btn btn-warning btn-block" type="submit" name="actualizar_admin" value="Actualizar Datos">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ajustes para el cambio de contraseña -->
  <!-- Modal Contraseña-->
  <div class="portfolio-modal modal fade" id="ajustecontraseña" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form class="needs-validation" novalidate method="POST">
                  <div class="form-row">
                    <!-- otra clase para los pasword  contraseña antigua-->
                    <div class="form-group col-md-12">
                      <label for="actual"> Contraseña Actual</label>
                      <input type="text" class="form-control" name="actual" id="actual" placeholder="Escriba su contraseña" required>
                    </div>
                    <!-- validacion de la nueva contraseña -->
                    <div class="form-group col-md-12">
                      <label for="nueva">Nueva Contraseña</label>
                      <input type="text" class="form-control" name="nueva" id="nueva" placeholder="Ingrese su Nueva Contraseña" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="confirmar">Confirme su Nueva Contraseña</label>
                      <input type="text" class="form-control" name="confirm" id="confirmar" placeholder="Confirme su Nueva Contraseña" required>
                    </div>
                  </div>
                  <input class="btn btn-warning btn-block" type="submit" name="actualizar_clave" value="Actualizar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>