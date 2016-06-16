<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Notificaciones extends CI_Model {

    function __construct() {
        parent::__construct();
    }



    function agregarNotificacion($insert){

        $params = json_decode($insert['params']);

        if(isset($params->usuarios_por_notificar_string)){
            unset( $params->usuarios_por_notificar_string);
        }

        if(isset($params->tutores_por_inscribir)){
            unset( $params->tutores_por_inscribir);
        }

        $insert['params'] = json_encode( $params );

        $this->db->insert('notificaciones', $insert);
        return $this->db->insert_id();

    }

    function agregarNotificacionUsuario($insert){

        $params = json_decode($insert['params']);

        if(isset($params->usuarios_por_notificar_string)){
            unset( $params->usuarios_por_notificar_string);
        }

        if(isset($params->tutores_por_inscribir)){
            unset( $params->tutores_por_inscribir);
        }

        $insert['params'] = json_encode( $params );

        $this->db->insert('notificaciones_usuarios', $insert);

        return true;
    }


    
    function obtenerDesdeCatalogo($tipo_notificacion){
        $where = array (
            "valor"     => $tipo_notificacion,
            "activo"    => "1"
        );
        $this->db->select('*');
        $this->db->from('cat_notificaciones');
        $this->db->where($where);
        $data = $this->db->get();
        $data = $data->row();
        return $data;
    }


    function listarNotificacionesUsuario($usuario_k , $tipo_notificacion){

        $where = array(
            "nu.usuario_k"                => $usuario_k,
            "nu.activo"                   => "1",
            "n.activo"                    => "1",
            "cn.activo"                   => "1",
            "cn.notificacion_html_activo" => "1"
        );

        switch ( $tipo_notificacion ){

            case( NOTIFICACIONES_HTML ):
                $where['cn.notificacion_html_activo'] = "1";
                break;

            case( NOTIFICACIONES_ALERTA ):
                $where['cn.notificacion_alerta_activo'] = "1";
                break;

        }

        $this->db->select("nu.* , CONCAT_WS(' ', u.nombre , u.apellido_paterno , u.apellido_materno ) nombre_usuario,cn.valor as tipo_notificacion_k, cn.atributo as tipo_notificacion");
        $this->db->from('notificaciones_usuarios nu');
        $this->db->join('notificaciones n', 'n.notificacion_k = nu.notificacion_k');
        $this->db->join('cat_notificaciones cn', 'cn.cat_notificacion_k = n.cat_notificacion_k');
        $this->db->join('usuarios u' , 'u.id = n.id');
        $this->db->where($where);
        $this->db->order_by("notificacion_usuario_k", "desc");

        $data = $this->db->get();
        return $data->result();
    }

    
    function eliminarNotificacionUsuario( $id ){

        $where = array(
            "notificacion_usuario_k" => $id
        );

        $upd = array(
            "activo" => "0",
            "usuario_eliminacion" => $this->session->getUsuarioId(),
            "fecha_hora_eliminacion" => date("Y-m-d H:i:s")
        );

        $this->db->where( $where );
        $this->db->update('notificaciones_usuarios' , $upd );

        return $this->db->trans_status();

    }

}