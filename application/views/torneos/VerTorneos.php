<!DOCTYPE html>
<html>
<head>
	<title> Torneos </title>
	<style>
		table{
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
<h1>Torneos</h1><br>
<?php
if($this->session->userdata('perfil')=='a') {
	echo '<p ><a href = "'.base_url().'index.php/torneos/AnadirTorneo" > Añadir</a ></p >';
}
?>
<div class="container-fluid">
	<div class="table-responsive">
		<table class="table">
			<thead>
			<tr>
				<th scope="col"></th>
				<th scope="col" class='text-center'>Nombre</th>
				<th scope="col" colspan="2" class='text-center'>Juego</th>
				<th scope="col" class='text-center'>Fecha Inicio</th>
				<th scope="col" class='text-center'>Fecha Fin</th>
				<th scope="col" class='text-center'>Inscritos</th>
				<th scope="col" class='text-center'>Máximo Jugadores</th>
				<th scope="col" class='text-center'>Precio Inscripción</th>
				<th scope="col" class='text-center'>Premio</th>
			</tr>
			</thead>
			<tbody>
			<?php	foreach ($torneos->result() as $row){
				echo '<tr>';
				echo "<td class='text-center'>".$row->nombre."</td>";
				echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenJuego.'" alt="'.$row->nombre.'"></td>';
				echo "<td class='text-center'>".$row->nombreJuego."</td>";
				echo "<td class='text-center'>".$row->fechaInicio."</td>";
				echo "<td class='text-center'>".$row->fechaFin."</td>";
				echo "<td class='text-center'>".$row->inscritos."</td>";
				echo "<td class='text-center'>".$row->maxJugadores."</td>";
				echo "<td class='text-center'>".$row->precioInscripcion."</td>";
				echo "<td class='text-center'>".$row->premio."</td>";
				if($this->session->userdata('perfil')=='a'){
					echo '<td><a href="'.base_url().'index.php/torneos/editarTorneo?id='.$row->idTorneo.'&n='.$row->nombre.'">Editar</a></td>';
				}
				if($this->session->userdata('perfil')=='a'){
					echo '<td><a href="'.base_url().'index.php/torneos/eliminarTorneo?id='.$row->idTorneo.'">Eliminar</a></td>';
				}
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
