<!DOCTYPE html>
<html>
<head>
	<title> Videojuegos </title>
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
<h1>Videojuegos</h1><br>
<?php
if($this->session->userdata('perfil')=='a') {
	echo '<p ><a href = "'.base_url().'index.php/videojuegos/AnadirVideojuego" > Añadir</a ></p >';
}
?>
<div class="container-fluid">
<div class="table-responsive">
	<table class="table">
		<thead>
		<tr>
			<th scope="col"></th>
			<th scope="col" class='text-center'>Nombre</th>
			<th scope="col" class='text-center'>Tipo</th>
			<th scope="col" class='text-center'>Descripción</th>
			<th scope="col" class='text-center'>Edad Mínima</th>
			<th scope="col" class='text-center'></th>
			<th scope="col" class='text-center'></th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($videojuegos->result() as $row){
			echo '<tr>';
			echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenJuego.'" alt="'.$row->nombre.'"></td>';
			echo "<td class='text-center'>".$row->nombre."</td>";
			echo "<td class='text-center'>".$row->tipo."</td>";
			echo "<td class='text-center'>".$row->descripcion."</td>";
			echo "<td class='text-center'>".$row->edadMinima."</td>";
			if($this->session->userdata('perfil')=='a'){
				echo '<td><a href="'.base_url().'index.php/videojuegos/editarVideojuego?id='.$row->idJuego.'&n='.$row->nombre.'&d='.$row->descripcion.'&e='.$row->edadMinima.'&t='.$row->tipo.'">Editar</a></td>';
			}
			if($this->session->userdata('perfil')=='a'){
				echo '<td><a href="'.base_url().'index.php/videojuegos/eliminarVideojuego?id='.$row->idJuego.'&i='.$row->imagenJuego.'">Eliminar</a></td>';
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
