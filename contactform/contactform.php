<?php

//Classe do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;

// Classe do google para OAUTH
use League\OAuth2\Client\Provider\Google;


//data do servidor
date_default_timezone_set('Etc/UTC');

$err = false;
$msg = '';

//Dados para autenticação
$emailGoogle = 'jtbtrekkingtur@gmail.com';
$clientId = '898497640776-vu35d1a831ddc8shjcj915hu7cpe9lqh.apps.googleusercontent.com';
$clientSecret = 'Tuej7xWTrc0UHC1x61R3kqjz';

//Token obtido nos serviços da google
$refreshToken = '1/urzdisnsn_7NzY7KhDqTh01OOYKG_Jc4m8HWNt_rxHs';

//Dependências dos objetos PHPMailer e OAUTH
require '../vendor/autoload.php';

//Validação do assunto
if (array_key_exists('subject', $_POST)) {
        $subject = substr(strip_tags($_POST['subject']), 0, 255);
    } else {
        $subject = 'Assunto não informado';
    }
    
//Validação da mensagem
    if (array_key_exists('message', $_POST)) {
        //Limita o tamanho da mensagem
        $mensagem = substr(strip_tags($_POST['message']), 0, 16384);
    } else {
        $mensagem = '';
        $msg = 'Sem mensagem';
        $err = true;
    }

//Valida o nome
    if (array_key_exists('name', $_POST)) {
        //Limita o tamanho
        $name = substr(strip_tags($_POST['name']), 0, 255);
    } else {
        $name = '';
    }    
    
//Valida o endereço fornecido
    if (array_key_exists('email', $_POST) and PHPMailer::validateAddress($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $msg .= "Error: Endereço de e-mail invalido";
        $err = true;
    }   

    //corpo do email
    $corpo = 'Fale conosco

              Nome:    '.$name.'
              E-mail:  '.$email.'
              Assunto: '.$subject.'
              Mensagem:'.$mensagem.' ';
    
//se tudo bem começa a instanciar e carregar classe PMPMailer e Google  
if (!$err) {    
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->CharSet = 'utf-8';
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    //$mail->Host = "smtp.live.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is deprecated
    $mail->SMTPAuth = true;
    
    //Atibuição para utilização OAUTH REST
    $mail->AuthType = 'XOAUTH2';

    
    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );
    
    //Carrega o PHPMailer com os dados do OAUTH
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $emailGoogle,
            ]
        )
    );    
    
    
    $mail->setFrom('jtbtrekkingtur@gmail.com', 'Joy Travel Bureau Gmail - Cópia da mensagem enviada'); // From email and name
    $mail->addAddress($email, $name); // to email and name
    $mail->addBCC('jtbtrekkingtur@outlook.com', 'Joy Travel Bureau Outlook'); // copia oculta email and name
    $mail->Subject = $subject;
    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file
    
    //Carrega o corpo de email
    $mail->Body = $corpo;
    //$mail->AltBody = $corpo; // If html emails is not supported by the receiver, show this body

    if(!$mail->send()){
        echo "Mailer Error: " . $mail->ErrorInfo; //se deu ruim carrega a mensagem de erro
    }else{
        echo "Messagem Enviada!";
    }
}