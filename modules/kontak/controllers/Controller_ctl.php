<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Frontend
{
	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		is_logged_in();
	}


	public function index()
	{
		// LOAD TITLE
		$mydata['title'] = 'Kontak';

		// LOAD SESSION 
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');
		// LOAD DATA KONTAK 
		[
			$error, $message, $status, $result
		] = curl_get('attribut/kontak/', [
			"id_sekolah" => $id_sekolah,
			'id_wali' => $id_wali
		]);

		// DEKLARASI MYDATA 
		$mydata['result'] = $result;
		// LOAD DATA CONFIG PAGE
		$this->data['judul_halaman'] = 'Kontak';
		$this->data['button_back'] = base_url('home');
		// LOAD VIEW
		$this->data['content'] = $this->load->view('kontak', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}
}
