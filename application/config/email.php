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
	'smtp_host' => 'ssl://smtp.gmail.com',
	'smtp_port' => 465,
	'smtp_user' => 'sirwalwfanilas@gmail.com',
	'smtp_pass' => 'DigitalPoin8',
	'crlf' => "\r\n",
	'newline' => "\r\n",
  );
$config['mailtype'] = 'html';
$config['wordwrap'] = 'true';

$config['info_email'] = 'info@gigniter.com';
$config['support_email'] = 'support@gigniter.com';
$config['donotreply_email'] = 'donotreply@gigniter.com';
$config['from_name'] = 'Gigniter';

