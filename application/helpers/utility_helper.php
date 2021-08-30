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

function currency_format($amount, $format)
{
	$fmt = new NumberFormatter($format, NumberFormatter::CURRENCY);
	return $fmt->formatCurrency($amount, "USD");
}
