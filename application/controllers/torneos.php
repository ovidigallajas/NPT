<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Class videojuegos
 */
class torneos extends CI_Controller
{
	/**
	 * videojuegos constructor.
	 */
	public function __construct()
	{
		parent::__construct();
	}

	public function verTorneos()
	{
		$this->load->model('torneos_model');
		$data = array();
		$data['torneos'] = $this->torneos_model->ver_torneos();
		$this->load->view('torneos/verTorneos', $data);
	}

	public function OrganizarTorneos(){
		$this->load->model('torneos_model');
		$data = array();
		$data['torneos'] = $this->torneos_model->ver_mis_torneos($this->session->userdata('id'));
		$this->load->view('torneos/Organizador', $data);
	}

	public function AnadirTorneo()
	{
		$this->load->model('videojuegos_model');
		$data = array();
		$data['juegos'] = $this->videojuegos_model->ver_videojuegos();
		$data['plataforma'] = $this->videojuegos_model->ver_plataforma();
		$this->load->view('torneos/AnadirTorneo', $data);
	}

	public function AnadirTorneo_post()
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio');
		if ($this->form_validation->run() != false) {
			$nombre = $this->input->post('nombre');
			$this->load->model('torneos_model');
			if ($this->torneos_model->comprobarTorneo($nombre) > 0) {
				$datos["mensaje"] = "El nombre del torneo introducida ya existe";
				$this->load->view('torneos/AnadirTorneo', $datos);
			} else {

				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha registrado correctamente";
					$this->load->view('torneos/AnadirTorneo', $datos);
				} else {
					$this->load->model('torneos_model');
					$datos["img"] = $this->upload->data();

					if ($this->torneos_model->anadir_torneo($nombre, $datos["img"]["file_name"])) {
						Redirect("index.php/torneos/verTorneos");
					} else {
						$datos["mensaje"] = "No se ha registrado correctamente";
						$this->load->view('torneos/AnadirTorneo', $datos);
					}
				}
			}
		} else {
			$datos['mensaje'] = "";
			$this->load->view('torneos/AnadirTorneo', $datos);
		}
	}

	public function editarTorneo()
	{
		$data = array(
			'id' => $this->input->get('id'),
			'nombre' => $this->input->get('n')
		);
		$this->load->view('torneos/EditarTorneo', $data);
	}

	public function editarTorneo_post()
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio');
		if ($this->form_validation->run() != false) {
			$nombre = $this->input->post('nombre');
			$id = $this->input->post('id');
			$this->load->model('torneos_model');
			if ($this->torneos_model->comprobarTorneo($nombre) > 0) {
				$datos["mensaje"] = "El nombre de la plataforma introducida ya existe";
				$datos["nombre"] = $nombre;
				$datos["id"] = $id;
				$this->load->view('torneo/EditarTorneo', $datos);
			} else {

				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";
				$config['overwrite'] = true;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha editado correctamente";
					$this->load->view('torneo/EditarTorneo', $datos);
				} else {
					$this->load->model('torneos_model');
					$datos["img"] = $this->upload->data();

					if ($this->torneos_model->editar_torneo($id, $nombre, $datos["img"]["file_name"])) {
						Redirect("index.php/torneos/verTorneos");
					} else {
						$datos["mensaje"] = "No se ha editado correctamente";
						$this->load->view('torneos/EditarTorneo', $datos);
					}
				}
			}
		} else {
			$datos['mensaje'] = "";
			$this->load->view('torneos/EditarTorneo', $datos);
		}
	}

	public function eliminarTorneo()
	{
		$id = $this->input->get('id');
		$imagen = $this->input->get('i');
		$this->load->model('torneos_model');
		$this->torneos_model->eliminar_torneo($id);
		$path_to_file = 'recursos/imagenes/' . $imagen . '';
		unlink($path_to_file);
		Redirect('index.php/torneos/verTorneos');
	}

}
