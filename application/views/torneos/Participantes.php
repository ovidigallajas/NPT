<!DOCTYPE html>
<html>
<head>
	<title> Usuarios </title>
	<style>
		table{
			margin:0 auto;
		}
		#centrar{
			width:100px;
			margin:0 auto;
		}
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
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
<h1>Participantes</h1><br>
<div id="centrar">
	<form action="<?php echo base_url() ?>index.php/torneos/ganador_post" method="post" enctype="multipart/form-data">
		<input type="hidden" name="torneo" value="<?php echo $torneo?>"/>
		<?php
		foreach ($jugadores->result() as $row) {
			/*if($row->idUsuario==$row->Ganador){
				echo '<div class="form-check">
					<input type="radio" class="form-check-input" name="ganador" value="' . $row->idUsuarioJugador . '" checked/>
					<label class="form-check-label" for="">' . $row->nick . '</label>
				</div>';
			}else {*/
				echo '<div class="form-check">
					<input type="radio" class="form-check-input" name="ganador" value="' . $row->idUsuarioJugador . '"/>
					<label class="form-check-label" for="">' . $row->nick . '</label>
				</div>';
			//}
		}
		?>
		<br>
		<input type="submit" class="btn btn-outline-primary" value="Ganador">
	</form><br>
	<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
	<?=validation_errors();?><br>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
