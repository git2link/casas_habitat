<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Catalogos extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function allEstatusVenta() {
        $query = $this->db->get('cat_estatus_venta');
        return $query->result();
    }

    function allProcedencia() {
        $query = $this->db->get('cat_procedencia');
        return $query->result();
    }

    function allTipoCasa() {
        $query = $this->db->get('cat_tipo_casa');
        return $query->result();
    }

    function allPaqueteCasa() {
        $query = $this->db->get('cat_paquete_casa');
        return $query->result();
    }

    function allEstatusInvadida() {
        $query = $this->db->get('cat_estatus_invadida');
        return $query->result();
    }

    function allTipoVivienda() {
        $query = $this->db->get('cat_tipo_vivienda');
        return $query->result();
    }

    function allUsuarios() {
        $query = $this->db->get('usuario');
        return $query->result();
    }

    function getEstado( $estado_k ){
        $query = $this->db->get_where('cat_estados' , array( "estado_k" => $estado_k ));
        return $query->result();
    }

    function getMunicipio( $municipio_k ){
        $this->db->select('municipio_k , nombre');
        $this->db->from('cat_municipios');
        $this->db->where(array( "municipio_k" => $municipio_k ) );

        $query = $this->db->get();
        return $query->result();
    }

    function getColonias( $codigo_postal ){
        $this->db->select('*');
        $this->db->from('cat_colonias');
        $this->db->where(array( "codigo_postal" => $codigo_postal ) );
        $query = $this->db->get();
        return $query->result();
    }

    function getProveedores( $tipo_proveedor = NULL ){
        $this->db->select('*');
        $this->db->from('proveedor');
        if( $tipo_proveedor != NULL)
        $this->db->where('tipo_proveedor' , $tipo_proveedor );

        $query = $this->db->get();

        $data = $query->result();

        $pro = array();
        foreach($data as $proveedor ){
            $pro[$proveedor->proveedor_k] = $proveedor->empresa;
        }
        return $pro;        

    }

    function getCasas(){
        $this->db->select('*');
        $this->db->from('casa');
        $query = $this->db->get();

        $data = $query->result();

        $casas = array();
        foreach($data as $casa ){
            $casas[$casa->casa_k] = $casa->clave_interna;
        }
        return $casas;        

    }

    function getSiNo(){
        $lista = array();
        $lista[0] = 'No';
        $lista[1] = 'Si';
        return $lista;
    }

    function getTipoProveedores(){
        $lista = array();
        $lista[0]                           = 'SELECCIONAR ...';
        $lista[PROVEEDOR_NOTARIA]           = 'Notaria';
        $lista[PROVEEDOR_UNIDAD_VALUACION]  = 'Unidad de Valuación';
        $lista[PROVEEDOR_FACILITADORES]     = 'Habilitador';
        return $lista;
    }

    function getEstadoCivil(){
        $this->db->select('*');
        $this->db->from('cat_estado_civil');
        $query = $this->db->get();

        $data = $query->result();

        $estados_civiles = array();
        foreach($data as $estado_civil ){
            $estados_civiles[$estado_civil->estado_civil_k] = $estado_civil->descripcion;
        }
        return $estados_civiles;  
    }

    function get_forma_pago() {

        $lista = array();
        $query = $this->db->get('cat_forma_pago');

        $registros = $query->result();

        foreach ($registros as $registro) {
            $lista[$registro->forma_pago_k] = $registro->descripcion;
        }
        return $lista;
    }

    function getEstados(){
        $lista = array();
        $query = $this->db->get('cat_estados');
        $registros = $query->result();

        $lista[0] = '';
        foreach ($registros as $registro) {
            $lista[$registro->estado_k] = $registro->nombre;
        }
        return $lista;
    }

    function getSexos(){
        $lista = array();
        $lista[0]  = 'SELECCIONAR ...';
        $lista[1]  = 'Femenino';
        $lista[2]  = 'Masculino';

        return $lista;
    }

    function get_nivel_urgencia(){

        $lista = array();
        $lista[0]  = 'SELECCIONAR ...';
        $lista['Baja']  = 'Baja';
        $lista['Media'] = 'Media';
        $lista['Alta']  = 'Alta';

        return $lista;

    }

    function get_estados_json(){
        
        $this->db->select('estado_k , nombre');
        $this->db->from('cat_estados');
        $this->db->order_by("nombre", "desc");

        $query = $this->db->get();
        return $query->result();

    }

    function get_municipios_json( $estado_k ){

        $this->db->select('municipio_k , nombre');
        $this->db->from('cat_municipios');

        if(!empty($estado_k))
            $this->db->where('estado_k', $estado_k );
        $this->db->order_by("nombre", "desc"); 
        $query = $this->db->get();
        return $query->result(); 

    }

    function allServicios() {
        $query = $this->db->get('cat_servicios');
        return $query->result();
    }

    function allPuestos() {
        $query = $this->db->get('cat_puestos');
        return $query->result();
    }

    function allSucursales() {
        $query = $this->db->get('cat_sucursales');
        return $query->result();
    }

}
