<?php
class videojuegos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Saca todas las plataformas
	 * @return mixed
	 */
	public function ver_plataforma(){
		$query = $this->db->get('plataformas');
		return $query;
	}

	/**
	 * Saca todos los videojuegos
	 * @return mixed
	 */
	public function ver_videojuegos(){
		$query = $this->db->get('juegos');
		return $query;
	}

	/**
	 * Añade una plataforma
	 * @param $nombre string
	 * @param $imagen string
	 * @return mixed
	 */
	public function anadir_plataforma($nombre,$imagen)
	{
		$data = array(
			'nombre' => $nombre,
			'imagenPlataforma' => $imagen,
			'idAdministrador' => '1',
		);
		return $this->db->insert('plataformas', $data);
	}

	/**
	 * Añade un videojuego
	 * @param $nombre string
	 * @param $descripcion string
	 * @param $plataforma string
	 * @param $edad string
	 * @param $imagen string
	 * @return mixed
	 */
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

	/**
	 * Edita una plataforma
	 * @param $id integer
	 * @param $nombre string
	 * @param $imagen string
	 * @return mixed
	 */
	public function editar_plataforma($id,$nombre,$imagen)
	{
		$this->db->where('idPlataforma', $id);
		$this->db->set('nombre', $nombre);
		$this->db->set('imagenPlataforma', $imagen);
		return $this->db->update('plataformas');
	}

	/**
	 * Edita un videojuego
	 * @param $id integer
	 * @param $nombre string
	 * @param $descripcion string
	 * @param $plataforma string
	 * @param $edad string
	 * @param $imagen string
	 * @return mixed
	 */
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

	/**
	 * Elimina una plataforma
	 * @param $id integer
	 */
	public function eliminar_plataforma($id){
		$this->db->delete('plataformas', array('idPlataforma' => $id));
	}

	/**
	 * Elimina un videojuego
	 * @param $id integer
	 */
	public function eliminar_videojuego($id){
		$this->db->delete('juegos', array('idJuego' => $id));
	}

	/**
	 * Comprueba si existe el nombre de una plataforma
	 * @param $id integer
	 * @param $nombre string
	 * @return mixed
	 */
 	public function comprobarPlataforma($id,$nombre){
		$this->db->select('nombre');
		$this->db->from('plataformas');
		$this->db->where('idPlataforma !=', $id);
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}

	/**
	 * Comprueba si existe el nombre de un juego
	 * @param $id integer
	 * @param $nombre string
	 * @return mixed
	 */
	public function comprobarJuego($id,$nombre){
		$this->db->select('nombre');
		$this->db->from('juegos');
		$this->db->where('idJuego !=', $id);
		$this->db->where('nombre', $nombre);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}
