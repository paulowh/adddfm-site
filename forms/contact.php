<?php
require_once('../assets/mail/PHPMailer.php');
require_once('../assets/mail/SMTP.php');
require_once('../assets/mail/Exception.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$arquivo = "
<html>
  <p><strong>Nome: </strong>$name</p>
  <p><strong>E-mail: </strong>$email</p>
  <p><strong>Mensagem: </strong>$message</p>
  
</html>
";
$mail = new PHPMailer;
 
try {
	// $mail->SMTPDebug = SMTP::DEBUG_SERVER;
	$mail->isSMTP();
	$mail->Host = '	mail.adddfm.org.br';
	$mail->SMTPAuth = true;
	$mail->Username = 'contato@adddfm.org.br';
	$mail->Password = '201919*adddfm';
	$mail->Port = 587;
 
	$mail->setFrom($email);
	$mail->addAddress('contato@adddfm.org.br');
	// $mail->addAddress('endereco2@provedor.com.br');
 
	$mail->isHTML(true);
	$mail->Subject = '[SISTEMA SITE] ' . $subject;
	$mail->Body = $arquivo;
	// $mail->AltBody = 'Chegou o email teste do Paulo 587';
 
	if($mail->send()) {
		echo 'Sua mensagem foi enviada. Obrigada!';

        // echo "<meta http-equiv='refresh' content='5;URL=../contact.php'>";
	} else {
		echo 'Email nao enviado';
	}

} catch (Exception $e) {
	echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
}