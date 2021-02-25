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
	'smtp_host' => 'smtp.mailtrap.io',
	'smtp_port' => 2525,
	'smtp_user' => '28f97a1a718e43',
	'smtp_pass' => '2777a16b9398ac',
	'crlf' => "\r\n",
	'newline' => "\r\n",
  );
$config['mailtype'] = 'html';
$config['wordwrap'] = 'true';

$config['info_email'] = 'info@gigniter.com';
$config['support_email'] = 'support@gigniter.com';
$config['donotreply_email'] = 'donotreply@gigniter.com';
$config['from_name'] = 'Gigniter';

