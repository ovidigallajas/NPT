<?php
class videojuegos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function ver_plataforma(){
		$query = $this->db->get('torneos');
		return $query;
	}

	public function anadir_plataforma($nombre,$precioIns,$premio,$maxJugadores,$maxJugadoresPorEquipo,$fechaInicio,$fechaFin,$rondas,$organizador)
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
		return $this->db->insert('torneos', $data);
	}

	public function editar_plataforma($id,$nombre,$precioIns,$premio,$maxJugadores,$maxJugadoresPorEquipo,$fechaInicio,$fechaFin,$rondas,$organizador)
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

	public function eliminar_plataforma($id){
		$this->db->delete('torneos', array('idTorneo' => $id));
	}

	public function comprobarPlataforma($nombre){
		$this->db->select('nombre');
		$this->db->from('torneos');
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}

