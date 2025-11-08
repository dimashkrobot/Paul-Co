<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';
	require 'phpmailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'smtp.gmail.com ';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'lgg3s201538@gmail.com';                     //SMTP username
	$mail->Password   = 'hzle sycs djpb cmhu';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::SSL;            //Enable implicit TLS encryption
	$mail->Port       = 465;                 
	

	// //Від кого лист
	// $mail->setFrom('lgg3s201538@gmail.com', 'Фрілансер по життю'); // Вказати потрібний E-mail
	// //Кому відправити
	// $mail->addAddress('pubgmobajl12@gmail.com'); // Вказати потрібний E-mail
	// //Тема листа
	// $mail->Subject = 'Hi, from site!';

	//Тіло листа
	$body = '<h1>Information from form</h1>';

	if(trim(!empty($_POST['email']))){
		$body.=$_POST['email'];
	}	
	
	/*
	//Прикріпити файл
	if (!empty($_FILES['image']['tmp_name'])) {
		//шлях завантаження файлу
		$filePath = __DIR__ . "/files/sendmail/attachments/" . $_FILES['image']['name']; 
		//грузимо файл
		if (copy($_FILES['image']['tmp_name'], $filePath)){
			$fileAttach = $filePath;
			$body.='<p><strong>Фото у додатку</strong>';
			$mail->addAttachment($fileAttach);
		}
	}
	*/

	$mail->Body = $body;

	//Відправляємо
	if (!$mail->send()) {
		$message = 'Error';
	} else {
		$message = 'Дані надіслані!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>