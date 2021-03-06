<html>
<head>
	<title>Mockups-NPT</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
	<div class="container">
		<a class="navbar-brand" href="#">
			<img src="<?= base_url() ?>recursos/imagenes/Logofinal.png" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Inicio</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/videojuegos/verVideojuegos">Juegos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/videojuegos/verPlataformas">Plataformas</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Torneos
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
						<?php
						if($this->session->userdata('logueado')) {
							echo "<li><a class='dropdown-item' href='".base_url()."index.php/torneos/verMisTorneosIndi' > Mis Torneos Individuales </a ></li >";
							echo "<li><a class='dropdown-item' href='".base_url()."index.php/torneos/verMisTorneosEquipo' > Mis Torneos Equipos </a ></li >";
						}
						?>
						<li><a class="dropdown-item" href="<?= base_url() ?>index.php/torneos/verTorneosIndividuales">Individuales</a></li>
						<li><a class="dropdown-item" href="<?= base_url() ?>index.php/torneos/verTorneosEquipos">En Equipo</a></li>
					</ul>
				</li>
				<?php if($perfil=='j'){
					echo '<li class="nav-item">';
					echo "<a class='nav-link' href='".base_url()."index.php/torneos/OrganizarTorneos'>Organizador</a>";
					echo '</li>';
				}?>
				<?php if($perfil=='a'){
					echo '<li class="nav-item">';
					echo "<a class='nav-link' href='".base_url()."index.php/usuarios/verUsuarios'>Usuarios</a>";
					echo '</li>';
				}
				?>
				<?php
				if($this->session->userdata('logueado')){
					echo'
					<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Equipos
					</a>
					<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
					echo "<li><a class='dropdown-item' href='".base_url()."index.php/equipos/verMisEquipos' > Mis Equipos </a ></li >";
					echo "<li><a class='dropdown-item' href='".base_url()."index.php/equipos/verEquipos' > Equipos </a ></li >";
					echo'
					</ul>
					</li>';
				}
				?>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/usuarios/verCuentas">Mi Cuenta</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?php echo base_url() ?>index.php/usuarios/cerrar_sesion"> Cerrar sesi??n </a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/navi-vs-faze-clan-kusTcxuHz5" target="_blank">NaVi<br>VS<br>FaZe Clan</a></button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/g2-esports-vs-big-gGcyXx2p_" target="_blank">G2 Esports<br>VS<br>BIG</a></button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/alternate-attax-vs-forze-fl23G3d8d" target="_blank">ALTERNATE aTTaX<br>VS<br>forZe</a></button>
	</div>
</div>
<div class="titulo">
	<?php
	if($this->session->userdata('logueado')){
		echo '<h1>Bienvenido/a'.$nick.'</h1>';
	}
	?>
</div>
<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div id="juegos" class="carousel-inner">
			<div class="item active">
				<img src="<?= base_url() ?>recursos/imagenes/csgo.png" alt="csgo" style="width:30%;">
			</div>
			<!--<div class="item">
			  <img src="<?= base_url() ?>recursos/imagenes/fifa21.jpg" alt="fifa" style="width:30%;">
			</div>
			<div class="item">
			  <img src="<?= base_url() ?>recursos/imagenes/logo valorant.png" alt="valorant" style="width:30%;">
			</div>-->
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Siguiente</span>
		</a>
	</div>
</div>
<footer class="footer">
	<div class="container bottom_border">
		<div class="row">
			<div class=" col-sm-4 col-md col-sm-4  col-12 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Encuentranos</h5>
				<p class="mb10">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
				<p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35 </p>
				<p><i class="fa fa-phone"></i>  +91-9999878398  </p>
				<p><i class="fa fa fa-envelope"></i> info@example.com  </p>
			</div>
			<div class=" col-sm-4 col-md  col-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Enlaces Legales</h5>
				<ul class="footer_ul_amrc">
					<li><a href="http://webenlance.com">Image Rectoucing</a></li>
					<li><a href="http://webenlance.com">Clipping Path</a></li>
					<li><a href="http://webenlance.com">Hollow Man Montage</a></li>
					<li><a href="http://webenlance.com">Ebay & Amazon</a></li>
					<li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
					<li><a href="http://webenlance.com">Image Cropping</a></li>
				</ul>
			</div>
			<div class=" col-sm-4 col-md  col-6 col">
				<h5 class="headin5_amrc col_white_amrc pt2">Otros Enlaces</h5>
				<ul class="footer_ul_amrc">
					<li><a href="http://webenlance.com">Remove Background</a></li>
					<li><a href="http://webenlance.com">Shadows & Mirror Reflection</a></li>
					<li><a href="http://webenlance.com">Logo Design</a></li>
					<li><a href="http://webenlance.com">Vectorization</a></li>
					<li><a href="http://webenlance.com">Hair Masking/Clipping</a></li>
					<li><a href="http://webenlance.com">Image Cropping</a></li>
				</ul>
			</div>
			<div class=" col-sm-4 col-md  col-12 col">
				<h5 class="headin5_amrc col_white_amrc pt2">S??guenos</h5>
				<ul class="footer_ul2_amrc">
					<li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
					<li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
					<li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container">
		<ul class="foote_bottom_ul_amrc">
			<li><a href="http://webenlance.com">Home</a></li>
			<li><a href="http://webenlance.com">About</a></li>
			<li><a href="http://webenlance.com">Services</a></li>
			<li><a href="http://webenlance.com">Pricing</a></li>
			<li><a href="http://webenlance.com">Blog</a></li>
			<li><a href="http://webenlance.com">Contact</a></li>
		</ul>
		<p class="text-center">Copyright @2021 | Designed With by <a href="#">NPT Company</a></p>
		<ul class="social_footer_ul">
			<li><a href="http://webenlance.com"><i class="fab fa-facebook-f"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-twitter"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-linkedin"></i></a></li>
			<li><a href="http://webenlance.com"><i class="fab fa-instagram"></i></a></li>
		</ul>
	</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>recursos/js/navbar.js"></script>
</body>
</html>

