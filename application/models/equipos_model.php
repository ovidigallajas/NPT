<?php
class equipos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Saca todos los equipos
	 * @return mixed
	 */
	public function ver_equipos(){
		$query = $this->db->get('equipos');
		return $query;
	}

	/**
	 * Añade un equipo
	 * @param $nombre string
	 * @param $maxjugadores string
	 * @param $id integer
	 * @return mixed
	 */
	public function anadir_equipo($nombre,$maxjugadores,$id)
	{
		$data = array(
			'nombre' => $nombre,
			'maxJugadores' => $maxjugadores,
			'numJugadores' => '1',
			'idCreadorEquipo' => $id,
		);
		return $this->db->insert('equipos', $data);
	}

	/**
	 * Edita un equipo
	 * @param $id integer
	 * @param $nombre string
	 * @param $maxjugadores string
	 * @return mixed
	 */
	public function editar_equipo($id,$nombre,$maxjugadores)
	{
		$this->db->where('idEquipo', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('maxJugadores', $maxjugadores);
		return $this->db->update('equipos');
	}

	/**
	 * Elimina un equipo
	 * @param $id integer
	 */
	public function eliminar_equipo($id){
		$this->db->delete('equipos', array('idEquipo' => $id));
	}

	/**
	 * Comprueba si existe el nombre del torneo
	 * @param $id integer
	 * @param $nombre string
	 * @return mixed
	 */
	public function comprobarEquipo($id,$nombre){
		$this->db->select('nombre');
		$this->db->from('equipos');
		$this->db->where('idEquipo != ',$id);
		$this->db->where('nombre',$nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}

}
