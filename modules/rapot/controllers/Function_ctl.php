<?php defined('BASEPATH') or exit('No direct script access allowed');

class Function_ctl extends MY_Welcome
{
    public function __construct()
    {
        // Load the constructer from MY_Controller
        parent::__construct();
        is_logged_in();
    }


    public function modal_tugas()
    {
        // DEKLARASI DATA
        $id_pelajaran = $this->input->post('id_pelajaran');
        $id_kelas = $this->input->post('id_kelas');
        $id_siswa = $this->input->post('id_siswa');
        $id_wali = $this->session->userdata('lms_wali_id_wali');
        $id_sekolah = $this->session->userdata('lms_wali_id_sekolah');

        // GET API
        [
            $error, $message, $status, $result
        ] = curl_get(
            'rapot/tugas',
            [
                "id_sekolah" => $id_sekolah,
                "id_pelajaran" => $id_pelajaran,
                "id_kelas" => $id_kelas,
                "id_siswa" => $id_siswa
            ]
        );

        $mydata['result'] = $result;
        $this->load->view('modal_tugas', $mydata);
    }


    public function modal_ujian()
    {
        // DEKLARASI DATA
        $id_ujian = $this->input->post('id_ujian');
        $id_sekolah = $this->session->userdata('lms_wali_id_sekolah');

        // GET API
        [
            $error, $message, $status, $result
        ] = curl_get(
            'rapot/ujian',
            [
                "id_sekolah" => $id_sekolah,
                "id_ujian" => $id_ujian
            ]
        );
        $this->load->view('modal_ujian', $result);
    }
}
