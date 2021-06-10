<!DOCTYPE html>
<html>
<head>
	<title> Editar Equipo </title>
	<style>
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
<h1>Editar Equipo</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/equipos/EditarEquipo_post" method="post" enctype="multipart/form-data">
		<input type="hidden" name="idEquipo" value="<?php echo $idEquipo?>"/>
		<label for="nombre">Nombre</label><br>
		<input type="text" name="nombre" value="<?php echo $nombre?>"/><br>
		<label for="maxJugadores">Máximo de jugadores</label><br>
		<input type="text" name="maxJugadores" value="<?php echo $maxJugadores?>"/><br><br>
		<input type="submit" value="Editar">
	</form><br>
	<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
	<?=validation_errors();?><br>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
