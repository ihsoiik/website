<?php
    $email= $_GET['email'];
    $name= $_GET['name'];
    $phone= $_GET['phone'];
    $message= $_GET['message'];

    $subject = "=?utf-9?B?".base64_encode("Сообщение с сайта")."?=";
    $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

    $success = mail("admin@itproger.com", $subject, $message, $headers);
    echo $success;
?>