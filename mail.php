<?php
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