<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class Menu_PerfilLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería

		$this->CI->load->model('Model_Menu_Perfil');
    }

    public function my_validation($registro) {
        $this->CI->db->where('menu_id', $registro['menu_id']);
        $this->CI->db->where('perfil_id', $registro['perfil_id']);
        $query = $this->CI->db->get('menu_perfil');
        if ($query->num_rows() > 0 AND (!isset($registro['id']) OR ($registro['id'] != $query->row('id')))) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    public function dar_acceso($perfil_id, $menu_id) {
        $registro = array();
        $registro['menu_id'] = $menu_id;
        $registro['perfil_id'] = $perfil_id;
        $registro['created'] = date('Y/m/d H:i');
        $registro['updated'] = date('Y/m/d H:i');
        $this->CI->Model_Menu_Perfil->insert($registro);
    }

    public function quitar_acceso($perfil_id, $menu_id) {
        $this->CI->db->where('perfil_id', $perfil_id);
        $this->CI->db->where('menu_id', $menu_id);
        $this->CI->db->delete('menu_perfil');
    }

    public function findByMenuAndPerfil($menu_id, $perfil_id) {
        $this->CI->db->where('menu_id', $menu_id);
        $this->CI->db->where('perfil_id', $perfil_id);
        return $this->CI->db->get('menu_perfil')->row();
    }

}
