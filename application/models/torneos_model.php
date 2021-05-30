<?php
class torneos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Saca los torneos individuales y sus datos
	 * @return mixed
	 */
	public function ver_torneos_individuales($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.imagenJuego,p.nombre as nombrePlataforma');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->join('inscripcionjugadores i', 'i.idTorneo = t.idTorneo');
		$this->db->where('i.idUsuarioJugador !=',$id);
		$this->db->where('numMaxJugadoresEquipo',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca los torneos en equipo y sus datos
	 * @return mixed
	 */
	public function ver_torneos_equipo(){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.imagenJuego,p.nombre as nombrePlataforma');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->where('maxJugadores',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca los torneos individuales en los que está inscrito un usuario
	 * @param $id integer
	 * @return mixed
	 */
	public function ver_toneos_inscrito_indi($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.idJuego as idJuego,j.imagenJuego,p.idPlataforma as idPlataforma,p.nombre as nombrePlataforma,DATE_FORMAT(t.fechaInicio, "%d/%m/%Y") as fechaInicio,DATE_FORMAT(t.fechaFin, "%d/%m/%Y") as fechaFin');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->join('inscripcionjugadores i', 'i.idTorneo = t.idTorneo');
		$this->db->where('i.idUsuarioJugador',$id);
		$this->db->where('numMaxJugadoresEquipo',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca los torneos en equipo en los que está inscrito un usuario
	 * @param $id integer
	 * @return mixed
	 */
	public function ver_toneos_inscrito_equipo($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.idJuego as idJuego,j.imagenJuego,p.idPlataforma as idPlataforma,p.nombre as nombrePlataforma,DATE_FORMAT(t.fechaInicio, "%d/%m/%Y") as fechaInicio,DATE_FORMAT(t.fechaFin, "%d/%m/%Y") as fechaFin');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->join('inscripcionjugadores i', 'i.idTorneo = t.idTorneo');
		$this->db->where('i.idUsuarioJugador',$id);
		$this->db->where('maxJugadores',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca los torneos(y sus datos) individuales creados por un usuario
	 * @param $id integer
	 * @return mixed
	 */
	public function ver_mis_torneos_individuales($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.idJuego as idJuego,j.imagenJuego,p.idPlataforma as idPlataforma,p.nombre as nombrePlataforma,DATE_FORMAT(t.fechaInicio, "%d/%m/%Y") as fechaInicio,DATE_FORMAT(t.fechaFin, "%d/%m/%Y") as fechaFin');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->where('idOrganizador',$id);
		$this->db->where('numMaxJugadoresEquipo',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca los torneos(y sus datos) en equipo creados por un usuario
	 * @param $id integer
	 * @return mixed
	 */
	public function ver_mis_torneos_equipo($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.idJuego as idJuego,j.imagenJuego,p.idPlataforma as idPlataforma,p.nombre as nombrePlataforma,DATE_FORMAT(t.fechaInicio, "%d/%m/%Y") as fechaInicio,DATE_FORMAT(t.fechaFin, "%d/%m/%Y") as fechaFin');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->where('idOrganizador',$id);
		$this->db->where('maxJugadores',null);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Añade un torneo(en la tabla torneos y juegotorneo)
	 * @param $nombre string
	 * @param $precioIns float
	 * @param $premio float
	 * @param $maxJugadores string
	 * @param $maxJugadoresPorEquipo string
	 * @param $fechaInicio string
	 * @param $fechaFin string
	 * @param $rondas string
	 * @param $organizador string
	 * @param $juego integer
	 * @param $plataforma integer
	 * @return mixed
	 */
	public function anadir_torneo($nombre,$precioIns,$premio,$maxJugadores,$maxJugadoresPorEquipo,$fechaInicio,$fechaFin,$rondas,$organizador,$juego,$plataforma)
	{
		$data = array(
			'nombre' => $nombre,
			'precioInscripcion' => $precioIns,
			'premio' => $premio,
			'maxJugadores' => $maxJugadores,
			'numMaxJugadoresEquipo' => $maxJugadoresPorEquipo,
			'fechaInicio' => $fechaInicio,
			'fechaFin' => $fechaFin,
			'numRondas' => $rondas,
			'idOrganizador' => $organizador,
		);
		$this->db->insert('torneos', $data);
		$id = $this->db->insert_id();
		$data2 = array(
			'idTorneo' => $id,
			'idJuego'   => $juego,
			'idPlataforma' => $plataforma
		);
		return $this->db->insert('juegotorneo',$data2);
	}

	/**
	 * Edita un torneo
	 * @param $id integer
	 * @param $nombre string
	 * @param $precioIns float
	 * @param $premio float
	 * @param $maxJugadores string
	 * @param $maxJugadoresPorEquipo string
	 * @param $fechaInicio string
	 * @param $fechaFin string
	 * @param $rondas string
	 * @param $juego string
	 * @param $plataforma string
	 * @return mixed
	 */
	public function editar_torneo($id,$nombre,$precioIns,$premio,$maxJugadores,$maxJugadoresPorEquipo,$fechaInicio,$fechaFin,$rondas,$juego,$plataforma)
	{
		$this->db->where('idTorneo', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('precioInscripcion', $precioIns);
		$this->db->set('premio', $premio);
		$this->db->set('maxJugadores', $maxJugadores);
		$this->db->set('numMaxJugadoresEquipo', $maxJugadoresPorEquipo);
		$this->db->set('fechaInicio', $fechaInicio);
		$this->db->set('fechaFin', $fechaFin);
		$this->db->set('numRondas', $rondas);
		$this->db->update('torneos');

		$this->db->where('idTorneo', $id);
		$this->db->set('idJuego', $juego);
		$this->db->set('idPlataforma', $plataforma);
		return $this->db->update('juegotorneo');
	}

	/**
	 * Inscribirse a un torneo
	 * @param $torneo integer
	 * @param $id integer
	 * @return mixed
	 */
	public function inscribirse($torneo,$id)
	{
		$data = array(
			'idTorneo' => $torneo,
			'idUsuarioJugador' => $id,
		);
		$this->db->insert('inscripcionjugadores', $data);

		$this->db->where('idTorneo', $id);
		$this->db->set('inscritos','inscritos'+1);
		return $this->db->update('torneos');
	}

	/**
	 * Elimina un torneo
	 * @param $id integer
	 */
	public function eliminar_torneo($id){
		$this->db->delete('inscripcionjugadores', array('idTorneo'=>$id));
		$this->db->delete('juegotorneo', array('idTorneo' => $id));
		$this->db->delete('torneos', array('idTorneo' => $id));
	}

	/**
	 * Comprueba si existe el nombre de un torneo
	 * @param $id integer
	 * @param $nombre string
	 * @return mixed
	 */
	public function comprobarTorneo($id,$nombre){
		$this->db->select('nombre');
		$this->db->from('torneos');
		$this->db->where('idTorneo != ',$id);
		$this->db->where('nombre',$nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}

