<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Aws_test extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();


		$this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
		$this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
		$this->load->model('user/general_model', 'general_model');
		$this->load->model('user/configurations_model', 'configurations_model');
	}

	/* users functions starts */
	public function index()
	{
		$this->load->view('frontend/aws_test/index');
	}

	public function create_channel()
	{
		require 'amazonivs/aws-autoloader.php';
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: GET, OPTIONS");
		$data = $this->configurations_model->get_all_configurations_by_key('aws');
			// echo json_encode($data);
		// $key = $secret = '';
		// foreach($data as $key => $value) {
		// 	if($value->label == 'aws_key') {
		// 		$key = $value->value;
		// 	}
		// 	if($value->label == 'aws_secret') {
		// 		$secret = $value->value;
		// 	}
		// }
		$key = $data[0]->value;
		$secret = $data[1]->value;
		$version = $data[2]->value;
		$region = $data[3]->value;
		// echo ($key);
		// echo ($secret);
		// echo ($version);
		// echo ($region);
		// exit;
		$ivs = new Aws\IVS\IVSClient([
			'version' => $version,
			'region' => $region,
			'credentials' => [
				'key'    => $key,
				'secret' => $secret,
			],
		]);

		$result = $ivs->createChannel([
			'name' => 'Test_Channel_'.rand()
		]);
		$channel = $result->get('channel');
		$streamKey = $result->get('streamKey');
		$resp['channel_arn'] = $channel['arn'];
		$resp['playback_url'] = $channel['playbackUrl'];
		$resp['stream_url'] = 'rtmps://' . $channel['ingestEndpoint'] . ':443/app/';
		$resp['stream_arn'] = $streamKey['arn'];
		$resp['stream_key'] = $streamKey['value'];
		echo json_encode($resp);
	}
}
