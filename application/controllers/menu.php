<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller {

	// Constructor de Clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Menu');
		$this->load->library('menuLib');

		$this->form_validation->set_message('required', 'Debe ingresar un valor para %s');
		$this->form_validation->set_message('numeric', '%s debe ser un número');
		$this->form_validation->set_message('is_natural', '%s debe ser un número mayor a cero');
	}

	public function index() {
		$this->data['contenido'] = 'menu/index';
		$this->data['titulo'] = 'Menú';
		$this->data['query'] = $this->Model_Menu->all();
		$this->load->view('template', $this->data);
	}

	public function search() {
		$this->data['contenido'] = 'menu/index';
		$this->data['titulo'] = 'Menú';
		$value = $this->input->post('buscar');
		$this->data['query'] = $this->Model_Menu->allFiltered('name', $value);
		$this->load->view('template', $this->data);
	}

	public function my_validation() {
		return $this->menulib->my_validation($this->input->post());
	}

	public function create() {
		$this->data['contenido'] = 'menu/create';
		$this->data['titulo'] = 'Crear Menú';
		$this->load->view('template', $this->data);
	}

	public function insert() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('name', 'Nombre', 'required|callback_my_validation');
		$this->form_validation->set_rules('orden', 'Orden', 'numeric|is_natural');
		if($this->form_validation->run() == FALSE) {
			$this->create();
		}
		else {
			$registro['created'] = date('Y/m/d H:i');
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Menu->insert($registro);
			redirect('menu/index');
		}
	}

	public function edit($id) {
		$this->data['contenido'] = 'menu/edit';
		$this->data['titulo'] = 'Actualizar Menú';
		$this->data['registro'] = $this->Model_Menu->find($id);
		$this->load->view('template', $this->data);
	}

	public function update() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('name', 'Nombre', 'required|callback_my_validation');
		$this->form_validation->set_rules('orden', 'Orden', 'numeric|is_natural');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Menu->update($registro);
			redirect('menu/index');
		}
	}

	public function delete($id) {
		$this->Model_Menu->delete($id);
		redirect('menu/index');
	}

	public function menu_perfiles($menu_id) {
		$this->data['contenido'] = 'menu/menu_perfiles';
		$this->data['titulo'] = 'Accesos de '.$this->Model_Menu->find($menu_id)->name;

		// Cargar arreglos Izquierda y Derecha
		$perfiles = $this->menulib->get_perfiles_asig_noasig($menu_id);
		$this->data['query_izq'] = $perfiles[0];
		$this->data['query_der'] = $perfiles[1];

		$this->load->view('template', $this->data);
	}

	public function mp_noasig() {
		$perfil_id = $this->uri->segment(3);
		$menu_id = $this->uri->segment(4);

		$this->load->library('menu_PerfilLib');
		$this->menu_perfillib->quitar_acceso($perfil_id, $menu_id);
		redirect('menu/menu_perfiles/'.$menu_id);
	}

	public function mp_asig() {
		$perfil_id = $this->uri->segment(3);
		$menu_id = $this->uri->segment(4);

		$this->load->library('menu_PerfilLib');
		$this->menu_perfillib->dar_acceso($perfil_id, $menu_id);
		redirect('menu/menu_perfiles/'.$menu_id);
	}

}
