<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Proveedor extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('p.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('proveedor p');
        $this->db->join('cat_estados ce' , 'ce.estado_k = p.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = p.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = p.colonia_k');
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('p.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('proveedor p');
        $this->db->join('cat_estados ce' , 'ce.estado_k = p.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = p.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = p.colonia_k');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('proveedor_k', $id);
		return $this->db->get('proveedor')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('proveedor');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('proveedor_k', $registro['proveedor_k']);
		$this->db->update('proveedor');
    }

    function delete($id) {
    	$this->db->where('proveedor_k', $id);
		$this->db->delete('proveedor');
    }


}