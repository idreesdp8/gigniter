<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email settings
| -------------------------------------------------------------------------
| Your Email servers can be specified below.
|
|
*/
$config = array(
	'protocol' => 'smtp',
	'smtp_host' => 'mail.dp8staging.com',
	'smtp_port' => 465,
	'smtp_user' => 'test@dp8staging.com',
	'smtp_pass' => 'l3E1BN&?aLM6',
	"smtp_crypto" => "ssl",
	"smtp_timeout" => "10",
	'crlf' => "\r\n",
	'newline' => "\r\n",
);
// $config = array(
// 	'protocol' => 'smtp',
// 	'smtp_host' => 'gigniter.ca',
// 	'smtp_port' => 465,
// 	'smtp_user' => 'mail@gigniter.ca',
// 	'smtp_pass' => '0s1ot4Y$',
// 	"smtp_crypto" => "ssl",
// 	"smtp_timeout" => "10",
// 	'crlf' => "\r\n",
// 	'newline' => "\r\n",
// );
$config['mailtype'] = 'html';
$config['wordwrap'] = 'true';

$config['info_email'] = 'info@gigniter.ca';
$config['support_email'] = 'support@gigniter.ca';
$config['donotreply_email'] = 'donotreply@gigniter.ca';
$config['from_name'] = 'Gigniter';
