<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Checklist extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function checklist( $casa_k ) {
        $this->db->select('*');
        $this->db->from('casa_checklist');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result_array();
    }

    function checklist_description( $casa_k ) {
        $this->db->select('a.*');
        $this->db->from('casa_checklist_description a');
        $this->db->join('casa_checklist b', 'a.checklist_k = b.checklist_k');
        $this->db->where('b.casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result_array();
    }

    function checklistfiles( $casa_k ) {
        $this->db->select('a.*');
        $this->db->from('casa_checklist_files a');
        $this->db->join('casa_checklist b', 'a.checklist_k = b.checklist_k');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result();
    }

    function checklist_by_column( $column, $casa_k ) {
        $this->db->select( $column );
        $this->db->from('casa_checklist');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result_array();
    }

    function checklistfiles_casa( $casa_k ) {
        $this->db->select('a.*');
        $this->db->from('casa_checklist_files_casa a');
        $this->db->join('casa_checklist b', 'a.checklist_k = b.checklist_k');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result();
    }
    function checklistfiles_habitat( $casa_k ) {
        $this->db->select('a.*');
        $this->db->from('casa_checklist_files_habitat a');
        $this->db->join('casa_checklist b', 'a.checklist_k = b.checklist_k');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result();
    }
    function checklistfiles_personales( $casa_k ) {
        $this->db->select('a.*');
        $this->db->from('casa_checklist_files_personales a');
        $this->db->join('casa_checklist b', 'a.checklist_k = b.checklist_k');
        $this->db->where('casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result();
    }

    /*function checklistfiles( $casa_k ) {
        $this->db->select('b.*, c.*, d.*', false);
        $this->db->from('casa_checklist a');
        $this->db->join('casa_checklist_file_part1 b', 'a.checklist_k = b.checklist_k', 'left');
        $this->db->join('casa_checklist_file_part2 c', 'a.checklist_k = c.checklist_k', 'left');
        $this->db->join('casa_checklist_file_part3 d', 'a.checklist_k = d.checklist_k', 'left');
        $this->db->where('a.casa_k', $casa_k );
        $query = $this->db->get();
        return $query->result();
    }*/

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('casa_checklist');
        return $this->db->insert_id();
    }

    function insertfiles_casa($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_checklist_files_casa');
        return $this->db->insert_id();
    }
    function insertfiles_habitat($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_checklist_files_habitat');
        return $this->db->insert_id();
    }
    function insertfiles_personales($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_checklist_files_personales');
        return $this->db->insert_id();
    }

    function insert_description($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_checklist_description');
        return $this->db->insert_id();
    }

    function insertfile($registro, $table) {
    	$this->db->set($registro);
		$this->db->insert($table);
        return $this->db->insert_id();
    }

    function update($registro, $id) {
        $this->db->set($registro);
		$this->db->where('casa_k', $id);
		return $this->db->update('casa_checklist');
    }

    function update_venta_by_casa($registro, $casa_k) {
        $this->db->set($registro);
        $this->db->where('b.casa_k', $casa_k);
        return $this->db->update('venta a
                                    join casa_cliente b on a.casa_cliente_k = b.casa_cliente_k');
    }


    function updatefiles_habitat($registro) {
        $this->db->set($registro);
        $this->db->where('checklist_k', $registro['checklist_k']);
        return $this->db->update('casa_checklist_files_habitat');
    }
    function updatefiles_casa($registro) {
        $this->db->set($registro);
        $this->db->where('checklist_k', $registro['checklist_k']);
        return $this->db->update('casa_checklist_files_casa');
    }
    function updatefiles_personales($registro) {
        $this->db->set($registro);
        $this->db->where('checklist_k', $registro['checklist_k']);
        return $this->db->update('casa_checklist_files_personales');
    }

    function updatefile($registro, $id, $table) {
        $this->db->set($registro);
		$this->db->where('checklist_k', $id);
		return $this->db->update($table);
    }

    function update_description($registro) {
        $this->db->set($registro);
        $this->db->where('checklist_k', $registro['checklist_k']);
        return $this->db->update('casa_checklist_description');
    }

    function fieldexists($field, $table) {
        return $this->db->field_exists($field, $table);
    }



    function exist( $id ) {
    	$this->db->select('checklist_k');
        $this->db->from('casa_checklist');
        $this->db->where('casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function exist_files( $id ) {
        $this->db->select('*');
        $this->db->from('casa_checklist a');
        $this->db->join('casa_checklist_files_habitat b', 'a.checklist_k = b.checklist_k');
        $this->db->join('casa_checklist_files_casa c', 'a.checklist_k = c.checklist_k');
        $this->db->join('casa_checklist_files_personales d', 'a.checklist_k = d.checklist_k');
        $this->db->where('a.casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function existfilebycasa( $id, $table ) {
    	$this->db->select('a.checklist_k, b.checklist_file_k');
        $this->db->from('casa_checklist a');
        $this->db->join($table . ' b', 'a.checklist_k = b.checklist_k', 'left');
        $this->db->where( 'a.casa_k' , $id );
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_checklist_adviser() {
        $this->db->select('id, 
        	perfil_id as perfil, 
        	concat(nombre, " ", apellido_paterno, " ", apellido_materno) as name', false);
        $this->db->from('usuario');
        $this->db->where('perfil_id', 2);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_checklist_user( $id ) {
        $this->db->select('id, 
        	perfil_id as perfil, 
        	concat(nombre, " ", apellido_paterno, " ", apellido_materno) as name', false);
        $this->db->from('usuario a');
        $this->db->join('casa_checklist b', 'a.id = b.usuario_modificacion');
        $this->db->where('casa_k', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_current_user( $id ) {
        $this->db->select('id, 
        	perfil_id as perfil, 
        	concat(nombre, " ", apellido_paterno, " ", apellido_materno) as name', false);
        $this->db->from('usuario');
        $this->db->where('id', $id );
        $query = $this->db->get();
        return $query->result_array();
    }

    function get_notaria_list( ) {
        $this->db->select('notaria_k, nombre');
        $this->db->from('notaria');
        $query = $this->db->get();
        return $query->result_array();
    }

}
