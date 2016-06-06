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

    function direcciones( $filtro ){
        $sql = "select ce.estado_k, ce.nombre as estado , cm.municipio_k, cm.nombre as municipio, cc.colonia_k ,       cc.nombre as colonia, cc.codigo_postal from cat_estados ce
            join cat_municipios cm using(estado_k)
            join cat_colonias cc using (municipio_k) 
            where ce.estado_k = ".$filtro['estado_k']." ";

        if( !empty($filtro['municipio_k']))
            $sql .= " and cm.municipio_k = ".$filtro['municipio_k']." ";
        if( !empty($filtro['colonia_k']))
            $sql .= " and cc.colonia_k = ".$filtro['colonia_k']." ";

        $data = $this->db->query( $sql );

        return $data->result();

    }

    function insert_colonia( $registro ) {
        $this->db->set($registro);
        $this->db->insert('cat_colonias');
        return $this->db->insert_id();
    }

    function update_colonia( $registro , $colonia_k){
        $this->db->set($registro);
        $this->db->where('colonia_k', $colonia_k);
        $this->db->update('cat_colonias');
    }

    function procedencia(){

        $sql = "select * from cat_procedencia
                where activo = 1";

        $data = $this->db->query( $sql );

        return $data->result();
    }

    function insert_procedencia( $registro ){

        $registro['activo'] = 1;
        $this->db->set($registro);
        $this->db->insert('cat_procedencia');
        return $this->db->insert_id();

    }

    function update_procedencia( $registro , $procedencia_k ){

        $this->db->set($registro);
        $this->db->where('procedencia_k', $procedencia_k);
        $this->db->update('cat_procedencia');

    }

    function estatus_venta(){

        $sql = "select * from cat_estatus_venta
                where activo = 1";

        $data = $this->db->query( $sql );

        return $data->result();
    }

    function insert_estatus_venta( $registro ){

        $registro['activo'] = 1;
        $this->db->set($registro);
        $this->db->insert('cat_estatus_venta');
        return $this->db->insert_id();

    }

    function update_estatus_venta( $registro , $estatus_venta_k ){

        $this->db->set($registro);
        $this->db->where('estatus_venta_k', $estatus_venta_k);
        $this->db->update('cat_estatus_venta');

    }

    function forma_pago(){

        $sql = "select * from cat_forma_pago
                where activo = 1";

        $data = $this->db->query( $sql );

        return $data->result();
    }

    function insert_forma_pago( $registro ){
        $registro['activo'] = 1;
        $this->db->set($registro);
        $this->db->insert('cat_forma_pago');
        return $this->db->insert_id();

    }

    function update_forma_pago( $registro , $forma_pago_k ){

        $this->db->set($registro);
        $this->db->where('forma_pago_k', $forma_pago_k);
        $this->db->update('cat_forma_pago');

    }

    function puestos(){

        $sql = "select * from cat_puestos
                where activo = 1";

        $data = $this->db->query( $sql );

        return $data->result();
    }

    function insert_puesto( $registro ){
        $registro['activo'] = 1;
        $this->db->set($registro);
        $this->db->insert('cat_puestos');
        return $this->db->insert_id();

    }

    function update_puesto( $registro , $puesto_k ){

        $this->db->set($registro);
        $this->db->where('puesto_k', $puesto_k);
        $this->db->update('cat_puestos');

    }

    function sucursales(){

        $sql = "select * from cat_sucursales
                where activo = 1";

        $data = $this->db->query( $sql );

        return $data->result();
    }

    function insert_sucursal( $registro ){
        $registro['activo'] = 1;
        $this->db->set($registro);
        $this->db->insert('cat_sucursales');
        return $this->db->insert_id();

    }

    function update_sucursal( $registro , $sucursal_k ){

        $this->db->set($registro);
        $this->db->where('sucursal_k', $sucursal_k);
        $this->db->update('cat_sucursales');

    }
    
}
