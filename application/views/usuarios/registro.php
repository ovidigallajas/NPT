<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title> Usuarios </title>
	<style>
		span{
			color:red;
		}
		p{
			color:red;
		}
		h1{
			margin-left: 100px;
			font-family:Courier New;
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
<h1>Registro</h1>
<div class="formulario">
	<form method="post" action="<?php echo base_url() ?>index.php/usuarios/registroUsuarios">
		<div class="form-group">
			<label> Usuario <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="nick" />
		</div>
		<div class="form-group">
			<label> Nombre <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="nombre" />
		</div>
		<div class="form-group">
			<label> Correo <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="correo" />
		</div>
		<div class="form-group">
			<label> Contraseña <span>*</span></label>
			<br />
			<input type="password" class="form-control" name="password" />
		</div>
		<div class="form-group">
			<label>Repetir Contraseña <span>*</span></label>
			<br />
			<input type="password" class="form-control" name="password2" />
		</div>
		<div class="form-group">
			<label> Edad <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="edad" />
		</div>
		<br/>
		<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
		<?=validation_errors();?>
		<input type="submit" value="Registrarse" class="btn btn-default"/>
	</form>
</div>
<?php $this->load->view("templates/footer")?>
</body>
</html>
