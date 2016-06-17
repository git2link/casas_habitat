<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Cliente extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all( $registro=NULL ) {

        $where = array(
            'cli.activo'    => 1
            );

        if( !empty ($registro['estatus_cliente']))
            $where['estatus_cliente'] = $registro['estatus_cliente'];

        $this->db->select(' cli.*, 
                            ce.nombre as estado , 
                            cm.nombre as municipio, 
                            cc.nombre as colonia, 
                            concat(cli.nombre, " ", cli.apellido_paterno, " ", cli.apellido_materno) as name,
                            p.descripcion as procedencia', false);
        $this->db->from('cliente cli');
        $this->db->join('cat_estados ce' , 'ce.estado_k = cli.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = cli.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = cli.colonia_k');
        $this->db->join('cat_procedencia p' , 'p.procedencia_k = cli.procedencia_k');
        $this->db->where ( $where );
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('cli.*');
        $this->db->from('cliente cli');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('cliente_k', $id);
		return $this->db->get('cliente')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('cliente');

        return $this->db->insert_id();
    }

    function update($registro, $id ) {
        $this->db->set($registro);
        $this->db->where('cliente_k', $id);
        $this->db->update('cliente');
    }
    

    function delete($id) {
    	$this->db->where('cliente_k', $id);
		$this->db->delete('cliente');
    }

    function insertProspectoCompra($registro){
        $this->db->set($registro);
        $this->db->insert('prospectos_compra');
    }

    function validarCurp( $curp){
        $this->db->select('cli.*');
        $this->db->from('cliente cli');
        $this->db->where('curp', $curp);

        $query = $this->db->get();
        
        return $query->num_rows();
    }

}
