<!DOCTYPE html>
<html>
<head>
	<title> Plataformas </title>
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
<h1>Plataformas</h1><br>
<?php
if($this->session->userdata('perfil')=='a') {
	echo '<p ><a href = "'.base_url().'index.php/videojuegos/AnadirPlataforma" style="font-size:1.5em"><abbr title="AÑADIR"><i class="fas fa-plus"></i></abbr></a ></p >';
}
?>
<div class="table-responsive container">
	<table class="table">
		<thead>
		<tr>
			<th scope="col"></th>
			<th scope="col" class='text-center'>Nombre</th>
			<th scope="col" class='text-center'></th>
			<th scope="col" class='text-center'></th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($plataforma->result() as $row){
			echo '<tr>';
			echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenPlataforma.'" alt="plataforma"></td>';
			echo "<td class='text-center'>".$row->nombre."</td>";
			if($this->session->userdata('perfil')=='a'){
				echo '<td><a href="'.base_url().'index.php/videojuegos/editarPlataforma?id='.$row->idPlataforma.'&i='.$row->imagenPlataforma.'&n='.$row->nombre.'" style="font-size:1.3em"><abbr title="EDITAR"><i class="fas fa-edit"></i></abbr></a></td>';
			}
			if($this->session->userdata('perfil')=='a'){
				echo '<td><a href="'.base_url().'index.php/videojuegos/eliminarPlataformas?id='.$row->idPlataforma.'&i='.$row->imagenPlataforma.'" style="font-size:1.3em"><abbr title="ELIMINAR"><i class="fas fa-trash"></i></abbr></a></td>';
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

