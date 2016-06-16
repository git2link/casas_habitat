<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* Constantes para Proveedores */
define('PROVEEDOR_NOTARIA', 				1 );
define('PROVEEDOR_UNIDAD_VALUACION', 		2 );
define('PROVEEDOR_FACILITADORES', 			3 );


/* Constantes para Perfiles */
define('PERFIL_ADMINISTRADOR', 				1);
define('PERFIL_ASESOR',		 				2);

/* Constantes para tipos de casas*/
define('CASA_VIVE',							1 );
define('CASA_SUBASTA', 						2 );
define('CASA_MA',				 			3 );

/* Constantes para estatus de casa */
define('ESTATUS_CASA_PROSPECTO',			1 );
define('ESTATUS_CASA_INVENTARIO_VENTA',		2 );
define('ESTATUS_CASA_VENDIDA',				3 );

/* Constantes para tipos de cliente */

define('TABLA_CLIENTE_COMPRAR',			'comprar' 		);
define('TABLA_CLIENTE_VENDER',			'vender'  		);
define('TABLA_CLIENTE_REMODELAR',		'remodelar'  	);
define('TABLA_CLIENTE_CONSTRUIR',		'construir'  	);
define('TABLA_CLIENTE_MANTENIMIENTO',	'mantenimiento' );


define('ESTATUS_CLIENTE_PROSPECTO',			'prospecto' );

define('NIVEL_URGENCIA_BAJA', 				1			);
define('NIVEL_URGENCIA_MEDIA', 				2			);
define('NIVEL_URGENCIA_ALTA', 				3			);


/* End of file constants.php */
/* Location: ./application/config/constants.php */