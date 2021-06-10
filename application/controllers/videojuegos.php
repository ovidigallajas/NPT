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

	/**
	 * Saca todas las plataformas
	 */
	public function verPlataformas(){
			$this->load->model('videojuegos_model');
			$data=array();
			$data['plataforma'] = $this->videojuegos_model->ver_plataforma();
			$this->load->view('videojuegos/VerPlataformas',$data);
	}

	/**
	 * Carga el formulario para añadir una plataforma
	 */
	public function AnadirPlataforma() {
		$data = array();
		$this->load->view('videojuegos/AnadirPlataforma', $data);
	}

	/**
	 * Recoge los campos del formulario y añade la plataforma
	 */
	public function AnadirPlataforma_post(){
		/**
		 * Comprueba si se ha introducido el nombre
		 */
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
			$this->form_validation->set_message('required','El campo %s es obligatorio');
			if($this->form_validation->run()!=false) {
				/**
				 * Comprueba si el nombre de la plataforma no existe
				 */
				$nombre = $this->input->post('nombre');
				$this->load->model('videojuegos_model');
				if($this->videojuegos_model->comprobarPlataforma("",$nombre)>0){
					$datos["mensaje"] = "El nombre de la plataforma introducida ya existe";
					$this->load->view('videojuegos/AnadirPlataforma', $datos);
				}else {
					/**
					 * Subir imagen de la plataforma a la carpeta de imagenes
					 */
					$config['upload_path'] = "recursos/imagenes/";
					$config['file_name'] = $nombre;
					$config['allowed_types'] = "jpg|png|jpeg";

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload()) {
						$datos["mensaje"] = "No se ha registrado correctamente";
						$this->load->view('videojuegos/AnadirPlataforma', $datos);
					} else {
						/**
						 * Añadir la plataforma
						 */
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

	/**
	 * Carga el formulario para editar una plataforma
	 */
	public function editarPlataforma(){
		$data = array(
			'id' => $this->input->get('id'),
			'nombre' => $this->input->get('n')
		);
		$this->load->view('videojuegos/EditarPlataforma', $data);
	}

	/**
	 * Recoge los campos del formulario y edita la plataforma
	 */
	public function editarPlataforma_post(){
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			$nombre = $this->input->post('nombre');
			$id = $this->input->post('id');
			$this->load->model('videojuegos_model');
			/**
			 * Comprueba si el nombre de la plataforma no existe
			 */
			if($this->videojuegos_model->comprobarPlataforma($id,$nombre)>0){
				$datos["mensaje"] = "El nombre de la plataforma introducida ya existe";
				$datos["nombre"] = $nombre;
				$datos["id"] = $id;
				$this->load->view('videojuegos/EditarPlataforma', $datos);
			}else {
				/**
				 * Sube la imagen de la plataforma
				 */
				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";
				$config['overwrite'] = true;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha editado correctamente";
					$this->load->view('videojuegos/EditarPlataforma', $datos);
				} else {
					/**
					 * Edita la plataforma
					 */
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

	/**
	 * Elimina una plataforma y su imagen
	 */
	public function  eliminarPlataformas(){
		$id = $this->input->get('id');
		$imagen = $this->input->get('i');
		$this->load->model('videojuegos_model');
		$this->videojuegos_model->eliminar_plataforma($id);
		$path_to_file = 'recursos/imagenes/'.$imagen.'';
		unlink($path_to_file);
		Redirect('index.php/videojuegos/verPlataformas');
	}

	/**
	 * Saca todos los videojuegos
	 */
	public function verVideojuegos(){
		$this->load->model('videojuegos_model');
		$data=array();
		$data['videojuegos'] = $this->videojuegos_model->ver_videojuegos();
		$this->load->view('videojuegos/VerVideojuegos',$data);
	}

	/**
	 * Carga el formulario para añadir un videojuego
	 */
	public function AnadirVideojuego() {
		$data = array();
		$this->load->view('videojuegos/AnadirVideojuego', $data);
	}

	/**
	 * Recoge los datos del formulario y añade el videojuego
	 */
	public function AnadirVideojuego_post(){
		/**
		 * Comprueba que no se dejan campos vacíos
		 */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('edad', 'Edad', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			/**
			 * Recoge los datos del formulario
			 */
			$nombre = $this->input->post('nombre');
			$descripcion = $this->input->post('descripcion');
			$tipo = $this->input->post('tipo');
			$edad = $this->input->post('edad');
			$this->load->model('videojuegos_model');
			/**
			 * Comprueba si el nombre del vieojuego ya existe
			 */
			if($this->videojuegos_model->comprobarJuego("",$nombre)>0){
				$datos["mensaje"] = "El nombre del videojuego introducido ya existe";
				$this->load->view('videojuegos/AnadirVideojuego', $datos);
			}else {
				/**
				 * Sube la imagen del vieojuego
				 */
				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$datos["mensaje"] = "No se ha registrado correctamente";
					$this->load->view('videojuegos/AnadirVideojuego', $datos);
				} else {
					/**
					 * Añade el videojuego
					 */
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

	/**
	 * Carga el formulario para editar un videojuego
	 */
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

	/**
	 * Recoge los datos del formulario y edita el videojuego
	 */
	public function editarVideojuego_post(){
		/**
		 * Comprueba que no se dejen campos vacíos
		 */
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required');
		$this->form_validation->set_rules('tipo', 'Tipo', 'required');
		$this->form_validation->set_rules('edad', 'Edad', 'required');
		//$this->form_validation->set_rules('imagen', 'Imagen', 'required');
		$this->form_validation->set_message('required','El campo %s es obligatorio');
		if($this->form_validation->run()!=false) {
			/**
			 * Recoge los datos enviados por el formulario
			 */
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$tipo = $this->input->post('tipo');
			$edad = $this->input->post('edad');
			$descripcion = $this->input->post('descripcion');
			$this->load->model('videojuegos_model');
			/**
			 * Comprueba que el nombre del videojuego introducido no existe
			 */
			if($this->videojuegos_model->comprobarJuego($id,$nombre)>0){
				$datos = array(
					'mensaje'=> 'El nombre del videojuego introducido ya existe',
					'nombre' => $nombre,
					'id'=>$id,
					'tipo'=>$tipo,
					'edad'=>$edad,
					'descripcion'=>$descripcion
				);
				$this->load->view('videojuegos/EditarVideojuego', $datos);
			}else {
				/**
				 * Sube la imgane del videojuego
				 */
				$config['upload_path'] = "recursos/imagenes/";
				$config['file_name'] = $nombre;
				$config['allowed_types'] = "jpg|png|jpeg";
				$config['overwrite'] = true;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload()) {
					$data = array(
						'mensaje'=> 'La imagen es obligatoria',
						'nombre' => $this->input->post('nombre'),
						'id'=>$this->input->post('id'),
						'tipo'=>$this->input->post('tipo'),
						'edad'=>$this->input->post('edad'),
						'descripcion'=>$this->input->post('descripcion')
					);
					$this->load->view('videojuegos/EditarVideojuego', $data);
				} else {
					/**
					 * Edita el videojuego
					 */
					$this->load->model('videojuegos_model');
					$datos["img"] = $this->upload->data();

					if ($this->videojuegos_model->editar_videojuego($id, $nombre, $descripcion, $tipo, $edad, $datos["img"]["file_name"])) {
						Redirect("index.php/videojuegos/verVideojuegos");
					} else {
						$data = array(
							'mensaje'=> 'No se ha editado correctamente',
							'nombre' => $this->input->post('nombre'),
							'id'=>$this->input->post('id'),
							'tipo'=>$this->input->post('tipo'),
							'edad'=>$this->input->post('edad'),
							'descripcion'=>$this->input->post('descripcion')
						);
						$this->load->view('videojuegos/EditarVideojuego', $data);
					}
				}
			}
		}else{
			$datos = array(
				'mensaje'=> '',
				'nombre' => $this->input->post('nombre'),
				'id'=>$this->input->post('id'),
				'tipo'=>$this->input->post('tipo'),
				'edad'=>$this->input->post('edad'),
				'descripcion'=>$this->input->post('descripcion')
			);
			$this->load->view('videojuegos/EditarVideojuego', $datos);
		}
	}

	/**
	 * Elimina un videojuego y su imagen
	 */
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
