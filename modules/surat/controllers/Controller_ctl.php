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
		$mydata['title'] = 'Surat Ijin';

		// LOAD CSS
		$this->data['css_add'][] = '<link rel="stylesheet" href="' . base_url('assets/css/page/suratijin.css') . '">';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/suratijin/suratijin.js?v=' . date('YmdHis') . '"></script>';

		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');

		// LOAD DATA API
		[
			$error, $message, $status, $result
		] = curl_get(
			'surat',
			[
				'id_sekolah' => $id_sekolah,
				'id_siswa' => $id_siswa,
				'id_wali' => $id_wali
			]
		);
		// DEKLARASI VARIABEL MYDATA
		$mydata['result'] = $result;
		if ($id_siswa != NULL) {
			$mydata['id_siswa'] = $id_siswa;
		} else {
			$mydata['id_siswa'] = $result->siswa[0]->id_siswa;
		}

		// LOAD DATA CONFIG PAGE 
		$this->data['button_back'] = base_url('home');
		$this->data['judul_halaman'] = 'Surat Ijin';
		$this->data['config_hidden']['footer'] = true;
		$this->data['config_hidden']['notifikasi'] = TRUE;

		// LOAD VIEW
		$this->data['content'] = $this->load->view('surat_ijin', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}


	public function modal_detail()
	{
		$id_surat_ijin = $this->input->post('id_surat_ijin');
		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		$id_wali = $this->session->userdata('lms_wali_id_wali');
		// LOAD DATA API
		[
			$error, $message, $status, $result
		] = curl_get(
			'surat',
			[
				'id_sekolah' => $id_sekolah,
				'id_surat_ijin' => $id_surat_ijin,
				'id_wali' => $id_wali
			]
		);
		sleep(1.5);
		$this->load->view('modal_surat_ijin', $result);
	}


	public function tambah()
	{
		$arrVar['id_siswa'] = 'ID Siswa';
		$arrVar['tipe']     = 'Tipe Surat';
		$arrVar['tanggal_mulai']   = 'Tanggal Mulai';
		$arrVar['tanggal_sampai']   = 'Tanggal Sampai';
		foreach ($arrVar as $var => $value) {
			$$var = $this->input->post($var);
			if (!$$var) {
				$data['required'][] = ['req_' . $var, $value . ' tidak boleh kosong !'];
				$arrAccess[] = false;
			} else {
				$arrAccess[] = true;
			}
		}

		$surat = $_FILES['surat'];
		if (!isset($surat['tmp_name']) || $surat['tmp_name'] == null) {
			$data['required'][] = ['req_surat',  'Surat tidak boleh kosong !'];
			$arrAccess[] = false;
		} else {
			$arrAccess[] = true;
		}
		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		if (!in_array(FALSE, $arrAccess)) {
			// DEKLARASI DATA
			$arr['id_sekolah'] = $id_sekolah;
			$arr['id_siswa'] = $id_siswa;
			$arr['tipe'] = $tipe;
			$arr['tanggal_mulai'] = $tanggal_mulai;
			$arr['tanggal_sampai'] = $tanggal_sampai;
			$arrFile['surat'] = $_FILES['surat'];
			// LOAD DATA API
			$insert = curlPost('surat/tambah', $arr, $arrFile);
			$data['status'] = !$insert->error;
			$data['alert']['message'] = $insert->message;
			if ($insert->status == 200) {
				$data['alert']['title'] = 'PEMBERITAHUAN';
				$data['modal']['id'] = '#tambahSuratIjin';
				$data['modal']['action'] = 'hide';
				$data['load'][0]['parent'] = '#parent_load';
				$data['load'][0]['reload'] = base_url('surat/index/' . $id_siswa) . ' #load_surat';
			} else {
				$data['alert']['title'] = 'PERINGATAN';
			}
			echo json_encode($data);
			exit;
		} else {
			$data['status'] = false;
			echo json_encode($data);
			exit;
		}
	}


	public function edit()
	{
		$arrVar['tipe']     = 'Tipe Surat';
		$arrVar['id_surat']     = 'ID Surat';
		$arrVar['mulai_berlaku']   = 'Tanggal Mulai';
		$arrVar['berlaku_hingga']   = 'Tanggal Sampai';
		foreach ($arrVar as $var => $value) {
			$$var = $this->input->post($var);

			if (!$$var) {
				$data['required'][] = ['req_edit_' . $var, $value . ' tidak boleh kosong !'];
				$arrAccess[] = false;
			} else {
				$arrAccess[] = true;
			}
		}
		// Meta data
		$id_sekolah = $this->session->userdata('lms_wali_id_sekolah');
		if (!in_array(FALSE, $arrAccess)) {
			// DEKLARASI DATA
			$arr['id_sekolah'] = $id_sekolah;
			$arr['id_surat_ijin'] = $id_surat;
			$arr['tipe'] = $tipe;
			$arr['tanggal_mulai'] = $mulai_berlaku;
			$arr['tanggal_sampai'] = $berlaku_hingga;
			if ($_FILES['surat']['tmp_name'] != NULL) {
				$arrFile['surat'] = $_FILES['surat'];
			} else {
				$arrFile = NULL;
			}

			// LOAD DATA API
			$update = curlPost('surat/edit', $arr, $arrFile);
			$data['status'] = !$update->error;
			$data['alert']['message'] = $update->message;
			if ($update->status == 200) {
				$data['alert']['title'] = 'PEMBERITAHUAN';
				$data['reload'] = true;
			} else {
				$data['alert']['title'] = 'PERINGATAN';
			}
			echo json_encode($data);
			exit;
		} else {
			$data['status'] = false;
			echo json_encode($data);
			exit;
		}
	}


	public function hapus_surat()
	{
		$id_surat = $this->input->post('id_surat_ijin');
		$result = curlPost('surat/hapus', ['id_sekolah' => $this->session->userdata('lms_wali_id_sekolah'), 'id_wali' => $this->session->userdata('lms_wali_id_wali'), 'id_surat_ijin' => $id_surat]);
		if ($result->status == 200) {
			$data['status'] = TRUE;
			$data['title'] = 'PEMBERITAHUAN';
		} else {
			$data['status'] = FALSE;
			$data['title'] = 'PERINGATAN';
		}

		$data['message'] = $result->message;
		sleep(1.5);
		echo json_encode($data);
	}
}
