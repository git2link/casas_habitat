<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidad_Valuacion extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Unidad_Valuacion');
		$this->load->model('Model_Catalogos');
		//$this->load->library('proveedorLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$this->data['contenido'] = 'unidad_valuacion/index';
		$this->data['titulo'] = 'Unidades de Valuación';
		$this->data['query'] = $this->Model_Unidad_Valuacion->all();
		$this->load->view('template_v3', $this->data);
	}

	public function search() {

		$this->data['contenido'] 	= 'unidad_valuacion/index';
		$this->data['titulo'] 	= 'Unidades de Valuación';
		$value 				= $this->input->post('buscar');
		$this->data['query'] 		= $this->Model_Unidad_Valuacion->allFiltered('uv.empresa', $value);
		$this->load->view('template_v3', $this->data);

	}

	public function my_validation() {

		//return $this->unidad_valuacionlib->my_validation($this->input->post());

	}

	public function create() {
		$this->data['contenido'] 			= 'unidad_valuacion/create';
		$this->data['titulo'] 			= 'Crear Unidad de Valuación';
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template_v3', $this->data);
	}

	public function insert() {

		$registro = $this->input->post();
        $this->form_validation->set_rules('empresa', 'Nombre de la Empresa', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->create();

        }
        else {

			$registro['fecha_hora_creacion'] = date('Y-m-d H:i:s');
			$this->Model_Unidad_Valuacion->insert($registro);
			redirect('unidad_valuacion/index');

        }
	}

	public function edit($id) {

		$this->data['contenido'] 	= 'unidad_valuacion/edit';
		$this->data['titulo'] 	= 'Actualizar Unidad de Valuación';
		$this->data['registro'] 	= $this->Model_Unidad_Valuacion->find($id);
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->data['estado']				= $this->Model_Catalogos->getEstado   ( $this->data['registro']->estado_k );
		$this->data['municipio']			= $this->Model_Catalogos->getMunicipio( $this->data['registro']->municipio_k );
		$this->data['colonias']			= $this->Model_Catalogos->getColonias ( $this->data['registro']->codigo_postal );

		$this->load->view('template_v3', $this->data);
		
	}

	public function update() {
		$registro = $this->input->post();

        $this->form_validation->set_rules('empresa', 'Nombre de la Empresa', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['unidad_valuacion_k']);
		}
		else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Unidad_Valuacion->update($registro);
			redirect('unidad_valuacion/index');
		}
	}

	public function delete($id) {
		$this->Model_Unidad_Valuacion->delete($id);
		redirect('unidad_valuacion/index');
	}

}
