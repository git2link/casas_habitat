<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class Functions {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
    }

    public function encrypt_decrypt($action,$string){
            $output = false;
            $encrypt_method = "AES-256-CBC";
            $secret_key = "Habitat";
            $secret_iv = "Seguridad";
            
            #Hash
            $key = hash("sha256", $secret_key);
            $iv = substr(hash("sha256", $secret_iv), 0, 16);

            if ($action === "encrypt") {
                $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
                //openssl_encrypt('data', 'AES-256-CBC', 'password');
                $output = base64_encode($output);
            }elseif ($action === "decrypt") {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
            return $output;
    }


    public function resizeImage( $obj_file ){
            $type       = substr($obj_file['file_upload']['type'], 6);
            $file_type  = $obj_file['file_upload']['type'];

            $name = 'photo_std.' . $type;
            
            $target_dir =   'server/usuarios/photo/';

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $target_file = $target_dir . basename( $name );
            move_uploaded_file($obj_file['file_upload']['tmp_name'], $target_file);


            header('Content-Type: ' . $file_type);

            list($width, $height) = getimagesize($target_file);
            $resize_width = 416;
            $resize_height = 312;

            $thumb = imagecreatetruecolor($resize_width, $resize_height);

            switch ($file_type) {
                case 'image/jpeg':
                    $source = imagecreatefromjpeg($target_file);
                    break;
                case 'image/png':
                    $source = imagecreatefrompng($target_file);
                    break;
                case 'image/gif':
                    $source = imagecreatefromgif($target_file);
                    break;
            }
            

            imagecopyresized($thumb, $source, 0, 0, 0, 0, $resize_width, $resize_height, $width, $height);

            $destination = $target_dir;

            $destination = $destination . $name;
            
            switch ($file_type) {
                case 'image/jpeg':
                    imagejpeg($thumb, $destination);
                    break;
                case 'image/png':
                    imagepng($thumb, $destination);
                    break;
                case 'image/gif':
                    imagegif($thumb, $destination);
                    break;
            }

            imagedestroy($source);
            imagedestroy($thumb);
    }

}
