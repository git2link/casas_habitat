<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_Perfil extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Menu_Perfil');
		$this->load->library('menu_PerfilLib');

        $this->form_validation->set_message('my_validation', 'Existe otro registro con esa combinación');
    }

	public function index() {
		$this->data['contenido'] = 'menu_perfil/index';
		$this->data['titulo'] = 'Accesos';
		$this->data['query'] = $this->Model_Menu_Perfil->all();
		$this->load->view('template', $this->data);
	}

	public function search() {
		$this->data['contenido'] = 'menu_perfil/index';
		$this->data['titulo'] = 'Accesos';
		$value = $this->input->post('buscar');
		$this->data['query'] = $this->Model_Menu_Perfil->allFiltered('perfil.name', $value);
		$this->load->view('template', $this->data);
	}

	public function my_validation() {
		return $this->menu_perfillib->my_validation($this->input->post());
	}

	public function create() {
		$this->data['contenido'] = 'menu_perfil/create';
		$this->data['titulo'] = 'Crear Acceso';
		$this->data['menus'] = $this->Model_Menu_Perfil->get_menus(); /* Lista de los Menu */
		$this->data['perfiles'] = $this->Model_Menu_Perfil->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $this->data);
	}

	public function insert() {
		$registro = $this->input->post();

        $this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        }
        else {
			$registro['created'] = date('Y/m/d H:i');
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Menu_Perfil->insert($registro);
			redirect('menu_perfil/index');
        }
	}

	public function edit($id) {
		// $id = $this->uri->segment(3);

		$this->data['contenido'] = 'menu_perfil/edit';
		$this->data['titulo'] = 'Actualizar Acceso';
		$this->data['registro'] = $this->Model_Menu_Perfil->find($id);
		$this->data['menus'] = $this->Model_Menu_Perfil->get_menus(); /* Lista de los Menu */
		$this->data['perfiles'] = $this->Model_Menu_Perfil->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $this->data);
	}

	public function update() {
		$registro = $this->input->post();

		$this->form_validation->set_rules('id', 'ID', 'callback_my_validation');
		if($this->form_validation->run() == FALSE) {
			$this->edit($registro['id']);
		}
		else {
			$registro['updated'] = date('Y/m/d H:i');
			$this->Model_Menu_Perfil->update($registro);
			redirect('menu_perfil/index');
		}
	}

	public function delete($id) {
		$this->Model_Menu_Perfil->delete($id);
		redirect('menu_perfil/index');
	}

}
