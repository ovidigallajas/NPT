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
		$this->load->view('equipos/AnadirEquipos', $data);
	}

	public function AnadirEquipo_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('maxJugadores', 'Máximo de Jugadores', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$maxJugadores = $this->input->post('maxJugadores');
			$this->load->model('equipos_model');
			if($this->equipos_model->comprobarEquipo("",$nombre)>0){
				$datos["mensaje"] = "El nombre del equipo introducido ya existe";
				$this->load->view('equipos/AnadirEquipos', $datos);
			}else {
				if ($this->equipos_model->anadir_equipo($nombre,$maxJugadores,$this->session->userdata('id'))) {
					Redirect("index.php/equipos/verEquipos");
				} else {
					$datos["mensaje"] = "No se ha añadido correctamente";
					$this->load->view('equipos/AnadirEquipos', $datos);
				}
			}
		}else{
			$datos['mensaje']="";
			$this->load->view('equipos/AnadirEquipos', $datos);
		}
	}

	public function editarEquipo(){
		$data = array(
			'idEquipo' => $this->input->get('i'),
			'nombre' => $this->input->get('n'),
			'maxJugadores' => $this->input->get('m')
		);
		$this->load->view('equipos/EditarEquipos', $data);
	}

	public function editarEquipo_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('maxJugadores', 'Máximo de Jugadores', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$id = $this->input->post('idEquipo');
			$maxJugadores = $this->input->post('maxJugadores');
			$this->load->model('equipos_model');
			if($this->equipos_model->comprobarEquipo($id,$nombre)>0){
				$datos["mensaje"] = "El nombre del equipo introducido ya existe";
				$datos["nombre"] = $nombre;
				$datos["idEquipo"] = $id;
				$datos["maxJugadores"] = $maxJugadores;
				$this->load->view('equipos/EditarEquipos', $datos);
			}else {
				if ($this->equipos_model->editar_equipo($id,$nombre,$maxJugadores)) {
					Redirect("index.php/equipos/verEquipos");
				} else {
					$datos["mensaje"] = "No se ha añadido correctamente";
					$this->load->view('equipos/AnadirEquipos', $datos);
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
