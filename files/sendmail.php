<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('email@kochur.com.ua', 'Garage');
	//Кому отправить
	$mail->addAddress('glomokomo@gmail.com');
	//Тема письма
	$mail->Subject = 'Application for a call from the site "Japan"';

	//Тело письма
	$body = '<h1>Customer data</h1>';
	
	if(trim(!empty($_POST['name']))){
		$body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
	}
	if(trim(!empty($_POST['tel']))){
		$body.='<p><strong>Phone number:</strong> '.$_POST['tel'].'</p>';
	}	
	if(trim(!empty($_POST['question']))){
		$body.='<p><strong>Message:</strong> '.$_POST['question'].'</p>';
	}
	
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'You made a mistake. Check if you filled out the form correctly.'; 
		// Error
	} else {
		$message = 'The data has been sent. We will contact you shortly.';
		// Ok
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>