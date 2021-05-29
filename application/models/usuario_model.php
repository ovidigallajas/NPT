<?php
class usuario_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Comprueba el usuario y contraseña
	 * @param $nick string
	 * @param $password string
	 * @return mixed
	 */
	public function usuario_por_nick_password($nick, $password){
		$this->db->select('idUsuario, nick, password, perfil, organizador');
		$this->db->from('usuarios');
		$this->db->join('jugadores','usuarios.idUsuario = jugadores.idUsuarioJugador');
		$this->db->where('nick', $nick);
		$this->db->where('password', $password);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}

	/**
	 * Saca los datos del usuario logueado
	 * @param $id integer
	 * @return mixed
	 */
	public function ver_cuenta($id){
		$this->db->select('nick,nombre,correo,edad');
		$this->db->from('usuarios');
		$this->db->where('idUsuario', $id);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}

	/**
	 * Saca todos los usuarios y sus datos
	 * @return mixed
	 */
	public function ver_usuarios(){
		$query = $this->db->get('usuarios');
		return $query;
	}

	/**
	 * Edita los datos de un usuario
	 * @param $id integer
	 * @param $nick string
	 * @param $nombre string
	 * @param $correo string
	 * @param $edad string
	 * @return mixed
	 */
	public function editar_cuenta($id,$nick,$nombre,$correo,$edad){
		$this->db->where('idUsuario', $id);
		$this->db->set('nick', $nick);
		$this->db->set('nombre', $nombre);
		$this->db->set('correo', $correo);
		$this->db->set('edad', $edad);
		return $this->db->update('usuarios');
	}

	/**
	 * Registro de usuarios (tabla Usuarios y Jugadores)
	 * @param $nick string
	 * @param $nombre string
	 * @param $correo string
	 * @param $password string
	 * @param $edad string
	 * @return mixed
	 */
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
		$this->db->insert('usuarios', $data);
		$id = $this->db->insert_id();
		$data2 = array(
			'idUsuarioJugador' => $id,
			'organizador'   => false,
		);
		return $this->db->insert('jugadores',$data2);
	}

	/**
	 * Eliminar usuario
	 * @param $id integer
	 */
	public function eliminar_usuario($id){
		$this->db->delete('usuarios', array('idUsuario' => $id));
	}

	/**
	 * Coge la contraseña del usuario para enviarsela por correo
	 * @param $correo string
	 * @return mixed
	 */
	public function recuperar_contrasena($correo){
		$this->db->select('password');
		$this->db->from('usuarios');
		$this->db->where('correo', $correo);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		return $resultado;
	}

	/**
	 * Comprueba si el nombre de usuario ya existe
	 * @param $id integer
	 * @param $usuario string
	 * @return mixed
	 */
	public function comprobarUsuario($id,$usuario){
		$this->db->select('nick');
		$this->db->from('usuarios');
		$this->db->where('idUsuario !=',$id);
		$this->db->where('nick', $usuario);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}

	/**
	 * Comprueba si el email ya existe
	 * @param $id integer
	 * @param $correo string
	 * @return mixed
	 */
	public function comprobarCorreo($id,$correo){
		$this->db->select('correo');
		$this->db->from('usuarios');
		$this->db->where('idUsuario !=',$id);
		$this->db->where('correo', $correo);
		$consulta = $this->db->get();
		return $consulta->num_rows();
	}
}
