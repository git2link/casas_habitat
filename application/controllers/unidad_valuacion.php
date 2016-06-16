<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unidad_Valuacion extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Unidad_Valuacion');
		$this->load->model('Model_Catalogos');
		//$this->load->library('proveedorLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$data['contenido'] = 'unidad_valuacion/index';
		$data['titulo'] = 'Unidades de Valuación';
		$data['query'] = $this->Model_Unidad_Valuacion->all();
		$this->load->view('template2', $data);
	}

	public function search() {

		$data['contenido'] 	= 'unidad_valuacion/index';
		$data['titulo'] 	= 'Unidades de Valuación';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Unidad_Valuacion->allFiltered('uv.empresa', $value);
		$this->load->view('template2', $data);

	}

	public function my_validation() {

		//return $this->unidad_valuacionlib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'unidad_valuacion/create';
		$data['titulo'] 			= 'Crear Unidad de Valuación';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template2', $data);
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

		$data['contenido'] 	= 'unidad_valuacion/edit';
		$data['titulo'] 	= 'Actualizar Unidad de Valuación';
		$data['registro'] 	= $this->Model_Unidad_Valuacion->find($id);
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$data['estado']				= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']			= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']			= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );

		$this->load->view('template2', $data);
		
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
