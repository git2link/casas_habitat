<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_Perfil extends CI_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Menu_Perfil');
		$this->load->library('menu_PerfilLib');

        $this->form_validation->set_message('my_validation', 'Existe otro registro con esa combinación');
    }

	public function index() {
		$data['contenido'] = 'menu_perfil/index';
		$data['titulo'] = 'Accesos';
		$data['query'] = $this->Model_Menu_Perfil->all();
		$this->load->view('template', $data);
	}

	public function search() {
		$data['contenido'] = 'menu_perfil/index';
		$data['titulo'] = 'Accesos';
		$value = $this->input->post('buscar');
		$data['query'] = $this->Model_Menu_Perfil->allFiltered('perfil.name', $value);
		$this->load->view('template', $data);
	}

	public function my_validation() {
		return $this->menu_perfillib->my_validation($this->input->post());
	}

	public function create() {
		$data['contenido'] = 'menu_perfil/create';
		$data['titulo'] = 'Crear Acceso';
		$data['menus'] = $this->Model_Menu_Perfil->get_menus(); /* Lista de los Menu */
		$data['perfiles'] = $this->Model_Menu_Perfil->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $data);
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

		$data['contenido'] = 'menu_perfil/edit';
		$data['titulo'] = 'Actualizar Acceso';
		$data['registro'] = $this->Model_Menu_Perfil->find($id);
		$data['menus'] = $this->Model_Menu_Perfil->get_menus(); /* Lista de los Menu */
		$data['perfiles'] = $this->Model_Menu_Perfil->get_perfiles(); /* Lista de los Perfiles */
		$this->load->view('template', $data);
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
