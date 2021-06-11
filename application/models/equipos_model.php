<?php
class equipos_model extends CI_Model {
	public function __construct() {
		parent::__construct();
		$this->db = $this->load->database('npt',TRUE);
	}

	/**
	 * Saca todos los equipos
	 * @return mixed
	 */
	public function ver_equipos($id){
		$this->db->select('e.*');
		$this->db->from('equipos e');
		$this->db->where('e.idEquipo not in (SELECT ej.idEquipo FROM equipojugador ej WHERE ej.idUsuarioJugador="'.$id.'")');
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca todos los equipos en los que está inscrito un usuario
	 * @return mixed
	 */
	public function ver_mis_equipos($id){
		$this->db->select('e.*,ej.*');
		$this->db->from('equipos e');
		$this->db->join('equipojugador ej', 'e.idEquipo = ej.idEquipo');
		$this->db->where('idUsuarioJugador',$id);
		$query = $this->db->get();
		return $query;
	}

	/**
	 * Saca el listado de equipos validos para inscribirse a un torneo
	 * @param $id integer
	 * @param $jugadores string
	 * @return mixed
	 */
	public function equipos_validos($id,$jugadores){
		return $this->db->query("SELECT * FROM equipos WHERE idCreadorEquipo='".$id."' AND maxJugadores=numJugadores AND maxJugadores='".$jugadores."'");
		/*$this->db->select('*');
		$this->db->from('equipos');
		$this->db->where('idCreadorEquipo',$id);
		$this->db->where('maxJugadores','numJugadores');
		$this->db->where('maxJugadores',$jugadores);
		$query = $this->db->get();
		return $query;*/
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
		$this->db->insert('equipos', $data);
		$idEquipo = $this->db->insert_id();
		$data2 = array(
			'idEquipo' => $idEquipo,
			'idUsuarioJugador'   => $id,
		);
		return $this->db->insert('equipojugador', $data2);
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
	 * Unirse a un equipo
	 * @param $idEquipo integer
	 * @param $idJugador integer
	 * @return mixed
	 */
	public function unirse($idEquipo,$idJugador){
		$sql="INSERT INTO equipojugador(idEquipo,idUsuarioJugador) SELECT (SELECT idEquipo FROM equipos WHERE numJugadores!=maxJugadores AND idEquipo='".$idEquipo."'),idUsuarioJugador FROM jugadores WHERE idUsuarioJugador='".$idJugador."'";
		if($this->db->query($sql)){
			return $this->db->query("UPDATE equipos SET numJugadores=numJugadores+1 WHERE idEquipo='".$idEquipo."'");
		}else{
			return false;
		}
	}

	/**
	 * Salirse de un equipo
	 * @param $idEquipo integer
	 * @param $idJugador integer
	 * @return mixed
	 */
	public function salirse($idEquipo,$idJugador){
		if($this->db->delete('equipojugador',array('idEquipo'=>$idEquipo,'idUsuarioJugador'=>$idJugador))){
			return $this->db->query("UPDATE equipos SET numJugadores=numJugadores-1 WHERE idEquipo='".$idEquipo."'");
		}else{
			return false;
		}
	}

	/**
	 * Elimina un equipo
	 * @param $id integer
	 */
	public function eliminar_equipo($id){
		$this->db->delete('equipojugador', array('idEquipo' => $id));
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
