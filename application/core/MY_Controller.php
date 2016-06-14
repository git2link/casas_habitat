<?php
if ( ! defined('BASEPATH')) exit ('No direct script access allowed');

class MY_Controller extends CI_Controller{

	public $data = array();

	function __construct(){
		parent::__construct();

		$this->load->model('Model_Usuario');

		$foto = $this->Model_Usuario->get_foto( $this->session->userdata('usuario_id') );

		$this->data['foto'] = $foto;
	}
}