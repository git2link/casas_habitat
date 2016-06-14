<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaluo extends MY_Controller {

	function __construct() {
		parent::__construct();

		$this->load->model('Model_Avaluo');
		$this->load->model('Model_Catalogos');
		$this->load->model('Model_Casa');
		$this->load->model('Model_Unidad_Valuacion');
		//$this->load->library('avaluoLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$this->data['contenido'] = 'avaluo/index';
		$this->data['titulo'] = 'Avaluos';
		$this->data['query'] = $this->Model_Avaluo->all();
		$this->load->view('template_v3', $this->data);
	}

	public function search() {

		$this->data['contenido'] 	= 'avaluo/index';
		$this->data['titulo'] 	= 'Avaluos';
		$value 				= $this->input->post('buscar');
		$this->data['query'] 		= $this->Model_Avaluo->allFiltered('p.empresa', $value);
		$this->load->view('template_v3', $this->data);

	}

	public function my_validation() {

		//return $this->avaluolib->my_validation($this->input->post());

	}

	public function create() {
		$this->data['contenido'] 			= 'avaluo/create';
		$this->data['titulo'] 			= 'Crear Avaluo';
		$this->data['casas']				= $this->Model_Catalogos->getCasas();
		$this->data['unidades_valuacion'] = $this->Model_Catalogos->getProveedores( PROVEEDOR_UNIDAD_VALUACION );
		$this->data['sino']			    = $this->Model_Catalogos->getSiNo();
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
			$this->Model_Avaluo->insert($registro);
			redirect('avaluo/index');

        }
	}

	public function edit($id) {

		$this->data['contenido'] 	= 'avaluo/edit';
		$this->data['titulo'] 	= 'Actualizar Avaluo';
		$this->data['registro'] 	= $this->Model_Avaluo->find($id);
		$this->data['casas']				= $this->Model_Catalogos->getCasas();
		$this->data['unidades_valuacion'] = $this->Model_Catalogos->getProveedores( PROVEEDOR_UNIDAD_VALUACION );
		$this->load->view('template_v3', $this->data);
		
	}

	public function update() {
		$registro = $this->input->post();

        $this->form_validation->set_rules('empresa', 'Nombre de la Empresa', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['avaluo_k']);
		}
		else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Avaluo->update($registro);
			redirect('avaluo/index');
		}
	}

	public function delete($id) {
		$this->Model_Avaluo->delete($id);
		redirect('avaluo/index');
	}

}
