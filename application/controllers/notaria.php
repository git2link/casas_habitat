<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notaria extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Notaria');
		$this->load->model('Model_Catalogos');
		//$this->load->library('notariaLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$this->data['contenido'] = 'notaria/index';
		$this->data['titulo'] = 'Notarias';
		$this->data['query'] = $this->Model_Notaria->all();
		$this->load->view('template_v3', $this->data);
	}

	public function search() {

		$this->data['contenido'] 	= 'notaria/index';
		$this->data['titulo'] 	= 'Notarias';
		$value 				= $this->input->post('buscar');
		$this->data['query'] 		= $this->Model_Notaria->allFiltered('n.nombre', $value);
		$this->load->view('template_v3', $this->data);

	}

	public function my_validation() {

		//return $this->notarialib->my_validation($this->input->post());

	}

	public function create() {
		$this->data['contenido'] 			= 'notaria/create';
		$this->data['titulo'] 			= 'Crear Notaria';
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template_v3', $this->data);
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

		$this->data['contenido'] 	= 'notaria/edit';
		$this->data['titulo'] 	= 'Actualizar Notaria';
		$this->data['registro'] 	= $this->Model_Notaria->find($id);
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->data['estado']				= $this->Model_Catalogos->getEstado   ( $this->data['registro']->estado_k );
		$this->data['municipio']			= $this->Model_Catalogos->getMunicipio( $this->data['registro']->municipio_k );
		$this->data['colonias']			= $this->Model_Catalogos->getColonias ( $this->data['registro']->codigo_postal );

		$this->load->view('template_v3', $this->data);
		
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
