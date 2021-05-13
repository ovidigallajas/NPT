<?php
class videojuegos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	public function ver_plataforma(){
		$query = $this->db->get('plataformas');
		return $query;
	}

	public function ver_videojuegos(){
		$query = $this->db->get('juegos');
		return $query;
	}

	public function anadir_plataforma($nombre,$imagen)
	{
		$data = array(
			'nombre' => $nombre,
			'imagenPlataforma' => $imagen,
			'idAdministrador' => '1',
		);
		return $this->db->insert('plataformas', $data);
	}

	public function anadir_videojuego($nombre,$descripcion,$plataforma,$edad,$imagen)
	{
		$data = array(
			'nombre' => $nombre,
			'imagenJuego' => $imagen,
			'edadMinima' => $edad,
			'descripcion' => $descripcion,
			'tipo' => $plataforma,
			'idAdministrador' => '1',
		);
		return $this->db->insert('juegos', $data);
	}

	public function editar_plataforma($id,$nombre,$imagen)
	{
		$this->db->where('idPlataforma', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('imagenPlataforma', $imagen);
		return $this->db->update('plataformas');
	}

	public function editar_videojuego($id,$nombre,$descripcion,$plataforma,$edad,$imagen)
	{
		$this->db->where('idJuego', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('imagenJuego', $imagen);
		$this->db->set('descripcion', $descripcion);
		$this->db->set('tipo', $plataforma);
		$this->db->set('edadMinima', $edad);
		return $this->db->update('juegos');
	}

	public function eliminar_plataforma($id){
		$this->db->delete('plataformas', array('idPlataforma' => $id));
	}
	public function eliminar_videojuego($id){
		$this->db->delete('juegos', array('idJuego' => $id));
	}

 	public function comprobarPlataforma($nombre){
		$this->db->select('nombre');
		$this->db->from('plataformas');
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
	public function comprobarJuego($nombre){
		$this->db->select('nombre');
		$this->db->from('juegos');
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}
