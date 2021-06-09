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

	public function InstalarBD(){
		$this->load->model('instalacion_model');
		$this->instalacion_model->crearBD();
		$this->load->view('instalacion/InstalarBD');
	}

	/**
	 * Instala la base de datos
	 */
	public function instalar(){
		$this->load->model('instalacion_model');
		$data = array();
		if($this->instalacion_model->instalarBD()){
			$this->load->view('instalacion/AltaAdministrador');
		}else{
			$data['mensaje']="La base de datos no se ha instalado correctamente";
			$this->load->view('instalacion/InstalarBD',$data);
		}
	}

	/**
	 * Saca todos los equipos
	 */
	public function AltaAdministrador(){
		if($this->input->post('password')==$this->input->post('password2')){
			/**
			 * Comprueba que estén todos los campos rellenos y que el email es válido
			 */
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->form_validation->set_rules('password2', 'Contraseña', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			$this->form_validation->set_rules('edad', 'Edad', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','El correo no es valido');
			if($this->form_validation->run()!=false) {
				/**
				 * Recoge los datos enviados por post
				 */
				$nick = $this->input->post('nick');
				$nombre = $this->input->post('nombre');
				$correo = $this->input->post('correo');
				$password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
				$edad = $this->input->post('edad');
				$this->load->model('instalacion_model');

				/**
				* Realiza el registro
				*/
				if ($this->instalacion_model->registrar_admin($nick, $nombre, $correo, $password, $edad)) {
					$datos['mensajeCorrecto'] = "Registro completado correctamente";
					$this->load->view('usuarios/iniciar_sesion', $datos);
				} else {
							$datos["mensaje"] = "No se ha registrado correctamente";
					$this->load->view('instalacion/AltaAdministrador', $datos);
				}
			}
			else{
				$datos["mensaje"]="";
				$this->load->view('instalacion/AltaAdministrador',$datos);
			}

		}else{
			$datos["mensaje"]="Las contraseñas no coinciden";
			$this->load->view('instalacion/AltaAdministrador',$datos);
		}

	}

}

