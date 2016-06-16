<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Model_Upload');
    }

    function index() {
        //CARGAMOS LA VISTA DEL FORMULARIO
        $this->load->view('upload_view');
    }

    //FUNCIÓN PARA SUBIR LA IMAGEN Y VALIDAR EL TÍTULO
    function do_upload( $casa_k ) {

        
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2000';
        $config['max_width'] = '2024';
        $config['max_height'] = '2008';

        $this->load->library('upload', $config);
        $file_info = $this->upload->data();
        //ENVÍAMOS LOS DATOS AL MODELO PARA HACER LA INSERCIÓN

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r( $error );
        }
        
        //USAMOS LA FUNCIÓN create_thumbnail Y LE PASAMOS EL NOMBRE DE LA IMAGEN,
        //ASÍ YA TENEMOS LA IMAGEN REDIMENSIONADA
        $this->_create_thumbnail($_FILES['userfile']['name']);
        $data = array('upload_data' => $this->upload->data());
        $imagen = $_FILES['userfile']['name'];
        $thumb  =  substr( $imagen , 0 , strrpos( $imagen, '.') )."_thumb".substr( $imagen , strrpos( $imagen, '.') );
        $subir = $this->Model_Upload->subir($casa_k,$imagen , $thumb);
        header('Location: '.base_url('casa/galeria/'.$casa_k ) );
        
        
    }
    //FUNCIÓN PARA CREAR LA MINIATURA A LA MEDIDA QUE LE DIGAMOS
    function _create_thumbnail($filename){
        if(!is_dir("uploads/thumbs/"))
            mkdir("uploads/thumbs/", 0777);
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='uploads/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();

    }
}