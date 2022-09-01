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
		$mydata['title'] = 'Notifikasi';

		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');


		// LOAD CONFIG PAGE
		if ($_SERVER['HTTP_REFERER'] == NULL || $_SERVER['HTTP_REFERER'] == base_url('notifikasi')) {
			$link = base_url('home');
		} else {
			$link = $_SERVER['HTTP_REFERER'];
		}
		$this->data['button_back'] =  $link;
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['config_hidden']['footer'] = TRUE;
		$this->data['judul_halaman'] = 'Notifikasi';

		// 	GET API
		[
			$error, $message, $status, $result
		] = curl_get(
			'notifikasi',
			[
				"id_sekolah" => $id_sekolah,
				"id_wali" => $id_wali
			]
		);

		$mydata['result'] = $result;

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/page/notifikasi.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/notifikasi/notifikasi.js"></script>';

		// LOAD CONFIG PAGE
		$this->data['khusus']['notifikasi'] = TRUE;
		// LOAD VIEW
		$this->data['content'] = $this->load->view('index', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}


	public function read_notif()
	{
		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');
		$id_notifikasi = $this->input->post('id_notifikasi');
		$action =  curlPost(
			'notifikasi/read',
			[
				"id_sekolah" => $id_sekolah,
				"id_notifikasi" => $id_notifikasi
			]
		);

		echo json_encode($action);
	}

	public function detail_notif()
	{
		$id_notifikasi = $this->input->post('id_notifikasi');
		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');
		// 	GET API
		[
			$error, $message, $status, $result
		] = curl_get(
			'notifikasi',
			[
				"id_sekolah" => $id_sekolah,
				"id_wali" => $id_wali,
				"id_notifikasi_ortu" => $id_notifikasi
			]
		);
		$this->load->view('modal_notifikasi', $result);
	}

	public function hapus_all()
	{
		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_notifikasi = $this->input->post('id_notifikasi');

		$api = curlPost('notifikasi/hapus', ['id_sekolah' => $id_sekolah, 'id_notifikasi' => json_encode($id_notifikasi)]);

		$data['status'] = 200;
		$data['id_notifikasi'] = $id_notifikasi;

		sleep(1.5);
		echo json_encode($data);
	}

	public function read_all()
	{
		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_notifikasi = $this->input->post('id_notifikasi');

		$api = curlPost('notifikasi/read_all', ['id_sekolah' => $id_sekolah, 'id_notifikasi' => json_encode($id_notifikasi)]);

		$data['status'] = 200;
		// $data['load']['parent'] = '#parent_notif';
		// $data['load']['reload'] = base_url('notifikasi #reload_content_notif');
		$data['id_notifikasi'] = $id_notifikasi;

		sleep(2);
		echo json_encode($data);
	}
}
