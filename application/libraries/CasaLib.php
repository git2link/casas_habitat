<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para casa
class CasaLib {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
		$this->CI->load->model('Model_Casa');
        $this->CI->load->model('Model_Direccion');
        //$this->CI->load->model('Model_Perfil');
    }

    function generarClaveInterna( $registro ){

        switch ($registro['tipo_casa_k']) {
            case ( CASA_MA ):
                
                $autoIncremental = $this->CI->Model_Casa->obtenerAutoIncrementalMA( $registro['tipo_casa_k']);

                $clave_interna = "MA-".$autoIncremental->autoincremental;

                $datos_adicionales = array(
                    "autoincremental_tipo"  => $autoIncremental->autoincremental,
                    "clave_interna"         => $clave_interna
                    );

                return $datos_adicionales;

                break;

            case ( CASA_VIVE ):

                $autoIncremental = $this->CI->Model_Casa->obtenerAutoIncrementalVive( $registro['tipo_casa_k'] , $registro['municipio_k'] );
                $municipio      = $this->CI->Model_Direccion->getMunicipioById( $registro['municipio_k'] );
                $paquete        = $this->CI->Model_Casa->getPaqueteById( $registro['paquete_casa_k']);   

                $numeroPaquete  = substr( $paquete->descripcion , strrpos( $paquete->descripcion, ' ' )+1 );

                $clave_interna = strtoupper(substr( $municipio->nombre , 0 , 3).$autoIncremental->autoincremental."-".$numeroPaquete );

               $datos_adicionales = array(
                    "autoincremental_tipo"  => $autoIncremental->autoincremental,
                    "clave_interna"         => $clave_interna
                    );

                return $datos_adicionales;

                break;

            case ( CASA_SUBASTA ):

                $autoIncremental = $this->CI->Model_Casa->obtenerAutoIncrementalVive( $registro['tipo_casa_k'] , $registro['municipio_k'] );
                $municipio      = $this->CI->Model_Direccion->getMunicipioById( $registro['municipio_k'] );
                $paquete        = $this->CI->Model_Casa->getPaqueteById( $registro['paquete_casa_k']);   

                $numeroPaquete  = substr( $paquete->descripcion , mb_strrpos($paquete->descripcion, '.')+1 );

                $clave_interna = "S-".strtoupper(substr( $municipio->nombre , 0 , 3).$autoIncremental->autoincremental."-".$numeroPaquete );
                
                $datos_adicionales = array(
                    "autoincremental_tipo"  => $autoIncremental->autoincremental,
                    "clave_interna"         => $clave_interna
                    );

                return $datos_adicionales;

                break;
            
            default:
            
                $autoIncremental = $this->CI->Model_Casa->obtenerAutoIncrementalVive( $registro['tipo_casa_k'] , $registro['municipio_k'] );
                $municipio      = $this->CI->Model_Direccion->getMunicipioById( $registro['municipio_k'] );
                $paquete        = $this->CI->Model_Casa->getPaqueteById( $registro['paquete_casa_k']);   

                $numeroPaquete  = substr( $paquete->descripcion , mb_strrpos($paquete->descripcion, '.')+1 );

                $clave_interna = "S-".strtoupper(substr( $municipio->nombre , 0 , 3).$autoIncremental->autoincremental."-".$numeroPaquete );
                
                $datos_adicionales = array(
                    "autoincremental_tipo"  => $autoIncremental->autoincremental,
                    "clave_interna"         => $clave_interna
                    );

                return $datos_adicionales;


                break;
        }


    }

    

}
