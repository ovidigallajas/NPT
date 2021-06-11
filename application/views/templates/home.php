<html>
<head>
	<title>Mockups-NPT</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?= base_url() ?>recursos/css/index.css" type="text/css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<?php $this->load->view('templates/nav'); ?>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img class="d-block w-100" src="<?= base_url() ?>recursos/imagenes/cabecera.jpg" alt="First slide">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/navi-vs-faze-clan-kusTcxuHz5" target="_blank">NaVi<br>VS<br>FaZe Clan</a></button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/g2-esports-vs-big-gGcyXx2p_" target="_blank">G2 Esports<br>VS<br>BIG</a></button>
	</div>
	<div class="col-lg-4 col-md-12 col-sm-12">
		<button class="botones"><a href="https://es.egamersworld.com/counterstrike/match/alternate-attax-vs-forze-fl23G3d8d" target="_blank">ALTERNATE aTTaX<br>VS<br>forZe</a></button>
	</div>
</div>
<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>
		<div id="juegos" class="carousel-inner">
			<div class="item active">
				<img src="<?= base_url() ?>recursos/imagenes/csgo.png" alt="csgo" style="width:30%;">
			</div>
			<!--<div class="item">
			  <img src="<?= base_url() ?>recursos/imagenes/fifa21.jpg" alt="fifa" style="width:30%;">
			</div>
			<div class="item">
			  <img src="<?= base_url() ?>recursos/imagenes/logo valorant.png" alt="valorant" style="width:30%;">
			</div>-->
		</div>
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Anterior</span>
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Siguiente</span>
		</a>
	</div>
</div>
<?php $this->load->view('templates/footer'); ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>recursos/js/navbar.js"></script>
</body>
</html>
