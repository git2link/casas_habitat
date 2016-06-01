<?php if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class Mail {

	function __construct() {
		$this->CI = & get_instance(); // Esto para acceder a la instancia que carga la librería
    }

    public function simple_mail( $subject, $address, $body ) {
        require_once 'application/libraries/phpmailer/settings.php';
        require_once 'application/libraries/phpmailer/class.phpmailer.php';
        $mail = new PHPMailer();
        $mail->CharSet      = MAIL_CHARSET;
        $mail->IsSMTP();
        $mail->Port         = MAIL_PORT;
        $mail->SMTPAuth     = true;
        $mail->Mailer       = MAIL_MAILER;
        $mail->Host         = MAIL_HOST;
        $mail->Username     = MAIL_USERNAME;
        $mail->Password     = MAIL_PASS;
        $mail->SMTPSecure   = MAIL_SMTPSECURE;
        $mail->SetFrom('casas_habitat@sistemas2link.com','Casas Habitat');
        $mail->Subject = $subject;
        $mail->AddAddress( $address );
        $mail->MsgHTML($body);
        //$mail->AddBCC('luismedina216@gmail.com','Luis Medina');
        $request = $mail->Send();
        $mail->ClearAllRecipients();
        return $request;
    }

}
