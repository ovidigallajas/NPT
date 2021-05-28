<?php
class equipos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function ver_equipos(){
		$query = $this->db->get('equipos');
		return $query;
	}

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

	public function editar_equipo($id,$nombre,$maxjugadores)
	{
		$this->db->where('idEquipo', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('maxJugadores', $maxjugadores);
		return $this->db->update('equipos');
	}

	public function eliminar_equipo($id){
		$this->db->delete('equipos', array('idEquipo' => $id));
	}

	public function comprobarEquipo($id,$nombre){
		$this->db->select('nombre');
		$this->db->from('equipos');
		$this->db->where('idEquipo != ',$id);
		$this->db->where('nombre',$nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}

}
