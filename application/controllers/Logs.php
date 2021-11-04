<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logs extends CI_Controller
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

        $this->load->model('user/users_model', 'users_model');
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function index()
    {
        $this->load->helper('file');
        $file_name = 'log-' . date('Y-m-d') . '.php';
        // echo json_encode($file_name);
        if ($_SERVER['HTTP_HOST'] == 'localhost') {
            $file_path = '/Applications/XAMPP/xamppfiles/htdocs/CodeIgniter/gigniter/application/logs/';
        } else {
            $file_path = 'https://gigniter.ca/staging/';
        }
        $string = file_get_contents($file_path . $file_name);
        $messages = explode('(*_*)', $string);
        $message_arr = array();
        foreach ($messages as $message) {
            $level = strtolower(substr($message, 0, 9));
            if ($level == 'user_info') {
                $temp['datetime'] = substr($message, 12, 31);
                // $temp['message'] = substr($message, 36);
                array_push($message_arr, $temp);
            }
        }
        echo json_encode($message_arr);
        // $this->load->view('frontend/stream/index');
    }
}
