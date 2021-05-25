<?php
class torneos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function ver_torneos(){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.imagenJuego,p.nombre as nombrePlataforma');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$query = $this->db->get();
		return $query;
	}

	public function ver_mis_torneos($id){
		$this->db->select('t.*,jt.*,j.nombre as nombreJuego,j.imagenJuego,p.nombre as nombrePlataforma,DATE_FORMAT(t.fechaInicio, "%d/%m/%Y") as fechaInicio,DATE_FORMAT(t.fechaFin, "%d/%m/%Y") as fechaFin');
		$this->db->from('torneos t');
		$this->db->join('juegotorneo jt', 't.idTorneo = jt.idTorneo');
		$this->db->join('juegos j', 'jt.idJuego = j.idJuego');
		$this->db->join('plataformas p', 'jt.idPlataforma = p.idPlataforma');
		$this->db->where('idOrganizador',$id);
		$query = $this->db->get();
		return $query;
	}

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

	public function editar_torneo($id,$nombre,$precioIns,$premio,$maxJugadores,$maxJugadoresPorEquipo,$fechaInicio,$fechaFin,$rondas,$organizador)
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
		$this->db->set('idOrganizador', $organizador);
		return $this->db->update('torneos');
	}

	public function eliminar_torneo($id){
		$this->db->delete('juegotorneo', array('idTorneo' => $id));
		$this->db->delete('torneos', array('idTorneo' => $id));
	}

	public function comprobarTorneo($nombre){
		$this->db->select('nombre');
		$this->db->from('torneos');
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}

