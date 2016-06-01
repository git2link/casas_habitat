<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Producto extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all() {
        $this->db->select('* ');
        $this->db->from('products p');
        
        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('products')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('products');
        return $this->db->insert_id();
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('id', $registro['id']);
		$this->db->update('products');
    }

    function delete($id) {
    	$this->db->where('id', $id);
		$this->db->delete('products');
    }


}