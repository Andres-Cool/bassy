<?php
require_once('View/Views/cabezera.php');
require_once('View/Views/navbarAdmin.php');
?>
<header class="masthead">
  <div class="container">
    <div class="intro-text">
      <div class="intro-heading text-uppercase">asignar rutas</div>
    </div>
  </div>
</header>
<!-- rutas_bus -->
<section class="page-section">
  <div class="container">
    <div class="text-center">
      <h2 class="text-uppercase">ASIGNAR BUSES <i class="fa fa-bus"></i></h2>
      <h5>Aqui podra asignar el cronograma semanal de un bus en una ruta</h5>
    </div>
    <form class="needs-validation" novalidate action="" method="POST">
      <div class="form-row my-5">
        <div class="col-md-6 mb-3">
          <label class="col-md-12" for="ruta_in">Ruta</label>
          <select class="form-control" id="ruta_in" name="ruta_in">
            <?php foreach ($rutas as $f_ruta) { ?>
              <option value="<?php echo $f_ruta[0]; ?>"> <?php echo "$f_ruta[0] $f_ruta[2]"; ?> </option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-6 mb-3">
          <label class="col-md-12" for="bus_in">Bus</label>
          <select class="form-control" id="bus_in" name="bus_in">
            <?php foreach ($bus_general as $f_bus) { ?>
              <option value="<?php echo $f_bus[0]; ?>"> <?php echo $f_bus[0]; ?> </option>
            <?php } ?>
          </select>
        </div>
      </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="text-uppercase">Horario <i class="fa fa-clock"></i></h2>
        <h5>Seleccione los turnos de la semana que tomara la ruta del vehiculo</h5>
      </div>
    </div>
    <div class="form-row">
      <?php
      $febrero = 1;
      $marzo = 1;
      $abril = 1;
      $mayo = 1;
      $junio = 1;
      $julio = 1;
      $agosto = 1;
      $septiembre = 1;
      $octubre = 1;
      $noviembre = 1;
      $diciembre = 1;
      for ($i = 1; $i < 8; $i++) {
        $año_num = date("20y");
        $mes_num = date("m");
        $dia_num = date("d") + $i;
        $fmt_dia = str_pad($dia_num, 2, "0", STR_PAD_LEFT);
        $hoy = $año_num . "-" . $mes_num . "-" . $fmt_dia;
        $mes_num2 = date("m") + 1;
        $fmt_mes = str_pad($mes_num2, 2, "0", STR_PAD_LEFT);
        if ($mes_num == 1 && $dia_num > 31) {
          $fmt_febrero = str_pad($febrero, 2, "0", STR_PAD_LEFT);
          $hoy2 = $año_num . "-" . $fmt_mes . "-" . $fmt_febrero;
          $febrero++;
      ?>
          <div class="col-md-3 mb-3">
            <label for="fecha_h<?php echo $i; ?>">Fecha</label>
            <input type="date" value="<?php echo $hoy2; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
          </div>
          <div class="col-md-3 mb-3">
            <label for="turno_h<?php echo $i; ?>">Turno</label>
            <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
              <!-- lo mismo genero los name y id con la variable i -->
              <option value="Diurno"> Diurno </option>
              <option value="Noche"> Noche </option>
            </select>
          </div>
          <?php
        } else {
          if ($mes_num == 2 && $dia_num > 29) {
            $fmt_marzo = str_pad($marzo, 2, "0", STR_PAD_LEFT);
            $hoy3 = $año_num . "-" . $fmt_mes . "-" . $fmt_marzo;
            $marzo++;

          ?>
            <div class="col-md-3 mb-3">
              <label for="fecha_h<?php echo $i; ?>">Fecha</label>
              <input type="date" value="<?php echo $hoy3; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
            </div>
            <div class="col-md-3 mb-3">
              <label for="turno_h<?php echo $i; ?>">Turno</label>
              <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                <!-- lo mismo genero los name y id con la variable i -->
                <option value="Diurno"> Diurno </option>
                <option value="Noche"> Noche </option>
              </select>
            </div>
            <?php
          } else {
            if ($mes_num == 3 && $dia_num > 31) {
              $fmt_abril = str_pad($abril, 2, "0", STR_PAD_LEFT);
              $hoy4 = $año_num . "-" . $fmt_mes . "-" . $fmt_abril;
              $abril++;

            ?>
              <div class="col-md-3 mb-3">
                <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                <input type="date" value="<?php echo $hoy4; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
              </div>
              <div class="col-md-3 mb-3">
                <label for="turno_h<?php echo $i; ?>">Turno</label>
                <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                  <!-- lo mismo genero los name y id con la variable i -->
                  <option value="Diurno"> Diurno </option>
                  <option value="Noche"> Noche </option>
                </select>
              </div>
              <?php
            } else {
              if ($mes_num == 4 && $dia_num > 30) {
                $fmt_mayo = str_pad($mayo, 2, "0", STR_PAD_LEFT);
                $hoy5 = $año_num . "-" . $fmt_mes . "-" . $fmt_mayo;
                $mayo++;
              ?>
                <div class="col-md-3 mb-3">
                  <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                  <input type="date" value="<?php echo $ho5; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                </div>
                <div class="col-md-3 mb-3">
                  <label for="turno_h<?php echo $i; ?>">Turno</label>
                  <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                    <!-- lo mismo genero los name y id con la variable i -->
                    <option value="Diurno"> Diurno </option>
                    <option value="Noche"> Noche </option>
                  </select>
                </div>
                <?php
              } else {
                if ($mes_num == 5 && $dia_num > 31) {
                  $fmt_junio = str_pad($junio, 2, "0", STR_PAD_LEFT);
                  $hoy6 = $año_num . "-" . $fmt_mes . "-" . $fmt_junio;
                  $junio++;
                ?>
                  <div class="col-md-3 mb-3">
                    <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                    <input type="date" value="<?php echo $hoy6; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="turno_h<?php echo $i; ?>">Turno</label>
                    <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                      <!-- lo mismo genero los name y id con la variable i -->
                      <option value="Diurno"> Diurno </option>
                      <option value="Noche"> Noche </option>
                    </select>
                  </div>
                  <?php
                } else {
                  if ($mes_num == 6 && $dia_num > 30) {
                    $fmt_julio = str_pad($julio, 2, "0", STR_PAD_LEFT);
                    $hoy7 = $año_num . "-" . $fmt_mes . "-" . $fmt_julio;
                    $julio++;
                  ?>
                    <div class="col-md-3 mb-3">
                      <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                      <input type="date" value="<?php echo $hoy7; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="turno_h<?php echo $i; ?>">Turno</label>
                      <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                        <!-- lo mismo genero los name y id con la variable i -->
                        <option value="Diurno"> Diurno </option>
                        <option value="Noche"> Noche </option>
                      </select>
                    </div>
                    <?php
                  } else {
                    if ($mes_num == 7 && $dia_num > 31) {
                      $fmt_agosto = str_pad($agosto, 2, "0", STR_PAD_LEFT);
                      $hoy8 = $año_num . "-" . $fmt_mes . "-" . $fmt_agosto;
                      $agosto++;
                    ?>
                      <div class="col-md-3 mb-3">
                        <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                        <input type="date" value="<?php echo $hoy8; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                      </div>
                      <div class="col-md-3 mb-3">
                        <label for="turno_h<?php echo $i; ?>">Turno</label>
                        <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                          <!-- lo mismo genero los name y id con la variable i -->
                          <option value="Diurno"> Diurno </option>
                          <option value="Noche"> Noche </option>
                        </select>
                      </div>
                      <?php
                    } else {
                      if ($mes_num == 8 && $dia_num > 31) {
                        $fmt_septiembre = str_pad($septiembre, 2, "0", STR_PAD_LEFT);
                        $hoy9 = $año_num . "-" . $fmt_mes . "-" . $fmt_septimbre;
                        $septiembre++;
                      ?>
                        <div class="col-md-3 mb-3">
                          <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                          <input type="date" value="<?php echo $hoy9; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="turno_h<?php echo $i; ?>">Turno</label>
                          <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                            <!-- lo mismo genero los name y id con la variable i -->
                            <option value="Diurno"> Diurno </option>
                            <option value="Noche"> Noche </option>
                          </select>
                        </div>
                        <?php
                      } else {
                        if ($mes_num == 9 && $dia_num > 30) {
                          $fmt_octubre = str_pad($octubre, 2, "0", STR_PAD_LEFT);
                          $hoy10 = $año_num . "-" . $fmt_mes . "-" . $fmt_octubre;
                          $octubre++;
                        ?>
                          <div class="col-md-3 mb-3">
                            <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                            <input type="date" value="<?php echo $hoy10; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                          </div>
                          <div class="col-md-3 mb-3">
                            <label for="turno_h<?php echo $i; ?>">Turno</label>
                            <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                              <!-- lo mismo genero los name y id con la variable i -->
                              <option value="Diurno"> Diurno </option>
                              <option value="Noche"> Noche </option>
                            </select>
                          </div>
                          <?php
                        } else {
                          if ($mes_num == 10 && $dia_num > 31) {
                            $fmt_noviembre = str_pad($septiembre, 2, "0", STR_PAD_LEFT);
                            $hoy11 = $año_num . "-" . $fmt_mes . "-" . $fmt_noviembre;
                            $noviembre++;
                          ?>
                            <div class="col-md-3 mb-3">
                              <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                              <input type="date" value="<?php echo $hoy11; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                            </div>
                            <div class="col-md-3 mb-3">
                              <label for="turno_h<?php echo $i; ?>">Turno</label>
                              <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                                <!-- lo mismo genero los name y id con la variable i -->
                                <option value="Diurno"> Diurno </option>
                                <option value="Noche"> Noche </option>
                              </select>
                            </div>
                            <?php
                          } else {
                            if ($mes_num == 11 && $dia_num > 30) {
                              $fmt_diciembre = str_pad($marzo, 2, "0", STR_PAD_LEFT);
                              $hoy12 = $año_num . "-" . $fmt_mes . "-" . $fmt_diciembre;
                              $diciembre++;
                            ?>
                              <div class="col-md-3 mb-3">
                                <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                                <input type="date" value="<?php echo $hoy12; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="turno_h<?php echo $i; ?>">Turno</label>
                                <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                                  <!-- lo mismo genero los name y id con la variable i -->
                                  <option value="Diurno"> Diurno </option>
                                  <option value="Noche"> Noche </option>
                                </select>
                              </div>
                            <?php
                            } else {
                            ?>
                              <div class="col-md-3 mb-3">
                                <label for="fecha_h<?php echo $i; ?>">Fecha</label>
                                <input type="date" value="<?php echo $hoy; ?>" class="form-control" name="fecha_h<?php echo $i; ?>" id="fecha_h<?php echo $i; ?>"><!-- genero los name y los id con la variable i -->
                              </div>
                              <div class="col-md-3 mb-3">
                                <label for="turno_h<?php echo $i; ?>">Turno</label>
                                <select class="form-control" name="turno_h<?php echo $i; ?>" id="turno_h<?php echo $i; ?>">
                                  <!-- lo mismo genero los name y id con la variable i -->
                                  <option value="Diurno"> Diurno </option>
                                  <option value="Noche"> Noche </option>
                                </select>
                              </div>
      <?php
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
      ?>
      <div class="clearfix"></div>
      <div class="col-lg-12 text-center">
        <div id="success"></div>
        <input class="btn btn-success btn-block" type="submit" name="confirm_horario" value="ASIGNAR BUS">
      </div>
    </div>
    </form>
  </div>
</section>

<div class="col-12 text-center">
  <h2 class="text-uppercase">SUB-RUTAS</h2>
  <h5>Aqui podra gestionar las sub-rutas de una ruta</h5>
</div>
<!-- Busqueda/filtro de rutas -->
<form action="" method="POST">
  <div class="col-6 input-group container mt-5">
    <input type="search" class="form-control" id="consulta" placeholder="Busqueda por ruta, nombre, costo" name="search_ruta" value="">
    <div class="input-group-prepend">
      <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar_ruta" value="Buscar Ruta">
    </div>
  </div>
</form>
<!-- vista de rutas actuales [update and delete] ============================================================ -->
<section class="page-section">
  <div class="container">
    <div class="row">
      <?php
      $h = 0;
      foreach ($rutas as $f_sub_rut) {
      ?>
        <div class="col-lg-3 col-md-6 col-sm-12 my-3">
          <div class="card cardDeleteAdd  bg-dark text-light">
            <div class="card-header card-title text-center text-uppercase"><?php echo $f_sub_rut[2]; ?></div>
            <div class="card-body text-light">
              <h5 class="text-center"> Sub Rutas <i class="fas fa-walking"></i></h5>
              <?php
              $subruta_en_ruta = $sub_rut_ruta->subruta_de_ruta($f_sub_rut[0]);
              foreach ($subruta_en_ruta as $f_asig) {
              ?>
                <label class="card-text text-lowercase"><?php echo $f_asig[1]; ?></label><br>
              <?php } ?>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#quitarsub<?php echo $h; ?>">Quitar <i class="fas fa-minus-circle"></i></button>
              <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#agregarsub<?php echo $h; ?>">Agregar <i class="fas fa-pen-alt"></i><i></i></button>
            </div>
          </div>
        </div>
      <?php
        $h++;
      }
      ?>
    </div>

    <!-- Modal quitar-->
    <?php
    $i = 0;
    foreach ($rutas as $f_sub_rut) {
      $i2 = 0;
    ?>
      <div class="modal fade" id="quitarsub<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalCenterTitle">Sub Rutas Agregadas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
              <input type="hidden" name="ruta_dni_sub" value="<?php echo $f_sub_rut[0]; ?>">
              <?php
              $subruta_en_ruta = $sub_rut_ruta->subruta_de_ruta($f_sub_rut[0]);
              foreach ($subruta_en_ruta as $f_quitar) {
              ?>
                <div class="modal-body">
                  <input type="checkbox" name="quitar_sub<?php echo $i2; ?>" value="<?php echo $f_quitar[0]; ?>">
                  <label><?php echo $f_quitar[1]; ?></label>
                </div>
              <?php $i2++;
              } ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-danger" name="fuera" value="Quitar">
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
      $i++;
    }
    ?>
    <!-- modal agregar -->
    <?php
    $p = 0;
    foreach ($rutas as $f_sub_rut) {
      $p2 = 0;
    ?>
      <div class="modal fade" id="agregarsub<?php echo $p; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalCenterTitle">Sub Rutas Disponibles</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
              <input type="hidden" name="ruta_id_sub" value="<?php echo $f_sub_rut[0]; ?>">
              <?php
              $subruta_no_ruta = $sub_rut_ruta->subruta_disponible($f_sub_rut[0]);
              foreach ($subruta_no_ruta as $f_asig) {
              ?>
                <div class="modal-body">
                  <input type="checkbox" name="agregar_sub<?php echo $p2; ?>" value="<?php echo $f_asig[0]; ?>">
                  <label><?php echo $f_asig[1]; ?></label>
                </div>
              <?php $p2++;
              } ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" name="anadir_subruta" value="Agregar">
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
      $p++;
    }

    ?>

  </div>
</section>

<!-- =================================================================================================-->

<!--========================= SECCION DE PARADEROS CON SUBRUTA -->

<div class="col-12 text-center">
  <h2 class="text-uppercase">PARADEROS</h2>
  <h5>Aqui podra gestionar los paraderos de una sub-ruta</h5>
</div>

<form action="" method="POST">
  <div class="col-6 input-group container mt-5">
    <input type="search" class="form-control" id="consulta" placeholder="Busqueda de sub-rutas por nombre y costo" name="search_subruta" value="">
    <div class="input-group-prepend">
      <input class="btn btn-outline-success text-uppercase" type="submit" name="consultar_subruta" value="Buscar Ruta">
    </div>
  </div>
</form>
<!-- vista de rutas actuales [update and delete] ============================================================ -->
<section class="page-section">
  <div class="container">
    <div class="row">
      <?php
      $l = 0;
      foreach ($subrutas_general as $f_subruta) {
      ?>
        <div class="col-lg-3 col-md-6 col-sm-12 my-3">
          <div class="card cardDeleteAdd bg-dark text-light">
            <div class="card-header card-title text-center text-uppercase"><?php echo $f_subruta[1]; ?></div>
            <div class="card-body text-light">
              <h5 class="text-center"> Paraderos <i class="fas fa-shoe-prints"></i></h5>
              <?php
              $sub_con_para = $sub_para->paradero_con_subruta($f_subruta[0]);
              foreach ($sub_con_para as $f_par) {
              ?>
                <label class="card-text text-lowercase"><?php echo $f_par[1]; ?></label><br>
              <?php } ?>

            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#quitarpar<?php echo $l; ?>">Quitar <i class="fas fa-minus-circle"></i></button>
              <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#agregarpar<?php echo $l; ?>">Agregar <i class="fas fa-pen-alt"></i><i></i></button>
            </div>
          </div>
        </div>
      <?php
        $l++;
      }
      ?>
    </div>

    <!-- Modal quitar-->
    <?php
    $m = 0;
    foreach ($subrutas_general as $f_subruta) {
      $m2 = 0;
    ?>
      <div class="modal fade" id="quitarpar<?php echo $m; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalCenterTitle">Paraderos Agregados</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
              <input type="hidden" name="subruta_id" value="<?php echo $f_subruta[0]; ?>">
              <?php
              $sub_con_para = $sub_para->paradero_con_subruta($f_subruta[0]);
              foreach ($sub_con_para as $f_par) {
              ?>
                <div class="modal-body">
                  <input type="checkbox" name="quitar_par<?php echo $m2; ?>" value="<?php echo $f_par[0]; ?>">
                  <label><?php echo $f_par[1]; ?></label>
                </div>
              <?php $m2++;
              } ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-danger" name="borrar_par" value="Quitar">
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
      $m++;
    }
    ?>

    <!-- modal agregar -->
    <?php
    $n = 0;
    foreach ($subrutas_general as $f_subruta) {
      $n2 = 0;
    ?>
      <div class="modal fade" id="agregarpar<?php echo $n; ?>" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ModalCenterTitle">Paraderos Disponibles</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="" method="POST">
              <input type="hidden" name="subruta_dni" value="<?php echo $f_subruta[0]; ?>">
              <?php
              $sub_sin_para = $sub_para->paradero_sin_subruta($f_subruta[0]);
              foreach ($sub_sin_para as $f_parno) {
              ?>
                <div class="modal-body">
                  <input type="checkbox" name="capturar_par<?php echo $n2; ?>" value="<?php echo $f_parno[0]; ?>">
                  <label><?php echo $f_parno[1]; ?></label>
                </div>
              <?php $n2++;
              } ?>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" class="btn btn-success" name="agregar_par" value="Agregar">
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php
      $n++;
    }
    ?>
  </div>

</section>

<?php
require_once('View/Views/footer.php');
?>