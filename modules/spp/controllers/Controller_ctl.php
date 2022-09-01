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
		// LOAD TITLE
		$mydata['title'] = 'SPP';

		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');


		$tahun = $this->input->get('tahun');
		$bulan = $this->input->get('bulan');
		$kategori = $this->input->get('kategori');
		$lunas = $this->input->get('lunas');

		[
			$error, $message, $status, $data_siswa
		] = curl_get(
			'data_anak',
			[
				"id_sekolah" => $id_sekolah,
				"id_wali" => $id_wali
			]
		);

		if ($id_siswa == null) {
			$id_siswa = $data_siswa[0]->id_siswa;
			$mydata['id_siswa'] = $id_siswa;
		} else {
			$mydata['id_siswa'] = $id_siswa;
		}
		$mydata['data_siswa'] = $data_siswa;

		if ($tahun) {
			$arrSpp['tahun'] = $tahun;
			$mydata['id_tahun'] = $tahun;
		} else {
			$mydata['id_tahun'] = NULL;
		}
		if ($bulan) {
			$arrSpp['bulan'] = $bulan;
			$mydata['id_bulan'] = $bulan;
		} else {
			$mydata['id_bulan'] = NULL;
		}
		if ($kategori) {
			$arrSpp['id_kategori_biaya'] = $kategori;
			$mydata['kats'] = $kategori;
		} else {
			$mydata['kats'] = NULL;
		}
		if ($lunas) {
			$arrSpp['lunas'] = $lunas;
			$mydata['lunas'] = $lunas;
		} else {
			$mydata['lunas'] = NULL;
		}

		$arrSpp['id_sekolah'] = $id_sekolah;
		$arrSpp['id_siswa'] = $id_siswa;
		$arrSpp['id_wali'] = $id_wali;
		[
			$error, $message, $status, $data_spp
		] = curl_get(
			'spp',
			$arrSpp
		);
		$mydata['data_spp'] = $data_spp;

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/style-wali.css') . '">';
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/page/spp.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/spp/spp.js"></script>';

		// LOAD CONFIG HALAMAN
		$this->data['right_button']['spp'] = true;
		$this->data['config_hidden']['notifikasi'] = true;
		// LOAD VIEW
		$this->data['content'] = $this->load->view('index', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function modal_detail_tagihan()
	{
		$id_siswa = $this->input->post('id_siswa');
		$id_tagihan = $this->input->post('id_tagihan');

		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		[
			$error, $message, $status, $data_spp
		] = curl_get(
			'spp',
			[
				"id_sekolah" => $id_sekolah,
				"id_siswa" => $id_siswa,
				"id_wali" => $this->session->userdata('lms_wali_id_wali'),
				"id_tagihan" => $id_tagihan
			]
		);

		$this->load->view("modal_detail_tagihan", $data_spp);
	}


	public function modal_bayar_tagihan()
	{
		$id_siswa = $this->input->post('id_siswa');
		$id_tagihan = $this->input->post('id_tagihan');

		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		[
			$error, $message, $status, $data_spp
		] = curl_get(
			'spp',
			[
				"id_sekolah" => $id_sekolah,
				"id_siswa" => $id_siswa,
				"id_wali" => $this->session->userdata('lms_wali_id_wali'),
				"id_tagihan" => $id_tagihan
			]
		);

		echo json_encode($data_spp);
	}

	public function bayar()
	{
		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$arr['id_sekolah'] = $id_sekolah;
		$arr['id_tagihan'] = $this->input->post('id_tagihan');
		$arr['id_metode_bayar'] = $this->input->post('id_metode_bayar');
		$arrFile['bukti'] = $_FILES['bukti'];

		$result = curlPost('spp/bayar', $arr, $arrFile);
		$data['status'] = $result->status;
		$data['message'] = $result->message;
		$data['id_siswa'] = $this->input->post('id_siswa');
		sleep(1.5);
		echo json_encode($data);
	}
}
