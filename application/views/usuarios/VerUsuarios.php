<!DOCTYPE html>
<html>
<head>
	<title> Usuarios </title>
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
<h1>Usuarios</h1><br>
<div class="table-responsive container">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Usuario</th>
			<th scope="col">Nombre</th>
			<th scope="col">Correo</th>
			<th scope="col">Edad</th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($usuarios->result() as $row){
			echo '<tr>';
			echo '<td scope="row">'.$row->idUsuario.'</td>';
			echo "<td>".$row->nick."</td>";
			echo "<td>".$row->nombre."</td>";
			echo "<td>".$row->correo."</td>";
			echo "<td>".$row->edad."</td>";
			echo '<td><a href="'.base_url().'index.php/usuarios/eliminarUsuarios?id='.$row->idUsuario.'">Eliminar</a></td>
			</tr>';
		}?>
		</tbody>
	</table>
</div>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>

