<!DOCTYPE html>
<html>
<head>
	<title> Equipos </title>
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
<h1>Equipos</h1><br>
<div class="table-responsive container">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" class='text-center'>Nombre</th>
			<th scope="col" class='text-center'>Número de Jugadores</th>
			<th scope="col" class='text-center'>Máximo de Jugadores</th>
			<th scope="col" class='text-center'></th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($equipos->result() as $row){
			echo '<tr>';
			echo '<td class="text-center">'.$row->nombre.'</td>';
			echo "<td class='text-center'>".$row->numJugadores."</td>";
			echo "<td class='text-center'>".$row->maxJugadores."</td>";
			echo '<td><a href="'.base_url().'index.php/equipos/unirse?i='.$row->idEquipo.'"><i class="fas fa-user-plus"></i></a></td>';
			echo '</tr>';
		}?>
		</tbody>
	</table>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
