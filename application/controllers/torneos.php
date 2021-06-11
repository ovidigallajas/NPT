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

	/**
	 * Saca todos los torneos individuales
	 */
	public function verTorneosIndividuales($mensaje="")
	{
		$this->load->model('torneos_model');
		$data = array();
		$data['mensaje']=$mensaje;
		$data['torneosi'] = $this->torneos_model->ver_torneos_individuales($this->session->userdata('id'));
		$this->load->view('torneos/verTorneosIndividuales', $data);
	}

	/**
	 * Saca todos los torneos en equipo
	 */
	public function verTorneosEquipos($mensaje="")
	{
		$this->load->model('torneos_model');
		//$this->load->model('equipos_model');
		$data = array();
		$data['mensaje']=$mensaje;
		$data['torneose'] = $this->torneos_model->ver_torneos_equipo();
		//$data['equipos'] = $this->torneos_model->equipos_validos($this->session->userdata('id'));
		$this->load->view('torneos/verTorneosEquipos', $data);
	}

	/**
	 * Saca todos los torneos en individuales en los que está inscrito el usuario
	 */
	public function verMisTorneosIndi($mensaje="")
	{
		$this->load->model('torneos_model');
		$data = array();
		$data['mensaje']=$mensaje;
		$data['mistorneosi'] = $this->torneos_model->ver_toneos_inscrito_indi($this->session->userdata('id'));
		$this->load->view('torneos/verMisTorneosIndi', $data);
	}

	/**
	 * Saca todos los torneos en equipo en los que está inscrito el usuario
	 */
	public function verMisTorneosEquipo($mensaje="")
	{
		$this->load->model('torneos_model');
		$data = array();
		$data['mensaje']=$mensaje;
		$data['mistorneose'] = $this->torneos_model->ver_toneos_inscrito_equipo($this->session->userdata('id'));
		$this->load->view('torneos/verMisTorneosEquipos', $data);
	}

	/**
	 * Saca el listado de los torneos que ha creado el usuario
	 * @param string $mensaje
	 */
	public function OrganizarTorneos($mensaje = ""){
		$this->load->model('torneos_model');
		$data = array();
		$data['torneosi'] = $this->torneos_model->ver_mis_torneos_individuales($this->session->userdata('id'));
		$data['torneose'] = $this->torneos_model->ver_mis_torneos_equipo($this->session->userdata('id'));
		$data['mensaje'] = $mensaje;
		$this->load->view('torneos/Organizador', $data);
	}

	/**
	 * Saca los participantes de un torneo individual
	 */
	public function participantes(){
		$torneo = $this->input->get('i');
		$this->load->model('torneos_model');
		$data = array();
		$data['jugadores'] = $this->torneos_model->ver_participantes($torneo);
		$data['torneo']=$torneo;
		$this->load->view('torneos/Participantes', $data);
	}

	/**
	 * Añade los ganadores de un torneo
	 */
	public function ganador_post(){
		$this->form_validation->set_rules('ganador', 'Ganador', 'required');
		if ($this->form_validation->run() != false) {
			$this->load->model('torneos_model');
			$idGanador=$this->input->post('ganador');
			$idTorneo=$this->input->post('torneo');
			$data = array();
		/*	if($this->torneos_model->comprobar_ganador($idTorneo)>0){
				$this->torneos_model->eliminar_ganador($idTorneo);*/
				if($this->torneos_model->ganador($idTorneo,$idGanador)){
					//$datos["confirmacion"] = "Ganador establecido con éxito";
					Redirect('index.php/torneos/OrganizarTorneos');
				}else{
					$data["mensaje"] = "Ganador establecido con éxito";
					$this->load->view('torneos/Participantes', $data);
				}
		/*	}else{
				if($this->torneos_model->ganador($idTorneo,$idGanador)){
					//$datos["confirmacion"] = "Ganador establecido con éxito";
					Redirect('index.php/torneos/OrganizarTorneos');
				}else{
					$data["mensaje"] = "Ganador establecido con éxito";
					$this->load->view('torneos/Participantes', $data);
				}
			}*/

		}
	}

	/**
	 * Carga el formulario para añadir un torneo
	 * @param string $mensaje
	 */
	public function AnadirTorneo($mensaje = "")
	{
		$this->load->model('videojuegos_model');
		$data = array();
		$data['mensaje'] = $mensaje;
		$data['juegos'] = $this->videojuegos_model->ver_videojuegos();
		$data['plataforma'] = $this->videojuegos_model->ver_plataforma();
		$this->load->view('torneos/AnadirTorneo', $data);
	}

	/**
	 * Añade un torneo
	 */
	public function AnadirTorneo_post()
	{
		/**
		 * Comprueba que no haya campos vacíos
		 */
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
			//$fechaInicio = str_replace("%/%","-",$this->input->post('fechaInicio'));
			//$fechaFin = str_replace("%/%","-",$this->input->post('fechaFin'));
			$fechaInicio = $this->input->post('fechaInicio');
			$fechaFin = $this->input->post('fechaFin');
			$pinscripcion = $this->input->post('pinscripcion');
			$premio = $this->input->post('premio');
			$numJugadores = $this->input->post('numJugadores');
			$numJugadoresEquipo = $this->input->post('numJugadoresEquipo');
			$rondas = $this->input->post('rondas');
			/**
			 * Si el torneo es individual se guarda a null el número de jugadores por equipo
			 * y si el torneo es en equipo se guarda a null el numero de juegadores
			 */
			if($numJugadores==""){
				$numJugadores=null;
			}
			if($numJugadoresEquipo==""){
				$numJugadoresEquipo=null;
			}
			/**
			 * Cambia del formato dd/MM/YYYY a YYYY-MM-dd para poder guardarla en base de datos
			 */
			$fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicio);
			$fechaFin = DateTime::createFromFormat('d/m/Y', $fechaFin);
			$fechaInicio = $fechaInicio->format('Y-m-d');
			$fechaFin= $fechaFin->format('Y-m-d');
			$this->load->model('torneos_model');
			/**
			 * Comprueba si el nombre del torneo existe
			 */
			if ($this->torneos_model->comprobarTorneo("",$nombre) > 0) {
				$datos["mensaje"] = "El nombre del torneo introducida ya existe";
				$this->AnadirTorneo($datos['mensaje']);
			} else {
				/**
				 * Añade el torneo
				 */
				if ($this->torneos_model->anadir_torneo($nombre, $pinscripcion, $premio, $numJugadores, $numJugadoresEquipo, $fechaInicio, $fechaFin, $rondas, $this->session->userdata('id'),$juego,$plataforma)) {
					$datos['mensaje'] = "Torneo creado correctamente";
					//$this->load->view('torneos/Organizador', $datos);
					$this->OrganizarTorneos($datos['mensaje']);
				} else {
					$datos["mensaje"] = "No se ha creado correctamente";
					$this->AnadirTorneo($datos['mensaje']);
				}
			}
		} else {
			$datos['mensaje'] = "";
			//$this->load->view('torneos/AnadirTorneo', $datos);
			$this->AnadirTorneo($datos['mensaje']);
		}
	}

	/**
	 * Recoge los datos pasador por url y carga el formulario para editar torneos
	 * @param string $mensaje
	 */
	public function editarTorneo($mensaje = "")
	{
		//$data=unserialize(urldecode($this->input->get('i')));
		//$data=unserialize($this->input->get('i'));
		$data = array(
			'idTorneo' => $this->input->get('i'),
			'idJuego' => $this->input->get('j'),
			'nombre' => $this->input->get('n'),
			'idPlataforma' => $this->input->get('p'),
			'fechaInicio' => $this->input->get('fi'),
			'fechaFin' => $this->input->get('ff'),
			'maxJugadores' => $this->input->get('mj'),
			'maxJugadoresEquipos' => $this->input->get('mje'),
			'pInscripcion' => $this->input->get('pi'),
			'premio' => $this->input->get('pr'),
			'rondas' => $this->input->get('r')
		);

		$this->load->model('videojuegos_model');
		$data['mensaje'] = $mensaje;
		$data['juegos'] = $this->videojuegos_model->ver_videojuegos();
		$data['plataformas'] = $this->videojuegos_model->ver_plataforma();
		$this->load->view('torneos/EditarTorneo', $data);
	}

	/**
	 * Recoge los campos del formulario y edita el torneo
	 */
	public function editarTorneo_post()
	{
		/**
		 * Recoge los datos del formulario y los guarda en un array
		 */
		$this->load->model('videojuegos_model');
		$datos = array(
			'idTorneo' => $this->input->post('idTorneo'),
			'idJuego' => $this->input->post('juego'),
			'nombre' => $this->input->post('nombreTorneo'),
			'idPlataforma' => $this->input->post('plataforma'),
			'fechaInicio' => $this->input->post('fechaInicio'),
			'fechaFin' => $this->input->post('fechaFin'),
			'maxJugadores' => $this->input->post('numJugadores'),
			'maxJugadoresEquipos' => $this->input->post('numJugadoresEquipo'),
			'pInscripcion' => $this->input->post('pinscripcion'),
			'premio' => $this->input->post('premio'),
			'rondas' => $this->input->post('rondas'),
			'juegos' => $this->videojuegos_model->ver_videojuegos(),
			'plataformas' => $this->videojuegos_model->ver_plataforma()
		);
		/**
		 * Comprueba que todos los campos esten rellenos
		 */
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
			/**
			 * Recoge los datos del formulario
			 */
			$id = $this->input->post('idTorneo');
			$nombre = $this->input->post('nombreTorneo');
			$juego = $this->input->post('juego');
			$plataforma = $this->input->post('plataforma');
			$fechaInicio = $this->input->post('fechaInicio');
			$fechaFin = $this->input->post('fechaFin');
			$pinscripcion = $this->input->post('pinscripcion');
			$premio = $this->input->post('premio');
			$numJugadores = $this->input->post('numJugadores');
			$numJugadoresEquipo = $this->input->post('numJugadoresEquipo');
			$rondas = $this->input->post('rondas');
			/**
			 * Si el torneo es individual se guarda a null el número de jugadores por equipo
			 * y si el torneo es en equipo se guarda a null el numero de juegadores
			 */
			if($numJugadores==""){
				$numJugadores=null;
			}
			if($numJugadoresEquipo==""){
				$numJugadoresEquipo=null;
			}
			/**
			 * Cambia del formato dd/MM/YYYY a YYYY-MM-dd para poder guardarla en base de datos
			 */
			$fechaInicio = DateTime::createFromFormat('d/m/Y', $fechaInicio);
			$fechaFin = DateTime::createFromFormat('d/m/Y', $fechaFin);
			$fechaInicio = $fechaInicio->format('Y-m-d');
			$fechaFin= $fechaFin->format('Y-m-d');
			$this->load->model('torneos_model');
			/**
			 * Comprueba si el nombre del torneo existe
			 */
			if ($this->torneos_model->comprobarTorneo($id,$nombre) > 0) {
				$datos["mensaje"] = "El nombre del torneo introducido ya existe";
				$this->load->view('torneos/EditarTorneo', $datos);
			} else {
				/**
				 * Edita el torneo
				 */
				if ($this->torneos_model->editar_torneo($id,$nombre, $pinscripcion, $premio, $numJugadores, $numJugadoresEquipo, $fechaInicio, $fechaFin,$rondas,$juego,$plataforma)) {
						$datos['mensaje'] = "Torneo editado correctamente";
						//$this->load->view('torneos/Organizador', $datos);
						$this->OrganizarTorneos($datos['mensaje']);
				} else {
					$datos["mensaje"] = "No se ha editado correctamente";
					$this->load->view('torneos/EditarTorneo', $datos);
				}
			}
		} else {
			$datos['mensaje'] = "";
			//$this->load->view('torneos/AnadirTorneo', $datos);
			$this->load->view('torneos/EditarTorneo', $datos);
			//$this->editarTorneo($datos['mensaje']);
		}
	}

	/**
	 * Inscribirse a un torneo individual
	 */
	public function inscribirse(){
		$this->load->model('torneos_model');
		$data = array();
		$id=$this->session->userdata('id');
		if(!$this->torneos_model->inscribirse($this->input->get('i'),$id)){
			$data['mensaje']="No se ha inscrito correctamente";
			$data['torneosi'] = $this->torneos_model->ver_torneos_individuales($id);
			$this->load->view('torneos/verTorneosIndividuales', $data);
		}else {
			$data['mensaje']="Inscrito correctamente";
			$data['torneosi'] = $this->torneos_model->ver_torneos_individuales($id);
			$this->load->view('torneos/verTorneosIndividuales', $data);
		}
	}

	/**
	 * Recibe el torneo al que se quiere inscribir un equipo y le saca el listado de equipos validos para la inscripción
	 */
	public function inscribir_equipo(){
		$torneo = $this->input->get('i');
		$jugadores = $this->input->get('j');
		$this->load->model('equipos_model');
		$data = array();
		$data['equipos'] = $this->equipos_model->equipos_validos($this->session->userdata('id'),$jugadores);
		//$data['equipos'] = $this->equipos_model->equipos_validos($this->session->userdata('id'));
		$data['torneo']=$torneo;
		$this->load->view('torneos/EquiposInscribir', $data);
	}

	/**
	 * Inscribir equipos a torneo
	 */
	public function inscribir_equipo_post(){
		$torneo = $this->input->post('torneo');
		$equipo = $this->input->post('equipo');
		$this->load->model('torneos_model');
		if($this->torneos_model->inscribir_equipo($torneo,$equipo)){
			Redirect('index.php/torneos/verMisTorneosEquipo');
		}else{
			Redirect('index.php/torneos/inscribir_equipo');
		}
	}

	/**
	 * Desinscribirse a un torneo individual
	 */
	public function desinscribirse(){
		$this->load->model('torneos_model');
		$data = array();
		$id=$this->session->userdata('id');
		if(!$this->torneos_model->desinscribirse($this->input->get('i'),$id)){
			$data['mensaje']="No se ha desinscribido correctamente";
			$data['mistorneosi'] = $this->torneos_model->ver_toneos_inscrito_indi($id);
			$this->load->view('torneos/verMisTorneosIndi', $data);
		}else {
			$data['mistorneosi'] = $this->torneos_model->ver_toneos_inscrito_indi($id);
			$this->load->view('torneos/verMisTorneosIndi', $data);
		}
	}

	/**
	 * Desinscribir equipo de un torneo individual
	 */
	public function desinscribir_equipo(){
		$this->load->model('torneos_model');
		$data = array();
		$id=$this->session->userdata('id');
		if(!$this->torneos_model->desinscribir_equipo($this->input->get('i'),$this->input->get('e'))){
			$data['mensaje']="No se ha desinscribido correctamente";
			$data['mistorneose'] = $this->torneos_model->ver_toneos_inscrito_equipo($id);
			$this->load->view('torneos/verMisTorneosEquipo', $data);
		}else {
			$data['mistorneose'] = $this->torneos_model->ver_toneos_inscrito_equipo($id);
			$this->load->view('torneos/verMisTorneosEquipo', $data);
		}
	}

	/**
	 * Elimina un torneo
	 */
	public function eliminarTorneo()
	{
		$id = $this->input->get('id');
		$this->load->model('torneos_model');
		$this->torneos_model->eliminar_torneo($id);
		Redirect('index.php/torneos/OrganizarTorneos');
	}

}
