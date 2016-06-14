<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Proveedor');
		$this->load->model('Model_Catalogos');
		//$this->load->library('proveedorLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$this->data['contenido'] = 'proveedor/index';
		$this->data['titulo'] = 'Proveedores';
		$this->data['query'] = $this->Model_Proveedor->all();
		$this->load->view('template_v3', $this->data);
	}

	public function search() {

		$this->data['contenido'] 	= 'proveedor/index';
		$this->data['titulo'] 	= 'Proveedores';
		$value 				= $this->input->post('buscar');
		$this->data['query'] 		= $this->Model_Proveedor->allFiltered('p.empresa', $value);
		$this->load->view('template_v3', $this->data);

	}

	public function my_validation() {

		//return $this->proveedorlib->my_validation($this->input->post());

	}

	public function create() {
		$this->data['contenido'] 			= 'proveedor/create';
		$this->data['titulo'] 			= 'Crear Proveedor';
		$this->data['proveedor']			= $this->Model_Catalogos->getTipoProveedores();
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
			$this->Model_Proveedor->insert($registro);
			redirect('proveedor/index');

        }
	}

	public function edit($id) {

		$this->data['contenido'] 	= 'proveedor/edit';
		$this->data['titulo'] 	= 'Actualizar Proveedor';
		$this->data['registro'] 	= $this->Model_Proveedor->find($id);
		$this->data['proveedor']			= $this->Model_Catalogos->getTipoProveedores();
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
			$this->edit($registro['proveedor_k']);
		}
		else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Proveedor->update($registro);
			redirect('proveedor/index');
		}
	}

	public function delete($id) {
		$this->Model_Proveedor->delete($id);
		redirect('proveedor/index');
	}

}
