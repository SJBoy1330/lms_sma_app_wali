<?php defined('BASEPATH') or exit('No direct script access allowed');

class Controller_ctl extends MY_Welcome
{
	public function __construct()
	{
		// Load the constructer from MY_Controller
		parent::__construct();
	}


	public function index()
	{
		// CEK SESSION
		if ($this->session->userdata('lms_wali_id_wali')) {
			redirect('home');
		}
		// LOAD TITLE
		$mydata['title'] = 'Splash';

		// LOAD JS
		$this->data['js_add'][] = '<script type="text/javascript">$(document).ready(function() {
        $("body").addClass("d-flex flex-column h-100");setTimeout(function () {window.location.replace("' . base_url('auth/login') . '");}, 4000)} );</script>';
		// LOAD VIEW
		$this->data['content'] = $this->load->view('index', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function login()
	{
		// CEK SESSION
		if ($this->session->userdata('lms_wali_id_wali')) {
			redirect('home');
		}

		// LOAD CSS
		$this->data['css_add'][] = '
		<style>
			.form-control.form-control-pribadi{
				text-align: start;
			}
		</style>
		';

		// LOAD TITLE
		$mydata['title'] = 'Login';
		// LOAD VIEW
		$this->data['content'] = $this->load->view('login', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function send_email()
	{
		// CEK SESSION
		if ($this->session->userdata('lms_wali_id_wali')) {
			redirect('home');
		}
		// LOAD TITLE
		$mydata['title'] = 'send email';
		// LOAD VIEW
		$this->data['content'] = $this->load->view('send_email', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function otp()
	{
		// CEK SESSION
		if ($this->session->userdata('lms_wali_id_wali')) {
			redirect('home');
		}
		// LOAD TITLE
		$mydata['title'] = 'Verif OTP';
		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/auth/otp.js"></script>';
		// LOAD VIEW
		$this->data['content'] = $this->load->view('otp', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}

	public function reset_sandi()
	{
		// CEK SESSION
		if ($this->session->userdata('lms_wali_id_wali')) {
			redirect('home');
		}
		// LOAD TITLE
		$mydata['title'] = 'Verif OTP';

		// LOAD JS
		$this->data['js_add'][] = '<script src="' . base_url() . 'assets/js/page/auth/resetsandi.js"></script>';

		// LOAD VIEW
		$this->data['content'] = $this->load->view('reset_sandi', $mydata, TRUE);
		$this->display($this->input->get('routing'));
	}


	public function logout()
	{
		$this->session->unset_userdata('lms_sd_wali_server');
		$this->session->unset_userdata('lms_wali_id_wali');
		$this->session->unset_userdata('lms_wali_role');
		$this->session->unset_userdata('lms_wali_id_sekolah');
		$this->session->unset_userdata('lms_wali_nama');

		$this->session->set_flashdata('judul', 'PEMBERITAHUAN');
		$this->session->set_flashdata('message', 'Anda telah keluar !');
		$this->session->set_flashdata('icon', 'success');
		redirect('auth/login');
	}
}
