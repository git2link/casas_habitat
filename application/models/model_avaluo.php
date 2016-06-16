<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Avaluo extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function all() {
        $this->db->select('a.*, c.clave_interna, uv.empresa, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('unidad_valuacion uv');
        $this->db->join('avaluo a' , 'a.unidad_valuacion_k = uv.unidad_valuacion_k');
        $this->db->join('casa c' , 'c.casa_k = a.casa_k');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('a.*, c.clave_interna, uv.empresa, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ');
        $this->db->from('unidad_valuacion uv');
        $this->db->join('avaluo a' , 'a.unidad_valuacion_k = uv.unidad_valuacion_k');
        $this->db->join('casa c' , 'c.casa_k = a.casa_k');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
        $this->db->where('avaluo_k', $id);
        return $this->db->get('avaluo')->row();
    }

    function insert($registro) {
        $this->db->set($registro);
        $this->db->insert('avaluo');
    }

    function update($registro) {
        $this->db->set($registro);
        $this->db->where('avaluo_k', $registro['avaluo_k']);
        $this->db->update('avaluo');
    }

    function delete($id) {
        $this->db->where('avaluo_k', $id);
        $this->db->delete('avaluo');
    }


}