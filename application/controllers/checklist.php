<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checklist extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Checklist');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	function all(){
		$datos = $this->Model_Checklist->all( ESTATUS_CASA_PROSPECTO );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);
	}

	
	public function index( $casa_k = 0, $clave_interna ) {
		$user_k								= $this->session->userdata('usuario_id');
		$this->data['contenido'] 					= 'checklist/index';
		$this->data['titulo'] 					= 'Casas';

		$arrQuery 							= $this->Model_Checklist->exist( $casa_k );
		
		if (count($arrQuery)==0) {
			$now 							= date('Y-m-d H:i:s');
			$user 							= $this->session->userdata('usuario_id');
			$new['fecha_hora_creacion']		= $now;
			$new['usuario_creacion'] 		= $user;
			$new_files 						= $new;
			$new['fecha_hora_modificacion'] = $now;
			$new['usuario_modificacion'] 	= $user;
			$new['casa_k'] 					= $casa_k;
			$new_files['checklist_k']		= $this->Model_Checklist->insert($new);
			$this->Model_Checklist->insertfiles_habitat($new_files);
			$this->Model_Checklist->insertfiles_casa($new_files);
			$this->Model_Checklist->insertfiles_personales($new_files); 
			$this->Model_Checklist->insert_description($new_files);

			$venta['estatus_k'] = 2;
			$this->Model_Checklist->update_venta_by_casa($venta, $casa_k);
		}

		$this->data['clave_interna']				= $clave_interna;
		$this->data['checklist']					= $this->Model_Checklist->checklist( $casa_k );
		$this->data['checklistfiles_casa']		= $this->Model_Checklist->checklistfiles_casa( $casa_k );
		$this->data['checklistfiles_habitat']		= $this->Model_Checklist->checklistfiles_habitat( $casa_k );
		$this->data['checklistfiles_personales']	= $this->Model_Checklist->checklistfiles_personales( $casa_k );
		$this->data['checklist_description']		= $this->Model_Checklist->checklist_description( $casa_k );
		$this->data['adviser']					= $this->Model_Checklist->get_checklist_adviser( $user_k );
		$this->data['user']						= $this->Model_Checklist->get_checklist_user( $casa_k );
		$this->data['notaria']					= $this->Model_Checklist->get_notaria_list();
		$this->data['currentuser']				= $this->Model_Checklist->get_current_user( $user_k );
		$this->data['casa_k']						= $casa_k;

		/*	Nombres */
			$checklist_name['hoja_presupuesto']					= 'Hoja de presupuesto';
			$checklist_name['carta_propuesta'] 					= 'Carta Propuesta';
			$checklist_name['titulo_propiedad'] 				= 'Título de propiedad';
			$checklist_name['registro_publico'] 				= 'Registro publico de la propiedad';
			$checklist_name['calculo_isr'] 						= 'Calculo ISR';
			$checklist_name['poder_notarial'] 					= 'Poder notarial';
			$checklist_name['cancelacion_hipoteca'] 			= 'Cancelación de la hipoteca';
			$checklist_name['adeudo_hipoteca'] 					= 'Adeudo hipoteca';
			$checklist_name['instruccion_cancelacion_hipoteca'] = 'Instrucion cancelación hipoteca';
			$checklist_name['escritura_adicional'] 				= 'Escritura adicional';
			$checklist_name['generales_propietario'] 			= 'Generales propietario';
			$checklist_name['acta_nacimiento'] 					= 'Acta de nacimiento';
			$checklist_name['ine'] 								= 'INE';
			$checklist_name['curp'] 							= 'CURP';
			$checklist_name['rfc'] 								= 'RFC';
			$checklist_name['acta_matrimonio'] 					= 'Acta de matrimonio';
			$checklist_name['generales_conyuge'] 				= 'Generales Conyuge';
			$checklist_name['boleta_predio'] 					= 'Boleta predio';
			$checklist_name['boleta_agua'] 						= 'Boleta agua';
			$checklist_name['recibo_luz'] 						= 'Recibo luz';
			$checklist_name['otros'] 							= 'Otros';
			$checklist_name['presupuesto_mejoras'] 				= 'Presupuesto de mejoras';
			$checklist_name['revision_legal'] 					= 'Revisión legal';
			$checklist_name['contrato_casas_habitat'] 			= 'Contrato casas habitat';
		/*  Nombres */

		$this->data['checklist_name']				= $checklist_name;

		$this->data['js_plugins']					= "
			<script src=".base_url('../js/fileinput/fileinput.min.js')."></script>
			<script src=".base_url('../js/fileinput/fileinput_locale_es.js')."></script>
			<script src=".base_url('../js/fileinput/jquery.media.js')."></script>
			<script src=".base_url('../js/demos/form-extended.js')."></script>";

		$this->data['css_plugins']		= "
			<link rel='stylesheet' href='".base_url('../css/fileinput/fileinput.min.css')."'>";

		$this->data['js']				    = "
			<script src=".base_url('../js/app/checklist.js')."></script>";

		$this->data['modal']				= 'checklist/checklist_modal';

		$this->load->view('template_v3', $this->data);
	}

	public function updatechecklist() {
		$registro 	= $this->input->post();
		$id 		= $registro['casa_k'];
		$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_modificacion'] 		= $this->session->userdata('usuario_id');
		$this->Model_Checklist->update($registro , $id );
	}

	public function insertchecklist() {
		$registro 							= $this->input->post();
		$registro['fecha_hora_creacion'] 		= date('Y-m-d H:i:s');
		$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_modificacion'] 	= $this->session->userdata('usuario_id');
		$registro['usuario_creacion'] 		= $this->session->userdata('usuario_id');
		$this->Model_Checklist->insert($registro);
	}

	public function setchecklist() {
		$registro 	= $this->input->post();
		$id 		= $registro['casa_k'];
		$arrQuery = $this->Model_Checklist->exist( $id );
		if (count($arrQuery)>0) {
			$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$registro['usuario_modificacion'] 		= $this->session->userdata('usuario_id');
			print $this->Model_Checklist->update($registro , $id );
		}else{
			$registro['fecha_hora_creacion'] 		= date('Y-m-d H:i:s');
			$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$registro['usuario_modificacion'] 	= $this->session->userdata('usuario_id');
			$registro['usuario_creacion'] 		= $this->session->userdata('usuario_id');
			print $this->Model_Checklist->insert($registro);
		}
	}

	public function setchecklist_2() {
		$registro 	= $this->input->post();
		$id 		= $registro['casa_k'];
		//$arrQuery = $this->Model_Checklist->exist( $id );

		foreach ($registro as $key => $value) {
			if ($value == 1 && $key != 'usuario_k' && $key != 'notaria_k' && $key != 'usuario_modificacion' ) {
				unset($registro[$key]);
			}
		}

		//if (count($arrQuery)>0) {

			$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$registro['usuario_modificacion'] 		= $this->session->userdata('usuario_id');
			$this->Model_Checklist->update($registro , $id );
		
		/*}else{
			$registro2['fecha_hora_creacion']		=	$registro['fecha_hora_creacion']		= date('Y-m-d H:i:s');
			$registro2['fecha_hora_modificacion'] 	=	$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$registro2['usuario_modificacion'] 		=	$registro['usuario_modificacion'] 		= $this->session->userdata('usuario_id');	
			$registro2['usuario_creacion'] 			=	$registro['usuario_creacion'] 			= $this->session->userdata('usuario_id');
			$registro2['checklist_k']				= 	$this->Model_Checklist->insert($registro);
			$this->Model_Checklist->insertfiles_habitat($registro2);
			$this->Model_Checklist->insertfiles_casa($registro2);
			$this->Model_Checklist->insertfiles_personales($registro2); 
			$this->Model_Checklist->insert_description($registro2); 

			$venta['estatus_k'] = 2;
			$this->Model_Checklist->update_venta_by_casa($venta, $id);

		}*/
		print 1;
	}

	public function uploadfile() {

		$registro 	= $this->input->post();
		$casa_k 	= $id 	= $registro['casa_k'];

		$user 		= $this->session->userdata('usuario_id');
		$type 		= substr($_FILES['file_upload']['type'], 12);
		$file_type 	= $_FILES['file_upload']['type'];
		$now  		= date('Y-m-d H:i:s');
		$name 		= md5( $now . $user );
		$name 		= $name . '.' . $type;

		$table 		= $registro['table'];
		unset($registro['table']);;
		$element_key = '';
		foreach ($registro as $key => $value) {
			if ( $key != 'casa_k' ) {
				$element_key = $key;
				unset($registro[$key]);
			}
		}

		$arrQuery	= $this->Model_Checklist->exist_files( $id );

		$target_dir = 'server/casas/files/' . $_POST['casa_k'] . '/';

		if (!file_exists($target_dir)) {
		    mkdir($target_dir, 0777, true);
		}

		$target_file = $target_dir . basename( $name );
		move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file);

		
		$registro['fecha_hora_modificacion'] 	= $now;
		$registro['usuario_modificacion'] 		= $user;

		//if (count($arrQuery)>0) {

			$arrQuery_2	= $this->Model_Checklist->checklist_by_column( $element_key, $casa_k );

			unset($registro['casa_k']);
			$id 	= 	$registro['checklist_k']	= $arrQuery[0]->checklist_k;

			foreach ($arrQuery[0] as $key => $value) {
				if ($key == $element_key) {
					if ($arrQuery_2[0][$element_key] == 2 || $arrQuery_2[0][$element_key] == 3) {
						$registro[$element_key]		= $name . ' ';
					}else{
						$registro[$element_key]		= $value . $name . ' ';
					}
					
				}
			}

			if ( $table == 'habitat' ) {
				$this->Model_Checklist->updatefiles_habitat($registro); 
			}elseif( $table == 'casa' ){
				$this->Model_Checklist->updatefiles_casa($registro); 
			}elseif( $table == 'personales' ){
				$this->Model_Checklist->updatefiles_personales($registro); 
			}

			$checklist_update['fecha_hora_modificacion']	= $now;
			$checklist_update['usuario_modificacion']		= $user;
			$checklist_update[$element_key]					= 1;
			$this->Model_Checklist->update($checklist_update , $casa_k );

		/*}else{

			$registro['usuario_creacion']			= $user;
			$registro['fecha_hora_creacion'] 		= $now;

			$registro['checklist_k']				= $this->Model_Checklist->insert($registro);
			unset($registro['casa_k']);
			$registro[$element_key]					= $name;

			if ( $table == 'habitat' ) {
				$this->Model_Checklist->insertfiles_habitat($registro); 
				unset($registro[$element_key]);
				$this->Model_Checklist->insertfiles_casa($registro);
				$this->Model_Checklist->insertfiles_personales($registro);
			}elseif( $table == 'casa' ){
				$this->Model_Checklist->insertfiles_casa($registro);
				unset($registro[$element_key]);
				$this->Model_Checklist->insertfiles_habitat($registro);
				$this->Model_Checklist->insertfiles_personales($registro);
			}elseif( $table == 'personales' ){
				$this->Model_Checklist->insertfiles_personales($registro); 
				unset($registro[$element_key]);
				$this->Model_Checklist->insertfiles_habitat($registro);
				$this->Model_Checklist->insertfiles_casa($registro);
			}

			$this->Model_Checklist->insert_description($registro); 		

			$venta['estatus_k'] = 2;
			$this->Model_Checklist->update_venta_by_casa($venta, $casa_k);		
			
		}*/

		print 1;
	}

	public function setDescription(){
		$registro 				= $this->input->post();
		$checklist['casa_k'] 	= $registro['casa_k'];
		
		$arrQuery 				= $this->Model_Checklist->exist( $checklist['casa_k'] );

		$element_key = '';
		foreach ($registro as $key => $value) {
			if ( $key != 'casa_k' ) {
				$element_key = $key;
				$description[$element_key] = $registro[$element_key];
			}
		}

		//if (count($arrQuery)>0) {
			$description['checklist_k']					= $arrQuery[0]->checklist_k;
			$description['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$description['usuario_modificacion'] 		= $this->session->userdata('usuario_id');
			$this->Model_Checklist->update_description($description);		
		/*}else{
			$files['fecha_hora_creacion']		=	$checklist['fecha_hora_creacion']		= date('Y-m-d H:i:s');
			$files['fecha_hora_modificacion'] 	=	$checklist['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$files['usuario_modificacion'] 		=	$checklist['usuario_modificacion'] 		= $this->session->userdata('usuario_id');	
			$files['usuario_creacion'] 			=	$checklist['usuario_creacion'] 			= $this->session->userdata('usuario_id');
			$files['checklist_k']				= 	$this->Model_Checklist->insert($checklist);
			$this->Model_Checklist->insertfiles_habitat($files);
			$this->Model_Checklist->insertfiles_casa($files);
			$this->Model_Checklist->insertfiles_personales($files); 
			$description 				= $files;
			$description[$element_key] 	= $registro[$element_key];
			$this->Model_Checklist->insert_description($description);

			$venta['estatus_k'] = 2;
			$this->Model_Checklist->update_venta_by_casa($venta, $checklist['casa_k']);

		}*/

		print 1;
	}

	public function getChecklistFileTableName($datos){
		$flagTable = true;
		if (count($datos)>0) {
			foreach ($datos as $key => $value) {
				if (!$this->Model_Checklist->fieldexists($key, 'casa_checklist_file_part1')) {
					$flagTable = false;
				} 
			}
			if ($flagTable) {
				return 'casa_checklist_file_part1';
			}else{
				$flagTable = true;
				foreach ($datos as $key => $value) {
					if (!$this->Model_Checklist->fieldexists($key, 'casa_checklist_file_part2')) {
						$flagTable = false;
					} 
				}
				if ($flagTable) {
					return 'casa_checklist_file_part2';
				}else{
					return 'casa_checklist_file_part3';
				}
			}
		}
	}
}

