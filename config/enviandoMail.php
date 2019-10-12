<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require APP_PATH . '/app/libraries/vendor/autoload.php';


function enviandoCorreoCuenta($destinatario, $nombreDestinatario, $password)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		$mail->setFrom('sgcs_administrador@ricaldone.edu.sv', 'SGCS');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Creacion de Cuenta';
		$mail->Body = '<center><h1>Bienvenido</h1><center>
		</br>
		<center><p>Saludos ' . $nombreDestinatario . ', se le notifica por medio de este correo que se ha creado su cuenta con exito. Se le envia su contraseña : ' . $password . '<br>Ingresar a esta URL:http://sgcs.ricaldone.edu.sv/dashboard/login</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}

function enviandoCorreoCuentaCambioContrasenia($destinatario, $nombreDestinatario, $password)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		$mail->setFrom('sgcs_administrador@ricaldone.edu.sv', 'SGCS');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Recuperacion de Contraseña';
		$mail->Body = '<center><h1>Contraseña Recuperada</h1><center>
		</br>
		<center><p>Saludos, se le notifica por medio de este correo que se cambiado con exito su
		contraseña. Se le envia su nueva contraseña : ' . $password . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}

function enviandoCorreoCuentaModificaContra($destinatario, $nombreDestinatario, $password)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		$mail->setFrom('sgcs_administrador@ricaldone.edu.sv', 'SGCS');
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Cambio de Contraseña';
		$mail->Body = '<center><h1>Cambio de contraseña</h1><center>
		</br>
		<center><p>Saludos ' . $nombreDestinatario . ', se le notifica por medio de este correo que se cambiado con exito su
		contraseña. Se le envia su contraseña de nuevo : ' . $password . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoPeticion($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $numeroQuedanOFactura, $facturaOquedan)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		//Content
		$mail->isHTML(true); // Set email format to HTML
		if ($facturaOquedan == 1) {
			$mail->Subject = 'Peticion para eliminacion de Factura';
			$mail->Body = '<center><h1>PETICION</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: ' . $nombreEmisor . ' ha realizado una peticion de eliminacion de un registro en el area de Factura la cual es la factura con el numero:' . $numeroQuedanOFactura . '. Le solicitamos que realice este proceso lo mas rapido posible</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		} else {
			$mail->Subject = 'Peticion para eliminacion de Quedan';
			$mail->Body = '<center><h1>PETICION</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: ' . $nombreEmisor . ' ha realizado una peticion de eliminacion de un registro en el area de Quedan la cual es el quedan con el numero:' . $numeroQuedanOFactura . '. Le solicitamos que realice este proceso lo mas rapido posible</p><center>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		}
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoPresupuesto($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $casa)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'Presupuesto Ingresado';
		$mail->Body = '<center><h1>PRESUPUESTO INGRESADO</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: ' . $nombreEmisor . ' de la casa ' . $casa . ' ha agregado su presupuesto con exito.</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoAlerta($nombreEmisor, $correoEmisor, $nombreReceptor, $correoReceptor, $identifcador, $alerta)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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

		//Content
		$mail->isHTML(true); // Set email format to HTML
		switch ($alerta) {
				//Curso a punto de finalizar
			case 1:
				$mail->Subject = 'CURSO PENDIENTE DE INFORME';
				$mail->Body = '<center>FALTA 1 DIA PAA REALIZAR EL INFORME<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el curso: ' . $identifcador . ' le falta un dia para finalizar el limite para enviar el informe a INSAFORP. Si ya lo envio, por favor cambiar el estado del curso en la parte de DASHBOARD</p><center>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				break;
				//Cursos pendientes de aprobacion de factura
			case 2:
				$mail->Subject = 'CURSO PENDIENTE DE APROBACION DE INFORME';
				$mail->Body = '<center><h1>APROBACION EN ESPERA</h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el informe del curso: ' . $identifcador . ' esta esperando su aprobacion para que pase a FACTURAS.</p><center>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				break;
			case 3:
				$mail->Subject = 'CURSO PENDIENTE DE FACTURA DE INSAFORP';
				$mail->Body = '<center><h1>QUEDAN POCOS DIAS</h1><center>
				</br>
				<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el informe del curso: ' . $identifcador . ' esta llegando a sus dias finales para esperar la emision de factura por INSAFORP, favor contactarse con ellos.</p><center>';
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
				break;
		}
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedan($nombreEmisor, $correoEmisor, $casa, $nombreReceptor, $correoReceptor, $quedan, $factura)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'FACTURA AGREGADA A QUEDAN';
		$mail->Body = '<center>FACTURA AGREGADA AL QUEDAN CON EXITO<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que su factura: ' . $factura . ' Ha sido agregada al quedan: ' . $quedan . ', la cual la ingreso el usuario ' . $nombreEmisor . ' proveniente de la casa: ' . $casa . '</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedanAbono($nombreEmisor, $correoEmisor, $casa, $nombreReceptor, $correoReceptor, $quedan, $factura)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = 'QUEDAN ABONADO';
		$mail->Body = '<center>SE HA ABONADO EL DINERO DEL QUEDAN<h1></h1><center>
			</br>
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que la casa salesiana encargada ya realizo el abono de su quedan : ' . $quedan . ' en el cual se ingresa su factura: ' . $factura . ', la cual la ingreso el usuario ' . $nombreEmisor . ' proveniente de la casa: ' . $casa . '. Favor verificar si esta informacion es correcta y modificar el estado su quedan</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviandoCorreoQuedanFin($nombreEmisor, $correoEmisor, $casa, $nombreReceptor, $correoReceptor, $quedan)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'sgcs_administrador@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'superadminricaldoneitr2019'; // SMTP password
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
			<center><p>Saludos ' . $nombreReceptor . ', por este correo se le notifica que el usuario: ' . $nombreEmisor . ' proveniente de la casa: ' . $casa . ', ha confirmado el recibimiento del dinero proveniente del quedan:' . $quedan . '.</p><center>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}

function enviarCorreoInvitacion($codigoEvento, $evento, $destinatario, $nombreDestinatario, $fotoEvento, $corrEven, $profesion)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		if ($corrEven == 1) {
			$mail->Username = 'eventos@ricaldone.edu.sv'; // SMTP username
			$mail->Password = 'eventosricaldone2019'; // SMTP password
		} else {
			$mail->Username = 'eventos_cfp@ricaldone.edu.sv'; // SMTP username
			$mail->Password = 'eventosricaldone2019'; // SMTP password
		}
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
		//Recipients
		if ($corrEven == 1) {
			$mail->setFrom('eventos@ricaldone.edu.sv', 'Instituto Tecnico Ricaldone');
		} else {
			$mail->setFrom('eventos_cfp@ricaldone.edu.sv', 'Centro de Formación Profesional');
		}
		$mail->addAddress($destinatario, $nombreDestinatario); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $evento;
		$mail->Body = '
<div style="background-color: #eee !important;    margin: 0;">
    <div style="    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		text-align: center;
		">
            <img src="http://sgcs.ricaldone.edu.sv/logos/RICALDONE.png" width="15%" style="margin-top: 20px; margin-bottom: 15px;" alt="imagenEvento">
        </div>
    </div>
    <div style="    margin-left: auto;
    margin-right: auto;
	margin-bottom: 20px;
	width: 85%;
	margin: 0 auto;
	max-width: 1280px;
	background-color: #fff !important;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;">
            <h6 style="font-size: 1rem;
			line-height: 110%;
			display: block;
			margin: .7666666667rem 0 .46rem 0;
			margin-block-start: 2.33em;
			margin-block-end: 2.33em;
			margin-inline-start: 0px;
			margin-inline-end: 0px;">Buen día: '.$profesion.' ' . $nombreDestinatario . ', La Oficina
                de Intermediación Laboral del CFP Ricaldone, se complace en invitarle al evento denominado: Desayuno
                Empresarial, a desarrollarse el día 9 de octubre del corriente a partir de las 7:30 am.</h6>
        </div>

        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		text-align: center;">
            <img src="http://sgcs.ricaldone.edu.sv/web/eventos/' . $fotoEvento . '" width="50%" alt="imagenEvento">
        </div>
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		text-align: center;">
            <a style="position: relative;
			cursor: pointer;
			display: inline-block;
			overflow: hidden;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-tap-highlight-color: transparent;
			vertical-align: middle;
			z-index: 1;
			-webkit-transition: .3s ease-out;
			transition: .3s ease-out;
			text-decoration: none;
    color: #fff;
    background-color: #26a69a;
    text-align: center;
    letter-spacing: .5px;
    -webkit-transition: background-color .2s ease-out;
    transition: background-color .2s ease-out;
	cursor: pointer;
	font-size: 14px;
	outline: 0;
	border: none;
    border-radius: 2px;
    display: inline-block;
    height: 36px;
    line-height: 36px;
    padding: 0 16px;
    text-transform: uppercase;
    vertical-align: middle;
	-webkit-tap-highlight-color: transparent;
	-webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
	box-shadow: 0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.2);
	color: #000 !important;
	background-color: #ffc107 !important;
		" href="http://sgcs.ricaldone.edu.sv/confirmacion.php?token=' . $codigoEvento . '">
                Confirmar asistencia 
            </a>
            <br>
        </div>
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		background-color: black;">
            <div style="    margin-left: -.75rem;
			margin-right: -.75rem;
			margin-bottom: 20px;
			text-align: center;
			box-sizing: inherit">
                <div>
					<h6 style="    color: #fff !important;
					font-size: 1.15rem;
    line-height: 110%;
	margin: .7666666667rem 0 .46rem 0;
	box-sizing: inherit;
	display: block;
    font-size: 0.67em;
    margin-block-start: 2.33em;
    margin-block-end: 2.33em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;">SALESIANOS</h6>
                </div>
				<div style="
				width: 100%;
				margin-left: auto;
				left: auto;
				right: auto;    float: left;
				-webkit-box-sizing: border-box;
				box-sizing: border-box;
				padding: 0 .75rem;
				min-height: 1px;
				">
                    <a href="https://www.facebook.com/ricaldone.itr/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/facebook.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.instagram.com/ricaldone/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/instagram.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://twitter.com/ricaldone_itr" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/twitter.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.youtube.com/user/ITecnicoRicaldone" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/youtube.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                </div>
            </div>
        </div>
    </div>
</div>
		';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}

function enviarCorreoConfirmacionPersona($nombre, $correo, $evento, $corrEven)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		if ($corrEven == 1) {
			$mail->Username = 'eventos@ricaldone.edu.sv'; // SMTP username
			$mail->Password = 'eventosricaldone2019'; // SMTP password
		} else {
			$mail->Username = 'eventos_cfp@ricaldone.edu.sv'; // SMTP username
			$mail->Password = 'eventosricaldone2019'; // SMTP password
		}
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
		if ($corrEven == 1) {
			$mail->setFrom('eventos@ricaldone.edu.sv', 'Instituto Tecnico Ricaldone');
		} else {
			$mail->setFrom('eventos_cfp@ricaldone.edu.sv', 'Centro de Formación Profesional');
		}

		$mail->addAddress($correo, $nombre); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = $evento;
		$mail->Body = '
<div style="background-color: #eee !important;    margin: 0;">
    <div style="    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		text-align: center;
		">
            <img src="http://sgcs.ricaldone.edu.sv/logos/RICALDONE.png" width="15%" style="margin-top: 20px; margin-bottom: 15px;" alt="imagenEvento">
        </div>
    </div>
    <div style="    margin-left: auto;
    margin-right: auto;
	margin-bottom: 20px;
	width: 85%;
	margin: 0 auto;
	max-width: 1280px;
	background-color: #fff !important;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;">
            <h6 style="font-size: 1.15rem;
			line-height: 110%;
			display: block;
			margin: .7666666667rem 0 .46rem 0;
			margin-block-start: 2.33em;
			margin-block-end: 2.33em;
			margin-inline-start: 0px;
			margin-inline-end: 0px;">Buen día: '.$nombre.', se ha confirmado con exito su asistencia al evento: '.$evento.'. Lo esperamos.</h6>
        </div>
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		background-color: black;">
            <div style="    margin-left: -.75rem;
			margin-right: -.75rem;
			margin-bottom: 20px;
			text-align: center;
			box-sizing: inherit">
                <div>
					<h6 style="    color: #fff !important;
					font-size: 1.15rem;
					line-height: 110%;
					margin: .7666666667rem 0 .46rem 0;
					box-sizing: inherit;
					display: block;
					font-size: 0.67em;
					margin-block-start: 2.33em;
					margin-block-end: 2.33em;
					margin-inline-start: 0px;
					margin-inline-end: 0px;
					font-weight: bold;">SALESIANOS</h6>
                </div>
				<div style="
				width: 100%;
				margin-left: auto;
				left: auto;
				right: auto;    float: left;
				-webkit-box-sizing: border-box;
				box-sizing: border-box;
				padding: 0 .75rem;
				min-height: 1px;
				">
                    <a href="https://www.facebook.com/ricaldone.itr/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/facebook.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.instagram.com/ricaldone/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/instagram.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://twitter.com/ricaldone_itr" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/twitter.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.youtube.com/user/ITecnicoRicaldone" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/youtube.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                </div>
            </div>
        </div>
    </div>
</div>
		';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
function enviarCorreoConfirmacionEncargado($nombre, $correo, $evento, $contacto)
{
	$mail = new PHPMailer(true); // Passing `true` enables exceptions
	try {
		//Server settings
		$mail->SMTPDebug = 0; // Enable verbose debug output
		$mail->isSMTP(); // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'eventos@ricaldone.edu.sv'; // SMTP username
		$mail->Password = 'eventosricaldone2019'; // SMTP password
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
		$mail->setFrom('eventos@ricaldone.edu.sv', 'Instituto Tecnico Ricaldone');
		$mail->addAddress('eventos_cfp@ricaldone.edu.sv', 'CFP'); // Add a recipient
		//Content
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject = "Confirmación del Evento: ". $evento;
		$mail->Body = '
<div style="background-color: #eee !important;    margin: 0;">
    <div style="    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		text-align: center;
		">
            <img src="http://sgcs.ricaldone.edu.sv/logos/RICALDONE.png" width="15%" style="margin-top: 20px; margin-bottom: 15px;" alt="imagenEvento">
        </div>
    </div>
    <div style="    margin-left: auto;
    margin-right: auto;
	margin-bottom: 20px;
	width: 85%;
	margin: 0 auto;
	max-width: 1280px;
	background-color: #fff !important;">
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;">
            <h6 style="font-size: 1.15rem;
			line-height: 110%;
			display: block;
			margin: .7666666667rem 0 .46rem 0;
			margin-block-start: 2.33em;
			margin-block-end: 2.33em;
			margin-inline-start: 0px;
			margin-inline-end: 0px;">Buen día: '.$nombre.', el contacto: '.$contacto.' ha confirmado su asistencia al evento: '.$evento.'. Favor verificar en sistema la confirmacion del contacto.</h6>
        </div>
        <div style="width: 100%;
		margin-left: auto;
		left: auto;
		right: auto;
		float: left;
		box-sizing: border-box;
		padding: 0 .75rem;
		min-height: 1px;
		background-color: black;">
            <div style="    margin-left: -.75rem;
			margin-right: -.75rem;
			margin-bottom: 20px;
			text-align: center;
			box-sizing: inherit">
                <div>
					<h6 style="    color: #fff !important;
					font-size: 1.15rem;
    line-height: 110%;
	margin: .7666666667rem 0 .46rem 0;
	box-sizing: inherit;
	display: block;
    font-size: 0.67em;
    margin-block-start: 2.33em;
    margin-block-end: 2.33em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;">SALESIANOS</h6>
                </div>
				<div style="
				width: 100%;
				margin-left: auto;
				left: auto;
				right: auto;    float: left;
				-webkit-box-sizing: border-box;
				box-sizing: border-box;
				padding: 0 .75rem;
				min-height: 1px;
				">
                    <a href="https://www.facebook.com/ricaldone.itr/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/facebook.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.instagram.com/ricaldone/" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/instagram.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://twitter.com/ricaldone_itr" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/twitter.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                    <a href="https://www.youtube.com/user/ITecnicoRicaldone" target="_blank"><img src="http://sgcs.ricaldone.edu.sv/web/img/redes/youtube.png" width="20px" style="margin: 20px; margin-top: 5px;" alt="imagenEvento"></a>
                </div>
            </div>
        </div>
    </div>
</div>
		';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	} catch (Exception $e) {
		return false;
	}
}
