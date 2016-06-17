<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propuestas extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Propuestas');
		$this->load->model('Model_Cliente');
		$this->load->library('comunLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index( $casa_k , $cliente_k ) {
		$data['casa_k']			= $casa_k;
		$data['cliente_k']		= $cliente_k;
		$data['contenido'] 		= 'propuestas/index';
		$data['modal'] 			= 'propuestas/propuestas_modal';
		$data['titulo'] 		= 'Propuestas';
		$data['js']				= "<script src=".base_url('../js/loadmask/jquery.loadmask.spin.js')."></script>
								   <script src=".base_url('../js/loadmask/spin.min.js')."></script>
								   ";
		$this->load->view('template_v3', $data);
	}

	public function datatable( $casa_k = null , $cliente_k = null ) {
		if ($_POST) {
			extract($_POST);
				print '{"data": ' . json_encode($this->Model_Propuestas->getPropuestasCasa( $casa_k , $cliente_k ) ) . '}';
		}
	}

	public function insertar_propuesta(){

		$registro 							= $this->input->post();
		$registro['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_creacion']	 	= $this->session->userdata('usuario_id');
		$registro['estatus']			 = 'En espera';

		$registro['pago_contado']	= $this->comunlib->format_num( $registro['pago_contado'] );
		$registro['precio_pactado']	= $this->comunlib->format_num( $registro['precio_pactado'] );
		$registro['anticipo']		= $this->comunlib->format_num( $registro['anticipo'] );

		$propuesta_tmp_k = $registro['propuesta_tmp_k']; 
		unset($registro['propuesta_tmp_k']);
		$id = $this->Model_Propuestas->insertar_propuesta($registro);

		$this->Model_Propuestas->copiarPagosDePropuestaTemporal( $id , $propuesta_tmp_k);

		$array = array(
			"estatus_atencion"		=> 'En Propuesta',
			"usuario_atencion"		=> $this->session->userdata('usuario_id'),
			"fecha_atencion"		=> date('Y-m-d'),
			"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+7 day' , strtotime ( date('Y-m-d') ) ) )
			);
		$this->Model_Cliente->update($array, $registro['cliente_k'] );

		echo 1;
	}

	public function insertar_tmp() {
		$registro = array();
		$registro['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_creacion']	 	= $this->session->userdata('usuario_id');
		$id = $this->Model_Propuestas->insertar_tmp($registro);


		print $id;
	}

	public function insertar_pago_tmp() {

		$registro 			= $this->input->post();
		$registro['monto']	= $this->comunlib->format_num( $registro['monto'] );
		$this->Model_Propuestas->insertar_pago_tmp($registro);

		print 1;
	}

}