<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Noticias extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function news( $start = 0, $limit = 5 ) {
        $sql = "SELECT 'Registro un prospecto de casa' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_creacion)) / 60 as fecha,
                foto
                FROM casa a
                join usuario b on a.usuario_creacion = b.id
                left join usuario_foto c on c.usuario_k = b.id 

                union all 

                SELECT 'Registro un prospecto de cliente' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_creacion)) / 60 as fecha,
                foto
                FROM cliente a
                join usuario b on a.usuario_creacion = b.id
                left join usuario_foto c on c.usuario_k = b.id

                union all 

                SELECT 'Actualizo la documentación de una casa prospecto' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_modificacion)) / 60 as fecha,
                foto
                FROM casa_checklist a
                join usuario b on a.usuario_modificacion = b.id
                left join usuario_foto c on c.usuario_k = b.id

                union all

                SELECT 'Agendo una visita' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_creacion)) / 60 as fecha,
                foto
                FROM visitas_casa_venta a
                join usuario b on a.usuario_creacion = b.id
                left join usuario_foto c on c.usuario_k = b.id

                union all

                SELECT 'Realizo una visita' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_modificacion)) / 60 as fecha,
                foto
                FROM visitas_casa_venta a
                join usuario b on a.usuario_k = b.id
                left join usuario_foto c on c.usuario_k = b.id
                where realizada =  1

                union all 

                SELECT 'Solicitó un presupuesto de mejora' as actividad, 
                concat(b.nombre, ' ', b.apellido_materno, ' ', b.apellido_materno) COLLATE utf8_general_ci as empleado,
                TIME_TO_SEC(TIMEDIFF(now(), a.fecha_hora_creacion)) / 60 as fecha,
                foto
                FROM mejora a
                join usuario b on a.usuario_creacion = b.id
                left join usuario_foto c on c.usuario_k = b.id

                order by fecha
                limit " . $start. "," . $limit;
        $query = $this->db->query($sql);
        return $query->result();
    }


}