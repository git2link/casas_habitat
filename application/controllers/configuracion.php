<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Configuracion');
		$this->load->model('Model_Catalogos');

    }


	public function casa_paquete() {
		$data['contenido'] 		= 'configuracion/casa_paquete';
		$data['modal'] 			= 'configuracion/casa_paquete_modal';
		$data['titulo'] 		= 'Configuracion';
		$this->load->view('template_v3', $data);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode($this->Model_Configuracion->casa_paquete()) . '}';
			}
		}
	}

	public function add_paquete() {

		$registro 					= $this->input->post();
		$registro2['descripcion']	= $registro['tipo'];

		$registro3['cliente']		= $registro['cliente'];
		$registro3['descripcion']	= $registro['paquete'];
		$registro3['activo']		= $registro['activo'];

		$arrQuery					= $this->Model_Configuracion->casa_tipo_id_byDescripcion( $registro['tipo'] );

		if (count($arrQuery)>0) {
			$registro3['tipo_casa_k'] 	= $arrQuery[0]->tipo_casa_k;
			if ( $arrQuery[0]->activo == 0 ) {
				$registro4['tipo_casa_k']	= $registro3['tipo_casa_k'];
				$registro4['activo']		= 1;
				$this->Model_Configuracion->update_casa_tipo( $registro4 );
			}

		}else{
        	$registro2['activo'] 		= 1;
			$registro3['tipo_casa_k']	= $this->Model_Configuracion->insert_casa_tipo( $registro2 );
		}

		$this->Model_Configuracion->insert_casa_tipo_paquete( $registro3 );
		
		print 1;
	}

	public function update_paquete() {

		$post_form		= $this->input->post();
		$arrQuery_1		= $this->Model_Configuracion->casa_paquete_byId( $post_form['paquete_casa_k'] ); 

		if ($post_form['tipo'] == $arrQuery_1[0]->tipo) {
			if ($post_form['activo'] == 0) {
				if ($arrQuery_1[0]->total == 1) {
					$tipo['tipo_casa_k']	= $arrQuery_1[0]->tipo_casa_k;
					$tipo['activo']			= 0;
					$this->Model_Configuracion->update_casa_tipo( $tipo );
				}
			}else{
				$tipo['tipo_casa_k']	= $arrQuery_1[0]->tipo_casa_k;
				$tipo['activo']			= 1;
				$this->Model_Configuracion->update_casa_tipo( $tipo );
			}
		}else{

			$arrQuery_2	= $this->Model_Configuracion->casa_tipo_id_byDescripcion( $post_form['tipo'] );

			if (count($arrQuery_2)>0) {
				
				$paquete['tipo_casa_k']	= $arrQuery_2[0]->tipo_casa_k;

				if ( $arrQuery_2[0]->activo == 0 ) {
					$tipo['tipo_casa_k']	= $arrQuery_2[0]->tipo_casa_k;
					$tipo['activo']			= 1;
					$this->Model_Configuracion->update_casa_tipo( $tipo );
				}

				if ($arrQuery_1[0]->total == 1) {
					$tipo['tipo_casa_k']	= $arrQuery_1[0]->tipo_casa_k;
					$tipo['activo']			= 0;
					$this->Model_Configuracion->update_casa_tipo( $tipo );
				}
			}else{
	        	$tipo['activo'] 		= 1;
	        	$tipo['descripcion'] 	= $post_form['tipo'];
				$paquete['tipo_casa_k']	= $this->Model_Configuracion->insert_casa_tipo( $tipo );
			}
			
		}

		$paquete['paquete_casa_k']	= $post_form['paquete_casa_k'];
		$paquete['cliente']			= $post_form['cliente'];
		$paquete['descripcion']		= $post_form['paquete'];
		$paquete['activo']			= $post_form['activo'];
		$this->Model_Configuracion->update_casa_paquete( $paquete );

		
		//print 1;
	}

	public function direcciones() {
		$data['contenido'] 		= 'configuracion/direcciones';
		$data['modal'] 			= 'configuracion/direcciones_modal';
		$data['estados']		= $this->Model_Catalogos->getEstados();
		$data['titulo'] 		= 'Configuracion';
		$this->load->view('template_v3', $data);
	}


	public function direccionesdatatable(){
		extract($_POST);
		$filtro['estado_k'] 	= $estado_k;
		$filtro['municipio_k'] 	= $municipio_k;

		if(!empty($filtro['estado_k'])){
			echo '{"data": ' . json_encode($this->Model_Configuracion->direcciones( $filtro)) . '}';
		}else{
			echo '{"data": "[]"}';
		}
	}

	public function add_direccion() {

		$registro 					= $this->input->post();

		$registro = array(
			'municipio_k' 	=> $registro['municipio_k'],
			'codigo_postal' => $registro['codigo_postal'],
			'nombre' 		=> $registro['colonia'],
		);


		$this->Model_Configuracion->insert_colonia( $registro );

		print 1;
	}

	public function update_colonia(){

		$registro 					= $this->input->post();
		$colonia_k = $registro['colonia_k'];
		$registro = array(
			'municipio_k' 	=> $registro['municipio_k'],
			'codigo_postal' => $registro['codigo_postal'],
			'nombre' 		=> $registro['colonia'],
		);


		$this->Model_Configuracion->update_colonia( $registro , $colonia_k);

		print 1;

	}

	public function procedencia_prospectos(){

		$data['contenido'] 		= 'configuracion/procedencia_prospectos';
		$data['modal'] 			= 'configuracion/procedencia_prospectos_modal';
		$data['titulo'] 		= 'Configuracion';

		$this->load->view('template_v3', $data);

	}

	public function procedenciadatatable(){

		echo '{"data": ' . json_encode($this->Model_Configuracion->procedencia()) . '}';
	}

	public function add_procedencia() {

		$registro = $this->input->post();
		unset( $registro['procedencia_k']);
		$this->Model_Configuracion->insert_procedencia( $registro );

		print 1;
	}

	public function update_procedencia(){

		$registro 					= $this->input->post();
		$procedencia_k 				= $registro['procedencia_k'];

		$this->Model_Configuracion->update_procedencia( $registro , $procedencia_k );

		print 1;

	}

	public function estatus_venta(){

		$data['contenido'] 		= 'configuracion/estatus_venta';
		$data['modal'] 			= 'configuracion/estatus_venta_modal';
		$data['titulo'] 		= 'Configuracion';

		$this->load->view('template_v3', $data);

	}

	public function estatusventadatatable(){

		echo '{"data": ' . json_encode($this->Model_Configuracion->estatus_venta()) . '}';
	}

	public function add_estatus_venta() {

		$registro = $this->input->post();
		unset( $registro['estatus_venta_k']);
		$this->Model_Configuracion->insert_estatus_venta( $registro );

		print 1;
	}

	public function update_estatus_venta(){

		$registro 					= $this->input->post();
		$estatus_venta_k 				= $registro['estatus_venta_k'];

		$this->Model_Configuracion->update_estatus_venta( $registro , $estatus_venta_k );

		print 1;

	}

	public function forma_pago(){

		$data['contenido'] 		= 'configuracion/forma_pago';
		$data['modal'] 			= 'configuracion/forma_pago_modal';
		$data['titulo'] 		= 'Configuracion';

		$this->load->view('template_v3', $data);

	}

	public function formapagodatatable(){

		echo '{"data": ' . json_encode($this->Model_Configuracion->forma_pago()) . '}';
	}

	public function add_forma_pago() {

		$registro = $this->input->post();
		unset( $registro['forma_pago_k']);
		$this->Model_Configuracion->insert_forma_pago( $registro );

		print 1;
	}

	public function update_forma_pago(){

		$registro 					= $this->input->post();
		$forma_pago_k 				= $registro['forma_pago_k'];

		$this->Model_Configuracion->update_forma_pago( $registro , $forma_pago_k );

		print 1;

	}


}

