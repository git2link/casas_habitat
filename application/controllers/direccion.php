<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Direccion extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Direccion');
		$this->load->model('Model_Catalogos');
		
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

    function obtenerCodigosPostales(){

    	$data = $this->Model_Direccion->obtenerCodigosPostales();

    	echo json_encode($data);
    }

    public function obtenerDirecciones( $cp ){

    	$data = $this->Model_Direccion->obtenerDirecciones($cp);

    	echo '{"direcciones": ' . json_encode($data) . '}';

    }

	public function obtenerEstados(){

		$data = $this->Model_Direccion->obtenerEstados();

		echo '{"estados": ' . json_encode($data) . '}';

	}

    public function obtenerMunicipios( $estado_k ){

    	$data = $this->Model_Direccion->obtenerMunicipios($estado_k);

    	echo '{"municipios": ' . json_encode($data) . '}';

    }

	public function index() {
		$data['contenido'] = 'direccion/index';
		$data['titulo'] = 'Direcciones';
		$data['query'] = $this->Model_Direccion->all();
		$this->load->view('template2', $data);
	}

	public function search() {

		$data['contenido'] 	= 'direccion/index';
		$data['titulo'] 	= 'Direcciones';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Direccion->allFiltered('c.clave_interna', $value);
		$this->load->view('template2', $data);

	}

	public function my_validation() {

		//return $this->direccionlib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'direccion/create';
		$data['titulo'] 			= 'Crear Direccion';
		$data['tipo_direccion'] 			= $this->Model_Direccion->get_tipo_direccion(); /* Lista de los Tipos de Direccion */
		$data['paquete_direccion'] 		= $this->Model_Direccion->get_paquete_direccion(); /* Lista de los Paquetes de Direccion */
		$data['estatus_venta'] 		= $this->Model_Direccion->get_estatus_venta();
		$data['estatus_invadida'] 	= $this->Model_Direccion->get_estatus_invadida();
		$data['tipo_vivienda'] 		= $this->Model_Direccion->get_tipo_vivienda();
		$data['usuarios'] 			= $this->Model_Direccion->get_usuarios();
		$data['llaves'] 			= $this->Model_Direccion->get_llaves();

		$this->load->view('template2', $data);
	}

	public function insert() {

		$registro = $this->input->post();
        $this->form_validation->set_rules('clave_interna', 'Clave Interna', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->create();

        }
        else {

			$registro['fecha_hora_creacion'] = date('Y-m-d H:i:s');
			$this->Model_Direccion->insert($registro);
			redirect('direccion/index');

        }
	}

	public function edit($id) {

		$data['contenido'] 	= 'direccion/edit';
		$data['titulo'] 	= 'Actualizar Direccion';
		$data['registro'] 	= $this->Model_Direccion->find($id);
		$data['tipo_direccion'] 			= $this->Model_Direccion->get_tipo_direccion(); /* Lista de los Tipos de Direccion */
		$data['paquete_direccion'] 		= $this->Model_Direccion->get_paquete_direccion(); /* Lista de los Paquetes de Direccion */
		$data['estatus_venta'] 		= $this->Model_Direccion->get_estatus_venta();
		$data['estatus_invadida'] 	= $this->Model_Direccion->get_estatus_invadida();
		$data['tipo_vivienda'] 		= $this->Model_Direccion->get_tipo_vivienda();
		$data['usuarios'] 			= $this->Model_Direccion->get_usuarios();
		$data['llaves'] 			= $this->Model_Direccion->get_llaves();
		$this->load->view('template2', $data);
		
	}

	public function update() {
		$registro = $this->input->post();

        $this->form_validation->set_rules('clave_interna', 'Clave Interna', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['direccion_k']);
		}
		else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Direccion->update($registro);
			redirect('direccion/index');
		}
	}

	public function delete($id) {
		$this->Model_Direccion->delete($id);
		redirect('direccion/index');
	}

	public function get_estados_json(){

    	$data = $this->Model_Catalogos->get_estados_json();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);

		echo json_encode($array_response);
    }

    public function get_municipios_json( $estado_k ){

    	$data = $this->Model_Catalogos->get_municipios_json( $estado_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);

		echo json_encode($array_response);
		
    }


}
