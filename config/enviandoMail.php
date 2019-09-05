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
		$mail->SMTPDebug = 0; // Enable verbose debug output
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
		if($mail->send()){
			return true;
		}else{
			return false;
		}
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
function enviandoCorreoPeticion($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $numeroQuedanOFactura, $facturaOquedan) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		if ($facturaOquedan==1) {
			$mail->Subject = 'Peticion para eliminacion de Factura';
			$mail->Body = '<center><h1>PETICION</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: '.$nombreEmisor.' ha realizado una peticion de eliminacion de un registro en el area de Factura la cual es la factura con el numero:'.$numeroQuedanOFactura.'. Le solicitamos que realice este proceso lo mas rapido posible</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		} else {
			$mail->Subject = 'Peticion para eliminacion de Quedan';
			$mail->Body = '<center><h1>PETICION</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: '.$nombreEmisor.' ha realizado una peticion de eliminacion de un registro en el area de Quedan la cual es el quedan con el numero:'.$numeroQuedanOFactura.'. Le solicitamos que realice este proceso lo mas rapido posible</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		}
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoPresupuesto($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $casa) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
			$mail->Subject = 'Presupuesto Ingresado';
			$mail->Body = '<center><h1>PRESUPUESTO INGRESADO</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: '.$nombreEmisor.' de la casa '.$casa.' ha agregado su presupuesto con exito.</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoAlerta($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $identifcador, $alerta) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		switch ($alerta) {
			//Curso a punto de finalizar
			case 1:
			$mail->Subject = 'CURSO PENDIENTE DE INFORME';
			$mail->Body = '<center>FALTA 1 DIA PAA REALIZAR EL INFORME<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el curso: '.$identifcador.' le falta un dia para finalizar el limite para enviar el informe a INSAFORP. Si ya lo envio, por favor cambiar el estado del curso en la parte de DASHBOARD</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				break;
			//Cursos pendientes de aprobacion de factura
			case 2:
			$mail->Subject = 'CURSO PENDIENTE DE APROBACION DE INFORME';
			$mail->Body = '<center><h1>APROBACION EN ESPERA</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el informe del curso: '.$identifcador.' esta esperando su aprobacion para que pase a FACTURAS.</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				break;
			case 3:
				$mail->Subject = 'CURSO PENDIENTE DE FACTURA DE INSAFORP';
				$mail->Body = '<center><h1>QUEDAN POCOS DIAS</h1><center>
				</br>
				<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el informe del curso: '.$identifcador.' esta llegando a sus dias finales para esperar la emision de factura por INSAFORP, favor contactarse con ellos.</p><center>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					break;
		}
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedan($nombreEmisor, $correoEmisor, $casa ,$nombreReceptor, $correoReceptor, $quedan, $factura) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'FACTURA AGREGADA A QUEDAN';
			$mail->Body = '<center>FACTURA AGREGADA AL QUEDAN CON EXITO<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que su factura: '.$factura.' Ha sido agregada al quedan: '.$quedan.', la cual la ingreso el usuario '.$nombreEmisor.' proveniente de la casa: '.$casa.'</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedanAbono($nombreEmisor, $correoEmisor, $casa ,$nombreReceptor, $correoReceptor, $quedan, $factura) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'QUEDAN ABONADO';
			$mail->Body = '<center>SE HA ABONADO EL DINERO DEL QUEDAN<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que la casa salesiana encargada ya realizo el abono de su quedan : '.$quedan.' en el cual se ingresa su factura: '.$factura.', la cual la ingreso el usuario '.$nombreEmisor.' proveniente de la casa: '.$casa.'. Favor verificar si esta informacion es correcta y modificar el estado su quedan</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedanFin($nombreEmisor, $correoEmisor, $casa ,$nombreReceptor, $correoReceptor, $quedan) {
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
		$mail->setFrom($correoEmisor, $nombreEmisor);
		$mail->addAddress($correoReceptor, $nombreReceptor); // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'CONFIRMACION DE ABONO DE QUEDAN';
			$mail->Body = '<center>SE HA CONFIRMADO QUE HA LLEGADO EL DINERO CORRESPONDIENTE DEL QUEDAN<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: '.$nombreEmisor.' proveniente de la casa: '.$casa.', ha confirmado el recibimiento del dinero proveniente del quedan:'.$quedan.'.</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		$mail->send();
		return true;
	} catch (Exception $e) {
		return false;
	}
}