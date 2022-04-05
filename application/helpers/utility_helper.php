<?php

function admin_asset_url()
{
	return base_url() . 'backend_assets/';
}

function user_asset_url()
{
	return base_url() . 'frontend_assets/';
}

// function assets_url(){
//    return base_url().'assets/';
// }  

function product_image_url()
{
	return base_url() . 'downloads/products_images/';
}

function product_thumbnail_image_url()
{
	return base_url() . 'downloads/products_images/thumb/';
}

function admin_base_url()
{
	return base_url() . 'index.php/admin/';
}

function user_base_url()
{
	return base_url() . 'index.php/';
}

function profile_image_relative_path()
{
	return 'downloads/profile_pictures/';
}

function profile_thumbnail_relative_path()
{
	return 'downloads/profile_pictures/thumb/';
}

function profile_image_url()
{
	return base_url() . profile_image_relative_path();
}

function profile_thumbnail_image_url()
{
	return base_url() . profile_thumbnail_relative_path();
}

function poster_relative_path()
{
	return 'downloads/posters/';
}

function session_relative_path()
{
	return 'downloads/session/';
}

function video_relative_path()
{
	return 'downloads/videos/';
}

function poster_thumbnail_relative_path()
{
	return 'downloads/posters/thumb/';
}

function session_thumbnail_relative_path()
{
	return 'downloads/session/thumb/';
}

function bundle_relative_path()
{
	return 'downloads/bundles/';
}


function bundle_thumbnail_relative_path()
{
	return 'downloads/bundles/thumb/';
}

function gig_images_relative_path()
{
	return 'downloads/gig_images/';
}

function poster_url()
{
	return base_url() . poster_relative_path();
}

function session_url()
{
	return base_url() . session_relative_path();
}

function video_url()
{
	return base_url() . video_relative_path();
}

function poster_thumbnail_url()
{
	return base_url() . poster_thumbnail_relative_path();
}

function session_thumbnail_url()
{
	return base_url() . session_thumbnail_relative_path();
}

function bundle_url()
{
	return base_url() . bundle_relative_path();
}

function gig_images_url()
{
	return base_url() . gig_images_relative_path();
}

function bundle_thumbnail_url()
{
	return base_url() . bundle_thumbnail_relative_path();
}

function barcode_relative_path()
{
	return 'downloads/barcodes/';
}

function barcode_url()
{
	return base_url() . barcode_relative_path();
}

function qrcode_relative_path()
{
	return 'downloads/tickets_qr_code_imgs/';
}

function qrcode_url()
{
	return base_url() . qrcode_relative_path();
}

function downloads_url()
{
	return base_url() . 'downloads/';
}
function send_email_helper($to_email, $subject, $template, $data = '')
{
	// $data = [$to_email, $to_name, $subject, $body];
	// return $data;
	$CI = &get_instance();
	$CI->load->library('email');
	$from_email = $CI->config->item('info_email');
	$from_name = $CI->config->item('from_name');
	$msg = $CI->load->view($template, $data, TRUE);


	$CI->email->from($from_email, $from_name);
	$CI->email->to($to_email);
	$CI->email->subject($subject);
	$CI->email->message($msg);
	//Send mail
	if ($CI->email->send()) {
		return true;
	} else {
		return false;
	}
}
function send_email_helper2($to_email, $subject, $template, $data = '')
{
	$CI = &get_instance();
	// $CI->load->model('user/configurations_model', 'configurations_model');

	$to = $to_email;

	$from_email = $CI->configurations_model->get_configuration_by_key('info_email');
	// echo json_encode($from_email);
	// die();
	$message = $CI->load->view($template, $data, TRUE);

	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From:' . $from_email->value . "\r\n";
	// $headers .= 'Cc: myboss@example.com' . "\r\n";
	$sent = mail($to, $subject, $message, $headers);
	//Send mail
	if ($sent) {
		return true;
	} else {
		return false;
	}
}
function insert_email_log($user_id, $email, $email_for)
{
	$CI = &get_instance();
	$CI->email_log_model->insert_email_log_data(['user_id' => $user_id, 'email' => $email, 'email_for' => $email_for]);
}
