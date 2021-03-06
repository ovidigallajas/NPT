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

	/**
	 * Saca todos los equipos en los que este inscrito el usuario
	 */
	public function verMisEquipos(){
		$this->load->model('equipos_model');
		$data=array();
		$data['equipos'] = $this->equipos_model->ver_mis_equipos($this->session->userdata('id'));
		$this->load->view('equipos/VerMisEquipos',$data);
	}

	/**
	 * Saca todos los equipos
	 */
	public function verEquipos(){
		$this->load->model('equipos_model');
		$data=array();
		$data['equipos'] = $this->equipos_model->ver_equipos($this->session->userdata('id'));
		$this->load->view('equipos/VerEquipos',$data);
	}

	/**
	 * Carga el formulario para añadir equipos
	 */
	public function AnadirEquipo() {
		$data = array();
		$this->load->view('equipos/AnadirEquipos', $data);
	}

	/**
	 * Recoge los datos del formulario y añade el equipo
	 */
	public function AnadirEquipo_post(){
		/**
		 * Comprueba que no haya campos vacíos
		 */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('maxJugadores', 'Máximo de Jugadores', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$maxJugadores = $this->input->post('maxJugadores');
			$this->load->model('equipos_model');
			/**
			 * Comprueba que el nombre del equipo no exista
			 */
			if($this->equipos_model->comprobarEquipo("",$nombre)>0){
				$datos["mensaje"] = "El nombre del equipo introducido ya existe";
				$this->load->view('equipos/AnadirEquipos', $datos);
			}else {
				/**
				 * Crea el equipo
				 */
				if ($this->equipos_model->anadir_equipo($nombre,$maxJugadores,$this->session->userdata('id'))) {
					Redirect("index.php/equipos/verMisEquipos");
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

	/**
	 * Carga el formulario para editar equipos
	 */
	public function editarEquipo(){
		$data = array(
			'idEquipo' => $this->input->get('i'),
			'nombre' => $this->input->get('n'),
			'maxJugadores' => $this->input->get('m')
		);
		$this->load->view('equipos/EditarEquipos', $data);
	}

	/**
	 * Recoge los datos del formulario y edita el equipo
	 */
	public function editarEquipo_post(){
		/**
		 * Comprueba que no haya campos vacíos
		 */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('maxJugadores', 'Máximo de Jugadores', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$id = $this->input->post('idEquipo');
			$maxJugadores = $this->input->post('maxJugadores');
			$this->load->model('equipos_model');
			/**
			 * Comprueba que no exista el nombre del equipo
			 */
			if($this->equipos_model->comprobarEquipo($id,$nombre)>0){
				$datos["mensaje"] = "El nombre del equipo introducido ya existe";
				$datos["nombre"] = $nombre;
				$datos["idEquipo"] = $id;
				$datos["maxJugadores"] = $maxJugadores;
				$this->load->view('equipos/EditarEquipos', $datos);
			}else {
				/**
				 * Edita el equipo
				 */
				if ($this->equipos_model->editar_equipo($id,$nombre,$maxJugadores)) {
					Redirect("index.php/equipos/verMisEquipos");
				} else {
					$datos = array(
						'mensaje'=>'',
						'nombre'=>$this->input->post('nombre'),
						'idEquipo'=>$this->input->post('idEquipo'),
						'maxJugadores'=>$this->input->post('maxJugadores')
					);
					$this->load->view('equipos/EditarEquipos', $datos);
				}
			}
		}else{
			$datos = array(
				'mensaje'=>'',
				'nombre'=>$this->input->post('nombre'),
				'idEquipo'=>$this->input->post('idEquipo'),
				'maxJugadores'=>$this->input->post('maxJugadores')
			);
			$this->load->view('equipos/EditarEquipos', $datos);
		}
	}

	/**
	 * Unirse a un equipo
	 */
	public function unirse(){
		$this->load->model('equipos_model');
		$data = array();
		$id=$this->session->userdata('id');
		if($this->equipos_model->unirse($this->input->get('i'),$id)){
			$data['mensaje']="No se ha unido correctamente";
		}
		$data['equipos'] = $this->equipos_model->ver_equipos($id);
		$this->load->view('equipos/verEquipos', $data);
	}

	/**
	 * Salirse de un equipo
	 */
	public function salirse(){
		$this->load->model('equipos_model');
		$data = array();
		$id=$this->session->userdata('id');
		if($this->equipos_model->salirse($this->input->get('i'),$id)){
			$data['mensaje']="No se ha unido correctamente";
		}
		$data['equipos'] = $this->equipos_model->ver_mis_equipos($id);
		$this->load->view('equipos/verMisEquipos', $data);
	}

	/**
	 * Elimina un equipo
	 */
	public function  eliminarEquipo(){
		$id = $this->input->get('i');
		$this->load->model('equipos_model');
		$this->equipos_model->eliminar_equipo($id);
		Redirect('index.php/equipos/verEquipos');
	}
}
