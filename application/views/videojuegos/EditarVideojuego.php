<!DOCTYPE html>
<html>
<head>
	<title> Plataformas </title>
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
			width: 400px;
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
		#descripcion{
			width: 400px;
			height: 50px;
		}
		input[type="text"]{
			width: 400px;
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
<h1>Editar Videojuego</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/videojuegos/EditarVideojuego_post" method="post" enctype="multipart/form-data">
		<label for="nombre">Nombre</label><br>
		<input type="text" name="nombre" value="<?php echo $nombre?>"/><br>
		<label for="tipo">Tipo</label><br>
		<input type="text" name="tipo" value="<?php echo $tipo?>"/><br>
		<label for="edad">Edad Mínima</label><br>
		<input type="text" name="edad" value="<?php echo $edad?>"/><br>
		<label for="descripcion">Descripción</label><br>
		<textarea id="descripcion" name="descripcion"><?php echo $descripcion?></textarea><br>
		<label for="userfile">Imagen</label><br>
		<input type="file" name="userfile"/><br><br>
		<input type="hidden" name="id" value="<?php echo $id?>"/>
		<input type="submit" value="Añadir">
	</form><br>
	<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
	<?=validation_errors();?><br>
	<p><a href="<?php echo base_url() ?>index.php/videojuegos/VerVideojuegos">Volver</a></p>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
