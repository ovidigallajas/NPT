<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class equipos
 */
class equipos extends CI_Controller {
	/**
	 * equipos constructor.
	 */
	public function __construct() {
		parent::__construct();
	}

	public function verEquipos(){
		$this->load->model('equipos_model');
		$data=array();
		$data['equipos'] = $this->equipos_model->ver_equipos();
		$this->load->view('equipos/VerEquipos',$data);
	}

	public function AnadirEquipo() {
		$data = array();
		$this->load->view('videojuegos/AnadirPlataforma', $data);
	}

	public function AnadirEquipo_post(){
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

	public function editarEquipo(){
		$data = array(
			'id' => $this->input->get('id'),
			'nombre' => $this->input->get('n')
		);
		$this->load->view('videojuegos/EditarPlataforma', $data);
	}

	public function editarEquipo_post(){
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

	public function  eliminarEquipo(){
		$id = $this->input->get('i');
		$this->load->model('equipos_model');
		$this->equipos_model->eliminar_equipo($id);
		Redirect('index.php/equipos/verEquipos');
	}
}
