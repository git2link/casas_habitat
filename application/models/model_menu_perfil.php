<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Menu_Perfil extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('menu_perfil.* , menu.name as menu_name , perfil.name as perfil_name');
        $this->db->from('menu_perfil');
        $this->db->join('menu', 'menu_perfil.menu_id = menu.id', 'left');
        $this->db->join('perfil', 'menu_perfil.perfil_id = perfil.id', 'left');

        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('menu_perfil.* , menu.name as menu_name , perfil.name as perfil_name');
        $this->db->from('menu_perfil');
        $this->db->join('menu', 'menu_perfil.menu_id = menu.id', 'left');
        $this->db->join('perfil', 'menu_perfil.perfil_id = perfil.id', 'left');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('id', $id);
		return $this->db->get('menu_perfil')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('menu_perfil');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('menu_perfil');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('menu_perfil');
    }

    function get_menus() {
        $lista = array();
        $this->load->model('Model_Menu');
        $registros = $this->Model_Menu->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->name;
        }
        return $lista;
    }

    function get_perfiles() {
        $lista = array();
        $this->load->model('Model_Perfil');
        $registros = $this->Model_Perfil->all();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->name;
        }
        return $lista;
    }

}
