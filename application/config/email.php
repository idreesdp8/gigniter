<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email settings
| -------------------------------------------------------------------------
| Your Email servers can be specified below.
|
|
*/
$config = Array(
	'protocol' => 'smtp',
	'smtp_host' => 'mail.dp8staging.com',
	'smtp_port' => 465,
	'smtp_user' => 'test@dp8staging.com',
	'smtp_pass' => 'l3E1BN&?aLM6',
	"smtp_crypto"=> "tls",
	"smtp_timeout"=> "10",
	'crlf' => "\r\n",
	'newline' => "\r\n",
  );
$config['mailtype'] = 'html';
$config['wordwrap'] = 'true';

$config['info_email'] = 'info@gigniter.com';
$config['support_email'] = 'support@gigniter.com';
$config['donotreply_email'] = 'donotreply@gigniter.com';
$config['from_name'] = 'Gigniter';

