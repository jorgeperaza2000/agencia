<?php
function enviaEmail($emailTo, $subject, $body, $server = "") {

	date_default_timezone_set('America/Caracas');

	require_once 'vendor/PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	$mail->isSMTP();

	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;

	$mail->Debugoutput = 'html';

	if ( $server == "gmail" ) {
		
		$mail->Host       = 'smtp.gmail.com'; // SMTP host
		$mail->Port       = 587; // SMTP open port
		$mail->SMTPAuth   = 'tls';
		$mail->SMTPSecure = false;
		$mail->Username   = 'jorgeperaza2000@gmail.com'; // SMTP username
		$mail->Password   = '18534098';

		$mail->setFrom("jorgeperaza2000@gmail.com", "vPortal");
	} else {
		$mail->Host       = 'smtp.zoho.com'; // SMTP host
		$mail->Port       = 587; // SMTP open port
		$mail->SMTPAuth   = 'tls';
		$mail->SMTPSecure = false;
		$mail->Username   = 'jperaza@codefull.com.ve'; // SMTP username
		$mail->Password   = 'Cucu0101**';

		$mail->setFrom("jperaza@codefull.com.ve", "vPortal");
	}
	

	if ( !empty( $emailTo ) ) {
		foreach($emailTo as $email => $name) {
			if ( !empty( $name ) )  {
				$mail->addAddress($email, $name);
			} else {
				$mail->addAddress($email);
			}
		}
	}

	$mail->Subject = $subject;

	if ( !empty( $body ) ){
		$mail->msgHTML($body);
	}

	if (!$mail->send()) {
	    return "error";
	} else {
		return "ok";
	}
}
