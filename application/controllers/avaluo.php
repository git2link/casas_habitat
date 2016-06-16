<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avaluo extends CI_Controller {

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
		$data['contenido'] = 'avaluo/index';
		$data['titulo'] = 'Avaluos';
		$data['query'] = $this->Model_Avaluo->all();
		$this->load->view('template_v3', $data);
	}

	public function search() {

		$data['contenido'] 	= 'avaluo/index';
		$data['titulo'] 	= 'Avaluos';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Avaluo->allFiltered('p.empresa', $value);
		$this->load->view('template_v3', $data);

	}

	public function my_validation() {

		//return $this->avaluolib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'avaluo/create';
		$data['titulo'] 			= 'Crear Avaluo';
		$data['casas']				= $this->Model_Catalogos->getCasas();
		$data['unidades_valuacion'] = $this->Model_Catalogos->getProveedores( PROVEEDOR_UNIDAD_VALUACION );
		$data['sino']			    = $this->Model_Catalogos->getSiNo();
		$this->load->view('template_v3', $data);
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

		$data['contenido'] 	= 'avaluo/edit';
		$data['titulo'] 	= 'Actualizar Avaluo';
		$data['registro'] 	= $this->Model_Avaluo->find($id);
		$data['casas']				= $this->Model_Catalogos->getCasas();
		$data['unidades_valuacion'] = $this->Model_Catalogos->getProveedores( PROVEEDOR_UNIDAD_VALUACION );
		$this->load->view('template_v3', $data);
		
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
