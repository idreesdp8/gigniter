<?php
$email_config = array(
'email_address' => 'hamza0952454@gmail.com',
'email_name' => 'Hamza Bhatti',
'email_password' => '2777a16b9398ac',
'email_subject' => 'Password Reset Code',
'email_username' => '28f97a1a718e43',
'smtp_host' => 'smtp.mailtrap.io',
'smtp_port' => '2525',
'smtp_encrypt' => 'tls'
);

$to = "hamza0952454@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: info@gigniter.com" . "\r\n" .
"CC: somebodyelse@example.com";

if(mail($to,$subject,$txt,$headers)) {
    echo 'Mail sent';
} else {
    echo 'Erro';
}
?>