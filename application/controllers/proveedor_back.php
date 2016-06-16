<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedor extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Proveedor');
		$this->load->model('Model_Catalogos');
		//$this->load->library('proveedorLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$data['contenido'] = 'proveedor/index';
		$data['titulo'] = 'Proveedores';
		$data['query'] = $this->Model_Proveedor->all();
		$this->load->view('template2', $data);
	}

	public function search() {

		$data['contenido'] 	= 'proveedor/index';
		$data['titulo'] 	= 'Proveedores';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Proveedor->allFiltered('p.empresa', $value);
		$this->load->view('template2', $data);

	}

	public function my_validation() {

		//return $this->proveedorlib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'proveedor/create';
		$data['titulo'] 			= 'Crear Proveedor';
		$data['proveedor']			= $this->Model_Catalogos->getTipoProveedores();
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
			$this->Model_Proveedor->insert($registro);
			redirect('proveedor/index');

        }
	}

	public function edit($id) {

		$data['contenido'] 	= 'proveedor/edit';
		$data['titulo'] 	= 'Actualizar Proveedor';
		$data['registro'] 	= $this->Model_Proveedor->find($id);
		$data['proveedor']			= $this->Model_Catalogos->getTipoProveedores();
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
