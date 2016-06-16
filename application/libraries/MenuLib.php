<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class MenuLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
    }

    public function my_validation($registro) {
        $ctr = ($registro['controlador'] != '');
        $acc = ($registro['accion'] != '');
        $url = ($registro['url'] != '');

        // No puede no ingresar Controlador, Accion, URL
        if(!$ctr AND !$acc AND !$url) {
            $this->CI->form_validation->set_message('my_validation', 'Debe ingresar Controlador y Acción o una URL');
            return FALSE;
        }

        // Si ingresó controlador, debe ingresar accion
        if($ctr AND !$acc) {
            $this->CI->form_validation->set_message('my_validation', 'Ingresó Controlador, falta la Acción');
            return FALSE;
        }

        // Si ingresó accion, debe ingresar controlador
        if(!$ctr AND $acc) {
            $this->CI->form_validation->set_message('my_validation', 'Ingresó Acción, falta en Controlador');
            return FALSE;
        }

        // Si ingresó URL, no puede haber ni Controlador ni Accion
        if($url AND ($ctr OR $acc)) {
            $this->CI->form_validation->set_message('my_validation', 'Si ingresa URL, no ingresar ni Controlador ni Acción');
            return FALSE;
        }

        return TRUE;
    }

    public function get_perfiles_asig_noasig($menu_id) {
        $lista_asig = array();
        $lista_noasig = array();

        $this->CI->load->model('Model_Perfil');
        $perfiles = $this->CI->Model_Perfil->all();

        foreach($perfiles as $perfil) {
            $this->CI->db->where('menu_id', $menu_id);
            $this->CI->db->where('perfil_id', $perfil->id);
            $query = $this->CI->db->get('menu_perfil');
            $existe = ($query->num_rows >0);

            if($existe) {
                $lista_asig[] = array($perfil->id, $perfil->name, $menu_id);
            }
            else {
                $lista_noasig[] = array($perfil->id, $perfil->name, $menu_id);
            }
        }

        return array($lista_noasig, $lista_asig);
    }

    public function findByControlador($controlador) {
        $this->CI->db->where('controlador', $controlador);
        return $this->CI->db->get('menu')->row();
    }

}
