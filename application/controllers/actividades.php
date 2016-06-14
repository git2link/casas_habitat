<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actividades extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();
		$this->load->model('Model_Actividades');
		$this->load->model('Model_Casa');
    }

	public function visitas() {
		$this->data['contenido'] 		= 'actividades/visita_calendario';
		$this->data['titulo'] 		= 'Visita';
		$this->data['js_plugins'] 	= "
			<script src=".base_url('../js/fullcalendar/moment.js')."></script>
			<script src=".base_url('../js/fullcalendar/fullcalendar.min.js')."></script>
			<script src=".base_url('../js/fullcalendar/es.js')."></script>
		";
		$this->data['css_plugins'] 	= "
			<link rel='stylesheet' href='".base_url('../css/fullcalendar/fullcalendar.css')."'>
		";
		$this->load->view('template_v3', $this->data);
	}

	public function set_visita_done() {
		extract($_POST);
		$arr_visita['visita_k'] 	= $visita_k;
		$arr_visita['realizada']	= 1;
		$this->Model_Actividades->update_visita_by_visita($arr_visita);
		print 1;
	}

	function visita( $visita_k ){
		
		$this->data['contenido']			= 'home/acceso_denegado';
		$this->data['titulo'] 			= 'Denegado';
		
		if (isset($visita_k)) {
			$arrQuery 					= $this->Model_Actividades->casa_by_visita($visita_k);
			if (count($arrQuery)>0) {
				if ($arrQuery[0]->realizada == 0) {

					$this->data['visita_k']			= $visita_k;
					$casa_k						= $arrQuery[0]->casa_k;
					$this->data['clave_interna']		= $arrQuery[0]->clave_interna;
					
					$this->data['contenido'] 			= 'casa/galeria2';
					$this->data['modal']				= 'casa/galeria_modal';
					$this->data['titulo'] 			= 'Casas';

					$this->data['imagenes']			= $this->Model_Casa->getImagenes_by_visita( $visita_k );
					$this->data['casa_k']				= $casa_k;
					$this->data['user_k']				= $user_k		= 		$this->session->userdata('usuario_id');
					
					$this->data['js_plugins']			= "
						<script src=".base_url('../js/fileinput/fileinput.min.js')."></script>
						<script src=".base_url('../js/fileinput/fileinput_locale_es.js')."></script>
						<script src=".base_url('../js/fileinput/jquery.media.js')."></script>
						<script src=".base_url('../js/viewer/viewer.js')."></script>
						<script src=".base_url('../js/app/common.js')."></script>";

					$this->data['css_plugins']		= "
						<link rel='stylesheet' href='".base_url('../css/fileinput/fileinput.min.css')."'>
						<link rel='stylesheet' href='".base_url('../css/viewer/viewer.css')."'>";
				}else{
					$this->data['contenido'] 			= 'actividades/visita_realizada';
					$this->data['titulo'] 			= 'Visita realizada';
				}
			}
		}

		$this->load->view('template_v3', $this->data);

	}

	public function get_calendar() {
		$arrQuery	= $this->Model_Actividades->visita_schedule();
		print json_encode($arrQuery);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode( $this->Model_Proveedor->all() ) . '}';
			}
		}
	}

}
