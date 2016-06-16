<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_Upload extends CI_Model {

    public function construct() {
        parent::__construct();
    }
    
    //FUNCIÓN PARA INSERTAR LOS DATOS DE LA IMAGEN SUBIDA
    function subir( $casa_k , $imagen , $thumb )
    {
        $data = array(
            'casa_k'    => $casa_k,
            'nombre'    => $imagen,
            'thumb'     => $thumb
        );
        return $this->db->insert('imagenes_casas', $data);
    }
}
