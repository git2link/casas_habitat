<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->library('usuarioLib');
		$this->load->model('Model_Noticias');
		$this->form_validation->set_message('required', 'Debe ingresar un valor para %s');
		$this->form_validation->set_message('loginok', 'Usuario o contraseña incorrectos');
		$this->form_validation->set_message('matches', '%s no coincide con %s');
		$this->form_validation->set_message('cambiook', 'No se puede realizar el cambio de contraseña');
	}

	public function index() {
		$this->data['contenido'] 		= 'home/index';
		$this->data['titulo'] 		= '';
		$this->data['news'] 			= $this->Model_Noticias->news();
		$this->load->view('template_v3', $this->data);
	}

	public function get_news() {
		extract($_POST);
		$arrquery	= $this->Model_Noticias->news($start, $limit);
		print json_encode($arrquery);

	}

	public function acerca_de() {
		$this->data['contenido'] = 'home/acerca_de';
		$this->data['titulo'] = 'Acerca De';
		$this->load->view('template_v3', $this->data);
	}

	public function acceso_denegado() {
		$this->data['contenido'] = 'home/acceso_denegado';
		$this->data['titulo'] = 'Denegado';
		$this->load->view('template_v3', $this->data);
	}

	public function ingreso() {
		$this->data['contenido'] = 'home/ingreso';
		$this->data['titulo'] = 'Ingreso';
		$this->load->view('template_login', $this->data);
	}

	public function ingresar() {
		$this->form_validation->set_rules('login', 'Usuario', 'required|callback_loginok');
		$this->form_validation->set_rules('password', 'Contraseña', 'required');
		if($this->form_validation->run() == FALSE) {
			$this->ingreso();
		}
		else {
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
		$this->data['contenido'] = 'home/cambio_clave';
		$this->data['titulo'] = 'Cambiar Contraseña';
		$this->load->view('template', $this->data);
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
