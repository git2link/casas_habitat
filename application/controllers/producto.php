<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Producto extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Producto');
		//$this->load->library('productoLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }


	public function index() {
		$this->data['contenido'] = 'producto/index';
		$this->data['titulo'] = 'Productos';

		$this->data['js']			= "
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


		$this->load->view('template_v3', $this->data);
	}

	function all(){
		$datos = $this->Model_Producto->all();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Data Selected From database',
			'data'		=> $datos
			);
		echo json_encode($array_response);
	}



	public function create() {
		$this->data['contenido'] 			= 'producto/create';
		$this->data['titulo'] 			= 'Crear Producto';
		$this->data['producto']			= $this->Model_Catalogos->getTipoProductos();
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template_v3', $this->data);
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

		$this->data['contenido'] 	= 'producto/edit';
		$this->data['titulo'] 	= 'Actualizar Producto';
		$this->data['registro'] 	= $this->Model_Producto->find($id);
		$this->data['producto']			= $this->Model_Catalogos->getTipoProductos();
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->data['estado']				= $this->Model_Catalogos->getEstado   ( $this->data['registro']->estado_k );
		$this->data['municipio']			= $this->Model_Catalogos->getMunicipio( $this->data['registro']->municipio_k );
		$this->data['colonias']			= $this->Model_Catalogos->getColonias ( $this->data['registro']->codigo_postal );

		$this->load->view('template_v3', $this->data);
		
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
