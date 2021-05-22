<html>
<head>
	<title>NPT</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
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
					<a class="nav-link" href="#">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/videojuegos/verVideojuegos">Juegos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/videojuegos/verPlataformas">Plataformas</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/torneos/verTorneos">Torneos</a>
				</li>
				<?php if($this->session->userdata('organizador')==true){
					echo '<li class="nav-item">';
					echo "<a class='nav-link' href='".base_url()."index.php/torneos/OrganizarTorneos'>Organizador</a>";
					echo '</li>';
				}?>
				<?php if($this->session->userdata('perfil')=='a'){
					echo '<li class="nav-item">';
					echo "<a class='nav-link' href='".base_url()."index.php/usuarios/verUsuarios'>Usuarios</a>";
					echo '</li>';
				}?>
				<li class="nav-item">
					<a class="nav-link" href="<?= base_url() ?>index.php/usuarios/verCuentas">Mi Cuenta</a>
				</li>
				<?php
				if($this->session->userdata('logueado')){
					echo '<a class="nav-link" href="'.base_url().'index.php/usuarios/cerrar_sesion">Cerrar Sesión</a>';
				}
				?>
			</ul>
		</div>
	</div>
</nav>
</body>
</html>
