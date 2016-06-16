<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pdf_file extends CI_Controller {

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
			$data['casa_k'] = $casa_k;
			$data['pdf'] = explode('%20', $str_file);
			//print_r($data['pdf']);
			$this->load->view('pdf/checklist', $data);
		}
	}

	public function saneamiento($casa_k, $str_file) {

		if ($str_file != '') {
			$data['casa_k'] = $casa_k;
			$data['pdf'] = explode('%20', $str_file);
			$this->load->view('pdf/saneamiento', $data);
		}
	}


}
