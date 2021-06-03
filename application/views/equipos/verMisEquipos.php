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
		.imagen{
			width:300px;
			height: 100px;
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
<?php
if($this->session->userdata('logueado')) {
	echo '<p ><a href = "'.base_url().'index.php/equipos/AnadirEquipo" >Añadir Equipo</a ></p >';
}
?>
<div class="table-responsive container">
	<table class="table">
		<thead>
		<tr>
			<th scope="col" class='text-center'>Nombre</th>
			<th scope="col" class='text-center'>Número de Jugadores</th>
			<th scope="col" class='text-center'>Máximo de Jugadores</th>
			<th scope="col" class='text-center'></th>
			<th scope="col" class='text-center'></th>
			<th scope="col" class='text-center'></th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($equipos->result() as $row){
			echo '<tr>';
			echo '<td class="text-center">'.$row->nombre.'</td>';
			echo "<td class='text-center'>".$row->numJugadores."</td>";
			echo "<td class='text-center'>".$row->maxJugadores."</td>";
			if($this->session->userdata('id')==$row->idCreadorEquipo){
				echo '<td><a href="'.base_url().'index.php/equipos/editarEquipo?i='.$row->idEquipo.'&n='.$row->nombre.'&m='.$row->maxJugadores.'"><abbr title="EDITAR"><i class="fas fa-edit"></i></abbr></a></td>';
			}
			if($this->session->userdata('id')==$row->idCreadorEquipo){
				echo '<td><a href="'.base_url().'index.php/equipos/eliminarEquipo?i='.$row->idEquipo.'"><abbr title="ELIMINAR"><i class="fas fa-trash"></i></abbr></a></td>';
			}
			if($this->session->userdata('id')!=$row->idCreadorEquipo){
				echo '<td><a href="'.base_url().'index.php/equipos/salirse?i='.$row->idEquipo.'"><abbr title="SALIRSE"><i class="fas fa-user-minus"></i></abbr></a></td>';
			}
			echo '</tr>';
		}?>
		</tbody>
	</table>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>
