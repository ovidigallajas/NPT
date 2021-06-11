<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title> Editar Torneo </title>
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
<h1>Editar Torneo</h1>
<div class="formulario">
	<form action="<?php echo base_url() ?>index.php/torneos/editarTorneo_post" method="post" enctype="multipart/form-data">
		<input type="hidden" name="idTorneo" value="<?php echo $idTorneo?>"/>
		<div class="form-group">
			<label> Nombre <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="nombreTorneo" value="<?php echo $nombre?>"/>
		</div>
		<div class="form-group">
			<label> Juego <span>*</span></label>
			<br />
			<select class="form-control" name="juego">
				<?php	foreach ($juegos->result() as $row){
					$juego=$row->idJuego;
					$njuego=$row->nombre;
					if($juego==$idJuego){
						echo '<option value="'.$juego.'" selected>'.$njuego.'</option>';
					}else{
						echo '<option value="'.$juego.'">'.$njuego.'</option>';
					}
				};?>
			</select>
		</div>
		<div class="form-group">
			<label> Plataforma <span>*</span></label>
			<br />
			<select class="form-control" name="plataforma">
				<?php	foreach ($plataformas->result() as $row){
					$plataforma=$row->idPlataforma;
					$nplataforma=$row->nombre;
					if($plataforma==$idPlataforma){
						echo '<option value="'.$plataforma.'" selected>'.$nplataforma.'</option>';
					}else {
						echo '<option value="' . $plataforma . '">' . $nplataforma . '</option>';
					}
				};?>
			</select>
		</div>
		<div class="form-group">
			<label> Fecha Inicio <span>*</span></label>
			<br />
			<input type="text" placeholder="dd/MM/yyyy" onblur="validarFormatoFechaInicio()" class="form-control" id="datepicker" name="fechaInicio" value="<?php echo $fechaInicio?>">
		</div>
		<div class="form-group">
			<label> Fecha Fin <span>*</span></label>
			<br />
			<input type="text" placeholder="dd/MM/yyyy" onblur="validarFormatoFechaFin()" class="form-control" class="datepicker" name="fechaFin" value="<?php echo $fechaFin?>">
		</div>
		<div class="form-group">
			<label> Precio Inscripción <span>*</span></label>
			<br />
			<input type="number" class="form-control" name="pinscripcion" value="<?php echo $pInscripcion?>"/>
		</div>
		<div class="form-group">
			<label> Premio <span>*</span></label>
			<br />
			<input type="number" class="form-control" name="premio" value="<?php echo $premio?>"/>
		</div>
		<label> Tipo de Torneo: <span>*</span></label>
		<div class="form-check">
			<?php
				if($maxJugadores!=null){
					echo '<input type="radio" onload="tipos()" class="form-check-input" name="tipoJugadores" value="Individual" checked disabled/>';
				}else{
					echo '<input type="radio" onload="tipos()" class="form-check-input" name="tipoJugadores" value="Individual" disabled/>';
				}
			?>
			<label class="form-check-label" for="individual">Individual</label>
		</div>
		<div class="form-check">
			<?php
			if($maxJugadoresEquipos!=null){
				echo '<input type="radio" onload="tipos()" class="form-check-input" name="tipoJugadores" value="Equipos" checked disabled/>';
			}else{
				echo '<input type="radio" onload="tipos()" class="form-check-input" name="tipoJugadores" value="Equipos" disabled/>';
			}
			?>
			<label class="form-check-label" for="equipos">Equipos</label>
		</div><br>
		<div class="form-group" id="Jugadores">
			<label> Número de jugadores <span>*</span></label>
			<br />
			<?php
			if($maxJugadores==null){
				echo '<input type="text" class="form-control" id="numJugadores" name="numJugadores" value="'.$maxJugadores.'" disabled/>';
			}else{
				echo '<input type="text" class="form-control" id="numJugadores" name="numJugadores" value="'.$maxJugadores.'"/>';
			}
			?>

		</div>
		<div class="form-group" id="Equipos">
			<label> Número de jugadores por Equipo <span>*</span></label>
			<br />
			<?php
			if($maxJugadoresEquipos==null){
				echo '<input type="text" class="form-control" id="numJugadoresEquipo" name="numJugadoresEquipo" value="'.$maxJugadoresEquipos.'" disabled/>';
			}else{
				echo '<input type="text" class="form-control" id="numJugadoresEquipo" name="numJugadoresEquipo" value="'.$maxJugadoresEquipos.'"/>';
			}
			?>
		</div>
		<div class="form-group">
			<label> Número de Rondas <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="rondas" value="<?php echo $rondas?>">
		</div>
		<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
		<?=validation_errors();?>
		<input type="submit" value="Editar" id="Enviar" class="btn btn-outline-primary"/>
		<p id="fechas"></p>
	</form>
</div>
<?php $this->load->view("templates/footer")?>
<script type="text/javascript">
	$(function() {
		$('#datepicker').datepicker({
			dateFormat: "yy-mm-dd"
		});
	});

	$(document).ready(function()
	{
		$("input[name=tipoJugadores]").click(function () {
			var tipo = $(this).val();
			if(tipo=="Individual") {
				$("#Jugadores").show();
				$("#Equipos").hide();
			}else{
				$("#Jugadores").hide();
				$("#Equipos").show();
			}
		});

	});

	function tipos(){
		var tipo = document.getElementById('tipoJugadores');
		if(tipo=="Individual"){
			document.getElementById('numJugadores').show();
			document.getElementById('numJugadoresEquipos').hide();
		}else{
			document.getElementById('numJugadoresEquipos').show();
			document.getElementById('numJugadores').hide();
		}
	}

	function validarFormatoFechaInicio() {
		var campo = document.getElementsByName('fechaInicio')[0].value;
		var exp = /^(0?[1-9]|[12][0-9]|[3][01])\/(0?[1-9]|[1][012])\/([0-9]{4})$/;
		if (exp.test(campo)) {
			document.getElementById('Enviar').disabled=false;
			document.getElementById('fechas').innerText="";
		} else {
			document.getElementById('Enviar').disabled=true;
			document.getElementById('fechas').innerText="Compruebe el formato de la fecha";
		}
	}

	function validarFormatoFechaFin() {
		var campo = document.getElementsByName('fechaFin')[0].value;
		var exp = /^(0?[1-9]|[12][0-9]|[3][01])\/(0?[1-9]|[1][012])\/([0-9]{4})$/;
		if (exp.test(campo)) {
			document.getElementById('Enviar').disabled=false;
			document.getElementById('fechas').value="Compruebe el formato de las fechas";
		} else {
			document.getElementById('Enviar').disabled=true;
			document.getElementById('fechas').value="";
		}
	}
</script>
</body>
</html>

