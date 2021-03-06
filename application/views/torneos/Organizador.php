<!DOCTYPE html>
<html>
<head>
	<title> Organizador </title>
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
<h1>Mis Torneos</h1><br>
<?php
	echo '<p ><a href = "'.base_url().'index.php/torneos/AnadirTorneo" style="font-size:1.5em"><abbr title="AÑADIR"><i class="fas fa-plus"></i></abbr></a ></p >';

?>
<div class="container-fluid">
	<div class="table-responsive">
		<h4>Individuales</h4>
		<table class="table">
			<thead>
			<tr>
				<th scope="col" class='text-center'>Nombre</th>
				<th scope="col" class='text-center'>Juego</th>
				<th scope="col" class='text-center'>Plataforma</th>
				<th scope="col" class='text-center'>Fecha Inicio</th>
				<th scope="col" class='text-center'>Fecha Fin</th>
				<th scope="col" class='text-center'>Inscritos</th>
				<th scope="col" class='text-center'>Máximo de Jugadores</th>
				<th scope="col" class='text-center'>Precio Inscripción</th>
				<th scope="col" class='text-center'>Premio</th>
				<th scope="col" colspan="3" class='text-center'></th>
			</tr>
			</thead>
			<tbody>
			<?php	foreach ($torneosi->result() as $row){
				echo '<tr>';
				echo "<td class='text-center'>".$row->nombre."</td>";
				echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenJuego.'" alt="'.$row->nombre.'"></td>';
				echo "<td class='text-center'>".$row->nombrePlataforma."</td>";
				echo "<td class='text-center'>".$row->fechaInicio."</td>";
				echo "<td class='text-center'>".$row->fechaFin."</td>";
				echo "<td class='text-center'>".$row->inscritos."</td>";
				echo "<td class='text-center'>".$row->maxJugadores."</td>";
				echo "<td class='text-center'>".$row->precioInscripcion."€</td>";
				echo "<td class='text-center'>".$row->premio."€</td>";
				/*$datos = array(
					'idTorneo' => $row->idTorneo,
					'idJuego' => $row->idJuego,
					'nombre' => $row->nombre,
					'idPlataforma' => $row->idPlataforma,
					'fechaInicio' => $row->fechaInicio,
					'fechaFin' => $row->fechaFin,
					'maxJugadores' => $row->maxJugadores,
					'maxJugadoresEquipos' => $row->numMaxJugadoresEquipo,
					'pInscripcion' => $row->precioInscripcion,
					'premio' => $row->premio,
					'rondas' => $row->numRondas
				);*/
				//$data=urlencode(serialize($datos));
				echo '<td><a href="'.base_url().'index.php/torneos/editarTorneo?i='.$row->idTorneo.'&j='.$row->idJuego.'&n='.$row->nombre.'&p='.$row->idPlataforma.'&fi='.$row->fechaInicio.'&ff='.$row->fechaFin.'&mj='.$row->maxJugadores.'&mje='.$row->numMaxJugadoresEquipo.'&pi='.$row->precioInscripcion.'&pr='.$row->premio.'&r='.$row->numRondas.'"><abbr title="EDITAR"><i class="fas fa-edit"></i></abbr></a></td>';
				echo '<td><a href="'.base_url().'index.php/torneos/participantes?i='.$row->idTorneo.'"><abbr title="GANADOR"><i class="fas fa-trophy"></abbr></i></a></td>';
				echo '<td><a href="'.base_url().'index.php/torneos/eliminarTorneo?id='.$row->idTorneo.'"><abbr title="ELIMINAR"><i class="fas fa-trash"></i></abbr></a></td>';
				echo '</tr>';
			}?>
			</tbody>
		</table>
	</div>
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
				<th scope="col" class='text-center'>Máximo de Jugadores</th>
				<th scope="col" class='text-center'>Precio Inscripción</th>
				<th scope="col" class='text-center'>Premio</th>
				<th scope="col" colspan="2" class='text-center'></th>
			</tr>
			</thead>
			<tbody>
			<?php	foreach ($torneose->result() as $row){
				echo '<tr>';
				echo "<td class='text-center'>".$row->nombre."</td>";
				echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenJuego.'" alt="'.$row->nombre.'"></td>';
				echo "<td class='text-center'>".$row->nombrePlataforma."</td>";
				echo "<td class='text-center'>".$row->fechaInicio."</td>";
				echo "<td class='text-center'>".$row->fechaFin."</td>";
				echo "<td class='text-center'>".$row->inscritos."</td>";
				echo "<td class='text-center'>".$row->numMaxJugadoresEquipo."</td>";
				echo "<td class='text-center'>".$row->precioInscripcion."€</td>";
				echo "<td class='text-center'>".$row->premio."€</td>";
				echo '<td><a href="'.base_url().'index.php/torneos/editarTorneo?i='.$row->idTorneo.'&j='.$row->idJuego.'&n='.$row->nombre.'&p='.$row->idPlataforma.'&fi='.$row->fechaInicio.'&ff='.$row->fechaFin.'&mj='.$row->maxJugadores.'&mje='.$row->numMaxJugadoresEquipo.'&pi='.$row->precioInscripcion.'&pr='.$row->premio.'&r='.$row->numRondas.'"><abbr title="EDITAR"><i class="fas fa-edit"></i></abbr></a></td>';
				echo '<td><a href="'.base_url().'index.php/torneos/eliminarTorneo?id='.$row->idTorneo.'"><abbr title="ELIMINAR"><i class="fas fa-trash"></i></abbr></a></td>';
				echo '</tr>';
			}?>
			</tbody>
		</table>
	</div>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
