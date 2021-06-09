<html>
<head>
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
</head>
<body>
<div id="cajacookies">
	<p>
		Éste sitio web usa cookies, si permanece aquí acepta su uso.
		Puede leer más sobre el uso de cookies en nuestra <a href="<?= base_url() ?>index.php/usuarios/AvisosLegales">política de privacidad</a>.
		<button onclick="aceptarCookies()" class="pull-right"></i> Aceptar cookies </button>
	</p>
</div>
<footer class="footer">
	<div class="container bottom_border">
		<div class="row">
			<div class=" col-sm-4 col-md col-sm-4  col-12 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Encuentranos</h5>
				<!--<p class="mb10"></p>-->
				<p><i class="fa fa-location-arrow"></i> C/Corte de Peleas,79 </p>
				<p><i class="fa fa-phone"></i> +34 924 25 17 61 </p>
				<p><i class="fa fa fa-envelope"></i> administracion.guadalupe@fundacionloyola.es </p>
			</div>
			<div class=" col-sm-4 col-md  col-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Enlaces Legales</h5>
				<ul class="footer_ul_amrc">
					<li><a href="<?= base_url() ?>index.php/usuarios/AvisosLegales">Avisos Legales</a></li>
					<li><a href="<?= base_url() ?>index.php/usuarios/AvisosLegales">Cookies</a></li>
				</ul>
			</div>
			<div class=" col-sm-4 col-md  col-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Otros Enlaces</h5>
				<ul class="footer_ul_amrc">
					<li><a href="https://fundacionloyola.com/vguadalupe/" target="_blank">Escuela Virgen de Guadalupe</a></li>
					<li><a href="https://fundacionloyola.com/" target="_blank">Fundacion Loyola</a></li>
					<li><a href="https://www.playstation.com/es-es/" target="_blank">Playstation España</a></li>
					<li><a href="https://www.xbox.com/es-ES" target="_blank">Xbox</a></li>
				</ul>
			</div>
			<div class=" col-sm-4 col-md  col-12 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Síguenos</h5>
				<ul class="footer_ul2_amrc">
					<li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Síguenos en nuestro Twitter: <a href="#">https://www.lipsum.com/</a></p></li>
					<li><a href="#"><i class="fab fa-instagram fleft padding-right"></i> </a><p>Síguenos en nuestro Instagram: <a href="#">https://www.lipsum.com/</a></p></li>
					<li><a href="#"><i class="fab fa-facebook fleft padding-right"></i> </a><p>Síguenos en nuestro Facebook: <a href="#">https://www.lipsum.com/</a></p></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<br>
		<p class="text-center">Copyright @2021 | Designed With by <a href="#">NPT Company</a></p>
		<!--<ul class="social_footer_ul">
			<li><a href="http://webenlance.com"><i class="fab fa-facebook-f"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-twitter"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-linkedin"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-instagram"></i></a></li>
		</ul>-->
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
	/* ésto comprueba la localStorage si ya tiene la variable guardada */
	function compruebaAceptaCookies() {
		if(localStorage.aceptaCookies == 'true'){
			cajacookies.style.display = 'none';
		}
	}

	/* aquí guardamos la variable de que se ha
	aceptado el uso de cookies así no mostraremos
	el mensaje de nuevo */
	function aceptarCookies() {
		localStorage.aceptaCookies = 'true';
		cajacookies.style.display = 'none';
	}

	/* ésto se ejecuta cuando la web está cargada */
	$(document).ready(function () {
		compruebaAceptaCookies();
	});
</script>
</body>
</html>
