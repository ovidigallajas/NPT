<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<title> Instalar Base de Datos </title>
	<style>
		#centrar{
			width: 400px;
			margin:0 auto;
			text-align: center;
		}
		h1{
			font-family:Courier New !important;
			text-align: center;
		}
	</style>
</head>
<body>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
<h1>INSTALACIÓN</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/Instalacion/instalar" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label> Usuario <span class="error">*</span></label>
			<br />
			<input type="text" class="form-control" name="nick" />
		</div>
		<div class="form-group">
			<label> Contraseña <span class="error">*</span></label>
			<br />
			<input type="password" class="form-control" name="password" />
		</div>
		<div class="form-group">
			<label>Repetir Contraseña <span class="error">*</span></label>
			<br />
			<input type="password" class="form-control" name="password2" />
		</div>
		<div class="error">
			<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
			<?=validation_errors();?><br>
			<input type="submit" value="Instalar">
		</div>
	</form><br>
</div>
<br>
</body>
</html>
