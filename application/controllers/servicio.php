<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Servicio extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Cliente');
		$this->load->model('Model_Casa');
		$this->load->model('Model_Catalogos');
		$this->load->model('Model_Servicio');
		$this->load->library('casaLib');
		$this->load->library('clienteLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');
		$this->form_validation->set_message('validarcurp', 'El %s ya se encuentra registrado en la base de datos');

    }

	public function comprar() {

		$data['contenido'] = 'servicio/comprar';
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['forma_pago'] 		= $this->Model_Catalogos->get_forma_pago();
		$data['estados']			= $this->Model_Catalogos->getEstados();		
		$data['sexo']				= $this->Model_Catalogos->getSexos();
		$data['titulo'] = 'Comprar';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
									<script src=".base_url('../js/demos/form-extended.js')."></script>
		";


		$this->load->view('template2', $data);

	}

	public function createcompra(){

		/*$this->form_validation->set_rules('curp', 'Curp', 'required|callback_validarcurp');
		if($this->form_validation->run() == FALSE) {
			$this->comprar();
		}
		else{*/
			$registro = $this->input->post();


			$array_cliente 	 =  array(
				"nombre"				=> $registro['nombre'],
				"apellido_paterno"		=> $registro['apellido_paterno'],
				"apellido_materno"		=> $registro['apellido_materno'],
				"fecha_nacimiento"		=> $registro['fecha_nacimiento'],
				"estado_nacimiento_k"	=> $registro['estado_nacimiento_k'],
				"sexo"					=> $registro['sexo'],
				"curp"					=> $registro['curp'],
				"rfc"					=> $registro['rfc'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"telefono_casa"			=> $registro['telefono_casa'],
				"telefono_celular"		=> $registro['telefono_celular'],
				"telefono_recados"		=> $registro['telefono_recados'],
				"twitter"				=> $registro['twitter'],
				"fb"					=> $registro['fb'],
				"empresa"				=> $registro['empresa'],
				"email"					=> $registro['email'],
				"usuario_creacion" 		=> $this->session->userdata('usuario_id'),
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				"estatus_cliente"		=> ESTATUS_CLIENTE_PROSPECTO,
				"estatus_atencion"		=> 'Alta',
				"fecha_atencion"		=> date('Y-m-d'),
				"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ),
				"usuario_atencion"		=> $this->session->userdata('usuario_id')
				);
			$cliente_k = $this->Model_Cliente->insert( $array_cliente );

			$array_prospecto = array(
				"cliente_k" 		=> $cliente_k,
				"estado_k"			=> $registro['estado_k'],
				"municipio_k"		=> $registro['municipio_k'],
				"forma_pago_k"		=> $registro['forma_pago_k'],
				"presupuesto"		=> $registro['presupuesto'],
				"tipo_vivienda_k"	=> $registro['tipo_vivienda_k'],
				);

			$this->Model_Cliente->insertProspectoCompra( $array_prospecto );

			redirect('home/index');
		/*}*/

	}

	public function vender() {
		$data['contenido'] 			= 'servicio/vender';
		$data['modal'] 				= 'servicio/vender_modal';
		$data['nivel_urgencia'] 	= $this->Model_Catalogos->get_nivel_urgencia();
		$data['cliente'] 			= $this->Model_Servicio->prospecto_cliente_list();
		$data['employee'] 			= $this->Model_Servicio->employees_availabe();
		$data['titulo'] 			= 'Vender';
		$data['js']				    = "";
		$this->load->view('template_v3', $data);

	}

	public function set_visita() {
		$visita 						= $this->input->post();
		$visita['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$visita['usuario_creacion']	 	= $this->session->userdata('usuario_id');
		$this->Model_Servicio->insertar_visita( $visita );

		$venta['estatus_k'] = 3;
		$this->Model_Servicio->update_venta_by_casa($venta, $visita['casa_k']);
		print 1;
	}

	public function get_casa_prospecto() {
		extract($_POST);
		$arrQuery	= $this->Model_Servicio->casa_cliente_prospecto_by_cliente( $cliente );
		print json_encode($arrQuery);
	}


	public function createventa(){

		/*$this->form_validation->set_rules('curp', 'Curp', 'required|callback_validarcurp');
		if($this->form_validation->run() == FALSE) {
			$this->vender();
		}
		else{
			*/
			$registro = $this->input->post();
			$registro['tipo_casa_k'] = CASA_MA;
			$datos_adicionales = $this->casalib->generarClaveInterna( $registro );
			
			$registro = array_merge( $registro , $datos_adicionales );

			$array_casa = array(
				"tipo_vivienda_k"		=> $registro['tipo_vivienda_k'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"tipo_casa_k"			=> $registro['tipo_casa_k'],
				"autoincremental_tipo"	=> $registro['autoincremental_tipo'],
				"clave_interna"			=> $registro['clave_interna'],
				"paquete_casa_k"		=> 1,
				"estatus_venta"			=> ESTATUS_CASA_PROSPECTO,
				"usuario_creacion" 		=> $this->session->userdata('usuario_id'),
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				);

			$casa_k = $this->Model_Casa->insert( $array_casa );

			$array_cliente 	 =  array(
				"nombre"				=> $registro['nombre'],
				"apellido_paterno"		=> $registro['apellido_paterno'],
				"apellido_materno"		=> $registro['apellido_materno'],
				"fecha_nacimiento"		=> $registro['fecha_nacimiento'],
				"estado_nacimiento_k"	=> $registro['estado_nacimiento_k'],
				"sexo"					=> $registro['sexo'],
				"curp"					=> $registro['curp'],
				"rfc"					=> $registro['rfc'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"telefono_casa"			=> $registro['telefono_casa'],
				"telefono_celular"		=> $registro['telefono_celular'],
				"telefono_recados"		=> $registro['telefono_recados'],
				"twitter"				=> $registro['twitter'],
				"fb"					=> $registro['fb'],
				"empresa"				=> $registro['empresa'],
				"email"					=> $registro['email'],
				"usuario_creacion"		=> $this->session->userdata('usuario_id'),
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				"estatus_cliente"		=> ESTATUS_CLIENTE_PROSPECTO,
				"estatus_atencion"		=> 'Alta',
				"fecha_atencion"		=> date('Y-m-d'),
				"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ),
				"usuario_atencion"		=> $this->session->userdata('usuario_id')
				);

			$cliente_k = $this->Model_Cliente->insert( $array_cliente );

			$array_servicio = array(
				"cliente_k"			=> $cliente_k,
				"casa_k"			=> $casa_k,
				"usuario_k"			=> $this->session->userdata('usuario_id'),
				"estatus"			=> ESTATUS_CLIENTE_PROSPECTO,
				"nivel_urgencia" 	=> $registro['nivel_urgencia']
				);

			$this->Model_Servicio->insertventa( $array_servicio );

			redirect('home/index');
		/*}*/

	}

	public function remodelar() {
		$data['contenido'] = 'servicio/remodelar';
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['forma_pago'] 		= $this->Model_Catalogos->get_forma_pago();
		$data['estados']			= $this->Model_Catalogos->getEstados();		
		$data['sexo']				= $this->Model_Catalogos->getSexos();
		$data['titulo'] 			= 'Remodelar';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
									<script src=".base_url('../js/demos/form-extended.js')."></script>
		";
		$this->load->view('template_v3', $data);

	}

	public function createremodelar(){
		$this->form_validation->set_rules('curp', 'Curp', 'required|callback_validarcurp');
		if($this->form_validation->run() == FALSE) {
			$this->remodelar();
		}
		else{

			$registro = $this->input->post();


			$array_cliente 	 =  array(
				"nombre"				=> $registro['nombre'],
				"apellido_paterno"		=> $registro['apellido_paterno'],
				"apellido_materno"		=> $registro['apellido_materno'],
				"fecha_nacimiento"		=> $registro['fecha_nacimiento'],
				"estado_nacimiento_k"	=> $registro['estado_nacimiento_k'],
				"sexo"					=> $registro['sexo'],
				"curp"					=> $registro['curp'],
				"rfc"					=> $registro['rfc'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"telefono_casa"			=> $registro['telefono_casa'],
				"telefono_celular"		=> $registro['telefono_celular'],
				"telefono_recados"		=> $registro['telefono_recados'],
				"twitter"				=> $registro['twitter'],
				"fb"					=> $registro['fb'],
				"empresa"				=> $registro['empresa'],
				"email"					=> $registro['email'],
				"presupuesto"			=> $registro['presupuesto'],
				"forma_pago_k"			=> $registro['forma_pago_k'],
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				"estatus_cliente"		=> ESTATUS_CLIENTE_PROSPECTO,
				"estatus_atencion"		=> 'Alta',
				"fecha_atencion"		=> date('Y-m-d'),
				"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ),
				"usuario_atencion"		=> $this->session->userdata('usuario_id')
				);

			$cliente_k = $this->Model_Cliente->insert( $array_cliente );

			$array_casa = array(
				"codigo_postal"		=> $registro['codigo_postal'],
				"estado_k"			=> $registro['estado_k'],
				"municipio_k"		=> $registro['municipio_k'],
				"colonia_k"			=> $registro['colonia_k'],
				"calle_numero"		=> $registro['calle_numero'],
				"lote"				=> $registro['lote'],
				"paquete_casa_k"		=> 1,
				
				);

			$casa_k = $this->Model_Casa->insert( $array_casa );

			$array_servicio = array(
				"cliente_k"		=> $cliente_k,
				"casa_k"		=> $casa_k,
				"usuario_k"		=> $this->session->userdata('usuario_id'),
				"estatus"		=> ESTATUS_CLIENTE_PROSPECTO
				);

			$this->Model_Servicio->insertremodelar( $array_servicio );

			redirect('home/index');
		}

	}

	public function construir() {
		$data['contenido'] = 'servicio/construir';
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['forma_pago'] 		= $this->Model_Catalogos->get_forma_pago();
		$data['estados']			= $this->Model_Catalogos->getEstados();		
		$data['sexo']				= $this->Model_Catalogos->getSexos();
		$data['titulo'] 			= 'Construir';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
									<script src=".base_url('../js/demos/form-extended.js')."></script>
		";
		$this->load->view('template_v3', $data);

	}

	public function createconstruir(){

		$this->form_validation->set_rules('curp', 'Curp', 'required|callback_validarcurp');
		if($this->form_validation->run() == FALSE) {
			$this->construir();
		}
		else{

			$registro = $this->input->post();


			$array_cliente 	 =  array(
				"nombre"				=> $registro['nombre'],
				"apellido_paterno"		=> $registro['apellido_paterno'],
				"apellido_materno"		=> $registro['apellido_materno'],
				"fecha_nacimiento"		=> $registro['fecha_nacimiento'],
				"estado_nacimiento_k"	=> $registro['estado_nacimiento_k'],
				"sexo"					=> $registro['sexo'],
				"curp"					=> $registro['curp'],
				"rfc"					=> $registro['rfc'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"telefono_casa"			=> $registro['telefono_casa'],
				"telefono_celular"		=> $registro['telefono_celular'],
				"telefono_recados"		=> $registro['telefono_recados'],
				"twitter"				=> $registro['twitter'],
				"fb"					=> $registro['fb'],
				"empresa"				=> $registro['empresa'],
				"email"					=> $registro['email'],
				"presupuesto"			=> $registro['presupuesto'],
				"forma_pago_k"			=> $registro['forma_pago_k'],
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				"estatus_cliente"		=> ESTATUS_CLIENTE_PROSPECTO,
				"estatus_atencion"		=> 'Alta',
				"fecha_atencion"		=> date('Y-m-d'),
				"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) ),
				"usuario_atencion"		=> $this->session->userdata('usuario_id')
				);
			$cliente_k = $this->Model_Cliente->insert( $array_cliente );

			$array_casa = array(
				"codigo_postal"		=> $registro['codigo_postal'],
				"estado_k"			=> $registro['estado_k'],
				"municipio_k"		=> $registro['municipio_k'],
				"colonia_k"			=> $registro['colonia_k'],
				"calle_numero"		=> $registro['calle_numero'],
				"lote"				=> $registro['lote'],
				"paquete_casa_k"		=> 1,
				
				);

			$casa_k = $this->Model_Casa->insert( $array_casa );

			$array_servicio = array(
				"cliente_k"		=> $cliente_k,
				"casa_k"		=> $casa_k,
				"usuario_k"		=> $this->session->userdata('usuario_id'),
				"estatus"		=> ESTATUS_CLIENTE_PROSPECTO
				);

			$this->Model_Servicio->insertconstruir( $array_servicio );

			redirect('home/index');
		}

	}

	public function mantenimiento() {
		$data['contenido'] = 'servicio/mantenimiento';
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['forma_pago'] 		= $this->Model_Catalogos->get_forma_pago();
		$data['estados']			= $this->Model_Catalogos->getEstados();		
		$data['sexo']				= $this->Model_Catalogos->getSexos();
		$data['titulo'] 			= 'Mantenimiento';
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
									<script src=".base_url('../js/demos/form-extended.js')."></script>
		";
		$this->load->view('template_v3', $data);

	}

	public function createmantenimiento(){

		$this->form_validation->set_rules('curp', 'Curp', 'required|callback_validarcurp');
		if($this->form_validation->run() == FALSE) {
			$this->vender();
		}
		else{

			$registro = $this->input->post();


			$array_cliente 	 =  array(
				"nombre"				=> $registro['nombre'],
				"apellido_paterno"		=> $registro['apellido_paterno'],
				"apellido_materno"		=> $registro['apellido_materno'],
				"fecha_nacimiento"		=> $registro['fecha_nacimiento'],
				"estado_nacimiento_k"	=> $registro['estado_nacimiento_k'],
				"sexo"					=> $registro['sexo'],
				"curp"					=> $registro['curp'],
				"rfc"					=> $registro['rfc'],
				"codigo_postal"			=> $registro['codigo_postal'],
				"estado_k"				=> $registro['estado_k'],
				"municipio_k"			=> $registro['municipio_k'],
				"colonia_k"				=> $registro['colonia_k'],
				"calle_numero"			=> $registro['calle_numero'],
				"lote"					=> $registro['lote'],
				"telefono_casa"			=> $registro['telefono_casa'],
				"telefono_celular"		=> $registro['telefono_celular'],
				"telefono_recados"		=> $registro['telefono_recados'],
				"twitter"				=> $registro['twitter'],
				"fb"					=> $registro['fb'],
				"empresa"				=> $registro['empresa'],
				"email"					=> $registro['email'],
				"presupuesto"			=> $registro['presupuesto'],
				"forma_pago_k"			=> $registro['forma_pago_k'],
				"fecha_hora_creacion"	=> date('Y-m-d H:i:s'),
				"tabla_propietario"		=> TABLA_CLIENTE_MANTENIMIENTO,
				"estatus_cliente"		=> ESTATUS_CLIENTE_PROSPECTO
				);
			$cliente_k = $this->Model_Cliente->insert( $array_cliente );

			$array_casa = array(
				"codigo_postal"		=> $registro['codigo_postal'],
				"estado_k"			=> $registro['estado_k'],
				"municipio_k"		=> $registro['municipio_k'],
				"colonia_k"			=> $registro['colonia_k'],
				"calle_numero"		=> $registro['calle_numero'],
				"lote"				=> $registro['lote'],
				
				);

			$this->Model_Casa->insert( $array_casa );

			redirect('home/index');
		}

	}

	public function casas_sin_interes( $cliente_k ){

		$filtro = json_decode(file_get_contents('php://input'),true);

		$data = $this->Model_Servicio->casas_sin_interes( $cliente_k , $filtro );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}

	public function agregar_interes( $cliente_k ){

		$registro = json_decode(file_get_contents('php://input'),true);
		$registro = (object)$registro;

		foreach ($registro->casas as $casa) {
			$interes = $this->Model_Servicio->existe_interes( $cliente_k , $casa['casa_k'] );
			if( empty($interes) ){
				$array_insert = array(
					'cliente_k'				=> $cliente_k,
					'casa_k' 				=> $casa['casa_k'],
					'usuario_creacion'		=> $this->session->userdata('usuario_id'),
					'fecha_hora_creacion'	=> date('Y-m-d H:i:s')
					);
				$this->Model_Servicio->agregar_interes( $array_insert );
				// actualiza el estatus de atencion del cliente
				$registro = array(
					"estatus_atencion"		=> 'Asignación Interes',
					"usuario_atencion"		=> $this->session->userdata('usuario_id'),
					"fecha_atencion"		=> date('Y-m-d'),
					"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) )
					);
				$this->Model_Cliente->update($registro, $cliente_k );
			}
			if( $interes->activo == 0){
				$array_update = array(
					'usuario_modificacion'		=> $this->session->userdata('usuario_id'),
					'fecha_hora_modificacion'	=> date('Y-m-d H:i:s'),
					'activo'					=> 1
					);
				$this->Model_Servicio->actualizar_interes( $interes->interes_k , $array_update);
				// actualiza el estatus de atencion del cliente
				$registro = array(
					"estatus_atencion"		=> 'Asignación Interes',
					"usuario_atencion"		=> $this->session->userdata('usuario_id'),
					"fecha_atencion"		=> date('Y-m-d'),
					"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+5 day' , strtotime ( date('Y-m-d') ) ) )
					);
				$this->Model_Cliente->update($registro, $cliente_k );
			}
		}

		$array_response = array(
				'status'	=> 'success',
				'message'   => 'Interes de casas agregado exitosamente',
				);

		echo json_encode($array_response);

	}

	public function eliminar_interes( $interes_k ){
		$array_update = array(
			'usuario_eliminacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_eliminacion'	=> date('Y-m-d H:i:s'),
			'activo'					=> 0
			);
		$this->Model_Servicio->actualizar_interes( $interes_k , $array_update);

		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Interes eliminado correctamente',
			);

		echo json_encode($array_response);
	}


	public function casas_con_interes( $cliente_k ){

		$data = $this->Model_Servicio->casas_con_interes( $cliente_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}

	public function casas_en_venta( $cliente_k ){

		$data = $this->Model_Servicio->casas_en_venta( $cliente_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}

	public function insertar_propuesta(){

		$registro 							= $this->input->post();
		$registro['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_creacion']	 	= $this->session->userdata('usuario_id');
		$registro['estatus']			 = 'En espera';

		$propuesta_tmp_k = $registro['propuesta_tmp_k']; 
		unset($registro['propuesta_tmp_k']);
		$id = $this->Model_Servicio->insertar_propuesta($registro);

		$this->Model_Servicio->copiarPagosDePropuestaTemporal( $id , $propuesta_tmp_k);

		$array = array(
			"estatus_atencion"		=> 'En Propuesta',
			"usuario_atencion"		=> $this->session->userdata('usuario_id'),
			"fecha_atencion"		=> date('Y-m-d'),
			"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+7 day' , strtotime ( date('Y-m-d') ) ) )
			);
		$this->Model_Cliente->update($array, $registro['cliente_k'] );

		echo 1;
	}

	public function visitas_casa( $casa_k , $cliente_k ){

		$data = $this->Model_Servicio->visitas_casa( $casa_k , $cliente_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);

	}

	public function actualizar_visita($visita_k){
		$registro = json_decode(file_get_contents('php://input'),true);
		$arreglo = array(
			'fecha_visita'				=> $registro['fecha_visita'],
			'realizada'					=> $registro['realizada'],
			'usuario_modificacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_modificacion'	=> date('YYYY-mm-dd')
			);

		$this->Model_Servicio->actualizar_visita($arreglo , $visita_k );
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Información Actualizada Éxitosamente',
			);

		echo json_encode($array_response);
	}

	public function insertar_visita(){
		$registro = json_decode(file_get_contents('php://input'),true);
		$arreglo = array(
			'casa_k'				=> $registro['casa_k'],
			'cliente_k'				=> $registro['cliente_k'],
			'usuario_k'				=> $this->session->userdata('usuario_id'),
			'fecha_visita'			=> $registro['fecha_visita'],
			'realizada'				=> $registro['realizada'],
			'usuario_creacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_creacion'	=> date('Y-m-d H:i:s'),
			);

		$id = $this->Model_Servicio->insertar_visita($arreglo);

		$array = array(
			"estatus_atencion"		=> 'Visita Ocular',
			"usuario_atencion"		=> $this->session->userdata('usuario_id'),
			"fecha_atencion"		=> date('Y-m-d'),
			"fecha_proxima_atencion"=> $registro['fecha_visita'], 
			);
		$this->Model_Cliente->update($array, $registro['cliente_k'] );

		$data = (object)array(
			'id'				=> $id,
			'nombre_usuario'	=> $this->session->userdata('usuario')
			);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Propuesta enviada exitosamente',
			'data'		=> $data
			);

		echo json_encode($array_response);
	}

	public function ofertas_casa( $casa_k , $cliente_k ){

		$data = $this->Model_Servicio->ofertas_casa( $casa_k , $cliente_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);

	}

	public function ofertas_casas(){

		$data = $this->Model_Servicio->ofertas_casas();

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);

	}

	public function insertar_oferta($tipo_oferta){
		$registro = json_decode(file_get_contents('php://input'),true);
		$tipo = ($tipo_oferta == 1) ? 'Oferta' : 'ContraOferta';
		$arreglo = array(
			'casa_k'				=> $registro['casa_k'],
			'cliente_k'				=> $registro['cliente_k'],
			'usuario_k'				=> $this->session->userdata('usuario_id'),
			'oferta'				=> $registro['oferta'],
			'estatus'				=> 'Pendiente',
			'tipo'					=> $tipo,
			'usuario_creacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_creacion'	=> date('Y-m-d H:i:s'),
			);


		$id = $this->Model_Servicio->insertar_oferta($arreglo);
		$array = array(
			"estatus_atencion"		=> 'Oferta',
			"usuario_atencion"		=> $this->session->userdata('usuario_id'),
			"fecha_atencion"		=> date('Y-m-d'),
			"fecha_proxima_atencion"=> date ( 'Y-m-d' , strtotime ( '+30 day' , strtotime ( date('Y-m-d') ) ) )
			);
		$this->Model_Cliente->update($array, $registro['cliente_k'] );
		$data = (object)array(
			'id'				=> $id,
			'nombre_usuario'	=> $this->session->userdata('usuario'),
			'estatus'			=> $arreglo['estatus'],
			'tipo'				=> $arreglo['tipo']
			);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Oferta enviada exitosamente',
			'data'		=> $data
			);

		echo json_encode($array_response);
	}

	public function insertar_contraoferta(){
		$registro = json_decode(file_get_contents('php://input'),true);

		$array_update = array(
			'estatus'	=> 'Revisada',
			);
		$this->Model_Servicio->actualizar_oferta( $registro['oferta_k'] , $array_update );
		
		$arreglo = array(
			'casa_k'				=> $registro['casa_k'],
			'cliente_k'				=> $registro['cliente_k'],
			'usuario_k'				=> $this->session->userdata('usuario_id'),
			'oferta'				=> $registro['contraoferta'],
			'estatus'				=> 'Pendiente',
			'tipo'					=> 'ContraOferta',
			'usuario_creacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_creacion'	=> date('Y-m-d H:i:s'),
			);


		$id = $this->Model_Servicio->insertar_oferta($arreglo);

		$data = (object)array(
			'id'				=> $id,
			'nombre_usuario'	=> $this->session->userdata('usuario'),
			'estatus'			=> $arreglo['estatus'],
			'tipo'				=> $arreglo['tipo']
			);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Oferta enviada exitosamente',
			'data'		=> $data
			);

		echo json_encode($array_response);
	}

	public function autorizar_ofertas(){

		$registro = json_decode(file_get_contents('php://input'),true);
		$registro = (object)$registro;

		foreach ($registro->ofertas['ofertas'] as $oferta) {
			$array = array (
				'estatus'					=> 'Autorizada',
				'usuario_modificacion'		=> $this->session->userdata('usuario_id'),
				'fecha_hora_modificacion'	=> date('Y-m-d H:i:s'),
				);
			$this->Model_Servicio->actualizar_oferta( $oferta['oferta_k'] , $array );
			
		}

		$array_response = array(
				'status'	=> 'success',
				'message'   => 'Ofertas actualizadas exitosamente',
				);

		echo json_encode($array_response);

	}

	function insertar_evaluacion(){
		$registro = json_decode(file_get_contents('php://input'),true);
		$arreglo = array(
			'cliente_k'				=> $registro['cliente_k'],
			'usuario_k'				=> $this->session->userdata('usuario_id'),
			'razon'					=> $registro['razon'],
			'comentarios'			=> $registro['comentarios'],
			'tabla_propietario'		=> $registro['tabla_propietario'],
			'usuario_creacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_creacion'	=> date('Y-m-d H:i:s'),
			);


		$id = $this->Model_Servicio->insertar_evaluacion($arreglo);
		$array_update = array(
			'activo'					=> 0,
			'usuario_eliminacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_eliminacion'	=> date('Y-m-d H:i:s')
			);

		$this->Model_Cliente->update($array_update, $registro['cliente_k']);
		$array_response = array(
			'status'	=> 'success',
			'message'   => 'Evaluación enviada exitosamente',
			);
		echo json_encode($array_response);


	}

	function validarcurp( $curp ){

		$validacion = $this->clientelib->validar_curp( $curp );

		return $validacion;

	}

	public function propuestas_casa( $casa_k , $cliente_k ){

		$data = $this->Model_Servicio->propuestas_casa( $casa_k , $cliente_k );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);

	}

	public function autorizar_propuesta( $propuesta_k ){

		$array = array (
			'estatus'					=> 'Autorizada',
			'usuario_modificacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_modificacion'	=> date('Y-m-d H:i:s'),
			);
		$this->Model_Servicio->actualizar_propuesta( $propuesta_k , $array );
		$array_response = array(
				'status'	=> 'success',
				'message'   => 'Ofertas actualizadas exitosamente',
				);

		echo json_encode($array_response);
	}

	public function rechazar_propuesta( $propuesta_k ){

		$array = array (
			'estatus'					=> 'Rechazada',
			'usuario_modificacion'		=> $this->session->userdata('usuario_id'),
			'fecha_hora_modificacion'	=> date('Y-m-d H:i:s'),
			);
		$this->Model_Servicio->actualizar_propuesta( $propuesta_k , $array );
		$array_response = array(
				'status'	=> 'success',
				'message'   => 'Ofertas actualizadas exitosamente',
				);

		echo json_encode($array_response);
	}

	public function insert_servicio_venta() {
		$venta 							= $this->input->post();

		$venta['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$venta['usuario_creacion'] 		= $this->session->userdata('usuario_id');
		$this->Model_Servicio->insert_servicio_venta($venta);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode( $this->Model_Servicio->servicio_venta() ) . '}';
			}
		}
	}

	public function insert_propuesta_temporal() {
		$registro = array();
		$registro['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_creacion']	 	= $this->session->userdata('usuario_id');
		$id = $this->Model_Servicio->insert_propuesta_temporal($registro);


		print $id;
	}

	public function insertar_pago_propuesta_tmp() {

		$registro 						= $this->input->post();

		$this->Model_Servicio->insertar_pago_propuesta_tmp($registro);

		print 1;
	}

}
