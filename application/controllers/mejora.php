<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mejora extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Mejora');
		$this->load->model('Model_Proveedor');
		$this->load->library('mail');
		$this->load->library('functions');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }


	/*public function create( $id ) {
		$data['contenido']  = 'mejora/index';
		$data['casa_k'] 	= $id;
		$data['titulo'] 	= 'Mejoras';

		$data['js']			= "
		<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/mejora/app.js')."></script>
		<script src=".base_url('../js/app/mejora/data.js')."></script>
		<script src=".base_url('../js/app/mejora/directives.js')."></script>
		<script src=".base_url('../js/app/mejora/mejoraCtrl.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";


		$this->load->view('template_v3', $data);
	}*/

	public function create( $id ) {

		$data['modal'] 		= 'mejora/mejora_modal';
		$data['titulo'] 	= 'Mejoras';
		$data['casa_k'] 	= $id;
		$data['proveedor'] 	= $this->Model_Proveedor->all();
		$data['casa'] 		= $this->Model_Mejora->ubicacion( $id );
		
		if (count($data['casa'])>0) {
			$data['clave'] 		= $data['casa'][0]->clave_interna;
			$data['contenido'] 	= 'mejora/mejora';
		}else{
			$data['contenido'] 	= 'home/acceso_denegado';
		}
		$this->load->view('template_v3', $data);
	}

	function all( $id ){
		$datos = $this->Model_Mejora->all( $id );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);
	}


/*
	public function create() {
		$data['contenido'] 			= 'mejora/create';
		$data['titulo'] 			= 'Crear Mejora';
		$data['mejora']			= $this->Model_Catalogos->getTipoMejoras();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->load->view('template_v3', $data);
	}*/

	public function insert() {

		/*$registro = json_decode(file_get_contents('php://input'),true);
		unset($registro['empresa']);
		unset($registro['save']);
		$id = $this->Model_Mejora->insert($registro);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Mejora agregada exitosamente',
			'data'		=> $id
			);

		echo json_encode($array_response);*/

		$registro 	= $this->input->post();

		$mejora['proveedor_k'] 				= $registro['proveedor_k'];
		$mejora['casa_k'] 					= $registro['casa_k'];
		$mejora['descripcion'] 				= $registro['descripcion'];
		$mejora['fecha_inicio_trabajos'] 	= $registro['fecha_inicio_trabajos'];
		$mejora['fecha_hora_creacion'] 		= date('Y-m-d H:i:s');
		$mejora['usuario_creacion']			= $this->session->userdata('usuario_id');

		$response 							= $this->Model_Mejora->insert($mejora);

		$id 								= $this->functions->encrypt_decrypt('encrypt', $response);

		$body = '<head>
		  <style type="text/css">
		    body{ font-family: "Open Sans"}
		    h2 { font-family: Oswald; color: rgb(51, 51, 51)}
		  </style>
		</head>
		<body>
		  <img src="http://sistemas2link.com/casas_habitat/img/logo_final.png">
		  <br>
		  <h2>Solicitud de mejora</h2>
		  <br>
		  <b>Ubicación:</b>
		  <br>
		  <label>' . $registro['calle'] . ' ' . $registro['lote'] . ' ' . $registro['colonia'] . ', ' . $registro['municipio'] . ' ' . $registro['estado'] . ' ' . $registro['codigo_postal'] . '</label>
		  <br><br>
		  <b>Descripción de la mejora:</b>
		  <br>
		  <label>' . $registro['descripcion']  .'</label>
		  <br><br>
		  <b>Fecha de inicio solicitada:</b>
		  <br>
		  <label>' . $registro['fecha_inicio_trabajos']  . ' </label>
		  <br><br><br>
		  <b> De clic en el <a href="http://sistemas2link.com/casas_habitat_request/index.php/request/mejora/' . $id . '">enlace</a> para tomar alguna decisión sobre la solicitud</b>
		  <br><br><br>
		  <div align="center">
		  	Casas Habitat mensaje<br>
		  	Si tiene duda o requiere alguna aclaración comuniquese al telefono.
		  </div>
		</body>';

		print $this->mail->simple_mail('Solicitud de mejora', $registro['email'], $body);

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

		$this->load->view('template_v3', $data);
		
	}

	public function update( $id ) {

		$registro = json_decode(file_get_contents('php://input'),true);
		unset($registro['empresa']);
		unset($registro['save']);
		$id = $this->Model_Mejora->update($registro , $id );
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Product information updated successfully',
			);

		echo json_encode($array_response);
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
				print '{"data": ' . json_encode( $this->Model_Mejora->all( $casa ) ) . '}';
			}
		}
	}

}
