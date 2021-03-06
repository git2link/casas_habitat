<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Usuario');
		$this->load->library('usuarioLib');
		$this->load->library('functions');
		$this->load->model('Model_Catalogos');

		$this->form_validation->set_message('required', 'Debe ingresar campo %s');
        $this->form_validation->set_message('valid_email', 'Campo %s no es un eMail valido');
        $this->form_validation->set_message('my_validation', 'Existe otro registro con el mismo nombre');
    }

	public function index() {
		$data['contenido'] 	= 'usuario/index';
		$data['modal'] 		= 'usuario/usuario_modal';
		$data['titulo'] 	= 'Usuarios';
		$data['puestos'] 	= $this->Model_Catalogos->allPuestos();
		$data['sucursales'] = $this->Model_Catalogos->allSucursales();
		$data['perfil'] 	= $this->Model_Usuario->get_perfil_list();
		$data['js_plugins']  = "
			<script type='text/javascript' src=".base_url('../js/webcamjs/webcam.js')."></script>";
		$data['js'] 					= "
			<script type='text/javascript' src=".base_url('../js/app/direccion_2.js')."></script>";

		$this->load->view('template_v3', $data);
		
	}


	public function set_picture(){
		$usuario_foto = $this->input->post();
		$arrQuery = $this->Model_Usuario->usuario_foto_exist($usuario_foto['usuario_k']);
		if (count($arrQuery)>0) {
			$usuario_foto['usuario_foto_k'] = $arrQuery[0]->usuario_foto_k;
			$this->Model_Usuario->update_usuario_foto($usuario_foto);
		}else{
			$this->Model_Usuario->insert_usuario_foto($usuario_foto);
		}
		print 1;
	}

	public function set_image_size(){
		if (isset($_FILES)) {
			$this->functions->resizeImage($_FILES);
			print 1;
		}
		
	}

	public function search() {
		$data['contenido'] = 'usuario/index';
		$data['titulo'] = 'Usuarios';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Usuario->allFiltered('usuario.name', $value);
		$this->load->view('template_v3', $data );
	}

	public function my_validation() {
		return $this->usuariolib->my_validation($this->input->post());
	}

	public function create() {
		$data['contenido'] 	= 'usuario/create';
		$data['titulo'] 	= 'Crear Usuario';
		$data['perfiles'] 	= $this->Model_Usuario->get_perfiles(); /* Lista de los Perfiles */
		$data['js']			= "<script src=".base_url('../js/app/direccion.js')."></script>
							<script type='text/javascript' src=".base_url('../js/angular/angular.min.js')."></script>
							<script src=".base_url('../js/angular/ui-bootstrap-tpls-0.9.0.js')."></script>
							<script type='text/javascript' src=".base_url('../js/app/codigo_postal.js')."></script>";
		$this->load->view('template_v3', $data );
	}

	public function insert() {
		$registro = $this->input->post();
		/*$this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('login', 'Login', 'required|callback_my_validation');
        $this->form_validation->set_rules('email', 'eMail', 'required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            //$this->create();
        }
        else {*/
        	$registro['usuario_creacion']		= $this->session->userdata('usuario_id');
			$registro['password'] 				= md5($registro['password']);
			$registro['fecha_hora_creacion'] 	= date('Y-m-d H:i:s');
			$this->Model_Usuario->insert($registro);
			print 1;
        //}
	}

				

	public function edit($id) {

		$data['contenido'] 	= 'usuario/edit';
		$data['titulo'] 	= 'Actualizar Usuario';
		$data['registro'] 	= $this->Model_Usuario->find($id);
		$data['perfiles'] 	= $this->Model_Usuario->get_perfiles(); /* Lista de los Perfiles */
		$data['estado']		= $this->Model_Catalogos->getEstado   ( $data['registro']->estado_k );
		$data['municipio']	= $this->Model_Catalogos->getMunicipio( $data['registro']->municipio_k );
		$data['colonias']	= $this->Model_Catalogos->getColonias ( $data['registro']->codigo_postal );
		$data['usuario_k']	= $id;

		$data['js']			= "<script src=".base_url('../js/app/direccion.js')."></script>
				<script src=".base_url('../js/plugins/fileupload/bootstrap-fileupload.js')."></script>
				<script src=".base_url('../js/plugins/magnific/jquery.magnific-popup.min.js')."></script>

				<script src=".base_url('../js/jquery-upload/vendor/jquery.ui.widget.js')."></script>
				<script src='//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js'></script>
				<script src='//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js'></script>
				<script src='//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js'></script>

				<script src='//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js'></script>
				<script src=".base_url('../js/jquery-upload/jquery.iframe-transport.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-process.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-image.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-audio.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-video.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-validate.js')."></script>
				<script src=".base_url('../js/jquery-upload/jquery.fileupload-ui.js')."></script>
				<script src=".base_url('../js/jquery-upload/usuariosmain.js')."></script>
		";
		$this->load->view('template_v3', $data );
	}

	public function update() {
		$registro = $this->input->post();

		/*$this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('login', 'Login', 'required|callback_my_validation');
        $this->form_validation->set_rules('email', 'Correo Electrónico', 'required|valid_email');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {*/
			$registro['password'] 				 	= md5($registro['password']);
			$registro['usuario_modificacion']		= $this->session->userdata('usuario_id');
			$registro['fecha_hora_modificacion'] 	= date('Y-m-d H:i:s');
			$this->Model_Usuario->update($registro);
			print 1;
			//redirect('usuario/index');
		//}
	}

	public function disable() {
		$registro = $this->input->post();
		$registro['usuario_eliminacion'] 	= $this->session->userdata('usuario_id');
		$registro['fecha_hora_eliminacion'] = date('Y-m-d H:i:s');
		$registro['activo'] 				= 0;
		$this->Model_Usuario->update($registro);
		print 1;
	}

	public function delete($id) {
		$this->Model_Usuario->delete($id);
		redirect('usuario/index');
	}

	public function find_json( $id ){
		$data = $this->Model_Usuario->find_json( $id );

		$array_response = array( 
			'success' 	=> true, 
			'message'	=> 'Seleccionados de base de datos',
			'data'		=> $data
			);
		echo json_encode($array_response);
	}

	public function datatable() {
		if ($_POST) {
			extract($_POST);
			if ($table == 1) {
				print '{"data": ' . json_encode( $this->Model_Usuario->all() ) . '}';
			}
		}
	}
}
