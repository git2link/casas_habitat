<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Notificaciones extends MY_Controller{

    function __construct() {
        parent::__construct();
        //$this->load->library('notificacionesLib');
        $this->load->model('Model_Notificaciones');

    }



    function listarNotificacionesUsuarioHtml(){

        $tipo_notificacion = NOTIFICACIONES_HTML;
        $usuario_k = $this->session->getUsuarioId();

        $resultado = $this->Model_Notificaciones->listarNotificacionesUsuario( $usuario_k , $tipo_notificacion );

        echo $this->getSuccess ( array("success" =>  "true", "numFilas" => count($resultado), "data"=> $resultado));

    }


    function listarNotificacionesUsuarioAlerta(){

        $tipo_notificacion = NOTIFICACIONES_ALERTA;
        $usuario_k         = $this->session->getUsuarioId();

        $resultado = $this->Model_Notificaciones->listarNotificacionesUsuario( $usuario_k , $tipo_notificacion);

        echo $this->getSuccess ( array("success" =>  "true", "numFilas" => count($resultado), "data"=> $resultado));

    }

    function eliminarNotificacionUsuario(){

        $notificacion_k = $this->input->post('i');

        $resultado = $this->Model_Notificaciones->eliminarNotificacionUsuario( $notificacion_k );

        echo $this->getSuccess( array( "success" => $resultado ) );



    }

}
