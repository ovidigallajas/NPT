<?php
class instalacion_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Instala la base de datos
	 * @return mixed
	 */
	public function crearBD()
	{
		$this->db->query("CREATE DATABASE IF NOT EXISTS NPT");
	}

	/**
	 * Crea todas las tablas
	 * @return mixed
	 */
	public function instalarBD(){
		$this->db->trans_start();
		$this->db->query("USE npt");
		$this->db->query("
		CREATE TABLE usuarios(
			idUsuario smallint unsigned not null primary key auto_increment,
			nick varchar(30) not null unique,
			nombre varchar(50) not null unique,
			correo varchar(80) not null unique,
			password varchar(255) not null,
			edad char(2) not null,
			perfil char(1) not null,
			diaRegistro datetime not null,
			CHECK(perfil in ('a','j'))
		);");
		$this->db->query("
		CREATE TABLE jugadores(
			idUsuarioJugador smallint unsigned not null primary key,
			organizador bit not null,
				CONSTRAINT fk_UsuarioJugador FOREIGN KEY (idUsuarioJugador)
				REFERENCES usuarios(idUsuario)
		);");
		$this->db->query("
		CREATE TABLE torneos(
			idTorneo int unsigned not null primary key auto_increment,
			nombre varchar(50) not null unique,
			precioInscripcion decimal(4,2) null,
			premio decimal(5,2) null,
			maxJugadores tinyint null,
			numMaxJugadoresEquipo tinyint null,
			inscritos tinyint not null,
			fechaInicio date not null,
			fechaFin date not null,
			numRondas char(1) not null,
			idOrganizador smallint unsigned not null,
			CONSTRAINT fk_UsuarioOrganizador FOREIGN KEY (idOrganizador)
				REFERENCES jugadores(idUsuarioJugador)
		);");
		$this->db->query("
		CREATE TABLE equipos(
			idEquipo smallint unsigned not null primary key auto_increment,
			nombre varchar(50) not null unique,
			maxJugadores tinyint not null,
			numJugadores tinyint not null,
			idCreadorEquipo smallint unsigned not null,
			CONSTRAINT fk_Equipo_Creador FOREIGN KEY (idCreadorEquipo)
				REFERENCES jugadores(idUsuarioJugador)
		); ");
		$this->db->query("
		CREATE TABLE juegos(
			idJuego tinyint unsigned not null primary key auto_increment,
			nombre varchar(50) not null unique,
			edadMinima char(2) not null,
			tipo varchar(20) not null,
			descripcion varchar(500) not null,
			imagenJuego varchar(100) not null,
			idAdministrador smallint unsigned not null,
			CONSTRAINT fk_UsuarioAdministrador FOREIGN KEY (idAdministrador)
				REFERENCES usuarios(idUsuario)
		);");
		$this->db->query("
		CREATE TABLE plataformas(
			idPlataforma tinyint unsigned not null primary key auto_increment,
			nombre varchar(50) not null unique,
			imagenPlataforma varchar(100) not null,
			idAdministrador smallint unsigned not null,
			CONSTRAINT fk_UsuarioAdministradorPlataforma FOREIGN KEY (idAdministrador)
				REFERENCES usuarios(idUsuario)
		);");
		$this->db->query("
		CREATE TABLE inscripcionJugadores(
			idTorneo int unsigned not null,
			idUsuarioJugador smallint unsigned not null,
			PRIMARY KEY (idTorneo,idUsuarioJugador),
			CONSTRAINT fk_TorneoJ FOREIGN KEY (idTorneo)
				REFERENCES torneos(idTorneo),
			CONSTRAINT fk_Torneo_Jugador FOREIGN KEY (idUsuarioJugador)
				REFERENCES usuarios(idUsuario)
		);");
		$this->db->query("
		CREATE TABLE equipoJugador(
			idEquipo smallint unsigned not null,
			idUsuarioJugador smallint unsigned not null,
			PRIMARY KEY (idEquipo,idUsuarioJugador),
			CONSTRAINT fk_Equipo_jugador FOREIGN KEY (idEquipo)
				REFERENCES equipos(idEquipo),
			CONSTRAINT fk_Jugador_equipo FOREIGN KEY (idUsuarioJugador)
				REFERENCES usuarios(idUsuario)
		);");
		$this->db->query("
		CREATE TABLE inscripcionEquipo(
			idTorneo int unsigned not null,
			idEquipo smallint unsigned not null,
			PRIMARY KEY (idTorneo,idEquipo),
			CONSTRAINT fk_InscripcionEquipo FOREIGN KEY (idEquipo)
				REFERENCES equipos(idEquipo),
			CONSTRAINT fk_Torneo_Equipo FOREIGN KEY (idTorneo)
				REFERENCES torneos(idTorneo)
		);");
		$this->db->query("
		CREATE TABLE juegoTorneo(
			idTorneo int unsigned not null,
			idJuego tinyint unsigned not null,
			idPlataforma tinyint unsigned not null,
			PRIMARY KEY(idTorneo,idJuego,idPlataforma),
			CONSTRAINT fk_Torneo_juego_plataforma FOREIGN KEY (idTorneo)
				REFERENCES torneos(idTorneo),
			CONSTRAINT fk_Torneo_juego FOREIGN KEY (idJuego)
				REFERENCES juegos(idJuego),
			CONSTRAINT fk_Torneo_plataforma FOREIGN KEY (idPlataforma)
				REFERENCES plataformas(idPlataforma)
		);");
		$this->db->query("

		CREATE TABLE partidas(
			idPartida int unsigned PRIMARY KEY not null, 
			idTorneo int unsigned not null,
			Ganador smallint unsigned null,
			Resultado varchar(50) null,
			Ronda varchar(20) null,
			CONSTRAINT fk_Torneo_partida FOREIGN KEY (idTorneo)
				REFERENCES torneos(idTorneo),
			CONSTRAINT fk_Torneos_GanadorEquipo FOREIGN KEY (Ganador)
				REFERENCES equipos(idEquipo),
			CONSTRAINT fk_Torneos_GanadorIndividual FOREIGN KEY (Ganador)
				REFERENCES jugadores(idUsuarioJugador)
		);");
		$this->db->query("
		CREATE TABLE partidasEquipos(
			idPartida int unsigned not null,
			idEquipo1 smallint unsigned not null,
			idEquipo2 smallint unsigned not null,
			PRIMARY KEY(idPartida,idEquipo1,idEquipo2),
			CONSTRAINT fk_Partida_Equipo FOREIGN KEY (idPartida)
				REFERENCES partidas(idPartida),
			CONSTRAINT fk_Partida_equipo1 FOREIGN KEY (idEquipo1)
				REFERENCES equipos(idEquipo),
			CONSTRAINT fk_Partida_equipo2 FOREIGN KEY (idEquipo2)
				REFERENCES equipos(idEquipo)
		);");
		$this->db->query("
		CREATE TABLE partidasIndividuales(
			idPartida int unsigned not null,
			idJugador smallint unsigned not null,
			PRIMARY KEY(idPartida,idJugador),
			CONSTRAINT fk_Partida_Individual FOREIGN KEY (idPartida)
				REFERENCES partidas(idPartida),
			CONSTRAINT fk_Partida_Jugador FOREIGN KEY (idJugador)
				REFERENCES jugadores(idUsuarioJugador)
		);");
		return $this->db->trans_complete();
	}

	/**
	 * Añade el administrador
	 * @param $nick string
	 * @param $password string
	 * @return mixed
	 */
	public function registrar_admin($nick,$password){
		$this->db->query("USE npt");
		$data = array(
			'nick' => $nick,
			'nombre'   => '',
			'correo' => 'nonprofessionaltournaments@gmail.com',
			'password' => $password,
			'edad' => '',
			'perfil' => 'a',
			'diaRegistro' => date("Y-m-d H:i:s"),
		);
		return $this->db->insert('usuarios', $data);
	}
}

