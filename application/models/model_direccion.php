<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Direccion extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function obtenerDirecciones($cp){
        $sql = "select ce.estado_k, ce.nombre as estado , cm.municipio_k, cm.nombre as municipio, cc.colonia_k ,       cc.nombre as colonia, cc.codigo_postal from cat_estados ce
            join cat_municipios cm using(estado_k)
            join cat_colonias cc using (municipio_k)
            where cc.codigo_postal = '".$cp."' ";
        $data = $this->db->query( $sql );

        return $data->result();
        
    }

    function obtenerMunicipios($estado_k){
        $sql = "select  cm.municipio_k, cm.nombre as municipio
         from cat_municipios cm 
        where cm.estado_k = '".$estado_k."' 
        order by cm.nombre ASC";
        $data = $this->db->query( $sql );

        return $data->result();
        
    }

    function all() {
        $this->db->select('c.*, ctc.descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa ');
        $this->db->from('casa c');
        $this->db->join('cat_tipo_casa ctc', 'ctc.tipo_casa_k = c.tipo_casa_k');
        $this->db->join('cat_paquete_casa cpc', 'cpc.paquete_casa_k = c.paquete_casa_k');
        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('c.*, ctc.descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa ');
        $this->db->from('casa c');
        $this->db->join('cat_tipo_casa ctc', 'ctc.tipo_casa_k = c.tipo_casa_k');
        $this->db->join('cat_paquete_casa cpc', 'cpc.paquete_casa_k = c.paquete_casa_k');
        $this->db->like($field, $value);

        $query = $this->db->get();
        return $query->result();
    }

    function find($id) {
    	$this->db->where('casa_k', $id);
		return $this->db->get('casa')->row();
    }

    function insert($registro) {
    	$this->db->set($registro);
		$this->db->insert('casa');
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('casa_k', $registro['casa_k']);
		$this->db->update('casa');
    }

    function delete($id) {
    	$this->db->where('casa_k', $id);
		$this->db->delete('casa');
    }

    function get_tipo_casa() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allTipoCasa();
        foreach ($registros as $registro) {
            $lista[$registro->tipo_casa_k] = $registro->descripcion;
        }
        return $lista;
    }

    function get_paquete_casa() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allPaqueteCasa();
        foreach ($registros as $registro) {
            $lista[$registro->paquete_casa_k] = $registro->descripcion;
        }
        return $lista;
    }

    function get_estatus_venta() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allEstatusVenta();
        foreach ($registros as $registro) {
            $lista[$registro->estatus_venta_k] = $registro->descripcion;
        }
        return $lista;
    }

    function get_estatus_invadida() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allEstatusInvadida();
        foreach ($registros as $registro) {
            $lista[$registro->estatus_invadida_k] = $registro->descripcion;
        }
        return $lista;
    }

    function get_tipo_vivienda() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allTipoVivienda();
        foreach ($registros as $registro) {
            $lista[$registro->tipo_vivienda_k] = $registro->descripcion;
        }
        return $lista;
    }

    function get_usuarios() {
        $lista = array();
        $this->load->model('Model_Catalogos');
        $registros = $this->Model_Catalogos->allUsuarios();
        foreach ($registros as $registro) {
            $lista[$registro->id] = $registro->name;
        }
        return $lista;
    }

    function get_llaves() {
        $lista = array();
        $lista[0] = 'No';
        $lista[1] = 'Si';
        return $lista;
    }

    function getMunicipioById( $municipio_k ){
        
        $this->db->select('*');
        $this->db->from('cat_municipios');
        $this->db->where('municipio_k' , $municipio_k );

        $data = $this->db->get();

        return $data->row();

    }

    function obtenerCodigosPostales(){

        $this->db->select('codigo_postal');
        $this->db->from('cat_colonias');
        $this->db->group_by('codigo_postal');

        $data = $this->db->get();

        return $data->result();

    }



}
