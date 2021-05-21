<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class videojuegos
 */
class videojuegos extends CI_Controller {
	/**
	 * videojuegos constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	public function verPlataformas(){
			$this->load->model('videojuegos_model');
			$data=array();
			$data['plataforma'] = $this->videojuegos_model->ver_plataforma();
			$this->load->view('videojuegos/VerPlataformas',$data);
	}

	public function AnadirPlataforma() {
		$data = array();
		$this->load->view('videojuegos/AnadirPlataforma', $data);
	}

	public function AnadirPlataforma_post(){
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			if($this->form_validation->run()!=false) {
				$nombre = $this->input->post('nombre');
				$this->load->model('videojuegos_model');
				if($this->videojuegos_model->comprobarPlataforma($nombre)>0){
					$datos["mensaje"] = "El nombre de la plataforma introducida ya existe";
					$this->load->view('videojuegos/AnadirPlataforma', $datos);
				}else {

					$config['upload_path'] = "recursos/imagenes/";
					$config['file_name'] = $nombre;
					$config['allowed_types'] = "jpg|png|jpeg";

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload()) {
						$datos["mensaje"] = "No se ha registrado correctamente";
						$this->load->view('videojuegos/AnadirPlataforma', $datos);
					} else {
						$this->load->model('videojuegos_model');
						$datos["img"] = $this->upload->data();

						if ($this->videojuegos_model->anadir_plataforma($nombre, $datos["img"]["file_name"])) {
							Redirect("index.php/videojuegos/verPlataformas");
						} else {
							$datos["mensaje"] = "No se ha registrado correctamente";
							$this->load->view('videojuegos/AnadirPlataforma', $datos);
						}
					}
				}
			}else{
				$datos['mensaje']="";
				$this->load->view('videojuegos/AnadirPlataforma', $datos);
			}
	}

	public function editarPlataforma(){
		$data = array(
			'id' => $this->input->get('id'),
			'nombre' => $this->input->get('n')
		);
		$this->load->view('videojuegos/EditarPlataforma', $data);
	}

	public function editarPlataforma_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$id = $this->input->post('id');
			$this->load->model('videojuegos_model');
			if($this->videojuegos_model->comprobarPlataforma($nombre)>0){
				$datos["mensaje"] = "El nombre de la plataforma introducida ya existe";
				$datos["nombre"] = $nombre;
				$datos["id"] = $id;
				$this->load->view('videojuegos/EditarPlataforma', $datos);
			}else {

				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";
				$config['overwrite'] = true;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha editado correctamente";
					$this->load->view('videojuegos/EditarPlataforma', $datos);
				} else {
					$this->load->model('videojuegos_model');
					$datos["img"] = $this->upload->data();

					if ($this->videojuegos_model->editar_plataforma($id, $nombre, $datos["img"]["file_name"])) {
						Redirect("index.php/videojuegos/verPlataformas");
					} else {
						$datos["mensaje"] = "No se ha editado correctamente";
						$this->load->view('videojuegos/EditarPlataforma', $datos);
					}
				}
			}
		}else{
			$datos['mensaje']="";
			$this->load->view('videojuegos/EditarPlataforma', $datos);
		}
	}

	public function  eliminarPlataformas(){
		$id = $this->input->get('id');
		$imagen = $this->input->get('i');
		$this->load->model('videojuegos_model');
		$this->videojuegos_model->eliminar_plataforma($id);
		$path_to_file = 'recursos/imagenes/'.$imagen.'';
		unlink($path_to_file);
		Redirect('index.php/videojuegos/verPlataformas');
	}

	public function verVideojuegos(){
		$this->load->model('videojuegos_model');
		$data=array();
		$data['videojuegos'] = $this->videojuegos_model->ver_videojuegos();
		$this->load->view('videojuegos/VerVideojuegos',$data);
	}

	public function AnadirVideojuego() {
		$data = array();
		$this->load->view('videojuegos/AnadirVideojuego', $data);
	}

	public function AnadirVideojuego_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('edad', 'Edad', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$descripcion = $this->input->post('descripcion');
			$tipo = $this->input->post('tipo');
			$edad = $this->input->post('edad');
			$this->load->model('videojuegos_model');
			if($this->videojuegos_model->comprobarJuego($nombre)>0){
				$datos["mensaje"] = "El nombre del videojuego introducido ya existe";
				$this->load->view('videojuegos/AnadirVideojuego', $datos);
			}else {

				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha registrado correctamente";
					$this->load->view('videojuegos/AnadirVideojuego', $datos);
				} else {
					$this->load->model('videojuegos_model');
					$datos["img"] = $this->upload->data();

					if ($this->videojuegos_model->anadir_videojuego($nombre, $descripcion, $tipo, $edad, $datos["img"]["file_name"])) {
						Redirect("index.php/videojuegos/verVideojuegos");
					} else {
						$datos["mensaje"] = "No se ha registrado correctamente";
						$this->load->view('videojuegos/AnadirVideojuego', $datos);
					}
				}
			}
		}else{
			$datos['mensaje']="";
			$this->load->view('videojuegos/AnadirVideojuego', $datos);
		}
	}

	public function editarVideojuego(){
		$data = array(
			'id' => $this->input->get('id'),
			'nombre' => $this->input->get('n'),
			'edad' => $this->input->get('e'),
			'descripcion' => $this->input->get('d'),
			'tipo' => $this->input->get('t')
		);
		$this->load->view('videojuegos/EditarVideojuego', $data);
	}

	public function editarVideojuego_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('edad', 'Edad', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$this->load->model('videojuegos_model');
			if($this->videojuegos_model->comprobarJuego($nombre)>0){
				$datos["mensaje"] = "El nombre del videojuego introducido ya existe";
				$datos["nombre"] = $nombre;
				$datos["id"] = $id;
				$this->load->view('videojuegos/EditarVideojuego', $datos);
			}else {
				$descripcion = $this->input->post('descripcion');
				$tipo = $this->input->post('tipo');
				$edad = $this->input->post('edad');

				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";
				$config['overwrite'] = true;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha editado correctamente";
					$this->load->view('videojuegos/EditarVideojuegos', $datos);
				} else {
					$this->load->model('videojuegos_model');
					$datos["img"] = $this->upload->data();

					if ($this->videojuegos_model->editar_videojuego($id, $nombre, $descripcion, $tipo, $edad, $datos["img"]["file_name"])) {
						Redirect("index.php/videojuegos/verVideojuego");
					} else {
						$datos["mensaje"] = "No se ha editado correctamente";
						$this->load->view('videojuegos/EditarVideojuego', $datos);
					}
				}
			}
		}else{
			$datos['mensaje']="";
			$this->load->view('videojuegos/EditarVideojuego', $datos);
		}
	}

	public function eliminarVideojuego(){
		$id = $this->input->get('id');
		$imagen = $this->input->get('i');
		$this->load->model('videojuegos_model');
		$this->videojuegos_model->eliminar_videojuego($id);
		$path_to_file = 'recursos/imagenes/'.$imagen.'';
		unlink($path_to_file);
		Redirect('index.php/videojuegos/VerVideojuegos');
	}
}
