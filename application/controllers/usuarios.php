<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class usuarios
 */
class usuarios extends CI_Controller {
	/**
	 * usuarios constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('cookie');
	}

	/**
	 * Carga el formulario de inicio de sesión
	 */
	public function iniciar_sesion() {
		$data = array();
		$this->load->view('usuarios/iniciar_sesion', $data);
	}

	/**
	 * Recoje los datos del formulario de inicio de sesión
	 */
	public function iniciar_sesion_post() {
		if ($this->input->post()) {
			/**
			 * Comprueba si están todos los campos rellenos
			 */
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			if($this->form_validation->run()!=false) {
				/**
				 * Recoge los datos enviados por post
				 */
				$datos["mensaje"]="";
				$nick = $this->input->post('nick');
				$password = $this->input->post('password');
				$this->load->model('usuario_model');
				/**
				 * Comprueba el usuario y la contraseña y si son correctos crea las variables de sesión
				 */
				$usuario = $this->usuario_model->usuario_por_nick_password($nick);
				if(password_verify($password,$usuario->password)) {
					if ($usuario) {
						$usuario_data = array(
							'id' => $usuario->idUsuario,
							'nick' => $usuario->nick,
							'perfil' => $usuario->perfil,
							'organizador' => TRUE,
							'logueado' => TRUE
						);
						$this->session->set_userdata($usuario_data);
						/*$cookie = array(
							'name'   => 'logins',
							'value'  => 'value'+1,
							'expire' => '300',
							'secure' => TRUE
						);
						$this->input->set_cookie($cookie);*/
						redirect('index.php/usuarios/logueado');
					} else {
						$datos["mensaje"] = "El usuario o la contraseña son incorrectos";
					}
				}else{
					$datos["mensaje"] = "El usuario o la contraseña son incorrectos";
				}
			}else{
				$datos["mensaje"]="";
			}
			$this->load->view("usuarios/iniciar_sesion",$datos);
		} else {
			$this->iniciar_sesion();
		}
	}

	/**
	 * Si es correcto el inicio de sesión manda a la página de inicio y envía las variables de sesión
	 */
	public function logueado() {
		if($this->session->userdata('logueado')){
			$data = array(
				'nick' =>  $this->session->userdata('nick'),
				'perfil' => $this->session->userdata('perfil'),
				'organizador' => $this->session->userdata('organizador'),
			);
			$this->load->view('usuarios/logueado', $data);
		}else{
			redirect('index.php/usuarios/iniciar_sesion');
		}
	}

	/**
	 * Saca los datos de la cuenta logueada
	 */
	public function verCuentas(){
		if($this->session->userdata('logueado')){
			$id=$this->session->userdata('id');
			$this->load->model('usuario_model');
			$data=array();
			$data['usuarios'] = $this->usuario_model->ver_cuenta($id);
			$this->load->view('usuarios/ver_cuenta',$data);
		}else{
			redirect('index.php/usuarios/iniciar_sesion');
		}
	}

	/**
	 * Recoje los datos del formulario de modificación de la cuenta para modificarlos en la base de datos
	 */
	public function modificarCuentas(){
		if ($this->input->post()) {
			/**
			 * Comprueba que estén todos los campos rellenos y que el email es válido
			 */
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			$this->form_validation->set_rules('edad', 'Edad', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','El correo no es valido');
			if($this->form_validation->run()!=false) {
				/**
				 * Recoge los datos enviados por post
				 */
				$id = $this->session->userdata('id');
				$nick = $this->input->post('nick');
				$nombre = $this->input->post('nombre');
				$correo = $this->input->post('correo');
				$edad = $this->input->post('edad');
				$this->load->model('usuario_model');
				/**
				 * Comprueba si el nombre de usuario ya existe
				 */
				if($this->usuario_model->comprobarUsuario($id,$nick)>0){
					$datos['usuarios'] = $this->usuario_model->ver_cuenta($id);
					$datos["mensaje"] = "El nombre de usuario introducido ya existe";
					$this->load->view('usuarios/ver_cuenta',$datos);
				}else {
					/**
					 * Comprueba si el email ya existe
					 */
					if($this->usuario_model->comprobarCorreo($id,$correo)>0) {
						$datos['usuarios'] = $this->usuario_model->ver_cuenta($id);
						$datos["mensaje"] = "El correo introducido ya existe";
						$this->load->view('usuarios/ver_cuenta',$datos);
					}else {
						if($this->usuario_model->editar_cuenta($id, $nick, $nombre, $correo, $edad)){
							$datos['usuarios'] = $this->usuario_model->ver_cuenta($id);
							$datos["mensajeCorrecto"] = "Cambio realizado con éxito";
							$this->load->view('usuarios/ver_cuenta',$datos);
						}else{
							$datos['usuarios'] = $this->usuario_model->ver_cuenta($id);
							$datos["mensaje"] = "No se ha editado correctamente";
							$this->load->view('usuarios/ver_cuenta',$datos);
						}
					}
				}
			}else{
				$this->load->model('usuario_model');
				$datos["mensaje"]="";
				$datos['usuarios'] = $this->usuario_model->ver_cuenta($this->session->userdata('id'));
				$this->load->view('usuarios/ver_cuenta',$datos);
			}
			//redirect('index.php/usuarios/verCuentas');
		} else {
			$this->iniciar_sesion();
		}
	}

	/**
	 * Redirige al registro de usuarios
	 */
	public function registro() {
		$data = array();
		$this->load->view('usuarios/registro', $data);
	}

	/**
	 * Recoje los datos del formulario de registro y se añade a la base de datos
	 */
	public function registroUsuarios(){
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
				$this->load->model('usuario_model');
				/**
				 * Comprueba si el nombre de usuario introducido ya existe
				 */
				if($this->usuario_model->comprobarUsuario("",$nick)>0){
					$datos["mensaje"] = "El nombre de usuario introducido ya existe";
					$this->load->view('usuarios/registro',$datos);
				}else{
					/**
					 * Comprueba si el correo introducido ya existe
					 */
					if($this->usuario_model->comprobarCorreo("",$correo)>0) {
						$datos["mensaje"] = "El correo introducido ya existe";
						$this->load->view('usuarios/registro',$datos);
					}else{
						/**
						 * Realiza el registro
						 */
						if ($this->usuario_model->registrar_usuario($nick, $nombre, $correo, $password, $edad)) {
							$datos['mensaje'] = "Registro completado correctamente";
							$this->load->view('usuarios/iniciar_sesion', $datos);
						} else {
							$datos["mensaje"] = "No se ha registrado correctamente";
							$this->load->view('usuarios/registro', $datos);
						}
					}
				}
			}
			else{
				$datos["mensaje"]="";
				$this->load->view('usuarios/registro',$datos);
			}

		}else{
			$datos["mensaje"]="Las contraseñas no coinciden";
			$this->load->view('usuarios/registro',$datos);
		}

	}

	/**
	 * Sacar el listado de todos los usuarios registrados en la aplicación
	 */
	public function verUsuarios(){
		if($this->session->userdata('logueado')){
			$this->load->model('usuario_model');
			$data= array();
			$data['usuarios'] = $this->usuario_model->ver_usuarios();
			$this->load->view('usuarios/verUsuarios',$data);
		}else{
			redirect('index.php/usuarios/logueado');
		}
	}

	/**
	 * Eliminar un usuario (administrador)
	 */
	public function  eliminarUsuarios(){
		$id = $this->input->get('id');
		$this->load->model('usuario_model');
		$this->usuario_model->eliminar_usuario($id);
		redirect('index.php/usuarios/verUsuarios');
	}

	/**
	 * Eliminar usuario (el usuario borra su cuenta)
	 */
	public function  eliminarUsuario(){
		if($this->session->userdata('logueado')){
			$this->load->model('usuario_model');
			$this->usuario_model->eliminar_usuario($this->session->userdata('id'));
			redirect('index.php/usuarios/cerrar_sesion');
		}else{
			redirect('index.php/usuarios/iniciar_sesion');
		}

	}

	/**
	 * Redirige a la página de recuperar contraseña
	 */
	public function recuperarContrasena(){
		$data = array();
		$this->load->view('usuarios/recuperarContrasena', $data);
	}

	/**
	 * Recoje los datos del formulario de recuperar contraseña y envía el correo con la contraseña al usuario
	 */
	public function recuperarContrasena_post(){
		/**
		 * Comprueba que estén todos los campos rellenos y que el email es válido
		 */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		$this->form_validation->set_message('valid_email','El correo no es valido');
		if($this->form_validation->run()!=false) {
			$correo = $this->input->post('correo');
			$nombre = $this->input->post('nombre');
			$this->load->model('usuario_model');
			$contrasena=$this->usuario_model->recuperar_contrasena($correo);
			if($contrasena!="") {
				$this->load->library('email');
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'ssl://smtp.gmail.com';
				$config['smtp_port'] = '465';
				$config['smtp_timeout'] = '7';
				$config['smtp_user'] = 'nonprofessionaltournaments@gmail.com';
				$config['smtp_pass'] = 'marcosyoscar';
				$config['charset'] = 'utf-8';
				$config['newline'] = "\r\n";
				$config['mailtype'] = 'html'; // or html
				$config['validation'] = TRUE;
				$this->email->initialize($config);
				$this->email->to($correo);
				$this->email->from('nonprofessionaltournaments@gmail.com', 'NPT');
				$this->email->subject('Recuperación de contraseña');
				$nuevaContrasena = $this->generarRandomString(10);
				foreach ($contrasena as $indice => $row) {
					$this->email->message('Estmado ' . $nombre . ',<br/>
 				Desde NPT le informamos que hemos recibido una solicitud de recuperación de tu contraseña. <br>
 				Su contraseña es: ' . $nuevaContrasena);
				}
				$this->load->model('usuario_model');
				if($this->usuario_model->actualizarContrasena($correo,password_hash($nuevaContrasena,PASSWORD_DEFAULT))){
					$this->email->send();
					redirect('index.php/usuarios/iniciar_sesion');
				}else{
					$data['mensaje']="El correo no se ha enviado correctamente";
					$this->load->view('usuarios/recuperarContrasena',$data);
				}
			}else{
				$data['mensaje']="El correo introducido no está registrado";
				$this->load->view('usuarios/recuperarContrasena',$data);
			}
		} else {
			$data['mensaje']="";
			$this->load->view('usuarios/recuperarContrasena',$data);
		}
	}

	function generarRandomString($length) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	/**
	 * Muestra la página de Avisos Legales
	 */
	public function AvisosLegales(){
		$this->load->view('templates/avisoslegales');
	}

	/**
	 * Cierra sesión y elimina las variables de sesión
	 */
	public function cerrar_sesion() {
		/*$usuario_data = array(
			'logueado' => FALSE
		);
		$this->session->set_userdata($usuario_data);*/
		$this->session->sess_destroy();
		redirect('index.php/usuarios/iniciar_sesion');
	}
}
