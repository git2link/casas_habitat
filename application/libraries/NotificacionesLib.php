<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Por Crysfel Villa
 * Clase para la administración de reportes
 * @class ReporteBI
 *
 * @autor Ing. Crysfel Villa<br>
 *        crysfel@bleext.com<br>
 *        http://www.crysfel.com
 * @fecha 15 de Febrero 2011. Monterrey NL
 * 
 */
require_once(BASEPATH . 'application/libraries/catalogobi' . EXT);
class NotificacionesBI extends CatalogoBI{
	

	function NotificacionesBI(){

        parent::CatalogoBI();
		$this->instance= & get_instance();

        $this->instance->load->library("lms/raprendizajebi");
        $this->raprendizajebi = $this->instance->raprendizajebi;

		$this->instance->load->model("notificaciondao","notificaciondao",TRUE);
		$this->dao = $this->instance->notificaciondao;
		
		$this->instance->load->library("emailbi");
		$this->emailbi = $this->instance->emailbi;

        $this->instance->load->library("consultabi");
        $this->consultabi = $this->instance->consultabi;

        $this->instance->load->model("notificacionesdao","notificacionesdao",TRUE);
        $this->notificacionesdao=$this->instance->notificacionesdao;

        $this->instance->load->model("calendariodao","calendariodao",TRUE);
        $this->calendariodao=$this->instance->calendariodao;

        $this->instance->load->model("forodao","forodao",TRUE);
        $this->forodao=$this->instance->forodao;

        $this->instance->load->model("comunidaddao","comunidaddao",TRUE);
        $this->comunidaddao = $this->instance->comunidaddao;

        $this->instance->load->model("usuariodao","usuariodao",TRUE);
        $this->usuariodao = $this->instance->usuariodao;
	}
	
	function guardar($notificaciones){
		foreach($notificaciones as $n){
			$obj = array(
				"usuario_k"			=> $n->usuario_k,
				"reporte_k"			=> $n->reporte_k,
				"periodo"			=> property_exists($n,"periodo")?$n->periodo:0,
				"dia"				=> property_exists($n,"dia")?$n->dia:0,
				"caducidad"			=> property_exists($n,"caducidad")?$n->caducidad:"",
				"activo"			=> property_exists($n,"activo")?$n->activo:true
			);
			if(property_exists($n,"notificacion_k")){
				$obj["notificacion_k"] = $n->notificacion_k;
				$this->dao->actualizar($obj);
			}else{
				$this->dao->guardar($obj);
			}
		}
	}

	function eliminarNotificacionUsuario($notificacion_k){

        $respuesta = $this->notificacionesdao->eliminarNotificacionUsuario($notificacion_k);

        return $respuesta;
	}
	
	function getNotificacionesByReporte($reporte_k){
		return $this->dao->getNotificacionesByReporte($reporte_k);
	}
	
	function runTask(){
		$notificaciones = $this->dao->getActiveNotificaciones();
		$today = date("Y-m-d");
		$day = date("N");
		$time = date("H:i:s");
		$dayMonth = date("j");
		$emails = array();
		
		foreach($notificaciones as $notif){
			$email = array(
				"para"		=> $notif["email"],
				"asunto"	=> "Reporte: ".$notif["reporte"],
				"mensaje"	=> "Dar click en el siguiente link para descagar el reporte: http://url.com/index.php/reportes/descargar/".$notif["reporte_k"],
				"fecha"		=> $today,
				"hora"		=> $time
			);
			
			if($notif["periodo"] == 1){			//diariamente
				$this->emailbi->agregar($email["para"],$email["asunto"],$email["mensaje"]);
			}else if($notif["periodo"] == 2 && $notif["dia"] == $day){	//semanal si hoy es el día de la semana definido
				$this->emailbi->agregar($email["para"],$email["asunto"],$email["mensaje"]);
			}else if($notif["periodo"] == 3 && $notif["dia"] == $dayMonth){ //mensual si hoy es el día del mes definido
				$this->emailbi->agregar($email["para"],$email["asunto"],$email["mensaje"]);
			}
		}

		//$this->emailbi->agregarEmails($emails);
	}

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: 26-Enero-2015
     * Tabla(s) afectada(s): notificaciones
     * Descripción: metodo(s) para agregar notificaciones a un usuario.
     * Recibe: $usuario_k (id de la sesion del usuario)
     *         $tipo_notificacion(dependiendo el evento que genero la notificacion)
     *         $params (dependiendo el evento que genero la notificacion)
     *************************************************************************/
    function agregarNotificacion( $usuario_k, $tipo_notificacion, $params ){
        // Traer mensaje de la tabla catalogo_mensajes_notificacion
        $mensaje = $this->notificacionesdao->obtenerDesdeCatalogo( $tipo_notificacion );

        if($mensaje == false){
            return false;
        }

        $params = $this->construirParams( $tipo_notificacion, $params );

        //Crea un arreglo para insertar en la tabla notificaciones
        $data = array (
            "cat_notificacion_k"  => $mensaje->cat_notificacion_k,
            "usuario_k"           => $usuario_k,
            "params"              => json_encode($params),
            "estatus"             => "1",
            "activo"              => "1",
            "usuario_creacion"    => $this->session->getUsuarioId(),
            "fecha_hora_creacion" => date("Y-m-d H:i:s")
        );

         // Llama al método que inserta en la tabla notificaciones.
        $notificacion_k = $this->notificacionesdao->agregarNotificacion( $data );



        $params = $this->construirParamsUsuarios( $tipo_notificacion, $params );

        $mensaje_string_html    = $this->reemplazarPlantilla( $tipo_notificacion, $mensaje->plantilla_html, $params   );
        $mensaje_string_alerta  = $this->reemplazarPlantilla( $tipo_notificacion, $mensaje->plantilla_alerta, $params );
        $mensaje_string_email   = $this->reemplazarPlantilla( $tipo_notificacion, $mensaje->plantilla_email, $params  );

        //$mensaje->esPersonalizada = FALSE;

        if( ($mensaje->personalizada ) == 0 ){

            $usuariosANotificar = $params->usuarios_por_notificar_string;

            unset ( $params->usuarios_por_notificar_string );

            $notificaciones_usuarios_insert = array(
                "notificacion_k"                => $notificacion_k,
                "usuarios_por_notificar_string" => $usuariosANotificar,
                "params"                        => json_encode($params),
                "estatus"                       => "1",
                "activo"                        => "1",
                "usuario_creacion"              => $this->session->getUsuarioId(),
                "fecha_hora_creacion"           => date("Y-m-d H:i:s")
            );

            if( !empty($mensaje->notificacion_html_activo) && $mensaje->notificacion_html_activo == 1 ){

                $notificaciones_usuarios_insert['notificacion']        = $mensaje_string_html;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_HTML;

                $this->determinarEnvioNotificacionMasiva( $notificaciones_usuarios_insert , $tipo_notificacion );

            }

            if( !empty($mensaje->notificacion_alerta_activo) && $mensaje->notificacion_alerta_activo == 1 ){

                $notificaciones_usuarios_insert['notificacion']        = $mensaje_string_alerta;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_ALERTA;

                $this->determinarEnvioNotificacionMasiva( $notificaciones_usuarios_insert , $tipo_notificacion );

            }

            if( !empty($mensaje->notificacion_email_activo) && $mensaje->notificacion_email_activo == 1 ){

                $notificaciones_usuarios_insert['notificacion']        = $mensaje_string_email;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_EMAIL;

                $this->determinarEnvioNotificacionMasiva( $notificaciones_usuarios_insert , $tipo_notificacion );

            }

        } else{
            $usuarios_array = $this->obtenerUsuariosPorEnviarNotificacion( $tipo_notificacion, $params );

            foreach( $usuarios_array AS $usuario_record ){

            // Se crea el arreglo para insertar en la tabla notificaciones_usuarios
            $notificaciones_usuarios_insert = array(
                "notificacion_k"      => $notificacion_k,
                "usuario_k"           => $usuario_record->usuario_k,
                "params"              => json_encode($params),
                "estatus"             => "1",
                "activo"              => "1",
                "usuario_creacion"    => $this->session->getUsuarioId(),
                "fecha_hora_creacion" => date("Y-m-d H:i:s")
            );

            /*
             * [ JAIR ] SE comenta, pero es posible considerar plantillas personlaizadas
             *
             *   if( !empty($mensaje->personalizada ) && $mensaje->personalizada == 0 ){
             *       $mensaje_string_html = $this->reemplazarPlantilla(      $tipo_notificacion, $mensaje->plantilla_html, $params );
             *       $mensaje_string_alerta = $this->reemplazarPlantilla(    $tipo_notificacion, $mensaje->plantilla_alerta, $params );
             *       $mensaje_string_email = $this->reemplazarPlantilla(     $tipo_notificacion, $mensaje->plantilla_email, $params );
             *   }
             */

            if( !empty($mensaje->notificacion_html_activo) && $mensaje->notificacion_html_activo == 1 ){
                $notificaciones_usuarios_insert['notificacion'] = $mensaje_string_html;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_HTML;
                $this->notificacionesdao->agregarNotificacionUsuario( $notificaciones_usuarios_insert);
            }

            if( !empty($mensaje->notificacion_alerta_activo) && $mensaje->notificacion_alerta_activo == 1 ){
                $notificaciones_usuarios_insert['notificacion'] = $mensaje_string_alerta;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_ALERTA;
                $this->notificacionesdao->agregarNotificacionUsuario( $notificaciones_usuarios_insert);
            }

            if( !empty($mensaje->notificacion_email_activo) && $mensaje->notificacion_email_activo == 1 ){
                $notificaciones_usuarios_insert['notificacion'] = $mensaje_string_email;
                $notificaciones_usuarios_insert['medio_visualizacion'] = COMUNIDADES_NOTIFICACIONES_EMAIL;
                $this->notificacionesdao->agregarNotificacionUsuario( $notificaciones_usuarios_insert);
            }

        }

    }

        return TRUE;

    }

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: Febrero-2015
     * Tabla(s) afectada(s): dependiendo el tipo de notificacion
     * Descripción: metodo(s) para obtener los usuarios a los que se les mandara
     *              notificacion una notificacion, dependiendo el tipo de notificacion.
     *************************************************************************/
    function obtenerUsuariosPorEnviarNotificacion( $tipo_notificacion, $params ){

        switch( $tipo_notificacion ){

            case( NOTIFICACIONES_CONVERSACIONES_MENSAJE_NUEVO ):

                switch( $params['tabla_propietario'] ){

                    case 'usuarios':
                        $return_array = array( ( object )array( "usuario_k" => $params['propietario_k'] ) );

                        break;

                    case 'grupos_por_definir_de_la_conversacion':


                        if( isset ( $params['propietario_k'] ) ){

                            $usuarios_en_conversacion = $params['usuarios_por_notificar'];

                        }else{

                            $usuarios_en_conversacion = $this->conversacionesdao->obtenerUsuarioPorGrupoChat( $params['propietario_k'] );

                        }

                        $return_array = array();

                        foreach( $usuarios_en_conversacion AS $record ){

                        array_push( $return_array, ( object )array( "usuario_k" => $record->destinatario ) );

                    }

                        break;

                    default:

                        break;

                }
                return $return_array;

                break;

            case( NOTIFICACIONES_FOROS_RESPUESTA_NUEVA ):
            case( NOTIFICACIONES_FOROS_PREGUNTA_NUEVA  ):
                return $this->forodao->obtenerUsuarioPorComunidad( $params );
                break;
            case ( NOTIFICACIONES_COMUNIDAD_DESACTIVADA                 ):
            case ( NOTIFICACIONES_COMUNIDAD_NUEVOS_ELEMENTOS_ASOCIADOS  ):
            case ( NOTIFICACIONES_COMENTARIO_NUEVO                      ):
                $usuarios = $this->comunidaddao->obtenerUsuarioPorComunidad( $params->comunidad_k );
                return $usuarios;
                break;

            case ( NOTIFICACIONES_NOTICIA_NUEVA                         ):

                switch( $params->tipo){
                    case(1):
                        $usuarios = $this->comunidaddao->obtenerUsuarioPorComunidad( $params->comunidad_k );
                        break;
                    case(2):
                        $usuarios = $this->usuariodao->listarUsuariosActivos();
                        break;
                }

                return $usuarios;
                break;

            case ( NOTIFICACIONES_COMUNIDAD_NUEVA    ):

                switch ( $params->tipo_acceso ){

                    case( COMUNIDADES_TIPO_ACCESO_PUBLICO_TODOS                  ):
                    case( COMUNIDADES_TIPO_ACCESO_PUBLICO_AUTOINSCRIPCION        ):
                    case( COMUNIDADES_TIPO_ACCESO_PUBLICO_MANUAL_AUTOINSCRIPCION ):

                        return $this->usuariodao->listarUsuariosActivos();

                        break;

                    case( COMUNIDADES_TIPO_ACCESO_PRIVADO ):
                        return $this->comunidaddao->obtenerConfiguracionUsuarios( $params->configuracion_k );
                        break;
                }
                break;

            case(NOTIFICACIONES_COMUNIDAD_NUEVOS_USUARIOS):

                if( !empty($params->usuarios_por_inscribir) && isset($params->usuarios_por_inscribir) ){
                    return $params->usuarios_por_inscribir;
                }else{
                    return (object) array();
                    //return $this->comunidaddao->obtenerConfiguracionUsuarios( $params->configuracion_k );
                }
                break;
            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_TUTORES ):
                if( !empty( $params->tutores_por_inscribir ) && isset($params->tutores_por_inscribir) ){
                    return $params->tutores_por_inscribir;
                }else{
                    return array();
                    //return $this->comunidaddao->obtenerConfiguracionTutores( $params->configuracion_k );
                }
                break;

            case ( NOTIFICACIONES_ASIGNACION_CONSULTA     ):

                $usuarioANotificar = array(
                    (object) array(
                        "usuario_k" => $params->usuario_asignado_k,
                    )
                );
                return $usuarioANotificar;

            case ( NOTIFICACIONES_CIERRE_CONSULTA    ):
            case ( NOTIFICACIONES_RESPUESTA_CONSULTA ):
                return $this->consultabi->obtenerUsuarioPorConsulta( $params->consulta_k);
                break;
            case ( NOTIFICACIONES_AGREGAR_MIS_CONTACTOS):

                $usuarioANotificar = array(
                    (object) array(
                        "usuario_k" => $params->usuario_k,
                    )
                );
                return $usuarioANotificar;

                break;
            case ( NOTIFICACIONES_RESPUESTA_COMENTARIO ):

                $usuarioANotificar = array(
                    (object) array(
                        "usuario_k" => $params->usuario_k,
                    )
                );
                return $usuarioANotificar;

                break;
            default:
                break;
        }


    }

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: 28-Enero-2015
     * Tabla(s) afectada(s): No modifica tablas
     * Descripción: metodo(s) para reemplazar los valores de la plantilla
     *              para enviar la notificacion.
     *************************************************************************/
    function reemplazarPlantilla( $tipo_notificacion, $plantilla, $params ){

        switch( $tipo_notificacion ){

            case ( NOTIFICACIONES_CONVERSACIONES_MENSAJE_NUEVO ):

                /*Obtener la informacion del nuevo usuario*/
                $this->instance->load->model( 'usuariodao', 'usuariodao', TRUE );
                $usuario = $this->instance->usuariodao->findById( $params['usuario_k'] );

                $mensaje_string = str_replace( '$usuario', $usuario->nombre , $plantilla );

                return $mensaje_string;

            break;

            case( NOTIFICACIONES_COMUNIDAD_DESACTIVADA      ):
            case( NOTIFICACIONES_FOROS_RESPUESTA_NUEVA      ):
            case( NOTIFICACIONES_FOROS_PREGUNTA_NUEVA       ):
            case( NOTIFICACIONES_NOTICIA_NUEVA              ):
            case( NOTIFICACIONES_COMENTARIO_NUEVO           ):

                $comunidad = $this->comunidaddao->getById( $params->comunidad_k );
                $mensaje_string = str_replace( '$comunidad', $comunidad->nombre ,$plantilla );
                return $mensaje_string;

            case( NOTIFICACIONES_RESPUESTA_CONSULTA ):
            case( NOTIFICACIONES_COMUNIDAD_NUEVA    ):
                return $plantilla;

            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_TUTORES   ):
            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_USUARIOS  ):
                $comunidad = $this->comunidaddao->obtenerConfiguracionGeneral( $params->configuracion_k );
                $mensaje_string = str_replace( '$comunidad', $comunidad->nombre ,$plantilla );
                return $mensaje_string;

            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_ELEMENTOS_ASOCIADOS ):

                $comunidad = $this->comunidaddao->getById( $params->comunidad_k );

                $mensaje_string = str_replace( '$comunidad', $comunidad->nombre, $plantilla );
                $mensaje_string = str_replace( '$tipo_elemento', $params->tabla_propietario, $mensaje_string );

                return $mensaje_string;

                break;

            case( NOTIFICACIONES_CIERRE_CONSULTA     ):
            case( NOTIFICACIONES_ASIGNACION_CONSULTA ):
                $mensaje_string = str_replace ('$consulta_k', $params->consulta_k , $plantilla );
                return $mensaje_string;
                break;
            case ( NOTIFICACIONES_AGREGAR_EVENTO ):
                $calendario = $this->calendariodao->getById( $params->calendario_k );
                $mensaje_string = str_replace ('$nombre', $calendario->nombre , $plantilla );
                return $mensaje_string;
                break;

            case ( NOTIFICACIONES_AGREGAR_MIS_CONTACTOS ):
                $usuario = $this->usuariodao->findById($params->usuario_contacto_k);
                $mensaje_string = str_replace ('$nombre', $usuario->nombre , $plantilla );
                return $mensaje_string;
                break;
            case( NOTIFICACIONES_RESPUESTA_COMENTARIO ):

                $usuario   = $this->usuariodao->findById($params->usuario_contacto_k);
                $comunidad = $this->comunidaddao->getById( $params->comunidad_k );

                $mensaje_string = str_replace ('$nombre',    $usuario->nombre , $plantilla );
                $mensaje_string = str_replace ('$comunidad', $comunidad->nombre , $mensaje_string );

                return $mensaje_string;

                break;
            case( NOTIFICACIONES_COMUNIDAD_NUEVO_DOCUMENTO ):

                $objeto = new stdClass();
                $objeto->ra_k = $params->llave_propietario_k;

                $curso =  $this->raprendizajebi->listar( 0, PAGESIZE ,$objeto );

                $mensaje_string = str_replace ('$lms',    $curso['data'][0]->nombre , $plantilla );
                return $mensaje_string;

                break;
            default:
                break;
        }
    }

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: 28-Enero-2015
     * Tabla(s) afectada(s): No modifica tablas
     * Descripción: metodo(s) para crear los parametros que se enviaran a la notificacion
     *                        dependiendo el tipo de notificacion
     *************************************************************************/

    function construirParamsUsuarios( $tipo_notificacion, $params ){

        switch( $tipo_notificacion ){

            case ( NOTIFICACIONES_COMUNIDAD_NUEVOS_USUARIOS  ):
                $params_object = ( object ) array(
                    "comunidad_k"                   => $params->comunidad_k,
                    "configuracion_k"               => $params->configuracion_k,
                    "usuarios_por_notificar_string" => $params->usuarios_por_notificar_string
                );
                break;
            case( NOTIFICACIONES_AGREGAR_MIS_CONTACTOS ):
                $params_object = ( object ) array(
                    "usuario_k"          => $params->usuario_k,
                    "usuario_contacto_k" => $this->session->getUsuarioId()
                );
                break;
            case ( NOTIFICACIONES_RESPUESTA_COMENTARIO ):
                $params_object = ( object ) array(
                    "comentario_k"           => $params->comentario_k,
                    "comunidad_k"            => $params->comunidad_k,
                    "usuario_k"              => $params->usuario_k,
                    "usuario_contacto_k"     => $this->session->getUsuarioId(),
                    "respuesta_comentario_k" => $params->respuesta_comentario_k
                );
                break;
            default:
                $params_object = $params;
                break;
        }
        return $params_object;
    }

    function construirParams( $tipo_notificacion, $params ){

        $params_object = ( object ) array();


        switch( $tipo_notificacion ){

            case ( NOTIFICACIONES_CONVERSACIONES_MENSAJE_NUEVO ):

                $params_object = $params;

                break;

            case ( NOTIFICACIONES_FOROS_RESPUESTA_NUEVA ):

                $comunidad = $this->forodao->getById( $params['foro_k'] );

                $params_object = ( object ) array(
                    "comunidad_k"       => $comunidad->comunidad_k,
                    "foro_k"            => $params['foro_k'],
                    "foro_pregunta_k"   => $params['foro_pregunta_k'],
                    "nombre"            => $params['nombre'],
                    "ruta"              => $params['ruta'],
                    "foro_respuesta_k"  => $params['foro_respuesta_k']
                );
                break;

            case ( NOTIFICACIONES_FOROS_PREGUNTA_NUEVA ):

                $comunidad = $this->forodao->getById($params['foro_k']);

                $params_object = ( object ) array(
                    "comunidad_k"       => $comunidad->comunidad_k,
                    "foro_k"            => $params['foro_k'],
                    "nombre"            => $params['nombre'],
                    "ruta"              => $params['ruta'],
                    "foro_pregunta_k"   => $params['foro_pregunta_k']
                );
                break;

            case ( NOTIFICACIONES_COMUNIDAD_NUEVO_DOCUMENTO ):

                $params_object = ( object ) array(
                    "carpeta_k"           => $params['carpeta_k'],
                    "ruta"                => $params['ruta'],
                    "nombre"              => $params['nombre'],
                    "llave_propietario_k" => $params['llave_propietario_k'],
                    "tabla_propietario"   => $params['tabla_propietario']
                );

                break;
            case ( NOTIFICACIONES_NOTICIA_NUEVA ):

                $params_object = ( object ) array(
                    "comunidad_k" => $params['comunidad_k'],
                    "noticia_k"   => $params['noticia_k'],
                    "nombre"      => $params['titulo'],
                    "tipo"        => $params['tipo']
                );
                break;

            case ( NOTIFICACIONES_COMUNIDAD_NUEVA ):

                $params_object = ( object ) array(
                    "comunidad_k"                   => $params['comunidad_k'],
                    "categoria_k"                   => $params['categoria_k'],
                    "nombre"                        => $params['nombre'],
                    "configuracion_k"               => $params['configuracion_k'],
                    "tipo_acceso"                   => $params['tipo_acceso'],
                    "usuarios_por_notificar_string" => $params['usuarios_por_notificar_string']
                );
                break;

            case( NOTIFICACIONES_COMENTARIO_NUEVO ):

                $params_object = ( object ) array(
                    "comentario_k"  => $params['comentario_k'],
                    "comunidad_k"   => $params['comunidad_k']
                );
                break;

            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_USUARIOS ):

                $params_object = ( object ) array(
                    "comunidad_k"            => $params['comunidad_k'],
                    "configuracion_k"        => $params['configuracion_k'],
                    "usuarios_por_notificar_string" => $params['usuarios_por_notificar_string']
                );
                break;

            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_TUTORES ):

                $params_object = (object) array(
                    "comunidad_k"           => $params['comunidad_k'],
                    "configuracion_k"       => $params['configuracion_k'],
                    "tutores_por_inscribir" => $params['tutores_por_inscribir']
                );
                break;

            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_ELEMENTOS_ASOCIADOS ):

                $params_object = (object) array(
                    "comunidad_k"       => $params['comunidad_k'],
                    "configuracion_k"   => $params['configuracion_k'],
                    "tabla_propietario" => $params['tabla_propietario'],
                    "propietario_k"     => $params['propietario_k']
                );
                break;

            case( NOTIFICACIONES_ASIGNACION_CONSULTA ):

                $params_object = ( object ) array(
                    "consulta_k"            => $params['consulta_k'],
                    "comunidad_k"           => $params['comunidad_k'],
                    "usuario_asignado_k"    => $params['usuario_asignado_k']

                );

                break;

            case( NOTIFICACIONES_RESPUESTA_CONSULTA ):

                $params_object = ( object ) array(

                    "consulta_k"    => $params['consulta_k'],
                    "comunidad_k"   => $params['comunidad_k'],
                    "respuesta_k"   => $params['respuesta_k']

                );
                break;

            case( NOTIFICACIONES_CIERRE_CONSULTA ):

                $params_object = ( object ) array(
                    "consulta_k"    => $params['consulta_k']
                );

                break;

            case( NOTIFICACIONES_COMUNIDAD_DESACTIVADA ):

                $params_object = ( object ) array(
                    "comunidad_k"   => $params['comunidad_k']
                );
                break;

            case( NOTIFICACIONES_AGREGAR_EVENTO ):
                $params_object = ( object ) array(
                    "calendario_k" => $params['calendario_k'],
                    "comunidad_k"  => $params['comunidad_k'],
                    "tipo"         => $params['tipo']
                );
                break;

            case( NOTIFICACIONES_AGREGAR_MIS_CONTACTOS ):
                $params_object = ( object ) array(
                    "usuario_k" => $params['usuario_k']
                );
                break;

            case ( NOTIFICACIONES_RESPUESTA_COMENTARIO ):
                $params_object = ( object ) array(
                    "comentario_k"           => $params['comentario_k'],
                    "comunidad_k"            => $params['comunidad_k'],
                    "usuario_k"              => $params['usuario_k'],
                    "respuesta_comentario_k" => $params['respuesta_comentario_k']
                );
                break;

            default:
                break;
        }

        return $params_object;

    }

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: 26-Enero-2015
     * Tabla(s) afectada(s): notificaciones
     * Descripción: metodo(s) para listar las notificaciones del usuario.
     *************************************************************************/
    function listarNotificacionesUsuario( $usuario_k , $tipo_notificacion){

        $resultado = $this->notificacionesdao->listarNotificacionesUsuario( $usuario_k , $tipo_notificacion );

        return $resultado;

    }

    /************************************************************************
     * Autor: Jair Almaraz Saldaña
     * Fecha: 26-Enero-2015
     * Tabla(s) afectada(s): notificaciones
     * Descripción: metodo(s) para listar las notificaciones del usuario.
     *************************************************************************/
    function determinarEnvioNotificacionMasiva( $notificaciones_usuarios_insert , $tipo_notificacion ){

        switch( $tipo_notificacion ){

            case( NOTIFICACIONES_COMUNIDAD_NUEVA           ):
            case( NOTIFICACIONES_COMUNIDAD_NUEVOS_USUARIOS ):

                $respuesta = $this->notificacionesdao->agregarNotificacionUsuarioMasivo( $notificaciones_usuarios_insert );
                break;

            case ( NOTIFICACIONES_NOTICIA_NUEVA ):

                $parametros = json_decode($notificaciones_usuarios_insert['params']);

                switch( $parametros->tipo ){

                    case ( TIPO_NOTICIA_COMUNIDAD ):

                        $respuesta = $this->notificacionesdao->agregarNotificacionUsuariosPorComunidadMasivo( $notificaciones_usuarios_insert );
                        break;

                    case (TIPO_NOTICIA_GENERAL    ):

                        $respuesta = $this->notificacionesdao->agregarNotificacionesUsuariosActivosMasivo   ( $notificaciones_usuarios_insert );
                        break;

                }
                break;
            case( NOTIFICACIONES_AGREGAR_EVENTO ):
                $parametros = json_decode($notificaciones_usuarios_insert['params']);

                switch($parametros->tipo){
                    case(1):
                        $respuesta = $this->notificacionesdao->agregarNotificacionUsuariosPorComunidadMasivo( $notificaciones_usuarios_insert );
                        break;
                    case(2):
                        $respuesta = $this->notificacionesdao->agregarNotificacionesUsuariosActivosMasivo   ( $notificaciones_usuarios_insert );
                        break;
                    case(3):
                        break;
                }
                break;

            case ( NOTIFICACIONES_COMENTARIO_NUEVO ):
            case ( NOTIFICACIONES_COMUNIDAD_NUEVOS_ELEMENTOS_ASOCIADOS ):
            case ( NOTIFICACIONES_FOROS_PREGUNTA_NUEVA ):
            case ( NOTIFICACIONES_FOROS_RESPUESTA_NUEVA ):
                $respuesta = $this->notificacionesdao->agregarNotificacionUsuariosPorComunidadMasivo( $notificaciones_usuarios_insert );
            break;
            case ( NOTIFICACIONES_COMUNIDAD_NUEVO_DOCUMENTO ):
                $respuesta = $this->notificacionesdao->agregarNotificacionUsuariosPorRaMasivo( $notificaciones_usuarios_insert );
                break;
        }

        return $respuesta;
    }

}