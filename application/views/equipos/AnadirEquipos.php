<!DOCTYPE html>
<html>
<head>
	<title> Nuevo Equipo </title>
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
			width: 200px;
			margin:0 auto;
		}
		h1{
			font-family:Courier New !important;
			text-align: center;
		}
		p{
			color: red ;
			width:500px ;
		}
	</style>
</head>
<body>
<?php $this->load->view("templates/nav")?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
<h1>Añadir Equipo</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/equipos/AnadirEquipo_post" method="post" enctype="multipart/form-data">
		<label for="nombre">Nombre</label><br>
		<input type="text" name="nombre"/><br>
		<label for="maxJugadores">Máximo de jugadores</label><br>
		<input type="text" name="maxJugadores"/><br><br>
		<input type="submit" value="Añadir">
	</form><br>
	<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
	<?=validation_errors();?><br>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
