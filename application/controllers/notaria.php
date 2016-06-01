<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notaria extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Notaria');
		$this->load->model('Model_Catalogos');
		//$this->load->library('notariaLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$data['contenido'] = 'notaria/index';
		$data['titulo'] = 'Notarias';
		$data['query'] = $this->Model_Notaria->all();
		$this->load->view('template2', $data);
	}

	public function search() {

		$data['contenido'] 	= 'notaria/index';
		$data['titulo'] 	= 'Notarias';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Notaria->allFiltered('n.nombre', $value);
		$this->load->view('template2', $data);

	}

	public function my_validation() {

		//return $this->notarialib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'notaria/create';
		$data['titulo'] 			= 'Crear Notaria';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template2', $data);
	}

	public function insert() {

		$registro = $this->input->post();
        $this->form_validation->set_rules('notario_nombre', 'Nombre del Notario', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->create();

        }
        else {

			$registro['fecha_hora_creacion'] = date('Y-m-d H:i:s');
			$this->Model_Notaria->insert($registro);
			redirect('notaria/index');

        }
	}

	public function edit($id) {

		$data['contenido'] 	= 'notaria/edit';
		$data['titulo'] 	= 'Actualizar Notaria';
		$data['registro'] 	= $this->Model_Notaria->find($id);
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$data['estado']				= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']			= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']			= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );

		$this->load->view('template2', $data);
		
	}

	public function update() {
		$registro = $this->input->post();

        $this->form_validation->set_rules('notario_nombre', 'Nombre del Notario', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['notaria_k']);
		}
		else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Notaria->update($registro);
			redirect('notaria/index');
		}
	}

	public function delete($id) {
		$this->Model_Notaria->delete($id);
		redirect('notaria/index');
	}

}
