<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Actividades extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function visita_schedule() {
        $sql = 'SELECT a.visita_k as visita,
                    b.clave_interna as title,
                    fecha_visita as start,
                    realizada as estatus,
                    concat (b.calle_numero, " lote ", b.lote, " ", c.nombre, " ", d.nombre, " ", e.nombre, " c.p. ", b.codigo_postal) as direccion ,
                    concat(g.nombre, " ", g.apellido_paterno, " ", g.apellido_materno) as cliente,
                    b.casa_k,
                    concat(h.nombre, " ", h.apellido_paterno, " ", h.apellido_materno) as empleado
                FROM visitas_casa_venta a
                join casa b             on a.casa_k         = b.casa_k
                join cat_colonias c     on b.colonia_k      = c.colonia_k
                join cat_municipios d   on b.municipio_k    = d.municipio_k
                join cat_estados e      on b.estado_k       = e.estado_k
                join casa_cliente f     on b.casa_k         = f.casa_k 
                join cliente g          on g.cliente_k      = f.cliente_k
                join usuario h          on a.usuario_k      = h.id';
        $query = $this->db->query( $sql );
        return $query->result();
    }

    function casa_by_visita( $visita_k ) {
        $this->db->select('b.casa_k, clave_interna, a.realizada');
        $this->db->from('visitas_casa_venta a');
        $this->db->join('casa b' , 'a.casa_k = b.casa_k');
        $this->db->where( 'visita_k' , $visita_k );
        $query = $this->db->get();
        return $query->result();
    }

    function update_visita($registro) {
        $this->db->set($registro);
        $this->db->where('casa_k', $registro['casa_k']);
        return $this->db->update('visitas_casa_venta');
    }

    function update_visita_by_visita($registro) {
        $this->db->set($registro);
        $this->db->where('visita_k', $registro['visita_k']);
        return $this->db->update('visitas_casa_venta');
    }

}