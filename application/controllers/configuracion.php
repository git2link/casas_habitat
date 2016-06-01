<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuracion extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Configuracion');

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


}

