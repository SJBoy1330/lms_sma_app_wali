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
		header("Access-Control-Allow-Origin: *");
		// LOAD TITLE
		$mydata['title'] = 'Profil';

		// Meta Data
		$mydata['nama_wali'] = $this->session->userdata('lms_wali_nama');
		$mydata['id_sekolah'] = $id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$mydata['id_wali'] = $id_wali =  $this->session->userdata('lms_wali_id_wali');

		$mydata['data'] = curl_get("profil/get", array('id_sekolah' => $id_sekolah, 'id_wali' => $id_wali))[3];
		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';
		// $this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/page/loader.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/profil/uploadfoto.js"></script>';

		// LOAD VIEW
		$this->data['content'] = $this->load->view('index', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function ubah_profil()
	{
		// LOAD TITLE
		$mydata['title'] = 'Ubah Profil';

		// Meta Data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');
		[
			$error, $message, $status, $data_profile
		] = curl_get(
			'profil',
			[
				"id_sekolah" => $id_sekolah,
				"id_wali" => $id_wali
			]
		);
		$mydata['data_wali'] = $data_profile;

		[
			$error, $message, $status, $data_agama
		] = curl_get(
			'attribut/agama',
			[
				"id_sekolah" => $id_sekolah
			]
		);
		$mydata['data_agama'] = $data_agama;

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';

		// LOAD CONFIG PAGE 
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['config_hidden']['footer'] = TRUE;
		$this->data['button_back'] = base_url('profil');
		$this->data['judul_halaman'] = 'Ubah Profil';
		$this->data['right_button']['profil'] = true;

		// LOAD VIEW
		$this->data['content'] = $this->load->view('ubah_profil', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function ubah_password()
	{
		// LOAD TITLE
		$mydata['title'] = 'Ubah Kata Sandi';

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/profil/ubahpassword.js"></script>';

		// LOAD CONFIG HALAMAN
		$this->data['judul_halaman'] = 'Ubah Kata Sandi';
		$this->data['button_back'] = base_url('profil');
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['config_hidden']['footer'] = TRUE;
		$this->data['right_button']['ubah_password'] = true;
		// LOAD VIEW
		$this->data['content'] = $this->load->view('ubah_password', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function laporan_presensi($id_siswa = NULL)
	{
		// LOAD TITLE
		$mydata['title'] = 'Laporan Presensi Siswa';

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/page/laporan_presensi.css') . '">';
		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/profil/laporan_presensi_siswa.js"></script>';

		// LOAD CONFIG PAGE

		// LOAD CONFIG PAGE
		$this->data['judul_halaman'] = 'Laporan Presensi';
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['config_hidden']['footer'] = TRUE;
		$this->data['button_back'] = base_url('profil');
		// Load meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');

		// GET API ANAK
		[
			$error, $message, $status, $data_siswa
		] = curl_get(
			'data_anak',
			[
				"id_sekolah" => $id_sekolah,
				"id_wali" => $id_wali
			]
		);
		$mydata['data_siswa'] = $data_siswa;
		if ($id_siswa == NULL) {
			$mydata['id_siswa'] = $data_siswa[0]->id_siswa;
			$mydata['id_kelas'] = $data_siswa[0]->id_kelas;
		} else {
			$mydata['id_siswa'] = $id_siswa;
		}

		// LOAD VIEW
		$this->data['content'] = $this->load->view('laporan_presensi', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function tentang_sekolah()
	{
		// LOAD TITLE
		$mydata['title'] = 'Tentang Sekolah';

		// meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		[
			$error, $message, $status, $data_sekolah
		] = curl_get(
			'profil/tentang_sekolah',
			[
				"id_sekolah" => $id_sekolah,
			]
		);
		$mydata['data_sekolah'] = $data_sekolah->sekolah;
		$mydata['count_siswa'] = $data_sekolah->jumlah->siswa;
		$mydata['count_staf'] = $data_sekolah->jumlah->staf;

		// LOAD CONFIG HALAMAN
		$this->data['button_back'] = base_url('profil');
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['config_hidden']['footer'] = TRUE;
		$this->data['judul_halaman'] = 'Tentang Sekolah';

		// HIDDEN FOOTER
		$mydata['config_hidden']['footer'] = true;
		$mydata['config_hidden']['button_back'] = true;

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';

		// LOAD VIEW
		$this->data['content'] = $this->load->view('tentang_sekolah', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function bantuan()
	{
		// LOAD TITLE
		$mydata['title'] = 'Bantuan';

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/profil/bantuan.js"></script>';


		// LOAD API 
		[
			$error, $message, $status, $data
		] = curl_get(
			'attribut/bantuan/',
			NULL
		);
		$mydata['result'] = $data;
		// LOAD CONFIG HALAMAN
		$this->data['button_back'] = base_url('profil');
		$this->data['config_hidden']['notifikasi'] = TRUE;
		$this->data['judul_halaman'] = 'Bantuan';

		// LOAD VIEW
		$this->data['content'] = $this->load->view('bantuan', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function get_detail_bantuan()
	{
		$id_bantuan = $this->input->post('id_bantuan');
		// LOAD API 
		[
			$error, $message, $status, $data
		] = curl_get(
			'attribut/bantuan/',
			['id_bantuan' => $id_bantuan]
		);

		$this->load->view('modal_detail_bantuan', $data);
	}

	public function get_report_absen()
	{
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_siswa = $this->input->post('id_siswa');

		$date = strtotime($this->input->post('date'));
		$hari = day_from_number(date('N', $date));
		$bulan = month_from_number(date('m', $date));
		$mydata['tanggal'] = $hari . ', ' . date('d', $date) . ' ' . $bulan . ' ' . date('Y', $date);

		// LOAD API 
		[
			$error, $message, $status, $data
		] = curl_get(
			'profil/laporan',
			[
				'id_sekolah' => $id_sekolah,
				'id_siswa' => $id_siswa,
				'tanggal' => date('Y-m-d', $date)
			]
		);
		$mydata['result'] = $data;
		$this->load->view('display_laporan', $mydata);
	}
}
