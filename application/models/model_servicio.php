<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Servicio extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function insertcompra($registro) {
        $this->db->set($registro);
        $this->db->insert('compra');
    }

     function insert_servicio_venta($registro) {
        $this->db->set($registro);
        $this->db->insert('venta');
        return $this->db->insert_id();
    }


    function servicio_venta() {
        $this->db->select('c.casa_k,
            c.clave_interna, 
            concat(g.nombre, " ", g.apellido_paterno, " ", g.apellido_materno) as cliente,
            concat (c.calle_numero, " lote ", c.lote, " ", d.nombre, " ", e.nombre, " ", f.nombre, " c.p. ", c.codigo_postal) as direccion ,
            a.nivel_urgencia,
            DATE_FORMAT(a.fecha_hora_creacion, "%Y-%m-%d") as fecha_creacion,
            h.estatus,
            case 
                when isNull(checklist_k)        then 0
                when presupuesto_mejoras    = 2 then 0
                when revision_legal         = 2 then 0
                when contrato_casas_habitat = 2 then 0
                else 1 
            end as visita', false);
        $this->db->from('venta a');
        $this->db->join('casa_cliente b',   'a.casa_cliente_k = b.casa_cliente_k');
        $this->db->join('casa c',           'b.casa_k = c.casa_k');
        $this->db->join('cat_colonias d',   'c.colonia_k = d.colonia_k');
        $this->db->join('cat_municipios e', 'c.municipio_k = e.municipio_k');
        $this->db->join('cat_estados f',    'c.estado_k = f.estado_k');
        $this->db->join('cliente g',        'b.cliente_k = g.cliente_k');
        $this->db->join('venta_estatus h',  'a.estatus_k = h.estatus_k');
        $this->db->join('casa_checklist i', 'i.casa_k = c.casa_k', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    function insertventa($registro) {
        $this->db->set($registro);
        $this->db->insert('venta');
    }

    function insertmantenimiento($registro) {
        $this->db->set($registro);
        $this->db->insert('mantenimiento');
    }

    function insertconstruccion($registro) {
        $this->db->set($registro);
        $this->db->insert('construccion');
    }

    function insertremodelacion($registro) {
        $this->db->set($registro);
        $this->db->insert('remodelacion');
    }

    function casas_sin_interes( $cliente_k , $filtro ){

        $sql =" SELECT c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa 
                FROM casa c
                JOIN cat_tipo_casa ctc ON ctc.tipo_casa_k = c.tipo_casa_k
                JOIN cat_paquete_casa cpc ON cpc.paquete_casa_k = c.paquete_casa_k
                JOIN cat_estados ce ON ce.estado_k = c.estado_k
                JOIN cat_municipios cm ON cm.municipio_k = c.municipio_k
                JOIN cat_colonias cc ON cc.colonia_k = c.colonia_k
                WHERE c.estatus_venta = ".ESTATUS_CASA_INVENTARIO_VENTA." ";
                
        if(!empty($filtro['estado_k']))
            $sql .= " AND c.estado_k = ".$filtro['estado_k']." ";

        if(!empty($filtro['municipio_k']))
            $sql .= " AND c.municipio_k = ".$filtro['municipio_k']." ";

        if(!empty($filtro['tipo_vivienda_k']))
            $sql .= " AND c.tipo_vivienda_k = ".$filtro['tipo_vivienda_k']." ";

        if(!empty($filtro['rango_k'])){
            switch ($filtro['rango_k']) {
                case '1':
                $sql .= "AND precio_venta <= 200000 ";
                    break;

                case '2':
                $sql .= "AND precio_venta >= 200000 
                        AND precio_venta <= 500000 ";
                    break;
                case '3':
                $sql .= "AND precio_venta >= 500000 ";
                    break;
                
                default:
                    $sql .= " ";
                    break;
            }
        }

        if(!empty($filtro['recamaras'])){
            switch ($filtro['recamaras']) {
                case '1':
                case '2':
                case '3':
                case '4':
                $sql .= " AND c.recamaras = ".$filtro['recamaras']." ";
                    break;

                case '5':
                $sql .= " AND c.recamaras >= ".$filtro['recamaras']." ";
                    break;
                
                default:
                    $sql .= " ";
                    break;
            }
        }

        if(!empty($filtro['banios'])){
            switch ($filtro['banios']) {
                case '1':
                case '2':
                case '3':
                case '4':
                $sql .= " AND c.banios = ".$filtro['banios']." ";
                    break;

                case '5':
                $sql .= " AND c.banios >= ".$filtro['banios']." ";
                    break;
                
                default:
                    $sql .= " ";
                    break;
            }
        }

        if(!empty($filtro['estacionamientos'])){
            switch ($filtro['estacionamientos']) {
                case '1':
                case '2':
                case '3':
                case '4':
                $sql .= " AND c.estacionamiento = ".$filtro['estacionamientos']." ";
                    break;

                case '5':
                $sql .= " AND c.estacionamiento >= ".$filtro['estacionamientos']." ";
                    break;
                
                default:
                    $sql .= " ";
                    break;
            }
        }


        $sql .= "AND c.casa_k NOT IN ( SELECT casa_k 
                 FROM casas_cliente_interes 
                 WHERE cliente_k = ".$cliente_k."
                 AND activo = 1 )";

        $query = $this->db->query( $sql );
        return $query->result();
    }

    function casas_con_interes( $cliente_k ){

        $this->db->select('c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa, cci.cliente_k , cci.interes_k ');
        $this->db->from('casa c');
        $this->db->join('cat_tipo_casa ctc', 'ctc.tipo_casa_k = c.tipo_casa_k');
        $this->db->join('cat_paquete_casa cpc', 'cpc.paquete_casa_k = c.paquete_casa_k');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
        $this->db->join('casas_cliente_interes cci' , 'cci.casa_k = c.casa_k');
        $this->db->where('cci.cliente_k' , $cliente_k );
        $this->db->where('cci.activo', 1 );
        $this->db->where('estatus_venta' , ESTATUS_CASA_INVENTARIO_VENTA);

        $query = $this->db->get();
        return $query->result();
    }

    function casas_en_venta( $cliente_k ){

        $this->db->select('c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , v.nivel_urgencia, v.cliente_k');
        $this->db->from('casa c');
        $this->db->join('venta v' , 'v.casa_k = c.casa_k');
        $this->db->join('cat_estados ce' , 'ce.estado_k = c.estado_k');
        $this->db->join('cat_municipios cm' , 'cm.municipio_k = c.municipio_k');
        $this->db->join('cat_colonias cc' , 'cc.colonia_k = c.colonia_k');
        $this->db->where('v.cliente_k' , $cliente_k );

        $query = $this->db->get();
        return $query->result();
    }

    function existe_interes( $cliente_k , $casa_k ){

        $where = array(
            'cliente_k' => $cliente_k,
            'casa_k'    => $casa_k
            );

        $this->db->select('*');
        $this->db->from('casas_cliente_interes');
        $this->db->where( $where );

        $data       = $this->db->get();
        return $data->row();

    }

    function agregar_interes( $registro ){
        $this->db->set($registro);
        $this->db->insert('casas_cliente_interes');
    }

    function insertpropuesta( $registro ){
        $this->db->set($registro);
        $this->db->insert('propuestas');
        return $this->db->insert_id();
    }

    function visitas_casa( $casa_k , $cliente_k ){
        
        $sql = " SELECT c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.  descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa, vcv.realizada, vcv.visita_k, vcv.fecha_visita ,
            CONCAT(c.codigo_postal,' ',c.calle_numero,' ',c.lote,' ',cc.nombre,' ',cm.nombre,' ',ce.nombre) as direccion,
            CONCAT(u.nombre,' ',u.apellido_paterno,' ',u.apellido_materno ) as nombre_usuario
                FROM casa c
                join visitas_casa_venta vcv ON vcv.casa_k = c.casa_k and vcv.cliente_k = ".$cliente_k."
                join usuario u ON vcv.usuario_k = u.id
                join cat_tipo_casa ctc ON ctc.tipo_casa_k = c.tipo_casa_k
                join cat_paquete_casa cpc ON cpc.paquete_casa_k = c.paquete_casa_k
                join cat_estados ce ON ce.estado_k = c.estado_k
                join cat_municipios cm ON cm.municipio_k = c.municipio_k
                join cat_colonias cc ON cc.colonia_k = c.colonia_k
                WHERE c.casa_k = ".$casa_k."
                ORDER BY vcv.fecha_hora_creacion ASC";


        $query = $this->db->query( $sql );
        return $query->result();

    }

    function actualizar_visita($arreglo , $visita_k ){
        $this->db->set($arreglo);
        $this->db->where('visita_k', $visita_k);
        $this->db->update('visitas_casa_venta');
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

    function insertar_visita($registro ){
        $this->db->set($registro);
        $this->db->insert('visitas_casa_venta');
        return $this->db->insert_id();
    }

    function ofertas_casa ( $casa_k , $cliente_k ){
        $sql = " SELECT c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.  descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa, ocv.oferta, ocv.estatus, ocv.tipo, ocv.fecha_hora_creacion as fecha_oferta,
            CONCAT(c.codigo_postal,' ',c.calle_numero,' ',c.lote,' ',cc.nombre,' ',cm.nombre,' ',ce.nombre) as direccion,
            CONCAT(u.nombre,' ',u.apellido_paterno,' ',u.apellido_materno ) as nombre_usuario
                FROM casa c
                join ofertas_casas_venta ocv ON ocv.casa_k = c.casa_k and ocv.cliente_k = ".$cliente_k."
                join usuario u ON ocv.usuario_k = u.id
                join cat_tipo_casa ctc ON ctc.tipo_casa_k = c.tipo_casa_k
                join cat_paquete_casa cpc ON cpc.paquete_casa_k = c.paquete_casa_k
                join cat_estados ce ON ce.estado_k = c.estado_k
                join cat_municipios cm ON cm.municipio_k = c.municipio_k
                join cat_colonias cc ON cc.colonia_k = c.colonia_k
                WHERE c.casa_k = ".$casa_k."
                ORDER BY ocv.fecha_hora_creacion ASC";


        $query = $this->db->query( $sql );
        return $query->result();

    }

    function insertar_oferta($registro ){
        $this->db->set($registro);
        $this->db->insert('ofertas_casas_venta');
        return $this->db->insert_id();
    }

    function ofertas_casas (){
        $sql = " SELECT c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia , ctc.  descripcion as descripcion_tipo_casa, cpc.descripcion as descripcion_paquete_casa, ocv.oferta, ocv.estatus, ocv.tipo, ocv.fecha_hora_creacion as fecha_oferta, ocv.oferta_k, ocv.cliente_k,
            CONCAT(c.codigo_postal,' ',c.calle_numero,' ',c.lote,' ',cc.nombre,' ',cm.nombre,' ',ce.nombre) as direccion,
            CONCAT(u.nombre,' ',u.apellido_paterno,' ',u.apellido_materno ) as nombre_usuario
                FROM casa c
                join ofertas_casas_venta ocv ON ocv.casa_k = c.casa_k
                join usuario u ON ocv.usuario_k = u.id
                join cat_tipo_casa ctc ON ctc.tipo_casa_k = c.tipo_casa_k
                join cat_paquete_casa cpc ON cpc.paquete_casa_k = c.paquete_casa_k
                join cat_estados ce ON ce.estado_k = c.estado_k
                join cat_municipios cm ON cm.municipio_k = c.municipio_k
                join cat_colonias cc ON cc.colonia_k = c.colonia_k
                WHERE ocv.estatus = 'Pendiente'
                AND ocv.tipo      = 'Oferta'
                GROUP BY ocv.casa_k , ocv.cliente_k
                ORDER BY ocv.fecha_hora_creacion DESC";

        $query = $this->db->query( $sql );
        return $query->result();

    }

    function actualizar_oferta( $oferta_k , $arreglo ){
        $this->db->set($arreglo);
        $this->db->where('oferta_k', $oferta_k);
        $this->db->update('ofertas_casas_venta');
    }

    function actualizar_interes( $interes_k , $array_update){
        $this->db->set($array_update);
        $this->db->where('interes_k', $interes_k);
        $this->db->update('casas_cliente_interes');
    }

    function insertar_evaluacion($registro ){
        $this->db->set($registro);
        $this->db->insert('evaluacion_servicios');
        return $this->db->insert_id();
    }

    function propuestas_casa ( $casa_k , $cliente_k ){
        $sql = " SELECT c.*, ce.nombre as estado , cm.nombre as municipio, cc.nombre as colonia ,
            CONCAT(c.codigo_postal,' ',c.calle_numero,' ',c.lote,' ',cc.nombre,' ',cm.nombre,' ',ce.nombre) as direccion,
            CONCAT(u.nombre,' ',u.apellido_paterno,' ',u.apellido_materno ) as nombre_usuario,
            p.pago_contado, p.precio_pactado , p.anticipo, p.mensualidades, p.monto_mensualidades, p.comercializacion, p.estatus, p.propuesta_k
                FROM casa c
                join propuestas p ON p.casa_k = c.casa_k 
                join usuario u ON p.usuario_creacion = u.id
                join cat_estados ce ON ce.estado_k = c.estado_k
                join cat_municipios cm ON cm.municipio_k = c.municipio_k
                join cat_colonias cc ON cc.colonia_k = c.colonia_k
                WHERE p.casa_k = ".$casa_k."
                AND   p.cliente_k = ".$cliente_k."
                ORDER BY p.fecha_hora_creacion ASC";


        $query = $this->db->query( $sql );
        return $query->result();

    }

    function prospecto_cliente_list (){
        $sql = 'SELECT a.cliente_k, 
                concat(a.nombre, " ", a.apellido_paterno, " ", a.apellido_materno) as cliente,
                a.estatus_cliente, 
                b.casa_cliente_k,
                c.clave_interna
                FROM cliente a
                    join casa_cliente b on a.cliente_k = b.cliente_k
                    join casa c on c.casa_k = b.casa_k
                WHERE c.estatus = "prospecto" 
                and b.casa_cliente_k not in(SELECT casa_cliente_k 
                                            FROM venta) 
                order by cliente';
        $query = $this->db->query( $sql );
        return $query->result();

    }

    function casa_cliente_prospecto_by_cliente($cliente_k) {
        $this->db->select('a.clave_interna, b.casa_cliente_k');
        $this->db->from('casa a');
        $this->db->join('casa_cliente b', ' a.casa_k = b.casa_k');
        $this->db->where('estatus_venta',  1);
        $this->db->where('b.cliente_k',  $cliente_k );
        $query = $this->db->get();
        return $query->result();
    }

    
    function actualizar_propuesta( $propuesta_k , $arreglo ){
        $this->db->set($arreglo);
        $this->db->where('propuesta_k', $propuesta_k);
        $this->db->update('propuestas');
    }

    function update_venta_by_casa($registro, $casa_k) {
        $this->db->set($registro);
        $this->db->where('b.casa_k', $casa_k);
        return $this->db->update('venta a
                                    join casa_cliente b on a.casa_cliente_k = b.casa_cliente_k');
    }

}