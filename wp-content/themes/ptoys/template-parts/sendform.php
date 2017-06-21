<?php

if ($_POST) {
    
	require_once('./ajax-class.php');

	$json = array();
	$json['error'] = "";

	$name = htmlspecialchars($_POST["name"]);
	$phone = htmlspecialchars($_POST["phone"]);
    
    if (!$name || !$phone) {
        $json['error'] = 'Вы заполнили не все поля!';
        echo json_encode($json);
        die();
    }

    $emailgo = new TEmail;
    $emailgo->from_email = 'noreply@pamperok.com.ua';
    $emailgo->from_name = 'Заявка на участие в акции [Pamperok]';
    $emailgo->to_email = 'vsa2006@ukr.net';
    $emailgo->to_name = '';
    $emailgo->subject = 'Новая заявка на участие в акции [Pamperok]';
    $emailgo->body = 	'<div style="background: #fffce8; border: 1px solid #cecece; padding: 15px">'.
                        '<b>Заявка от:</b><br>' . $name . '<br><br>'.
                        '<b>Телефон:</b><br>' . $phone . '<br><br>'.
                        '</div>';
    $emailgo->send();
	
	echo json_encode($json);

} else {
	echo 'GET LOST!';
}