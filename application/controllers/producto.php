<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Producto');
		//$this->load->library('productoLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }


	public function index() {
		$data['contenido'] = 'producto/index';
		$data['titulo'] = 'Productos';

		$data['js']			= "
		<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/productos/app.js')."></script>
		<script src=".base_url('../js/app/productos/data.js')."></script>
		<script src=".base_url('../js/app/productos/directives.js')."></script>
		<script src=".base_url('../js/app/productos/productsCtrl.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";


		$this->load->view('template2', $data);
	}

	function all(){
		$data = $this->Model_Producto->all();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Data Selected From database',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}



	public function create() {
		$data['contenido'] 			= 'producto/create';
		$data['titulo'] 			= 'Crear Producto';
		$data['producto']			= $this->Model_Catalogos->getTipoProductos();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template2', $data);
	}

	public function insert() {

		$registro = json_decode(file_get_contents('php://input'),true);
		$id = $this->Model_Producto->insert($registro);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Product added successfully',
			'data'		=> $id
			);

		echo json_encode($array_response);

	}

	public function edit($id) {

		$data['contenido'] 	= 'producto/edit';
		$data['titulo'] 	= 'Actualizar Producto';
		$data['registro'] 	= $this->Model_Producto->find($id);
		$data['producto']			= $this->Model_Catalogos->getTipoProductos();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$data['estado']				= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']			= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']			= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );

		$this->load->view('template2', $data);
		
	}

	public function update( $id ) {

		$registro = json_decode(file_get_contents('php://input'),true);
		$id = $this->Model_Producto->update($registro);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Product information updated successfully',
			);

		echo json_encode($array_response);
	}

	public function delete($id) {
		$this->Model_Producto->delete($id);
		redirect('producto/index');
	}

}
