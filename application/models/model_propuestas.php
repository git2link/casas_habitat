<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_Propuestas extends CI_Model {

	function __construct() {
		parent::__construct();
    }

    function getPropuestasCasa( $casa_k , $cliente_k){

    	$this->db->select('*');
    	$this->db->from('propuestas');
    	if( !empty($casa_k)){

    		$this->db->where( 'casa_k'    , $casa_k );
            $this->db->where( 'cliente_k' , $cliente_k );
    	}

    	$data = $this->db->get();

    	return $data->result();
    	
    }

    function insertar_propuesta( $registro ){
        $this->db->set($registro);
        $this->db->insert('propuestas');
        return $this->db->insert_id();
    }

    function insertar_tmp( $registro ){
        $this->db->set($registro);
        $this->db->insert('propuestas_tmp');
        return $this->db->insert_id();
    }
    
    function insertar_pago_tmp( $registro ){
        $this->db->set($registro);
        $this->db->insert('pagos_propuesta_tmp');
    }

    function copiarPagosDePropuestaTemporal( $id , $propuesta_tmp_k){

        $sql = "INSERT INTO pagos_propuesta (propuesta_k , monto , fecha )
        SELECT ".$id." , monto , fecha  FROM pagos_propuesta_tmp
         WHERE propuesta_tmp_k = ".$propuesta_tmp_k." " ;

         $this->db->query($sql);


    }


}
