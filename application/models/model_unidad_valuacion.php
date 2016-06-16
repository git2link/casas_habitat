<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Unidad_Valuacion extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('uv.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('unidad_valuacion uv');
        $this->db->join('cat_estados ce' , 'ce.estado_k = uv.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = uv.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = uv.colonia_k');
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('uv.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('unidad_valuacion uv');
        $this->db->join('cat_estados ce' , 'ce.estado_k = uv.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = uv.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = uv.colonia_k');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('unidad_valuacion_k', $id);
		return $this->db->get('unidad_valuacion')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('unidad_valuacion');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('unidad_valuacion_k', $registro['unidad_valuacion_k']);
		$this->db->update('unidad_valuacion');
    }

    function delete($id) {
    	$this->db->where('unidad_valuacion_k', $id);
		$this->db->delete('unidad_valuacion');
    }


}