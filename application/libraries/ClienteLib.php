<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para la creación de un usuario
class ClienteLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
        $this->CI->load->model('Model_Cliente');
    }

    public function validar_curp($curp) {

        $existe = $this->CI->Model_Cliente->validarCurp( $curp );
        
        $existe = ( $existe == 0 ) ? TRUE : FALSE;

        return $existe;
    }
}