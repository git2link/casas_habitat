<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->library('usuarioLib');
		$this->load->model('Model_Noticias');
		$this->load->model('Model_Usuario');
		$this->form_validation->set_message('required', 'Debe ingresar un valor para %s');
		$this->form_validation->set_message('loginok', 'Usuario o contraseña incorrectos');
		$this->form_validation->set_message('matches', '%s no coincide con %s');
		$this->form_validation->set_message('cambiook', 'No se puede realizar el cambio de contraseña');
	}

	public function index() {
		$data['contenido'] 		= 'home/index';
		$data['titulo'] 		= '';
		$data['news'] 			= $this->Model_Noticias->news();
		$this->load->view('template_v3', $data);
	}

	public function get_news() {
		extract($_POST);
		$arrquery	= $this->Model_Noticias->news($start, $limit);
		print json_encode($arrquery);

	}

	public function acerca_de() {
		$data['contenido'] = 'home/acerca_de';
		$data['titulo'] = 'Acerca De';
		$this->load->view('template_v3', $data);
	}

	public function acceso_denegado() {
		$data['contenido'] = 'home/acceso_denegado';
		$data['titulo'] = 'Denegado';
		$this->load->view('template_v3', $data);
	}

	public function ingreso() {
		$data['contenido'] = 'home/ingreso';
		$data['titulo'] = 'Ingreso';
		$this->load->view('template_login', $data);
	}

	public function ingresar() {
		$this->form_validation->set_rules('login', 'Usuario', 'required|callback_loginok');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->ingreso();
		}
		else {

			$arrQuery 		= $this->Model_Usuario->usuario_foto_by_usuario( $this->session->userdata('usuario_id') );
			if ( count($arrQuery)>0 ) {
				$_SESSION["photo"]	= $arrQuery[0]->foto;
			}else{
				$_SESSION["photo"]	= '';
			}
			
			redirect('home/index');

		}
	}

	public function loginok() {
		$login = $this->input->post('login');
		$password = $this->input->post('password');
		return $this->usuariolib->login($login, md5($password));
	}

	public function salir() {
		$this->session->sess_destroy();
		redirect('home/ingreso');
	}

	public function cambio_clave() {
		$data['contenido'] = 'home/cambio_clave';
		$data['titulo'] = 'Cambiar Contraseña';
		$this->load->view('template', $data);
	}

	public function cambiar_clave() {
		$this->form_validation->set_rules('clave_act', 'Contraseña Actual', 'required|callback_cambiook');
		$this->form_validation->set_rules('clave_new', 'Contraseña Nueva', 'required|matches[clave_rep]');
		$this->form_validation->set_rules('clave_rep', 'Repita Nueva', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->cambio_clave();
		}
		else {
			redirect('home/index');
		}
	}

	public function cambiook() {
		$act = $this->input->post('clave_act');
		$new = $this->input->post('clave_new');
		return $this->usuariolib->cambiarPWD(md5($act), md5($new));
	}

}
