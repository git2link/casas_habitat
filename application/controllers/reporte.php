<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Reporte');

    }

	public function index() {
		$data['contenido'] = 'reporte/index';
		$data['titulo'] = 'Reportes';
		$data['js']			= "
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
		$this->load->view('template_v3', $data);
	}

	public function venta() {
		$data['contenido'] = 'reporte/venta';
		$data['titulo'] = 'Venta';
		$data['js_plugins']			= "
			<script src=".base_url('../js/pivot/jquery.ui.touch-punch.min.js')."></script>
			<script src=".base_url('../js/pivot/jsapi.js')."></script>
			<script src=".base_url('../js/pivot/pivot.js')."></script>
			<script src=".base_url('../js/pivot/pivot.es.js')."></script>
			<script src=".base_url('../js/pivot/gchart_renderers.js')."></script>
			<script src=".base_url('../js/pivot/jquery.battatech.excelexport.js')."></script>";

		$data['css_plugins']			= "
			<link rel='stylesheet' href='".base_url('../css/pivot/pivot.css')."'>";
		$this->load->view('template_v3', $data);
	}

	public function atencion_compras(){

		$data = $this->Model_Reporte->atencion_compras();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);

	}

	public function atencion_ventas(){

		$data = $this->Model_Reporte->atencion_ventas();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
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

