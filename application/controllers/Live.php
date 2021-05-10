<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Aws\S3\S3Client;
use Aws\IVS\IVSClient;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
// use Monolog\Handler\StreamHandler;
// use Monolog\Logger;

class Live extends CI_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();

        $this->dbs_user_id = $vs_id = $this->session->userdata('us_id');
        $this->dbs_user_email = $vs_email = $this->session->userdata('us_email');
        $this->login_vs_role_id = $this->dbs_role_id = $vs_role_id = $this->session->userdata('us_role_id');
        $this->load->model('user/general_model', 'general_model');
        $this->load->model('user/permissions_model', 'permissions_model');
        // if(isset($vs_id) && (isset($vs_role_id) && $vs_role_id>=1)){

        // // 	$res_nums = $this->general_model->check_controller_permission_access('Admin/Users',$vs_role_id,'1');
        // // 	if($res_nums>0){

        // // 	}else{
        // // 		redirect('/');
        // // 	} 
        // }else{
        // 	redirect('login');
        // }

        $this->load->model('user/users_model', 'users_model');
        $this->load->model('user/configurations_model', 'configurations_model');
        // $this->load->model('user/countries_model', 'countries_model');
        $this->load->model('user/bookings_model', 'bookings_model');
        $this->load->model('user/gigs_model', 'gigs_model');
        // $perms_arrs = array('role_id' => $vs_role_id);
        $this->gig_status_key = 'gig-status';
        $this->genre_key = 'genre';
        $this->category_key = 'category';

        // $this->load->library('Ajax_pagination');
        // $this->perPage = 25;
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->view('frontend/stream/index');
    }

    public function record()
    {
        $this->load->view('frontend/stream/record');
    }
    public function record2()
    {
        $this->load->view('frontend/stream/record2');
    }

    public function agora($host = '')
    {
        $data['host'] = $host;
        $this->load->view('frontend/stream/agora', $data);
    }

    public function fetch_stream()
    {
        // require 'vendor/autoload.php';
        require 'amazonivs/aws-autoloader.php';

        $bucket = 'gigniter-bucket-122';
        $keyname = 'gigniter-bucket-122';
        $ivs = new Aws\IVS\IVSClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key'    => $awskey, //'<MYKEY>',
                'secret' => $awssecret, //'<MYSECRET>'
                //'key'    => $this->config->item('amazon_key'),
                //'secret' => $this->config->item('amazon_secret'),
            ],
        ]);

        $result1 = $ivs->listChannels(['filterByName' => 'Gigniter_2']); //['filterByName' => 'Gigniter_2']	


        //$result = $ivs->getRecordingConfiguration([/* ... */]);

        /*[
            'maxResults' => <integer>,
            'nextToken' => '<string>',
        ]
        */

        $video_url = '';

        if (isset($result1["channels"][0]["arn"])) {

            $arn = $result1["channels"][0]["arn"];
            $name = $result1["channels"][0]["name"];
            $latencyMode = $result1["channels"][0]["latencyMode"];
            $authorized = $result1["channels"][0]["authorized"];
            $recordingConfigurationArn  = $result1["channels"][0]["recordingConfigurationArn"];


            $result2 = $ivs->listRecordingConfigurations([
                'recordingConfigurations' => [
                    [
                        'arn' => "$recordingConfigurationArn",
                        'state' => 'ACTIVE',
                    ],
                ],
            ]);
            //print_r($result);  

            $recording_name = ($result2["recordingConfigurations"][0]["name"]);
            $recording_bucket_name =  ($result2["recordingConfigurations"][0]["destinationConfiguration"]["s3"]["bucketName"]);

            $client = new Aws\S3\S3Client([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => [
                    'key'    => $awskey, //'<MYKEY>',
                    'secret' => $awssecret, //'<MYSECRET>' 
                ],
            ]);

            $object = "test-video.mp4";
            $data['video_url'] = $client->getObjectUrl("$recording_bucket_name", $object);

            /*echo "<pre>";
            print_r($result3);
            echo "<pre>";
            
            exit;
            
            
            $result3 = $client->listObjects([
            'Bucket' => "$recording_bucket_name", //'gigniter-bucket-122', // REQUIRED
                'Delimiter' => '<string>',
                'EncodingType' => 'url',
                'ExpectedBucketOwner' => '<string>',
                'Marker' => '<string>',
                'MaxKeys' => <integer>,
                'Prefix' => '<string>',
                'RequestPayer' => 'requester',
            ]);
            
            echo "<pre>";
            print_r($result3);
            echo "<pre>";
            
            exit;*/

            //$object = "test-video.mp4";
            //echo $url = $client->getObjectUrl('gigniter-bucket-122', $object, "+10 minutes");
            //exit; 
        $this->load->view('frontend/stream/fetch', $data);
        }
    }

    public function amazonivs()
    {
        // $s3Client = new S3Client([
        //     'region' => 'REGION',
        //     'version' => '2006-03-01',
        // ]);
        require 'amazonivs/aws-autoloader.php';
        $ivs = new Aws\IVS\IVSClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key'    => $this->config->item('amazon_key'),
                'secret' => $this->config->item('amazon_secret'),
            ],
        ]);
        $s3 = new Aws\S3\S3Client([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => [
                'key'    => $this->config->item('amazon_key'),
                'secret' => $this->config->item('amazon_secret'),
            ],
        ]);
        $result = $s3->createBucket([
            'Bucket' => 'gigniter_bucket', // REQUIRED
        ]);
        // echo json_encode($s3);
        // die();

        // $result = $ivs->getChannel([
        //     'arn' => 'arn:aws:ivs:us-east-1:305842570590:channel/rXHpeVV22c6C'
        // ]);
        // $result = $ivs->listStreamKeys([
        //     'channelArn' => 'arn:aws:ivs:us-east-1:305842570590:channel/rXHpeVV22c6C'
        // ]);
        // $stream_keys = $result->get('streamKeys');
        // $stream_arn = '';
        // foreach($stream_keys as $stream_key) {
        //     $stream_arn = $stream_key['arn'];
        // }
        // // // echo $stream_arn;
        // $result = $ivs->getStreamKey([
        //     'arn' => $stream_arn
        // ]);
        // $result = $ivs->getStream([
        //     'channelArn' => 'arn:aws:ivs:us-east-1:305842570590:channel/rXHpeVV22c6C'
        // ]);
        // $result = $ivs->stopStream([
        //     'channelArn' => 'arn:aws:ivs:us-east-1:305842570590:channel/l8VkxGC66GJN'
        // ]);
        // $result = $ivs->createChannel([
        //     'name' => 'Gigniter_2'
        // ]);
        // echo json_encode($result->get('channel'));

        echo $result;
        die();


        $data = array();
        $this->load->view('frontend/stream/amazonivs', $data);
    }

    public function my_shows()
    {
        $dbs_user_email = $this->dbs_user_email;
        $dbs_user_id = $this->dbs_user_id;
        // $user = $this->users_model->get_user_by_email($dbs_user_email);
        // $gigs = $this->gigs_model->get_upcoming_user_gigs($user_id);
        // $bookings = $this->bookings_model->get_bookings_by_user_id($user->id);
        $tickets = $this->bookings_model->get_tickets_by_user($dbs_user_email, $dbs_user_id);
        // echo json_encode($tickets);die();
        $gigs = [];
        $now = new DateTime();
        foreach ($tickets as $ticket) {
            $cart = $this->bookings_model->get_booking_item_by_id($ticket->cart_id);
            // echo json_encode($cart);die();

            $temp = $this->gigs_model->get_gig_by_id($cart->gig_id);
            $user = $this->users_model->get_user_by_id($temp->user_id);
            $temp->user_name = $user->fname . ' ' . $user->lname;
            $args1 = [
                'key' => $this->genre_key,
                'value' => $temp->genre
            ];
            $genre = $this->configurations_model->get_configuration_by_key_value($args1);
            $temp->genre_name = $genre->label;
            $args2 = [
                'key' => $this->category_key,
                'value' => $temp->category
            ];
            $category = $this->configurations_model->get_configuration_by_key_value($args2);
            $temp->category_name = $category->label;
            $gig_date = new DateTime($temp->gig_date);
            $interval = $gig_date->diff($now);
            $temp->days_left = $interval->format('%a');
            $gigs[] = $temp;
        }
        $data['gigs'] = $gigs;
        $this->load->view('frontend/live/my_shows', $data);
        // echo json_encode($shows);
    }
}
