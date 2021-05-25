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

	public function OrganizarTorneos($mensaje = ""){
		$this->load->model('torneos_model');
		$data = array();
		$data['torneos'] = $this->torneos_model->ver_mis_torneos($this->session->userdata('id'));
		$data['mensaje'] = $mensaje;
		$this->load->view('torneos/Organizador', $data);
	}

	public function AnadirTorneo($mensaje = "")
	{
		$this->load->model('videojuegos_model');
		$data = array();
		$data['mensaje'] = $mensaje;
		$data['juegos'] = $this->videojuegos_model->ver_videojuegos();
		$data['plataforma'] = $this->videojuegos_model->ver_plataforma();
		$this->load->view('torneos/AnadirTorneo', $data);
	}

	public function AnadirTorneo_post()
	{
		$this->form_validation->set_rules('nombreTorneo', 'Nombre del Torneo', 'required');
		$this->form_validation->set_rules('juego', 'Juego', 'required');
		$this->form_validation->set_rules('plataforma', 'Plataforma', 'required');
		$this->form_validation->set_rules('fechaInicio', 'Fecha Inicio', 'required');
		$this->form_validation->set_rules('fechaFin', 'Fecha Fin', 'required');
		$this->form_validation->set_rules('pinscripcion', 'Precio de Inscripción', 'required');
		$this->form_validation->set_rules('premio', 'Premio', 'required');
		$this->form_validation->set_rules('tipoJugadores', 'Tipo de Torneo', 'required');
		$this->form_validation->set_rules('rondas', 'Rondas', 'required');
		$this->form_validation->set_message('required', 'El campo %s es obligatorio');
		if ($this->form_validation->run() != false) {
			$nombre = $this->input->post('nombreTorneo');
			$juego = $this->input->post('juego');
			$plataforma = $this->input->post('plataforma');
			$fechaInicio = str_replace("%/%","-",$this->input->post('fechaInicio'));
			$fechaFin = str_replace("%/%","-",$this->input->post('fechaFin'));
			$pinscripcion = $this->input->post('pinscripcion');
			$premio = $this->input->post('premio');
			$numJugadores = $this->input->post('numJugadores');
			$numJugadoresEquipo = $this->input->post('numJugadoresEquipo');
			$rondas = $this->input->post('rondas');
			if($numJugadores==""){
				$numJugadores=null;
			}
			if($numJugadoresEquipo==""){
				$numJugadoresEquipo=null;
			}
			$fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicio);
			$fechaFin = DateTime::createFromFormat('d/m/Y', $fechaFin);
			$fechaInicio = $fechaInicio->format('Y-m-d');
			$fechaFin= $fechaFin->format('Y-m-d');
			$this->load->model('torneos_model');
			if ($this->torneos_model->comprobarTorneo($nombre) > 0) {
				$datos["mensaje"] = "El nombre del torneo introducida ya existe";
				$this->load->view('torneos/AnadirTorneo', $datos);
			} else {
				if ($this->torneos_model->anadir_torneo($nombre, $pinscripcion, $premio, $numJugadores, $numJugadoresEquipo, $fechaInicio, $fechaFin, $rondas, $this->session->userdata('id'),$juego,$plataforma)) {
					$datos['mensaje'] = "Torneo creado correctamente";
					//$this->load->view('torneos/Organizador', $datos);
					$this->OrganizarTorneos($datos['mensaje']);
				} else {
					$datos["mensaje"] = "No se ha creado correctamente";
					$this->load->view('torneos/AnadirTorneo', $datos);
				}
			}
		} else {
			$datos['mensaje'] = "";
			//$this->load->view('torneos/AnadirTorneo', $datos);
			$this->AnadirTorneo($datos['mensaje']);
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
		$this->load->model('torneos_model');
		$this->torneos_model->eliminar_torneo($id);
		Redirect('index.php/torneos/OrganizarTorneos');
	}

}
