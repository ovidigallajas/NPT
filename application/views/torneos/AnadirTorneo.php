<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title> Nuevo Torneo </title>
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
<h1>Torneo</h1>
<div class="formulario">
	<form action="<?php echo base_url() ?>index.php/torneos/AnadirTorneo_post" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label> Nombre <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="nombreTorneo" />
		</div>
		<div class="form-group">
			<label> Juego <span>*</span></label>
			<br />
			<select class="form-control" name="juego">
				<?php	foreach ($juegos->result() as $row){
					echo '<option value="'.$row->idJuego.'">'.$row->nombre.'</option>';
				};?>
			</select>
		</div>
		<div class="form-group">
			<label> Plataforma <span>*</span></label>
			<br />
			<select class="form-control" name="plataforma">
			<?php	foreach ($plataforma->result() as $row){
				echo '<option value="'.$row->idPlataforma.'">'.$row->nombre.'</option>';
			};?>
			</select>
		</div>
		<div class="form-group">
			<label> Fecha Inicio <span>*</span></label>
			<br />
			<input type="text" placeholder="dd/MM/yyyy" onblur="validarFormatoFechaInicio()" class="form-control" id="datepicker" name="fechaInicio">
		</div>
		<div class="form-group">
			<label> Fecha Fin <span>*</span></label>
			<br />
			<input type="text" placeholder="dd/MM/yyyy" onblur="validarFormatoFechaFin()" class="form-control" class="datepicker" name="fechaFin">
		</div>
		<div class="form-group">
			<label> Precio Inscripción <span>*</span></label>
			<br />
			<input type="number" class="form-control" name="pinscripcion" />
		</div>
		<div class="form-group">
			<label> Premio <span>*</span></label>
			<br />
			<input type="number" class="form-control" name="premio" />
		</div>
		<label> Tipo de Torneo: <span>*</span></label>
		<div class="form-check">
			<input type="radio" class="form-check-input" name="tipoJugadores" value="Individual"/>
			<label class="form-check-label" for="individual">Individual</label>
		</div>
		<div class="form-check">
			<input type="radio" class="form-check-input" name="tipoJugadores" value="Equipos"/>
			<label class="form-check-label" for="equipos">Equipos</label>
		</div><br>
		<div class="form-group" id="Jugadores" style="display:none">
			<label> Número de jugadores <span>*</span></label>
			<br />
			<input type="text" class="form-control" id="numJugadores" name="numJugadores">
		</div>
		<div class="form-group" id="Equipos" style="display:none">
			<label> Número de jugadores por Equipo <span>*</span></label>
			<br />
			<input type="text" class="form-control" id="numJugadoresEquipo" name="numJugadoresEquipo">
		</div>
		<div class="form-group">
			<label> Número de Rondas <span>*</span></label>
			<br />
			<input type="text" class="form-control" name="rondas">
		</div>
		<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
		<?=validation_errors();?>
		<input type="submit" value="Crear" id="Crear" class="btn btn-outline-primary"/>
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

	function validarFormatoFechaInicio() {
		var campo = document.getElementsByName('fechaInicio')[0].value;
		var exp = /^(0?[1-9]|[12][0-9]|[3][01])\/(0?[1-9]|[1][012])\/([0-9]{4})$/;
		if (exp.test(campo)) {
			document.getElementById('Crear').disabled=false;
			document.getElementById('fechas').innerText="";
		} else {
			document.getElementById('Crear').disabled=true;
			document.getElementById('fechas').innerText="Compruebe el formato de la fecha";
		}
	}

	function validarFormatoFechaFin() {
		var campo = document.getElementsByName('fechaFin')[0].value;
		var exp = /^(0?[1-9]|[12][0-9]|[3][01])\/(0?[1-9]|[1][012])\/([0-9]{4})$/;
		if (exp.test(campo)) {
			document.getElementById('Crear').disabled=false;
			document.getElementById('fechas').value="Compruebe el formato de las fechas";
		} else {
			document.getElementById('Crear').disabled=true;
			document.getElementById('fechas').value="";
		}
	}
</script>
</body>
</html>
