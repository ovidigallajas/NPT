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
				<th scope="col" class='text-center'></th>
			</tr>
			</thead>
			<tbody>
			<?php	foreach ($torneosi->result() as $row){
				$fechaI=$row->fechaInicio;
				$hoy = date('Y-m-d');
				if($fechaI<$hoy) {
					echo '<tr style="background-color: rgba(255,0,0,0.84)">';
				}else{
					echo '<tr>';
				}
				echo "<td class='text-center'>".$row->nombre."</td>";
				echo '<td scope="row" class="imagen"><img src="'.base_url().'recursos/imagenes/'.$row->imagenJuego.'" alt="'.$row->nombre.'"></td>';
				echo "<td class='text-center'>".$row->nombrePlataforma."</td>";
				echo "<td class='text-center' id='fechaInicio'>".$row->fechaInicio."</td>";
				echo "<td class='text-center'>".$fechaI."</td>";
				echo "<td class='text-center'>".$row->inscritos."</td>";
				echo "<td class='text-center'>".$row->maxJugadores."</td>";
				echo "<td class='text-center'>".$row->precioInscripcion."€</td>";
				echo "<td class='text-center'>".$row->premio."€</td>";
				if($this->session->userdata('logueado')) {
					echo '<td class="text-center"><a href="' . base_url() . 'index.php/torneos/inscribirse?i=' . $row->idTorneo . '"><i class="fas fa-user-plus"></i></a></td>';
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
