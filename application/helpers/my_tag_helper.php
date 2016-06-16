<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Muestra TODOS errores de validación de un formulario
if ( ! function_exists('my_validation_errors')) {

	function my_validation_errors($errors) {
		$salida = '';

		if ($errors) {
			$salida = '<div class="alert alert-error">';
			$salida = $salida.'<button type="button" class="close" data-dismiss="alert"> × </button>';
			$salida = $salida.'<h4> Mensajes Validacion </h4>';
			$salida = $salida.'<small>'.$errors.'</small>';
			$salida = $salida.'</div>';
		}
		return $salida;
	}

}

// Opciones de menú de la barra superior (las opciones dependen si hay session o no)
if ( ! function_exists('my_menu_ppal')) {

	function my_menu_ppal() {
		$opciones = '<li>'.anchor('home/index', 'Inicio').'</li>';
		$opciones = $opciones.'<li>'.anchor('home/acerca_de', 'Acerca De').'</li>';

		if (get_instance()->session->userdata('usuario')) {
			$opciones = $opciones.'<li>'.anchor('home/cambio_clave', 'Cambio Clave').'</li>';
			$opciones = $opciones.'<li>'.anchor('home/salir', 'Salir').'</li>';
		}
		else {
			$opciones = $opciones.'<li>'.anchor('home/ingreso', 'Ingreso').'</li>';
		}

		return $opciones;
	}

}

if ( ! function_exists('my_menu_app')) {

	function my_menu_app() {
		$opciones = null;

		if (get_instance()->session->userdata('usuario')) {
			$opciones = '';
			get_instance()->load->model('Model_Menu');
			$query = get_instance()->Model_Menu->allForMenu();

			foreach ($query as $opcion) {
				if ($opcion->url != '') {
					$irA = $opcion->url;
					$param = array('target'=>'_blank');
				}
				else {
					$irA = $opcion->controlador.'/'.$opcion->accion;
					$param = array();
				}
				$opciones = $opciones.'<li>'.anchor($irA, $opcion->name, $param).'</li>';
			}
		}
		return $opciones;
	}

}