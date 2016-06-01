<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Configuracion extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function casa_paquete( ) {
        $this->db->select('a.tipo_casa_k, b.paquete_casa_k, a.descripcion as tipo, b.descripcion as paquete,
                            case when cliente=0 then "No" else "Si" end as cliente_requerido, 
                            case when b.activo=0 then "No" else "Si" end as activo_status, 
                            b.activo,
                            cliente', false);
        $this->db->from('cat_tipo_casa a');
        $this->db->join ('cat_tipo_casa_paquete b', 'a.tipo_casa_k = b.tipo_casa_k');
        $this->db->order_by('tipo, paquete');
        $query = $this->db->get();
        return $query->result();
    }

    function casa_paquete_byId( $id ) {
        $this->db->select('a.tipo_casa_k, b.paquete_casa_k, a.descripcion as tipo, b.descripcion as paquete,
                            case when cliente=0 then "No" else "Si" end as cliente_requerido, 
                            case when b.activo=0 then "No" else "Si" end as activo_status, 
                            b.activo,
                            cliente, total', false);
        $this->db->from('cat_tipo_casa a');
        $this->db->join ('cat_tipo_casa_paquete b', 'a.tipo_casa_k = b.tipo_casa_k');
        $this->db->join ('(SELECT tipo_casa_k, count(*) as total  
                            FROM cat_tipo_casa_paquete 
                            group by tipo_casa_k) c', 'c.tipo_casa_k = b.tipo_casa_k');
        $this->db->where('b.paquete_casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function casa_tipo_id_byDescripcion( $descripcion ) {
        $this->db->select('tipo_casa_k, activo');
        $this->db->from('cat_tipo_casa');
        $this->db->where('descripcion', trim($descripcion) );
        $query = $this->db->get();
        return $query->result();
    }

    function insert_casa_tipo( $registro ) {
        $this->db->set($registro);
        $this->db->insert('cat_tipo_casa');
        return $this->db->insert_id();
    }

    function update_casa_tipo( $registro ) {
        $this->db->set($registro);
        $this->db->where('tipo_casa_k', $registro['tipo_casa_k']);
        $this->db->update('cat_tipo_casa');
    }

    function update_casa_paquete( $registro ) {
        $this->db->set($registro);
        $this->db->where('paquete_casa_k', $registro['paquete_casa_k']);
        $this->db->update('cat_tipo_casa_paquete');
    }

    function insert_casa_tipo_paquete( $registro ) {
        $this->db->set($registro);
        $this->db->insert('cat_tipo_casa_paquete');
        return $this->db->insert_id();
    }
}
