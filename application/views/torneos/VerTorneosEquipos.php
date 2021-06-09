<!DOCTYPE html>
<html>
<head>
	<title> Torneos </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<style>
		table{
			margin:0 auto;
		}
		h1,h4{
			font-family:Courier New !important;
			text-align: center;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
		}
		.imagen{
			width:150px;
			height: 50px;
		}
		img{
			width: 100%;
			height: auto;
		}
		p{
			font-size: 20px;
			text-align: center;
			color:red;
		}
		i{
			font-size: 2em;
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
<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
<?=validation_errors();?><br>
<h1>Torneos</h1><br>
<div class="container-fluid">
	<div class="table-responsive">
		<h4>En Equipo</h4>
		<table class="table">
			<thead>
			<tr>
				<th scope="col" class='text-center'>Nombre</th>
				<th scope="col" class='text-center'>Juego</th>
				<th scope="col" class='text-center'>Plataforma</th>
				<th scope="col" class='text-center'>Fecha Inicio</th>
				<th scope="col" class='text-center'>Fecha Fin</th>
				<th scope="col" class='text-center'>Inscritos</th>
				<th scope="col" class='text-center'>Máximo Jugadores Equipo</th>
				<th scope="col" class='text-center'>Precio Inscripción</th>
				<th scope="col" class='text-center'>Premio</th>
				<th scope="col" class='text-center'></th>
			</tr>
			</thead>
			<tbody>
			<?php	foreach ($torneose->result() as $row) {
				$fechaI=$row->fechaFin;
				$hoy = date('Y-m-d');
				if($fechaI<$hoy) {
					echo '<tr style="background-color: rgba(255,0,0,0.84)">';
				}else{
					echo '<tr>';
				}
				echo "<td class='text-center'>" . $row->nombre . "</td>";
				echo '<td scope="row" class="imagen"><img src="' . base_url() . 'recursos/imagenes/' . $row->imagenJuego . '" alt="' . $row->nombre . '"></td>';
				echo "<td class='text-center'>" . $row->nombrePlataforma . "</td>";
				echo "<td class='text-center'>" . $fechaI . "</td>";
				echo "<td class='text-center'>" . $row->fechaFin . "</td>";
				echo "<td class='text-center'>" . $row->inscritos . "</td>";
				$numMaxJugadores = $row->numMaxJugadoresEquipo;
				echo "<td class='text-center'>" . $numMaxJugadores . "</td>";
				echo "<td class='text-center'>" . $row->precioInscripcion . "€</td>";
				echo "<td class='text-center'>" . $row->premio . "€</td>";
				echo '<td><a href="'.base_url().'index.php/torneos/inscribir_equipo?i='.$row->idTorneo.'&j='.$numMaxJugadores.'"><i class="fas fa-users"></i></a></td>
				</tr>';

			}?>
			</tbody>
		</table>
	</div>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
