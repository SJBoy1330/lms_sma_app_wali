<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Frontend
{
	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
		is_logged_in();
	}


	public function index($id_siswa = NULL)
	{
		if ($id_siswa == NULL) {
			redirect('home');
		}
		// meta data
		$id_wali = $this->session->userdata('lms_wali_id_wali');

		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		// LOAD DATA
		[
			$error, $message, $status, $data
		] = curl_get(
			'rapot',
			[
				"id_sekolah" => $id_sekolah,
				"id_siswa" => $id_siswa,
				"id_wali" => $id_wali
			]
		);
		$mydata['id_siswa'] = $id_siswa;
		$mydata['result'] = $data;

		// LOAD TITLE
		$mydata['title'] = 'Rapot';
		$mydata['judul_halaman'] = tampil_text($data->detail->nama, 18);

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/rapot/tablink-wali.js"></script>';
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/rapot/rapot.js"></script>';

		// LOAD CONFIG PAGE
		$this->data['khusus']['rapot'] = true;
		$this->data['button_back'] = base_url('home');
		$this->data['config_hidden']['footer'] = true;
		$this->data['config_hidden']['notifikasi'] = true;
		$this->data['text']['white'] = true;
		// LOAD VIEW
		$this->data['content'] = $this->load->view('index', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}
}
