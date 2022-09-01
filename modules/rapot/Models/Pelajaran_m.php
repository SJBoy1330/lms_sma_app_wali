<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Pelajaran_m extends MY_Model
{
    private $db_sekolah = NULL;
    protected $_table_name = '';
    protected $_primary_key = '';

    public function __construct()
    {
        parent::__construct();
        $this->db_sekolah = $this->load->database('db_sekolah', TRUE);
    }

    public function get_list_pelajaran_siswa($idsiswa)
    {
        $array["p.deleted"] = "N";
        $array["pk.id_siswa"] = $idsiswa;
        $this->db_sekolah->select("p.id_pelajaran, p.nama, COUNT(t.id_tugas) AS jumlah_tugas, CEIL(IF(t.id_tugas IS NULL, 0, (COUNT(ts.id_tugas_siswa)/COUNT(t.id_tugas)) * 100)) as persen_tugas");
        $this->db_sekolah->from("peserta_kelas pk");
        $this->db_sekolah->join("kelas k", 'k.id_kelas = pk.id_kelas');
        $this->db_sekolah->join("pelajaran p", 'p.id_tingkat = k.id_tingkat');
        $this->db_sekolah->join("tugas t", 't.id_pelajaran = p.id_pelajaran', 'left');
        $this->db_sekolah->join("tugas_siswa ts", 't.id_tugas = ts.id_tugas', 'left');
        $this->db_sekolah->where($array);
        $this->db_sekolah->group_by("p.id_pelajaran");

        $query = $this->db_sekolah->get();
        return $query->result();
        // return $this->db_sekolah->get_compiled_select();
    }
}
