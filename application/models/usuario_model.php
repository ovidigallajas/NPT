<?php
class usuario_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}
	public function usuario_por_nick_password($nick, $password){
		$this->db->select('idUsuario, nick, password, perfil');
		$this->db->from('usuarios');
		$this->db->where('nick', $nick);
		$this->db->where('password', $password);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}
	public function ver_cuenta($id){
		$this->db->select('nick,nombre,correo,edad');
		$this->db->from('usuarios');
		$this->db->where('idUsuario', $id);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}

	public function ver_usuarios(){
		$query = $this->db->get('usuarios');
		return $query;
	}
	public function editar_cuenta($id,$nick,$nombre,$correo,$edad){
		$this->db->where('idUsuario', $id);
		$this->db->set('nick', $nick);
		$this->db->set('nombre', $nombre);
		$this->db->set('correo', $correo);
		$this->db->set('edad', $edad);
		return $this->db->update('usuarios');
	}
	public function registrar_usuario($nick,$nombre,$correo,$password,$edad){
		$data = array(
			'nick' => $nick,
			'nombre'   => $nombre,
			'correo' => $correo,
			'password' => $password,
			'edad' => $edad,
			'perfil' => 'j',
			'diaRegistro' => date("Y-m-d H:i:s"),
		);
		return $this->db->insert('usuarios', $data);
	}
	public function eliminar_usuario($id){
		$this->db->delete('usuarios', array('idUsuario' => $id));
	}
	public function recuperar_contrasena($correo){
		$this->db->select('password');
		$this->db->from('usuarios');
		$this->db->where('correo', $correo);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}
}
