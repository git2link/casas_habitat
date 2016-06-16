<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfil extends CI_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Perfil');
		$this->load->library('perfilLib');

		$this->form_validation->set_message('required', 'Debe ingresar un valor para %s');
		$this->form_validation->set_message('norep', 'Existe otro registro con el mismo nombre');
	}

	public function index() {
		$data['contenido'] = 'perfil/index';
		$data['titulo'] = 'Perfiles';
		$data['query'] = $this->Model_Perfil->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'perfil/index';
		$data['titulo'] = 'Perfiles';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Perfil->allFiltered('name', $value);
		$this->load->view('template', $data);
	}

	public function norep() {
		return $this->perfillib->norep($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'perfil/create';
		$data['titulo'] = 'Crear Perfil';
		$this->load->view('template', $data);
	}

	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('name', 'Nombre', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$registro['created'] = date('Y/m/d H:i');
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Perfil->insert($registro);
			redirect('perfil/index');
		}
	}

	public function edit($id) {
		// $id = $this->uri->segment(3);

		$data['contenido'] = 'perfil/edit';
		$data['titulo'] = 'Actualizar Perfil';
		$data['registro'] = $this->Model_Perfil->find($id);
		$this->load->view('template', $data);
	}

	public function update() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('name', 'Nombre', 'required|callback_norep');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Perfil->update($registro);
			redirect('perfil/index');
		}
	}

	public function delete($id) {
		$this->Model_Perfil->delete($id);
		redirect('perfil/index');
	}

}
