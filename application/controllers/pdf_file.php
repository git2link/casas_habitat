<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdf_file extends MY_Controller {

	// Constructor de la clase
	function __construct() {
		parent::__construct();

		$this->load->model('Model_Casa');
		$this->load->model('Model_Catalogos');
		$this->load->model('Model_Cliente');
		$this->load->library('casaLib');
		$this->form_validation->set_message('required', 'Debe ingresar campo %s');

    }

	public function checklist($casa_k, $str_file) {

		if ($str_file != '') {
			$this->data['casa_k'] = $casa_k;
			$this->data['pdf'] = explode('%20', $str_file);
			//print_r($this->data['pdf']);
			$this->load->view('pdf/checklist', $this->data);
		}
	}


}
