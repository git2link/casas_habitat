<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Notaria extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('n.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('notaria n');
        $this->db->join('cat_estados ce' , 'ce.estado_k = n.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = n.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = n.colonia_k');
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('n.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('notaria n');
        $this->db->join('cat_estados ce' , 'ce.estado_k = n.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = n.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = n.colonia_k');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('notaria_k', $id);
		return $this->db->get('notaria')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('notaria');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('notaria_k', $registro['notaria_k']);
		$this->db->update('notaria');
    }

    function delete($id) {
    	$this->db->where('notaria_k', $id);
		$this->db->delete('notaria');
    }


}