<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para casa
class ComunLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
		//$this->CI->load->model('Model_Casa');
    }

    function format_num( $campo ){

        $campo = str_replace(',','',$campo);

        return $campo;

    }

    

}
