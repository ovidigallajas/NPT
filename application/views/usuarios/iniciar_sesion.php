<html>
<head>
	<style>
		span{
			color:red;
		}
		#fallo{
			color:red;
		}
		h1{
			margin-left: 100px;
			font-family:Courier New;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
		}
	</style>
</head>
<body>
<?php $this->load->view('templates/nav')?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera4.jpg" alt="First slide">
		</div>
	</div>
</div>
<h1>Iniciar Sesión</h1><br><br>
<div class="correcto padding-left">
<p><?php if(isset($mensajeCorrecto)) echo $mensajeCorrecto; ?></p>
</div>
<div class="formulario">
	<form method="post" action="<?php echo base_url() ?>index.php/usuarios/iniciar_sesion_post">
		<div class="form-group">
			<label for="nick">Usuario: <span>*</span></label>
			<input type="text" class="form-control" name="nick">
		</div>
		<div class="form-group">
			<label for="password">Contraseña: <span>*</span></label>
			<input type="password" class="form-control" name="password">
		</div>
		<div id="fallo">
			<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
			<?=validation_errors();?>
		</div>
		<div>
			<p><a href="<?php echo base_url() ?>index.php/usuarios/recuperarContrasena">Recuperar Contraseña</a></p>
			<p><a href="<?php echo base_url() ?>index.php/usuarios/registro">Registrarse</a></p>
		</div>
		<input type="submit" value="Iniciar sesión" class="btn btn-default"/>
	</form>
</div>
<?php $this->load->view('templates/footer')?>
</body>
</html>





