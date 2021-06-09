<!DOCTYPE html>
<html>
<head>
	<title> Equipos </title>
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<style>
		h1{
			font-family:Courier New !important;
			text-align: center;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
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
<h1>Inscribir Equipo</h1><br>
<div class="centrar">
	<form action="<?php echo base_url() ?>index.php/torneos/inscribir_equipo_post" method="post" enctype="multipart/form-data">
		<input type="hidden" name="torneo" value="<?php echo $torneo ?>">
		<div class="form-group">
			<label for="equipo"> Equipos válidos </label>
			<br />
			<select name="equipo">
		<?php	foreach ($equipos->result() as $row){
			echo '<option value="'.$row->idEquipo.'">'.$row->nombre.'</option>';
		}?>
			</select>
		</div>
		<input type="submit" value="Inscribirse">
	</form>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
