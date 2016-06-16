<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Saneamiento extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all_concepts( $id ) {
        $this->db->select(' b.saneamiento_concepto_k, 
                            a.saneamiento_k, 
                            b.concepto, 
                            b.descripcion, 
                            b.monto, 
                            case 
                                when b.evidencia = "" then "No Cargada" 
                                else "Cargada"
                            end as evidencia_estatus, 
                            b.evidencia,
                            b.estatus', false);
        $this->db->from('casa_saneamiento a');
        $this->db->join('casa_saneamiento_concepto b', 'a.saneamiento_k = b.saneamiento_k');
        $this->db->where('a.casa_k', $id );
        $this->db->where('b.activo', 1 );
        $this->db->where('a.activo', 1 );
        $query = $this->db->get();
        return $query->result();
    }

    function saneamiento_by_casa( $id ) {
        $this->db->select('*');
        $this->db->from('casa a');
        $this->db->join('casa_saneamiento b', 'a.casa_k = b.casa_k');
        $this->db->where('a.casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function saneamiento_by_id( $id ) {
        $this->db->select('*');
        $this->db->from('casa a');
        $this->db->join('casa_saneamiento b', 'a.casa_k = b.casa_k');
        $this->db->where('b.saneamiento_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function insert_concept($registro) {
    	$this->db->set($registro);
		$this->db->insert('casa_saneamiento_concepto');
        return $this->db->insert_id();
    }

    function insert($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_saneamiento');
        return $this->db->insert_id();
    }

    function update_concept( $registro ) {
    	$this->db->set($registro);
		$this->db->where('saneamiento_concepto_k', $registro['saneamiento_concepto_k'] );
		$this->db->update('casa_saneamiento_concepto');
    }

    function update( $registro ) {
        $this->db->set($registro);
        $this->db->where('saneamiento_k', $registro['saneamiento_k'] );
        $this->db->update('casa_saneamiento');
    }

    function delete($id) {
    	$this->db->where('mejora_k', $id);
		$this->db->delete('mejora');
    }


}