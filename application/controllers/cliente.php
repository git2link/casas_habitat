<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cliente extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Cliente');
		$this->load->model('Model_Casa');
		$this->load->model('Model_Catalogos');
		//$this->load->library('clienteLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {

		$registro['estatus_cliente'] 	= ESTATUS_CLIENTE_PROSPECTO;
		$this->data['contenido'] 				= 'cliente/index';
		$this->data['titulo'] 				= ' Clientes';
		$this->data['query'] 					= $this->Model_Cliente->all( $registro );
		$this->data['js']			= "
		<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/cliente/app.js')."></script>
		<script src=".base_url('../js/app/cliente/data.js')."></script>
		<script src=".base_url('../js/app/cliente/directives.js')."></script>
		<script src=".base_url('../js/app/cliente/clienteCtrl.js')."></script>

		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";
		$this->load->view('template_v3', $this->data);


	}

	public function personas( $tipo ) {
		if ( $tipo=='clientes' || $tipo=='prospectos' ) {
			$this->data['contenido'] 				= 'cliente/personas';
			$this->data['modal'] 					= 'cliente/personas_modal';
			$this->data['titulo'] 				= 'Personas';
			if ($tipo=='clientes') {
				$this->data['tipo'] 				= 'cliente';
			}else{
				$this->data['tipo'] 				= 'prospecto';
			}
			
			$this->data['estado']					= $this->Model_Catalogos->getEstados();
			$this->data['procedencia'] 			= $this->Model_Catalogos->allProcedencia();
			$this->data['servicios'] 				= $this->Model_Catalogos->allServicios();
			$this->data['js'] 					= "
			<script type='text/javascript' src=".base_url('../js/app/direccion_2.js')."></script>";
			
		}else{
			$this->data['contenido'] 				= 'home/acceso_denegado';
			$this->data['titulo'] 				= 'Denegado';
		}

		$this->load->view('template_v3', $this->data);
	}


	function all(){
		$filtro = json_decode(file_get_contents('php://input'),true);
		$datos = $this->Model_Cliente->all( $filtro );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);
	}

	public function search() {

		$this->data['contenido'] 	= 'cliente/index';
		$this->data['titulo'] 	= 'Clientes';
		$value 				= $this->input->post('buscar');
		$this->data['query'] 		= $this->Model_Cliente->allFiltered('cli.nombre', $value);
		$this->load->view('template_v3', $this->data);

	}

	public function my_validation() {

		//return $this->clientelib->my_validation($this->input->post());

	}

	public function create() {
		$this->data['contenido'] 			= 'cliente/create';
		$this->data['titulo'] 			= 'Crear Cliente';
		$this->data['casas']				= $this->Model_Catalogos->getCasas();
		$this->data['estado_civil']		= $this->Model_Catalogos->getEstadoCivil();
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
									<script src=".base_url('../js/demos/form-extended.js')."></script>

		";
		$this->load->view('template_v3', $this->data);
	}

	public function insert() {

		$registro = $this->input->post();
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->create();

        }
        else {

			$registro['fecha_hora_creacion'] = date('Y-m-d H:i:s');
			$this->Model_Cliente->insert($registro);
			redirect('cliente/index');

        }
	}

	public function insert_prospecto() {
		$registro = $this->input->post();
		$registro['estatus_cliente'] 			= 'prospecto';
		$registro['fecha_hora_creacion'] 		= date('Y-m-d H:i:s');
		$registro['usuario_creacion'] 			= $this->session->userdata('usuario_id');
		$this->Model_Cliente->insert($registro);
		print 1;
	}

	public function edit($id) {

		$this->data['contenido'] 	= 'cliente/edit';
		$this->data['titulo'] 	= 'Actualizar Cliente';
		$this->data['casas']		= $this->Model_Catalogos->getCasas();
		$this->data['registro'] 	= $this->Model_Cliente->find($id);
		$this->data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$this->data['estado']				= $this->Model_Catalogos->getEstado   ( $this->data['registro']->estado_k );
		$this->data['municipio']			= $this->Model_Catalogos->getMunicipio( $this->data['registro']->municipio_k );
		$this->data['colonias']			= $this->Model_Catalogos->getColonias ( $this->data['registro']->codigo_postal );
		$this->load->view('template_v3', $this->data);
		
	}

	public function update($id) {
		$registro = json_decode(file_get_contents('php://input'),true);
		$array = array(
			"nombre"	=> $registro['nombre'],
			"apellido_paterno"	=> $registro['apellido_paterno'],
			"apellido_materno"	=> $registro['apellido_materno'],
			"email"	=> $registro['email'],
			"telefono_casa"	=> $registro['telefono_casa'],
			"telefono_recados"	=> $registro['telefono_recados'],
			"telefono_celular"	=> $registro['telefono_celular']
			);

		$id = $this->Model_Cliente->update($array , $id );
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Cliente actualizado correctamente',
			);

		echo json_encode($array_response);
	}

	public function update_client() {

		$registro = $this->input->post();
		$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_modificacion'] 		= $this->session->userdata('usuario_id');
		$id 									= $registro['cliente_k'];
		$this->Model_Cliente->update($registro , $id );
		print 1;
	}

	public function delete($id) {
		$this->Model_Cliente->delete($id);
		redirect('cliente/index');
	}

	public function servicios($id){		
		$this->data['contenido'] 				= 'cliente/servicios';
		$this->data['titulo'] 				= ' Servicios';
		$this->data['usuario_k']				= $id;
		$this->data['datos_usuario']			= $this->Model_Cliente->find( $id );
		$this->data['js']			= "
		<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-resource.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>
		


		<script src=".base_url('../js/app/cliente/servicios/app.js')."></script>
		<script src=".base_url('../js/app/cliente/servicios/data.js')."></script>
		<script src=".base_url('../js/app/cliente/servicios/directives.js')."></script>
		<script src=".base_url('../js/app/cliente/servicios/clienteServiciosCtrl.js')."></script>
		<script src=".base_url('../js/angular/check-list-model.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>

		<script src=".base_url('../js/plugins/magnific/jquery.magnific-popup.min.js')."></script>
  		<script src=".base_url('../js/plugins/howl/howl.js')."></script>
		<script type='text/javascript' src=".base_url('../js/demos/ui-notifications.js')."></script>
		";
		$this->load->view('template_v3', $this->data);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				$registro['estatus_cliente'] 	= $tipo;
				print '{"data": ' . json_encode($this->Model_Cliente->all( $registro )) . '}';
			}
		}
	}

}
