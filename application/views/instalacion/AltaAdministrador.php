<!DOCTYPE html>
<html>
<head>
	<title> Alta Administrador </title>
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		p > a{
			text-align: center;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
			font-size: 20px;
		}
		#centrar{
			width: 300px;
			margin:0 auto;
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
<h1>Registro del administrador</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/Instalacion/AltaAdministrador" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label> Usuario <span class="error">*</span></label>
			<br />
			<input type="text" class="form-control" name="nick" />
		</div>
		<div class="form-group">
			<label> Nombre <span class="error">*</span></label>
			<br />
			<input type="text" class="form-control" name="nombre" />
		</div>
		<div class="form-group">
			<label> Correo <span class="error">*</span></label>
			<br />
			<input type="text" class="form-control" name="correo" />
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
		<div class="form-group">
			<label> Edad <span class="error">*</span></label>
			<br />
			<input type="text" class="form-control" name="edad" />
		</div>
		<br/>
		<p class="error"><?php if(isset($mensaje)) echo $mensaje; ?></p>
		<?=validation_errors();?>
		<input type="submit" value="Registrarse" class="btn btn-outline-primary"/>
	</form><br>
</div>
<br>
</body>
</html>
