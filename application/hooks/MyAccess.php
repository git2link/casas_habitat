<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Muestra TODOS errores de validación de un formulario
if ( ! function_exists('autentificar')) {

	function autentificar() {
		$CI = & get_instance();

		$controlador = $CI->uri->segment(1);
		$accion = $CI->uri->segment(2);
		$url = $controlador.'/'.$accion;

		$libres = array(
			'/',
			'home/index',
			'home/acceso_denegado',
			'home/acerca_de',
			'home/ingreso',
			'home/ingresar',
			'home/cambio_clave',
			'home/cambiar_clave',
			'home/salir'
		);

		if(in_array($url, $libres)) {
			echo $CI->output->get_output();
		}
		else {
			if($CI->session->userdata('usuario')) {
				if(autorizar()) {
					echo $CI->output->get_output();
				}
				else {
					redirect('home/acceso_denegado');
				}
			}
			else {
				redirect('home/acceso_denegado');
			}
		}

	}

}

function autorizar() {
	$CI = & get_instance();

	// El perfil del usuario logueado
	$perfil_id = $CI->session->userdata('perfil_id');

	// Con el controlador, buscar la opción de menú
	$CI->load->library('menuLib');
	$controlador = $CI->uri->segment(1);
	$menu_id = $CI->menulib->findByControlador($controlador)->id;

	if(!$menu_id) {
		return FALSE;
	}

	// Recuperar de la tabla de permisos, la combinación Menu - Perfil
	$CI->load->library('menu_PerfilLib');
	$acceso = $CI->menu_perfillib->findByMenuAndPerfil($menu_id, $perfil_id);
	if(!$acceso) {
		return FALSE;
	}

	return TRUE;
}
