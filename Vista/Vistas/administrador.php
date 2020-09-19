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
              <!-- detalles de la ventana modal para actualizar datos -->
              <h2 class="text-uppercase">Actualizar Datos Personales</h2>
              <?php foreach ($datos_administrador as $f_adm) { ?>
                <img id="imagenes" class="img-fluid rounded-circle" style = "width: 15rem; height: 15rem;" src="View/img/imgAdmin/<?php echo $f_adm[8]; ?>" alt="Imagen de perfil">
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
                  <label for="validationCustom01"> Nombre: </label>
                  <input type="text" class="form-control" id="validationCustom01" pattern="[a-zA-Z]+" name="nombre_admin" value="<?php echo $f_adm[1]; ?>">
                </div>
                <!--Apellido administrador -->
                <div class="col-md-12">
                  <label for="validationCustom01"> Apellido:</label>
                  <input type="text" class="form-control" id="validationCustom01" pattern="[a-zA-Z]+" name="apellido_admin" value="<?php echo $f_adm[2]; ?>">
                  <div class="invalid-feedback">
                    Ingrese Su Apellido Por Favor.
                  </div>
                </div>
                <!-- Telefono-->
                <div class="col-md-12">
                  <label for="validationCustom01"> Telefono:</label>
                  <input type="text" class="form-control" id="validationCustom01" pattern="[0-9]+" name="telefono_admin" value="<?php echo $f_adm[3]; ?>">
                </div>
              <?php } ?>
              </div>
          </div>
          <input class="btn btn-primary" type="submit" name="actualizar_admin" value="Actualizar Datos">
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
                    <!-- otra clase para los password  contraseña antigua-->
                    <div class="form-group col-md-12">
                      <label for="validationCustom02"> Contraseña Actual</label>
                      <input type="text" class="form-control" name="actual" id="validationCustom02" placeholder="Escriba su contraseña" required="">
                      <div class="invalid-feedback">
                        Ingrese su contraseña por favor.
                      </div>
                    </div>
                    <!-- validacion de la nueva contraseña -->
                    <div class="form-group col-md-12">
                      <label for="validationCustom02">Nueva Contraseña</label>
                      <input type="text" class="form-control" name="nueva" id="validationCustom02" placeholder="Ingrese su Nueva Contraseña" required="">
                      <div class="invalid-feedback">
                        Ingrese una nueva contraseña por favor.
                      </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="validationCustom02">Confirme su Nueva Contraseña</label>
                      <input type="text" class="form-control" name="confirm" id="validationCustom02" placeholder="Confirme su Nueva Contraseña" required="">
                      <div class="invalid-feedback">
                        Por favor confirme la contraseña
                      </div>
                    </div>
                  </div>
                  <input class="btn btn-primary" type="submit" name="actualizar_clave" value="Actualizar">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-heading text-uppercase">administrador</div>
      </div>
    </div>
  </header>
  <!-- administradores -->
  <?php if ($llave == "carlos@gmail.com" || $llave == "duvan@gmail.com") { ?>
    <section class="page-section">
      <div class="container">
        <div class="col-lg-12 text-center">
          <h2 class="text-uppercase">ADMINISTRADORES</h2>
          <h5>Aqui podra otorgar el acceso al rol administrador</h5>
        </div>
        <form class="mt-5" action = "" method = "POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="correo">Email</label>
              <input type="email" class="form-control" name="correo_admin_insert" id="correo" placeholder="correo@empresa.com" required>
            </div>
            <div class="form-group col-md-6">
              <label for="telefono">Telefono/Celular</label>
              <input type="tel" class="form-control" name="telefono_admin_insert" id="telefono" pattern="[0-9]+" placeholder="fijo o celular" required>
            </div>
            <div class="form-group col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control" name="nombre_admin_insert" id="nombre" pattern="[a-zA-Z]+" placeholder="Nombre completo" required>
            </div>
            <div class="form-group col-md-6">
              <label for="apellido">Apellido</label>
              <input type="text" class="form-control" name="apellido_admin_insert" id="apellido" pattern="[a-zA-Z]+" placeholder="Apellido" required>
            </div>
            <div class="form-group col-md-12">
              <label for="contrasena">Clave</label>
              <input type="text" class="form-control" name="contrasena_admin_insert" id="contrasena" placeholder="Letras y numeros" required>
            </div>
          </div>
          <input class="btn btn-danger btn-block text-uppercase" type="submit" name="nuevo_admin" value="otorgar permiso">
        </form>
      </div>
    </section>
    <section class="">
      <h2 class="text-center">ADMINISTRADORES</h2>
      <h5 class="text-center">Aqui podra actualizar el estado de cada administrador y sus datos personales</h5>
      <div class="container mt-5">
        <div class="accordion" id="acordionAdministradores">
          <?php
          $x = 1;
          foreach ($general_admins as $f_admins) {
          ?>
            <button class="btn btn-block botonAdmin" type="button" data-toggle="collapse" data-target="#infoAdmin<?php echo $x; ?>" aria-expanded="true">
              <?php echo "$f_admins[1] $f_admins[2]"; ?>
            </button>
            <div id="infoAdmin<?php echo $x; ?>" class="collapse hide" data-parent="#acordionAdministradores">
              <div class="container">
                <form class="needs-validation" novalidate action="" method="POST">
                  <div class="form-row">
                    <div class="col-md-4 mb-4">
                      <label for="correo_admin_actu<?php echo $x; ?>">Correo</label>
                      <input type="email" class="form-control" value="<?php echo $f_admins[0]; ?>" name="correo_admin_actu" id="correo_admin_actu<?php echo $x; ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="rol_admin_actu<?php echo $x; ?>">Rol</label>
                      <input type="text" class="form-control" value="<?php echo $f_admins[6]; ?>" name="rol_admin_actu" id="rol_admin_actu<?php echo $x; ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="estado_admin_actu<?php echo $x; ?>">Estado</label>
                      <select class="form-control" name="estado_admin_actu" id="estado_admin_actu<?php echo $x; ?>">
                        <option value="<?php echo $f_admins[7]; ?>"> <?php echo $f_admins[7]; ?> </option>
                        <?php if ($f_admins[7] == "Activo") { ?>
                          <option value="Suspendido"> Suspendido </option>
                        <?php } else { ?>
                          <option value="Activo"> Activo </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="nombre_admin_actu<?php echo $x; ?>">Nombre</label>
                      <input type="text" class="form-control" value="<?php echo $f_admins[1]; ?>" name="nombre_admin_actu" id="nombre_admin_actu<?php echo $x; ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="apellido_admin_actu<?php echo $x; ?>">Apellido</label>
                      <input type="text" class="form-control" value="<?php echo $f_admins[2]; ?>" name="apellido_admin_actu" id="apellido_admin_actu<?php echo $x; ?>" readonly>
                    </div>
                    <div class="col-md-4 mb-4">
                      <label for="telefono_admin_actu<?php echo $x; ?>">Telefono</label>
                      <input type="tel" class="form-control" value="<?php echo $f_admins[3]; ?>" name="telefono_admin_actu" id="telefono_admin_actu<?php echo $x; ?>" readonly>
                    </div>
                  </div>
                  <input id="adminsUpdate" class="btn btn-warning btn-block" name="actualizar_admins" type="submit" value="Actualizar Estado">
                </form>
              </div>
            </div>
          <?php
            $x++;
          }
          ?>
        </div>
      </div>
    <?php } ?>
    <div class="container mt-5">
      <h2 class="text-center text-uppercase">usuarios</h2>
      <h5 class="text-center">Podra actualizar el estado del usuario y ver los datos del mismo</h5>
      <!--  busqueda -->
      <form action="" method="POST">
        <div class="col-6 input-group container mt-5">
          <input type="search" class="form-control" id="consulta" placeholder="Busqueda por nombre, apellido, Email, estado" name="search_cli" value="">
          <div class="input-group-prepend">
            <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar_cli" value="Buscar">
          </div>
        </div>
      </form>
      <div class="accordion mt-5" id="acordionUsuarios">
        <?php
        $y = 1;
        foreach ($general_pas as $f_pasa) {
        ?>
          <button class="btn btn-block botonAdmin" type="button" data-toggle="collapse" data-target="#infoPasajero<?php echo $y; ?>" aria-expanded="true">
            <?php echo "$f_pasa[1] $f_pasa[2]"; ?>
          </button>
          <div id="infoPasajero<?php echo $y; ?>" class="collapse hide" data-parent="#acordionUsuarios">
            <div class="container">
              <form class="needs-validation" novalidate method="POST">
                <div class="form-row">
                  <div class="col-md-4 mb-4">
                    <label for="estado_actu_pas<?php echo $y; ?>">Estado</label>
                    <select class="form-control" name="estado_actu_pas" id="estado_actu_pas<?php echo $y; ?>">
                      <option value="<?php echo $f_pasa[6]; ?>"> <?php echo $f_pasa[6]; ?> </option>
                      <?php if ($f_pasa[6] == "Activo") { ?>
                        <option value="Suspendido"> Suspendido </option>
                      <?php } else { ?>
                        <option value="Activo"> Activo </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label for="nombre_actu_pas<?php echo $y; ?>">Nombre</label>
                    <input type="text" class="form-control" name="nombre_actu_pas" value="<?php echo $f_pasa[1]; ?>" id="nombre_actu_pas<?php echo $y; ?>" readonly>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label for="apellido_actu_pas<?php echo $y; ?>">Apellido</label>
                    <input type="text" class="form-control" name="apellido_actu_pas" value="<?php echo $f_pasa[2]; ?>" id="apellido_actu_pas<?php echo $y; ?>" readonly>
                  </div>
                  <div class="col-md-8 mb-8">
                    <label for="correo_actu_pas<?php echo $y; ?>">Correo</label>
                    <input type="email" class="form-control" name="correo_actu_pas" value="<?php echo $f_pasa[0]; ?>" id="correo_actu_pas<?php echo $y; ?>" readonly>
                  </div>
                  <div class="col-md-4 mb-4">
                    <label for="rol_actu_pas<?php echo $y; ?>">Rol</label>
                    <input type="text" class="form-control" name="rol_actu_pas" value="<?php echo $f_pasa[5]; ?>" id="rol_actu_pas<?php echo $y; ?>" readonly>
                  </div>
                </div>
                <input class="btn btn-block btn-warning" type="submit" name="actualizar_pasajero" value="Actualizar Estado">
              </form>
            </div>
          </div>
        <?php
        $y++;
        }
        ?>
      </div>
    </div>
    </div>
    </div>
    </section>

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
       toastr.info('Tiene $cantidad PQR por responder', 'PQR',{
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