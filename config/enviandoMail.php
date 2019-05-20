<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require APP_PATH . '/app/libraries/vendor/autoload.php';

function enviandoCorreoCuenta($destinatario, $nombreDestinatario, $password) {
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 2; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'carranzafernando99@gmail.com'; // SMTP username
		$mail->Password = 'Fernando12345'; // SMTP password
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
			),
		); // TCP port to connect to

		//Recipients
		$mail->setFrom('carranzafernando99@gmail.com', 'Fernando Ernesto Carranza Guardado');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Creacion de Cuenta';
		$mail->Body = '<center><h1>Bienvenido</h1><center>
		</br>
		<center><p>Saludos ' . $nombreDestinatario . ', se le notifica por medio de este correo que se ha creado su cuenta con exito. Se le envia su contraseña : ' . $password . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}

function enviandoCorreoCuentaCambioContrasenia($destinatario, $nombreDestinatario, $password) {
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 2; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'carranzafernando99@gmail.com'; // SMTP username
		$mail->Password = 'Fernando12345'; // SMTP password
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
			),
		); // TCP port to connect to

		//Recipients
		$mail->setFrom('carranzafernando99@gmail.com', 'Fernando Ernesto Carranza Guardado');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Recuperacion de Contraseña';
		$mail->Body = '<center><h1>Contraseña Recuperada</h1><center>
		</br>
		<center><p>Saludos ' . $nombreDestinatario . ', se le notifica por medio de este correo que se cambiado con exito su 
		contraseña. Se le envia su nueva contraseña : ' . $password . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}

function enviandoCorreoCuentaModificaContra($destinatario, $nombreDestinatario, $password) {
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 2; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'carranzafernando99@gmail.com'; // SMTP username
		$mail->Password = 'Fernando12345'; // SMTP password
		$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;
		$mail->CharSet = 'UTF-8';
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true,
			),
		); // TCP port to connect to

		//Recipients
		$mail->setFrom('carranzafernando99@gmail.com', 'Fernando Ernesto Carranza Guardado');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Cambio de Contraseña';
		$mail->Body = '<center><h1>Cambio de contraseña</h1><center>
		</br>
		<center><p>Saludos ' . $nombreDestinatario . ', se le notifica por medio de este correo que se cambiado con exito su 
		contraseña. Se le envia su contraseña de nuevo : ' . $password . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}