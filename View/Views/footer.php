<footer class="footer bg-dark text-light">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-4">
        <span class="copyright"><i class="fas fa-copyright"></i> BassyApp 2020, Sena ADSI 1751048</span>
      </div>
      <div class="col-md-4">
        <ul class="list-inline social-buttons">
          <li class="list-inline-item">
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="list-inline-item">
            <a href="#">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </li>
        </ul>
      </div>
      <div class="col-md-4">
        <ul class="list-inline quicklinks politics">
          <li class="list-inline-item">
            <a class="aFooter text-light" href="#">
              <i class="fas fa-balance-scale politicas"></i>
              Politicas de Privacidad
            </a>
          </li>
          <span>&</span>
          <li class="list-inline-item">
            <a class="aFooter text-light" href="#">
              Terminos de uso
              <i class="fas fa-tasks terminos"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<button class="btn btn-primary btn-block" onClick="alerta()" type="button">alert</button>

<!-- libreria Sweet Alert 2 -->
<script src="View\js\sweetalert2.all.min.js"></script>
<script>
function alerta(){
  Swal.fire({
    icon: 'success',
    title: 'example',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true
  }
  )
}
</script>
<!-- Nucleo JavaScript de Bootstrap y JQuery -->

<script src="View/js/jquery.min.js"></script>
<script src="View/js/bootstrap.bundle.min.js"></script>
<!-- Plugin JavaScript -->
<script src="View/js/jquery.easing.min.js"></script>
<!-- Script para la plantilla -->
<script src="View/js/agency.js"></script>
<script src="View/js/index.js"></script>
</body>

</html>