<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class equipos
 */
class Instalacion extends CI_Controller {
	/**
	 * Instalacion constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Crea la base de datos y lleva al formulario de registro del admin
	 */
	public function InstalarBD(){
		$this->load->model('instalacion_model');
		$this->instalacion_model->crearBD();
		$this->load->view('instalacion/InstalarBD');
	}

	/**
	 * Crea las tablas y el usuario administrador
	 */
	public function instalar()
	{
		$datos = array();
		if ($this->input->post('password') == $this->input->post('password2')) {
			/**
			 * Comprueba que estén todos los campos rellenos
			 */
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->form_validation->set_rules('password2', 'Contraseña', 'required');
			$this->form_validation->set_message('required', 'El campo %s es obligatorio');
			if ($this->form_validation->run() != false) {
				/**
				 * Recoge los datos enviados por post
				 */
				$this->load->model('instalacion_model');
				if (!$this->instalacion_model->instalarBD()) {
					$datos['mensaje'] = "La base de datos no se ha instalado correctamente";
					$this->load->view('instalacion/InstalarBD', $datos);
				} else {
					$nick = $this->input->post('nick');
					$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
					$this->load->model('instalacion_model');

					/**
					 * Realiza el registro
					 */
					$this->load->model('instalacion_model');
					if ($this->instalacion_model->registrar_admin($nick, $password)) {
						$datos['mensajeCorrecto'] = "Registro completado correctamente";
						$this->load->view('usuarios/iniciar_sesion', $datos);
					} else {
						$datos["mensaje"] = "No se ha registrado correctamente";
						$this->load->view('instalacion/InstalarBD', $datos);
					}
				}
			} else {
				$datos["mensaje"] = "";
				$this->load->view('instalacion/InstalarBD', $datos);
			}

		} else {
			$datos["mensaje"] = "Las contraseñas no coinciden";
			$this->load->view('instalacion/InstalarBD', $datos);
		}
	}

}

