<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Casa extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function all( $estatus_casa = NULL ) {
        $this->db->select(' case when isNull(casa_cliente_k) then 
                                ctc.descripcion else concat(cli.nombre, " ", cli.apellido_paterno, " ", cli.apellido_materno) 
                            end as cliente, ccli.cliente_k,
                            c.*, ce.nombre as estado , 
                            cm.nombre as municipio, 
                            cc.nombre as colonia , 
                            ctc.descripcion as descripcion_tipo_casa, 
                            cpc.descripcion as descripcion_paquete_casa,
                            case 
                                when isNull(checklist_k)        then 0
                                when presupuesto_mejoras    = 2 then 0
                                when revision_legal         = 2 then 0
                                when contrato_casas_habitat = 2 then 0
                                else 1 
                            end as visita', false);
        $this->db->from('casa c');
        $this->db->join('cat_tipo_casa ctc', 'ctc.tipo_casa_k = c.tipo_casa_k');
        $this->db->join('cat_tipo_casa_paquete cpc', 'cpc.paquete_casa_k = c.paquete_casa_k', 'left');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
        $this->db->join('casa_cliente ccli' , 'c.casa_k = ccli.casa_k and ccli.activo = 1', 'left');
        $this->db->join('cliente cli' , 'ccli.cliente_k = cli.cliente_k', 'left');
        $this->db->join('casa_checklist i', 'i.casa_k = c.casa_k', 'left');
        if( $estatus_casa != NULL)
            $this->db->where( 'estatus_venta' , $estatus_casa );

        $query = $this->db->get();
        return $query->result();
    }

    function allFiltered($field, $value) {
        $this->db->select('c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa ');
        $this->db->from('casa c');
        $this->db->join('cat_tipo_casa ctc', 'ctc.tipo_casa_k = c.tipo_casa_k');
        $this->db->join('cat_tipo_casa_paquete cpc', 'cpc.paquete_casa_k = c.paquete_casa_k');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
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
        return $this->db->insert_id();
    }

    function insertGaleria($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_galeria');
        return $this->db->insert_id();
    }

    function update($registro) {
    	$this->db->set($registro);
		$this->db->where('casa_k', $registro['casa_k']);
		$this->db->update('casa');
    }

    function update_casa_cliente($registro) {
        $this->db->set($registro);
        $this->db->where('casa_k', $registro['casa_k']);
        $this->db->update('casa_cliente');
    }

    function casa_cliente_byId($id) {
        $this->db->select('*');
        $this->db->from('casa_cliente');
        $this->db->where('casa_k',$id);
        $query = $this->db->get();
        return $query->result();
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
            $lista[$registro->id] = $registro->nombre;
        }
        return $lista;
    }

    function get_llaves() {
        $lista = array();
        $lista[0] = 'No';
        $lista[1] = 'Si';
        return $lista;
    }

    function insertmejora($registro) {
        $this->db->set($registro);
        $this->db->insert('mejora');
    }

    function insertcasa_cliente($registro) {
        $this->db->set($registro);
        $this->db->insert('casa_cliente');
        return $this->db->insert_id();
    }

    function getPaqueteById( $paquete_casa_k ){

        $this->db->select('*');
        $this->db->from('cat_tipo_casa_paquete');
        $this->db->where('paquete_casa_k' , $paquete_casa_k );

        $data = $this->db->get();
        
        return $data->row();

    }

    function getTipoPaquete(){

        $this->db->select('b.paquete_casa_k, b.tipo_casa_k, a.descripcion as tipo, b.descripcion as paquete, cliente');
        $this->db->from('cat_tipo_casa a');
        $this->db->join('cat_tipo_casa_paquete b', 'a.tipo_casa_k = b.tipo_casa_k');
        $this->db->where('a.activo' , 1 );
        $this->db->where('b.activo' , 1 );
        $this->db->order_by("tipo, paquete");

        $query = $this->db->get();
        return $query->result();

    }

    function obtenerAutoIncrementalMA( $tipo_casa_k ){

        $sql = "SELECT IF( max(autoincremental_tipo) IS NULL , 1 , max(autoincremental_tipo)+1 ) as autoincremental 
                FROM casa
                WHERE tipo_casa_k = ".$tipo_casa_k." ";

        $data = $this->db->query( $sql );
        
        return $data->row();

    }

    function obtenerAutoIncrementalVive( $tipo_casa_k , $municipio_k ){

        $sql = "SELECT IF( max(autoincremental_tipo) IS NULL , 1 , max(autoincremental_tipo)+1 ) as autoincremental 
                FROM casa c
                JOIN cat_municipios m ON m.municipio_k = c.municipio_k 
                WHERE tipo_casa_k = ".$tipo_casa_k." 
                AND c.municipio_k = ".$municipio_k." ";

        $data = $this->db->query( $sql );
        
        return $data->row();

    }

    /*function getImagenes( $casa_k ){
        $this->db->select('*');
        $this->db->from('imagenes_casas');
        $this->db->where('casa_k', $casa_k );

        $data = $this->db->get();

        return $data->result();
    }*/

    function getImagenes_by_visita( $visita_k ){
        $this->db->select('a.*');
        $this->db->from('casa_galeria a');
        $this->db->join('visitas_casa_venta b', 'a.casa_k = b.casa_k');
        $this->db->where('visita_k', $visita_k );
        $this->db->where('a.activo', 1 );

        $data = $this->db->get();

        return $data->result_array();
    }

    function updategaleria($registro, $id) {
        $this->db->set($registro);
        $this->db->where('galeria_k', $id);
        return $this->db->update('casa_galeria');
    }

    function actualizarEstatusVenta( $casa_k , $estatus_venta ){

        $this->db->where('casa_k' , $casa_k);
        $this->db->update('casa' , array( "estatus_venta" => $estatus_venta ) );
        return true;

    }


    function getMejorasCasa( $id ){

        $this->db->select('*');
        $this->db->from('mejora');
        $this->db->where('casa_k', $id );

        $data = $this->db->get();

        return $data->result();
        
    }

    function employees_availabe(){
        $sql = 'SELECT id, 
                    concat(nombre, " ", apellido_paterno, " ", apellido_materno) as employee 
                FROM usuario 
                WHERE activo= 1
                order by employee';
        $query = $this->db->query( $sql );
        return $query->result();
    }

}
