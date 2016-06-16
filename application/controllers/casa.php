<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Casa extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Casa');
		$this->load->model('Model_Catalogos');
		$this->load->model('Model_Cliente');
		$this->load->library('casaLib');
		$this->load->library('comunLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function index() {
		$data['contenido'] 	= 'casa/index';
		$data['modal'] 		= 'casa/casa_modal';
		$data['titulo'] 		= 'Casas';
		$data['tipo_paquete'] = $this->Model_Casa->getTipoPaquete();
		$data['cliente'] 		= $this->Model_Cliente->all();
		$data['employee'] 	= $this->Model_Casa->employees_availabe();
		$data['js']			= "<script src=".base_url('../js/loadmask/spin.min.js')."></script>
										<script src=".base_url('../js/loadmask/jquery.loadmask.spin.js')."></script>
		";
		/*$data['query'] 			= $this->Model_Casa->all( ESTATUS_CASA_PROSPECTO );*/
		$this->load->view('template_v3', $data);
	}

	public function search() {

		$data['contenido'] 	= 'casa/index';
		$data['titulo'] 	= 'Casas';
		$value 				= $this->input->post('buscar');
		$data['query'] 		= $this->Model_Casa->allFiltered('c.clave_interna', $value);
		$this->load->view('template_v3', $data);

	}

	function all(){
		$datos = $this->Model_Casa->all( ESTATUS_CASA_PROSPECTO );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $datos
			);
		echo json_encode($array_response);
	}

	public function my_validation() {

		//return $this->casalib->my_validation($this->input->post());

	}

	public function create() {
		$data['contenido'] 			= 'casa/create';
		$data['titulo'] 			= 'Crear Casa';
		$data['tipo_casa'] 			= $this->Model_Casa->get_tipo_casa(); /* Lista de los Tipos de Casa */
		$data['paquete_casa'] 		= $this->Model_Casa->get_paquete_casa(); /* Lista de los Paquetes de Casa */
		$data['estatus_venta'] 		= $this->Model_Casa->get_estatus_venta();
		$data['estatus_invadida'] 	= $this->Model_Casa->get_estatus_invadida();
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['usuarios'] 			= $this->Model_Casa->get_usuarios();
		$data['llaves'] 			= $this->Model_Casa->get_llaves();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>
												<script src=".base_url('../js/loadmask/spin.min.js')."></script>
												<script src=".base_url('../js/loadmask/jquery.loadmask.spin.js')."></script>
		";
		$this->load->view('template_v3', $data);
	}

	public function insert() {

		$registro 				= $this->input->post();
		$registro['costo'] 			= $this->comunlib->format_num( $registro['costo'] );
		$registro['precio_venta'] 	= $this->comunlib->format_num( $registro['precio_venta'] );
		$registro['apartado'] 		= $this->comunlib->format_num( $registro['apartado'] );
		

		$datos_adicionales = $this->casalib->generarClaveInterna( $registro );
		
		$registro = array_merge( $registro , $datos_adicionales );

        //$this->form_validation->set_rules('paquete_casa_k', 'Paquete', 'required');
        //$this->form_validation->set_rules('tipo_casa_k', 'Tipo', 'required');

        /*if ($this->form_validation->run() == FALSE) {

            $this->create();

        }else {*/
        $registro['usuario_creacion']		= $this->session->userdata('usuario_id');
		$registro['fecha_hora_creacion']	= date('Y-m-d H:i:s');
		$registro2['cliente_k']				= $registro['cliente_k'];
		unset($registro['cliente_k']);
		$registro2['casa_k']				= $this->Model_Casa->insert($registro);
		if (trim($registro2['cliente_k'])!='') {
			$this->Model_Casa->insertcasa_cliente($registro2);
		}
		print 1;
       // }
	}

	public function edit($id) {

		$data['contenido'] 	= 'casa/edit';
		$data['titulo'] 	= 'Actualizar Casa';
		$data['registro'] 	= $this->Model_Casa->find($id);
		$data['tipo_casa'] 			= $this->Model_Casa->get_tipo_casa(); /* Lista de los Tipos de Casa */
		$data['paquete_casa'] 		= $this->Model_Casa->get_paquete_casa(); /* Lista de los Paquetes de Casa */
		$data['estatus_venta'] 		= $this->Model_Casa->get_estatus_venta();
		$data['estatus_invadida'] 	= $this->Model_Casa->get_estatus_invadida();
		$data['tipo_vivienda'] 		= $this->Model_Casa->get_tipo_vivienda();
		$data['usuarios'] 			= $this->Model_Casa->get_usuarios();
		$data['llaves'] 			= $this->Model_Casa->get_llaves();
		$data['js']				    = "<script src=".base_url('../js/app/direccion.js')."></script>";
		$data['estado']				= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']			= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']			= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );

		$this->load->view('template_v3', $data);
		
	}

	public function update() {
		$registro = $this->input->post();

		$registro['costo'] 			= $this->comunlib->format_num( $registro['costo'] );
		$registro['precio_venta'] 	= $this->comunlib->format_num( $registro['precio_venta'] );
		$registro['apartado'] 		= $this->comunlib->format_num( $registro['apartado'] );
		
		$casa_cliente['cliente_k']	= $registro['cliente_k'];
		$casa_cliente['casa_k']		= $registro['casa_k'];
		unset($registro['cliente_k']);


        $this->form_validation->set_rules('paquete_casa_k', 'Paquete', 'required');
        $this->form_validation->set_rules('tipo_casa_k', 'Tipo', 'required');

		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['casa_k']);
		}else {
			$registro['fecha_hora_modificacion'] = date('Y-m-d H:i:s');
			$this->Model_Casa->update($registro);

			if ($casa_cliente['cliente_k'] == '') {
				$casa_cliente['activo'] = 0;
				$this->Model_Casa->update_casa_cliente( $casa_cliente );
			}else{
				$casa_cliente['activo'] = 1;
				$arrQuery = $this->Model_Casa->casa_cliente_byId($registro['casa_k']);

				if (count($arrQuery)>0) {
					$this->Model_Casa->update_casa_cliente( $casa_cliente );
				}else{
					
					$this->Model_Casa->insertcasa_cliente($casa_cliente);
				}

			}
			print 1;
		}
	}

	public function delete($id) {
		$this->Model_Casa->delete($id);
		redirect('casa/index');
	}

	public function createmejora( $id ) {
		$data['contenido'] 			= 'casa/createmejora';
		$data['titulo'] 			= 'Crear Mejora';
		$data['proveedores'] 		= $this->Model_Catalogos->getProveedores( PROVEEDOR_FACILITADORES );
		$data['query'] 			= $this->Model_Casa->getMejorasCasa( $id );
		$data['casa_k']				= $id;
		
		$data['js']				=   "<script src=".base_url('../js/app/mejoras.js')."></script>";

		$this->load->view('template_v3', $data);
	}

	public function insertmejora() {

		$registro = $this->input->post();
        $this->form_validation->set_rules('casa_k', 'Clave Casa', 'required');
        if ($this->form_validation->run() == FALSE) {

            $this->create();

        }
        else {

			$registro['fecha_hora_creacion'] = date('Y-m-d H:i:s');
			$this->Model_Casa->insertmejora($registro);
			redirect('casa/index');

        }
	}

	function galeria( $casa_k = null, $clave_interna = null ){
		if ($casa_k != null && $clave_interna != null) {
			$data['contenido'] 			= 'casa/galeria2';
			$data['modal']				= 'casa/galeria_modal';
			$data['titulo'] 			= 'Casas';
			$data['clave_interna']		= $clave_interna;
			$data['imagenes']			= $this->Model_Casa->getImagenes( $casa_k );
			//$data['proveedores'] 		= $this->Model_Catalogos->getProveedores( PROVEEDOR_FACILITADORES ); /* Lista de los Proveedores */
			$data['casa_k']				= $casa_k;
			$data['user_k']				= $user_k		= 		$this->session->userdata('usuario_id');
			
			$data['js_plugins']			= "
				<script src=".base_url('../js/fileinput/fileinput.min.js')."></script>
				<script src=".base_url('../js/fileinput/fileinput_locale_es.js')."></script>
				<script src=".base_url('../js/fileinput/jquery.media.js')."></script>
				<script src=".base_url('../js/viewer/viewer.js')."></script>
				<script src=".base_url('../js/app/common.js')."></script>";

			$data['css_plugins']		= "
				<link rel='stylesheet' href='".base_url('../css/fileinput/fileinput.min.css')."'>
				<link rel='stylesheet' href='".base_url('../css/viewer/viewer.css')."'>";

			
		}else{
			$data['contenido']			= 'home/acceso_denegado';
			$data['titulo'] 			= 'Denegado';
		}
		$this->load->view('template_v3', $data);

	}

	public function inventario_ventas() {
		$data['contenido'] = 'casa/inventario_ventas';
		$data['titulo'] = 'Casas';
		$data['query'] = $this->Model_Casa->all( ESTATUS_CASA_INVENTARIO_VENTA );
		$this->load->view('template_v3', $data);
	}

	function vender( $casa_k ){

		$this->Model_Casa->actualizarEstatusVenta( $casa_k , ESTATUS_CASA_VENDIDA );

		header('Location: '.base_url("casa/inventario_ventas"));
	}

	public function propuesta( $id ){
		$data['contenido'] 	= 'casa/propuesta';
		$data['casa_k']		= $id;
		$data['titulo'] 	= 'Propuesta';
		$this->load->view('template_v3', $data);

	}

	public function venta( $usuario_k ){
		$data['contenido'] 	= 'casa/venta';
		$data['casa_k']		= $usuario_k;
		$data['titulo'] 	= 'Casas en venta';
		$data['js']			= "<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/casa_venta/app.js')."></script>
		<script src=".base_url('../js/app/casa_venta/data.js')."></script>
		<script src=".base_url('../js/app/casa_venta/directives.js')."></script>
		<script src=".base_url('../js/app/casa_venta/casaVentaCtrl.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";
		$this->load->view('template_v3', $data);
	}

	public function ofertas_pendientes(){

		$data['contenido'] 	= 'casa/ofertas';
		$data['titulo'] 	= 'Ofertas para comprar Casas';
		$data['js']			= "<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ui-bootstrap-tpls-0.11.2.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-resource.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-route.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/angular-animate.min.js')."></script>


		<script src=".base_url('../js/app/casa/ofertas/app.js')."></script>
		<script src=".base_url('../js/app/casa/ofertas/data.js')."></script>
		<script src=".base_url('../js/app/casa/ofertas/directives.js')."></script>
		<script src=".base_url('../js/app/casa/ofertas/casaOfertasCtrl.js')."></script>
		<script src=".base_url('../js/angular/check-list-model.js')."></script>


		<script type='text/javascript' src=".base_url('../js/angular/underscore.min.js')."></script>
		<script type='text/javascript' src=".base_url('../js/angular/ie10-viewport-bug-workaround.js')."></script>";
		$this->load->view('template_v3', $data);

	}

	public function getLocation(){
		extract($_POST);
		$location = 'http://maps.googleapis.com/maps/api/geocode/json?latlng=' . $latitud . ',' . $longitud . '&sensor=true';
		$datos = file_get_contents($location);
		print $datos;

	}

	public function insertgaleria(){
		if (isset($_POST) && isset($_FILES)) {

			$user = $this->session->userdata('usuario_id');
			$type = substr($_FILES['file_upload']['type'], 6);
			$file_type = $_FILES['file_upload']['type'];
			$now  = date('Y-m-d H:i:s');

			$name = md5( $now . $user );
			$name = $name . '.' . $type;
			
			$target_dir = 	'server/casas/files/' . $_POST['casa_k'] . '/';

			if (!file_exists($target_dir)) {
			    mkdir($target_dir, 0777, true);
			}

			$target_file = $target_dir . basename( $name );
			move_uploaded_file($_FILES['file_upload']['tmp_name'], $target_file);


			/*header('Content-Type: ' . $file_type);

			list($width, $height) = getimagesize($target_file);
			$resize_width = 80;
			$resize_height = 70;

			$thumb = imagecreatetruecolor($resize_width, $resize_height);

			switch ($file_type) {
			    case 'image/jpeg':
			        $source = imagecreatefromjpeg($target_file);
			        break;
			    case 'image/png':
			        $source = imagecreatefrompng($target_file);
			        break;
			    case 'image/gif':
			        $source = imagecreatefromgif($target_file);
			        break;
			}
			

			imagecopyresized($thumb, $source, 0, 0, 0, 0, $resize_width, $resize_height, $width, $height);

			$destination = $target_dir . '/thumbnail/';

			if (!file_exists($destination)) {
			    mkdir($destination, 0777, true);
			}

			$destination = $destination . $name;

			
			
			switch ($file_type) {
			    case 'image/jpeg':
			        imagejpeg($thumb, $destination);
			        break;
			    case 'image/png':
			        imagepng($thumb, $destination);
			        break;
			    case 'image/gif':
			       	imagegif($thumb, $destination);
			        break;
			}


			imagedestroy($source);
			imagedestroy($thumb);*/

			$registro 								= $this->input->post();
			$registro['nombre'] 					= $name;
			$registro['fecha_hora_creacion'] 		= $now;
			$registro['fecha_hora_modificacion'] 	= $now;
			$registro['usuario_modificacion'] 		= $user;
			$registro['usuario_creacion'] 			= $user;

			$this->Model_Casa->insertGaleria($registro);

			print 1;

		}
	}


	public function str_encrypt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );
	}

	public function str_decrypt( $q ) {
	    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

	public function updategaleria() {
	    $registro 	= $this->input->post();
	    $id 		= $registro['galeria_k'];
	    $registro['fecha_hora_eliminacion'] 	= date('Y-m-d H:i:s');
		$registro['usuario_eliminacion'] 		= $this->session->userdata('usuario_id');
		print $this->Model_Casa->updategaleria($registro, $id);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode($this->Model_Casa->all( 1 )) . '}';
			}else{

			}
		}else{

		}
	}

	public function pagosdatatable() {
		if ($_POST) {
			extract($_POST);
				print '{"data": ' . json_encode($this->Model_Casa->pagos_propuesta_tmp( $propuesta_tmp_k )) . '}';
		}else{

		}
	}

}
