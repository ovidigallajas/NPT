<!DOCTYPE html>
<html>
<head>
	<title> Plataformas </title>
	<style>
		p > a{
			text-align: center;
		}
		a{
			text-decoration: none !important;
			font-weight: bold;
			font-size: 20px;
		}
		h1{
			font-family:Courier New !important;
			text-align: center;
		}
		p{
			color: red ;
			width:500px ;
		}
	</style>
</head>
<body>
<?php $this->load->view('templates/nav')?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
	<div class="titulo">
		<h1>Mis Datos</h1>
	</div>
	<div>
		<form method="post" action="<?php echo base_url() ?>index.php/usuarios/modificarCuentas">
			<table class="table">
				<thead>
					<tr>
						<?php foreach ($usuarios as $indice => $valor) {
							echo "<th scope='col' class='text-center'>" . strtoupper($indice) . "</th>";
						}
						?>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php foreach ($usuarios as $indice => $valor){
								echo "<td class='text-center'><input type='text' class='text-center' name='".$indice."' value='".$valor."'/></td>";
						}
						?>
					</tr>
				</tbody>
			</table>
			<div class="padding-left">
				<p><?php if(isset($mensaje)) echo $mensaje; ?></p>
				<?=validation_errors();?>
			</div>
			<div class="padding-left">
				<span>¿Cansado de tu cuenta? Puedes darte de baja <a href="<?php echo base_url() ?>index.php/usuarios/eliminarUsuario">aquí</a></span>
			</div>
			<input type="submit" value="Editar" class="btn btn-default padding-left"/><br><br>
		</form>
	</div>
<?php $this->load->view('templates/footer')?>
</body>
</html>
