<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Mejora extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all( $id ) {
        $this->db->select('m.casa_k, m.mejora_k, m.descripcion, p.empresa, p.nombre, m.presupuesto, m.fecha_inicio_trabajos, m.fecha_entrega_trabajos');
        $this->db->from('mejora m');
        $this->db->join('proveedor p ', 'p.proveedor_k = m.proveedor_k');
        $this->db->where('m.casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }

    function ubicacion( $id ) {
        $this->db->select('a.clave_interna, 
                        concat(calle_numero, " lote ", a.lote, " ", d.nombre , " ", c.nombre, " ", b.nombre, " c.p. ", a.codigo_postal) as direccion,
                        calle_numero, 
                        a.lote, 
                        d.nombre as colonia, 
                        c.nombre as municipio, 
                        b.nombre as estado, 
                        a.codigo_postal',false);
        $this->db->from('casa a');
        $this->db->join('cat_estados b' ,   'b.estado_k     = a.estado_k');
        $this->db->join('cat_municipios c', 'c.municipio_k  = a.municipio_k');
        $this->db->join('cat_colonias d' ,  'd.colonia_k    = a.colonia_k');
        $this->db->where('a.casa_k', $id );
        $query = $this->db->get();
        return $query->result();
    }



    function find($id) {
        $this->db->where('id', $id);
        return $this->db->get('mejora')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('mejora');
        return $this->db->insert_id();
    }

    function update($registro, $id ) {
    	$this->db->set($registro);
		$this->db->where('mejora_k', $id);
		$this->db->update('mejora');
    }

    function delete($id) {
    	$this->db->where('mejora_k', $id);
		$this->db->delete('mejora');
    }


}