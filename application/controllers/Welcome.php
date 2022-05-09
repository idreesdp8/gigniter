<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	
	public function index2()
	{
		require 'vendor/autoload.php';
	
		// instantiate and use the dompdf class
		$dompdf = new Dompdf\Dompdf();

		$html = $this->load->view('welcome_message',[],true);

		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');

		// Render the HTML as PDF
		$dompdf->render();

		// Get the generated PDF file contents
		$pdf = $dompdf->output();

		// Output the generated PDF to Browser
		$dompdf->stream();
	}

	public function test()
	{
		$this->load->model('admin/gigs_model', 'gigs_model');
		$data = [
			'is_approved' => 1,
			'is_rejected' => 0,
			'is_draft' => 0,
			'status' => 1,
			'is_highlighted' => 1,
		];
		$this->gigs_model->update_gig_data(222, $data);
		return 'Done';
		// $this->load->library('email');
		// $from_email = $this->config->item('info_email');
		// $from_name = $this->config->item('from_name');
		// $data['link'] = user_base_url() . 'account/reset_password/' . $this->general_model->safe_ci_encoder('hamza0952454@gmail.com');
		// $msg = $this->load->view('email/forgot_password', $data, TRUE);
		// $this->email->from($from_email, $from_name);
		// $this->email->to('hamza0952454@gmail.com');
		// $this->email->subject('verification');
		// $this->email->message($msg);
	}
}
