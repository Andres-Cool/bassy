(function($) {
	'use strict'; // Start of use strict

	// Smooth scrolling using jQuery easing
	$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
		if (
			location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
			location.hostname == this.hostname
		) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
			if (target.length) {
				$('html, body').animate(
					{
						scrollTop: target.offset().top - 54,
					},
					1000,
					'easeInOutExpo'
				);
				return false;
			}
		}
	});

	// Closes responsive menu when a scroll trigger link is clicked
	$('.js-scroll-trigger').click(function() {
		$('.navbar-collapse').collapse('hide');
	});

	// Activate scrollspy to add active class to navbar items on scroll
	$('body').scrollspy({
		target: '#mainNav',
		offset: 56,
	});

	// Collapse Navbar
	var navbarCollapse = function() {
		if ($('#mainNav').offset().top > 100) {
			$('#mainNav').addClass('navbar-shrink');
		} else {
			$('#mainNav').removeClass('navbar-shrink');
		}
	};
	// Collapse now if page is not at top
	navbarCollapse();
	// Collapse the navbar when page is scrolled
	$(window).scroll(navbarCollapse);
})(jQuery); // End of use strict

// ===================================== ScriptIndex.js ========================================
// funcion para alerta de comentarios en index
function comentar() {
	Swal.fire({
		title: 'Upps! Inicia sesion o registrate para poder comentar',
		icon: 'error',
		showConfirmButton: false,
		toast: true,
		timer: '2000',
		timerProgressBar: true,
	});
}
function muestraComentario() {
	Swal.fire({
		title: 'Funcion valida para usuarios',
		icon: 'warning',
		showConfirmButton: false,
		toast: true,
		timer: '2000',
		timerProgressBar: true,
	});
}

function rechazado() {
	Swal.fire({
		title: 'Success!',
		icon: 'error',
		text: 'response.scriptstatus',
		type: 'success',
		timer: '10000',
		timerProgressBar: true,
	}).then(function() {
		window.location.href = 'index.php';
	});
}

// =========================================== insercion de datos con fetch ===================

console.log('agency sirve');

// ==================================== INSERCION BUS ===========================================
var formInserBus = document.getElementById('newBus');
// aca le agregamos un evento para que cuando se oprima el boton de entrar y asi ejecutar algo
// la e evita que se haga por defecto el procesado del formulario por el navegador en la parte de la url

formInserBus.addEventListener('submit', function(e) {
	e.preventDefault();
	console.log('boton insercion bus');
	var datos = new FormData(formInserBus); // aca le estamos asignando el formulario al form data

	console.log(datos.get('placa')); // de esta manera accedemos a los datos del formulario enviado al dar click
	console.log(datos.get('marca'));
	console.log(datos.get('modelo'));
	console.log(datos.get('tipo'));

	// fetch por defecto trabaja con metodo GET por eso lo acondicionamos a metodo POST
	// averiguar validaciones para evitar que el formulario se envie vacio
	// fetch trabaja con un parametro obligatorio, este es el link o ubicacion de un archivo o api
	fetch('Modelo/datos_buses.php', {
		method: 'POST',
		body: datos, // LOS DATOS PUEDEN SER `STRING` O {OBJETOS}
	})
		.then((res) => res.json())
		.then((data) => {
			console.log('datos de promesa  ' + data);
			if (data == 'listo papa') {
				Swal.fire({
					title: 'Vehiculo ingresado con exito!',
					icon: 'success',
					showConfirmButton: true,
					allowOutsideClick: false,
					allowEnterKey: false,
					allowEscapeKey: false,
					timer: '5000',
					timerProgressBar: true,
				});
			} else {
				Swal.fire({
					title: 'Este vehiculo ya se encuentra ingresado',
					icon: 'error',
					showConfirmButton: true,
					allowOutsideClick: false,
					allowEnterKey: false,
					allowEscapeKey: false,
					timer: '5000',
					timerProgressBar: true,
				});
			}
		});
});

// ==========================================================================================================

// valida los campos para que tengan que rellenarse todos y ademas les da un color de acuerdo a su estado
(function() {
	'use strict';
	window.addEventListener(
		'load',
		function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener(
					'submit',
					function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					},
					false
				);
			});
		},
		false
	);
})();

//  valida los tooltips para que al pasar el mouse por encima de los inputs  me muestre un mensaje de que debo hacer en ese campo

$(function() {
	$('[data-toggle="tooltip"]').tooltip();
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('#example').tooltip({ boundary: 'window' });

///////////////////////////////////////////////////////////////////////////////////////////////////////
// Funcion para mostrar contraseña en en login
function mostrarPassword() {
	var cambio = document.getElementById('clave');
	if (cambio.type == 'password') {
		cambio.type = 'text';
		$('.icon')
			.removeClass('fa fa-eye-slash')
			.addClass('fa fa-eye');
	} else {
		cambio.type = 'password';
		$('.icon')
			.removeClass('fa fa-eye')
			.addClass('fa fa-eye-slash');
	}
}
//uso de JQuery
$(document).ready(function() {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function() {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});

function mostrarPasswordRegistro() {
	var cambio = document.getElementById('cla');
	if (cambio.type == 'password') {
		cambio.type = 'text';
		$('.icon')
			.removeClass('fa fa-eye-slash')
			.addClass('fa fa-eye');
	} else {
		cambio.type = 'password';
		$('.icon')
			.removeClass('fa fa-eye')
			.addClass('fa fa-eye-slash');
	}
}
//uso de JQuery
$(document).ready(function() {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function() {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});

// =============================================================================================================
// ================================================= Script_Acordeon.js ===========================================
$(document).ready(function() {
	$('.datos').hide();
	$('.titulos').click(function() {
		var pos = $('.titulos').index(this);
		var asig = $('.datos').eq(pos);
		$(asig).slideToggle();
	});
});
// ==============================================================================================================
// =============================================== JavaScript.js ================================================

//valida los campos para que tengan que rellenarse todos y ademas les da un color de acuerdo a su estado
(function() {
	'use strict';
	window.addEventListener(
		'load',
		function() {
			// Fetch all the forms we want to apply custom Bootstrap validation styles to
			var forms = document.getElementsByClassName('needs-validation');
			// Loop over them and prevent submission
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener(
					'submit',
					function(event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					},
					false
				);
			});
		},
		false
	);
})();

//  valida los dropdown para que despliegue la informacion al hacer alguna accion ya sea clickear

$('.dropdown-toggle').dropdown();
$('#myDropdown').on('show.bs.dropdown', function() {
	// do something…
});

//  valida los tooltips para que al pasar el mouse por encima de los inputs  me muestre un mensaje de que debo hacer en ese campo
$(function() {
	$('[data-toggle="tooltip"]').tooltip();
});
// ===============================================================================================================
// ================================================= Pqr.js ======================================================
$(document).ready(function() {
	$('.eleccion').click(function() {
		var posicion = $('.eleccion').index(this);
		var respuesta = $('.eleccion').eq(posicion);
		var id = $('.pqr_id').eq(posicion);
		res = respuesta.val();
		dni = id.val();

		alert('respuesta: ' + res + ' llave: ' + dni);

		$.ajax({
			url: 'nuevo.php',
			type: 'POST',
			data: {
				id_pqr: dni,
				leid: res,
			},
		})
			.done(function(pq) {
				$('#c').html(res);
			})
			.fail(function() {
				console.log('error');
			});
	});
});
// ===============================================================================================================
// // =====================================   leaflet   =============================================================

// var mymap = L.map('mapid').setView([51.505, -0.09], 13);

// L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
// 	attribution:
// 		'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
// 	maxZoom: 18,
// 	id: 'mapbox/streets-v11',
// 	tileSize: 512,
// 	zoomOffset: -1,
// 	accessToken:
// 		'pk.eyJ1IjoiYmFzc3lhcHAiLCJhIjoiY2s2czNreGthMDJndzNmcWo0b2g0bzQ5biJ9.LiQFNuP2FXbqSdDKb6tD-g',
// }).addTo(mymap);

// // ===============================================================================================================
