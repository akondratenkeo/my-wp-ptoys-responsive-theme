<?php

function mime_header_encode($str, $data_charset, $send_charset) {
	if($data_charset != $send_charset)
	$str=iconv($data_charset,$send_charset.'//IGNORE',$str);
	return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
}

class TEmail
{
	public $from_email;
	public $from_name;
	public $to_email;
	public $to_name;
	public $subject;
	public $data_charset='UTF-8';
	public $send_charset='windows-1251';
	public $body='';
	public $type='text/plain';

	function send(){
		$dc = $this->data_charset;
		$sc = $this->send_charset;
		$enc_to = $this->to_email;
		$enc_subject = $this->subject;
		$enc_from = $this->from_name.'<'.$this->from_email.'>';
		$enc_body = $this->body;

		$headers='';
		$headers.="Mime-Version: 1.0\r\n";
		$headers.="Content-type: text/html; charset=utf-8\r\n";
		$headers.="From: ".$enc_from."\r\n";
		return mail($enc_to, $enc_subject, $enc_body, $headers);
	}
}
