<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saneamiento extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Saneamiento');
		$this->load->library('mail');
		$this->load->library('functions');

    }

	public function create( $id ) {

		$data['casa_k'] = $this->functions->encrypt_decrypt('decrypt', $id);
		
		if ( is_numeric( $data['casa_k'] ) ) {
		
			$data['contenido'] 		= 'saneamiento/saneamiento';
			$data['modal'] 			= 'saneamiento/saneamiento_modal';
			$data['titulo'] 		= 'saneamiento';

			$arrQuery				= $this->Model_Saneamiento->saneamiento_by_casa( $data['casa_k'] );

			if ( count($arrQuery) == 0 ) {

				$saneamiento['casa_k']				= $data['casa_k'];
				$saneamiento['estatus'] 			= 'creacion';
				$saneamiento['fecha_hora_creacion'] = date('Y-m-d H:i:s');
				$saneamiento['usuario_creacion']	= $this->session->userdata('usuario_id');

				$id 								= $this->Model_Saneamiento->insert( $saneamiento );
				$arrQuery							= $this->Model_Saneamiento->saneamiento_by_id( $id );

			}
		
			if ( count($arrQuery)>0 ) {

				$data['saneamiento'] 		= $arrQuery[0]->saneamiento_k;
				$data['estatus'] 			= $arrQuery[0]->estatus;
				$data['clave']				= $arrQuery[0]->clave_interna;
			
			}
		
			$data['js_plugins']					= "
			<script src=".base_url('../js/fileinput/fileinput.min.js')."></script>
			<script src=".base_url('../js/fileinput/fileinput_locale_es.js')."></script>
			<script src=".base_url('../js/fileinput/jquery.media.js')."></script>";
			$data['css_plugins']		= "
				<link rel='stylesheet' href='".base_url('../css/fileinput/fileinput.min.css')."'>";
		
		}else{
		
			$data['contenido'] 		= 'home/acceso_denegado';
			$data['titulo'] 		= 'Denegado';
		
		}
		
			$this->load->view('template_v3', $data);

	}

	function all( $id ){
		$data = $this->Model_Mejora->all( $id );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}

	public function uploadfile() {
		extract($_POST);
		$user 		= $this->session->userdata('usuario_id');
		$type 		= substr($_FILES['file_upload']['type'], 12);
		$now  		= date('Y-m-d H:i:s');
		$name 		= md5( $now . $user );
		$name 		= $name . '.' . $type;
		$path 		= 'server/casas/saneamiento/' . $_POST['casa_k'] . '/';

		if (!file_exists($path)) {
		    mkdir($path, 0777, true);
		}

		$file = $path . basename( $name );
		move_uploaded_file($_FILES['file_upload']['tmp_name'], $file);

		$saneamiento['evidencia'] 					= $name;
		$saneamiento['saneamiento_concepto_k'] 		= $saneamiento_concepto_k;
		$saneamiento['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$saneamiento['usuario_modificacion']		= $this->session->userdata('usuario_id');
		$this->Model_Saneamiento->update_concept($saneamiento);

		print 1;
	}	

	public function insert() {

		$registro 	= $this->input->post();

		$saneamiento 								= $registro;
		$saneamiento['fecha_hora_creacion'] 		= date('Y-m-d H:i:s');
		$saneamiento['usuario_creacion']			= $this->session->userdata('usuario_id');
		$this->Model_Saneamiento->insert_concept($saneamiento);
			
		print 1;

	}

	public function update( ) {

		$saneamiento 								= $this->input->post();
		$saneamiento['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$saneamiento['usuario_modificacion']		= $this->session->userdata('usuario_id');
		$this->Model_Saneamiento->update_concept($saneamiento);
			
		print 1;

	}

	public function update_saneamiento( ) {

		$saneamiento 								= $this->input->post();
		$saneamiento['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$saneamiento['usuario_modificacion']		= $this->session->userdata('usuario_id');
		$this->Model_Saneamiento->update($saneamiento);
			
		print 1;

	}

	public function edit($id) {

		$data['contenido'] 	= 'mejora/edit';
		$data['titulo'] 	= 'Actualizar Mejora';
		$data['registro'] 	= $this->Model_Mejora->find($id);
		$data['mejora']			= $this->Model_Catalogos->getTipoMejoras();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$data['estado']				= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']			= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']			= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );

		$this->load->view('template2', $data);
		
	}


	public function delete($id) {
		$this->Model_Mejora->delete($id);
		
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Product information updated successfully',
			);

		echo json_encode($array_response);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode( $this->Model_Saneamiento->all_concepts( $casa ) ) . '}';
			}
		}
	}

}
