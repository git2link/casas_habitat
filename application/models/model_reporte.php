<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Reporte extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function atencion_compras() {
        $sql = "SELECT c.*, u.nombre, u.apellido_paterno , u.apellido_materno,
                CONCAT(c.nombre,' ', c.apellido_paterno,' ',c.apellido_materno) nombre_cliente,
                CONCAT(u.nombre,' ', u.apellido_paterno,' ',u.apellido_materno) nombre_usuario
                FROM cliente c
                JOIN prospectos_compra com ON com.cliente_k = c.cliente_k
                JOIN usuario u ON u.id = c.usuario_atencion 
                ORDER BY c.fecha_proxima_atencion asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function atencion_ventas() {
        $sql = "SELECT c.*, u.nombre, u.apellido_paterno , u.apellido_materno,
                CONCAT(c.nombre,' ', c.apellido_paterno,' ',c.apellido_materno) nombre_cliente,
                CONCAT(u.nombre,' ', u.apellido_paterno,' ',u.apellido_materno) nombre_usuario
                FROM cliente c
                JOIN venta v ON v.cliente_k = c.cliente_k
                JOIN usuario u ON u.id = c.usuario_atencion 
                ORDER BY c.fecha_proxima_atencion asc";
        $query = $this->db->query($sql);
        return $query->result();
    }

    function venta_actividades() {
        $sql = "SELECT '      Prospecto cliente' as actividad, 
                case when isNull(d.clave_interna) then '' else d.clave_interna end as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_creacion,'%Y-%m-%d') as fecha
                FROM cliente a
                join usuario b on a.usuario_creacion = b.id
                left join casa_cliente c on a.cliente_k = c.cliente_k
                left join casa d on d.casa_k = c.casa_k

                union all

                SELECT '     Prospecto casa' as actividad , 
                a.clave_interna as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_creacion,'%Y-%m-%d') as fecha
                FROM casa a
                join usuario b on a.usuario_creacion = b.id

                union all

                SELECT '    Solicitud venta' as actividad,
                d.clave_interna as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_creacion,'%Y-%m-%d') as fecha
                FROM venta a
                join usuario b on a.usuario_creacion = b.id
                join casa_cliente c on a.casa_cliente_k = c.casa_cliente_k
                join casa d on c.casa_k = d.casa_k

                union all

                SELECT '   Solicitud mejora' as actividad,
                c.clave_interna as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_creacion,'%Y-%m-%d') as fecha 
                FROM mejora a
                join usuario b on a.usuario_creacion = b.id
                join casa c on a.casa_k = c.casa_k

                union all

                SELECT '  Agendo visita' as actividad, 
                c.clave_interna as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_creacion,'%Y-%m-%d') as fecha 
                FROM visitas_casa_venta a
                join usuario b on a.usuario_creacion = b.id
                join casa c on a.casa_k = c.casa_k

                union all

                SELECT 'Realizo visita' as actividad, 
                c.clave_interna as 'clave interna',
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                DATE_FORMAT(a.fecha_hora_modificacion,'%Y-%m-%d') as fecha 
                FROM visitas_casa_venta a
                join usuario b on a.usuario_k = b.id and a.realizada = 1
                join casa c on a.casa_k = c.casa_k";
        $query = $this->db->query($sql);
        return $query->result();
    }


}