<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Reporte');

    }

	public function index() {
		$this->data['contenido'] = 'reporte/index';
		$this->data['titulo'] = 'Reportes';
		$this->data['js']			= "
		<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/reporte/app.js')."></script>
		<script src=".base_url('../js/app/reporte/data.js')."></script>
		<script src=".base_url('../js/app/reporte/directives.js')."></script>
		<script src=".base_url('../js/app/reporte/reporteCtrl.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";
		$this->load->view('template_v3', $this->data);
	}

	public function venta() {
		$this->data['contenido'] = 'reporte/venta';
		$this->data['titulo'] = 'Venta';
		$this->data['js_plugins']			= "
			<script src=".base_url('../js/pivot/jquery.ui.touch-punch.min.js')."></script>
			<script src=".base_url('../js/pivot/jsapi.js')."></script>
			<script src=".base_url('../js/pivot/pivot.js')."></script>
			<script src=".base_url('../js/pivot/pivot.es.js')."></script>
			<script src=".base_url('../js/pivot/gchart_renderers.js')."></script>
			<script src=".base_url('../js/pivot/jquery.battatech.excelexport.js')."></script>";

		$this->data['css_plugins']			= "
			<link rel='stylesheet' href='".base_url('../css/pivot/pivot.css')."'>";
		$this->load->view('template_v3', $this->data);
	}

	public function atencion_compras(){

		$datos = $this->Model_Reporte->atencion_compras();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);

	}

	public function atencion_ventas(){

		$datos = $this->Model_Reporte->atencion_ventas();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);

	}

	public function get_report( $type ){
		$user 	= $this->session->userdata('usuario_id');
		if ( isset($user) ) {
			if ($type == 1) {
				$arrQuery = $this->Model_Reporte->venta_actividades();
				print json_encode($arrQuery);
			}
		}
	}


}

