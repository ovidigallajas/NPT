<!DOCTYPE html>
<html>
<head>
	<title> Plataformas </title>
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<style>
		p > a{
			text-align: center;
		}
		h1{
			font-family:Courier New !important;
			text-align: center;
		}
	</style>
</head>
<body>
<?php $this->load->view('templates/nav')?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
	<div class="titulo">
		<h1>Mis Datos</h1>
	</div>
	<div>
		<form method="post" action="<?php echo base_url() ?>index.php/usuarios/modificarCuentas">
			<p class="correcto"><?php if(isset($mensajeCorrecto)) echo $mensajeCorrecto; ?></p>
			<div class="padding-left error">
				<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
				<?=validation_errors();?>
			</div>
			<table class="table">
				<thead>
					<tr>
						<?php foreach ($usuarios as $indice => $valor) {
							echo "<th scope='col' class='text-center'>" . strtoupper($indice) . "</th>";
						}
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php foreach ($usuarios as $indice => $valor){
								echo "<td class='text-center'><input type='text' class='text-center' name='".$indice."' value='".$valor."'/></td>";
						}
						?>
					</tr>
				</tbody>
			</table>
			<div class="padding-left">
				<span>¿Cansado de tu cuenta? Puedes darte de baja <a href="<?php echo base_url() ?>index.php/usuarios/eliminarUsuario">aquí</a></span>
			</div><br>
			<input type="submit" value="Editar" class="btn btn-outline-primary margin-left"/><br><br>
		</form>
		<div class="titulo">
			<h1>Cambiar Contraseña</h1>
		</div>
	</div>
<div class="formulario centrado">
	<form method="post" action="<?php echo base_url() ?>index.php/usuarios/cambiarContrasena">
		<div class="form-group">
			<label for="nick">Contraseña: <span class="error">*</span></label>
			<input type="text" class="form-control" name="password">
		</div>
		<div class="form-group">
			<label for="password">Repetir Contraseña: <span class="error">*</span></label>
			<input type="password" class="form-control" name="password2">
		</div>
		<br>
		<input type="submit" value="Cambiar Contraseña" class="btn btn-outline-primary margin-left"/><br><br>
	</form>
</div>
<?php $this->load->view('templates/footer')?>
</body>
</html>
