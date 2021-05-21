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
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			if($this->form_validation->run()!=false) {
				$datos["mensaje"]="";
				$nick = $this->input->post('nick');
				$password = $this->input->post('password');
				$this->load->model('usuario_model');
				$usuario = $this->usuario_model->usuario_por_nick_password($nick, $password);
				if ($usuario) {
					$usuario_data = array(
						'id' => $usuario->idUsuario,
						'nick' => $usuario->nick,
						'perfil' => $usuario->perfil,
						'logueado' => TRUE
					);
					$this->session->set_userdata($usuario_data);
					redirect('index.php/usuarios/logueado');
				}else{
					$datos["mensaje"]="El usuario o la contraseña son incorrectos";
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
	 * Crea las variables de sesión y manda a la página de inicio con el usuario ya logueado
	 */
	public function logueado() {
		if($this->session->userdata('logueado')){
			$data = array(
				'nick' =>  $this->session->userdata('nick'),
				'perfil' => $this->session->userdata('perfil'),
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
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			$this->form_validation->set_rules('edad', 'Edad', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','El correo no es valido');
			if($this->form_validation->run()!=false) {
				$id = $this->session->userdata('id');
				$nick = $this->input->post('nick');
				$nombre = $this->input->post('nombre');
				$correo = $this->input->post('correo');
				$edad = $this->input->post('edad');
				$this->load->model('usuario_model');
				$this->usuario_model->editar_cuenta($id, $nick, $nombre, $correo, $edad);
				$datos["mensaje"]="Cambio realizado con éxito";
			}else{
				$datos["mensaje"]="";
			}
			redirect('index.php/usuarios/verCuentas');
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
			$this->form_validation->set_rules('nick', 'Nombre de Usuario', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			$this->form_validation->set_rules('password2', 'Contraseña', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			$this->form_validation->set_rules('edad', 'Edad', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			$this->form_validation->set_message('valid_email','El correo no es valido');
			if($this->form_validation->run()!=false) {
				$nick = $this->input->post('nick');
				$nombre = $this->input->post('nombre');
				$correo = $this->input->post('correo');
				$password = $this->input->post('password');
				$edad = $this->input->post('edad');
				$this->load->model('usuario_model');
				if($this->usuario_model->registrar_usuario($nick, $nombre, $correo, $password, $edad)){
					$datos['mensaje']="Registro completado correctamente";
					$this->load->view('usuarios/iniciar_sesion',$datos);
				}else{
					$datos["mensaje"]="No se ha registrado correctamente";
					$this->load->view('usuarios/registro',$datos);
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
	 * Eliminar un usuarios
	 */
	public function  eliminarUsuarios(){
		$id = $this->input->get('id');
		$this->load->model('usuario_model');
		$this->usuario_model->eliminar_usuario($id);
		redirect('index.php/usuarios/verUsuarios');
	}

	/**
	 * Eliminar usuario
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
		if ($this->input->post()) {
			$correo = $this->input->post('correo');
			$nombre = $this->input->post('nombre');
			$this->load->model('usuario_model');
			$contrasena=$this->usuario_model->recuperar_contrasena($correo);
			$this->load->library('email');
			$config['protocol']    = 'smtp';
			$config['smtp_host']    = 'ssl://smtp.gmail.com';
			$config['smtp_port']    = '465';
			$config['smtp_timeout'] = '7';
			$config['smtp_user']    = 'ovidigal88@gmail.com';
			$config['smtp_pass']    = 'Ovl924492594';
			$config['charset']    = 'utf-8';
			$config['newline']    = "\r\n";
			$config['mailtype'] = 'html'; // or html
			$config['validation'] = TRUE;
			$this->email->initialize($config);
			$this->email->to($correo);
			$this->email->from('ovidigal88@gmail.com','NPT');
			$this->email->subject('Recuperación de contraseña');
			foreach ($contrasena as $indice => $row){
				$this->email->message('Estmado '.$nombre.',<br/>
 				Desde NPT le informamos que hemos recibido una solicitud de recuperación de tu contraseña. <br>
 				Su contraseña es: ' .$row);
			}
			$this->email->send();
			redirect('index.php/usuarios/iniciar_sesion');
		} else {
			$this->iniciar_sesion();
		}
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
