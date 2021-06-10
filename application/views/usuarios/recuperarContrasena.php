<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title> Usuarios </title>
	<style>
		#formulario{
			text-align: center;
		}
		h1{
			text-align: center;
			font-family:Courier New !important;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
		}
		#centrar{
			width: 300px;
			margin:0 auto;
		}
	</style>
</head>
<body>
<?php $this->load->view("templates/nav")?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera4.jpg" alt="First slide">
		</div>
	</div>
</div>
<h1> Recuperar Contraseña </h1><br>
<div id="centrar">
<form method="post" action="<?php echo base_url() ?>index.php/usuarios/recuperarContrasena_post">
	<label> Nombre </label>
	<br />
	<input type="text" name="nombre" />
	<br /><br />
	<label> Correo </label>
	<br />
	<input type="text" name="correo" />
	<br /><br/>
	<div class="error">
		<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
		<?=validation_errors();?>
	</div>
	<input type="submit" value="Enviar" /><br><br>
</form>
	<a href="<?php echo base_url() ?>index.php/usuarios/iniciar_sesion">Volver</a><br><br>
</div>
<?php $this->load->view("templates/footer")?>
</body>
</html>
