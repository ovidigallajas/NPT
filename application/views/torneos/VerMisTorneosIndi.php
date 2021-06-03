<!DOCTYPE html>
<html>
<head>
	<title> Torneos </title>
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
<?php if($this->session->userdata('logueado')) {
echo '<br><h1>Torneos Inscritos</h1><br>
	<div class="container-fluid">
		<div class="table-responsive">
		<h4>Individuales</h4>
			<table class="table">
				<thead>
				<tr>
					<th scope="col" class="text-center">Nombre</th>
					<th scope="col" class="text-center">Juego</th>
					<th scope="col" class="text-center">Plataforma</th>
					<th scope="col" class="text-center">Fecha Inicio</th>
					<th scope="col" class="text-center">Fecha Fin</th>
					<th scope="col" class="text-center">Inscritos</th>
					<th scope="col" class="text-center">Máximo de Jugadores</th>
					<th scope="col" class="text-center">Precio Inscripción</th>
					<th scope="col" class="text-center">Premio</th>
					<th scope="col" class="text-center"></th>
				</tr>
				</thead>
				<tbody>';
				foreach ($mistorneosi->result() as $row){
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
					echo '<td class="text-center"><a href="' . base_url() . 'index.php/torneos/desinscribirse?i=' . $row->idTorneo . '"><i class="fas fa-user-minus"></i></a></td>';
					echo '</tr>';
				}echo'
				</tbody>
			</table>
		</div>
	</div>';
}?>
<br>
<?php $this->load->view('templates/footer') ?>
</body>
</html>