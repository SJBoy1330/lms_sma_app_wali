<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Staf_m extends MY_Model
{

    protected $_table_name = 'staf';
    protected $_primary_key = 'id_staf';

    private $db_sekolah = NULL;

    public function __construct()
    {
        $this->db_sekolah = $this->load->database('db_sekolah', TRUE);
    }

    public function count_data_staf($filter = NULL)
    {
        $this->db_sekolah->select($this->_primary_key);
        $this->db_sekolah->from($this->_table_name);
        $this->db_sekolah->where(array('deleted' => 'N', 'aktif' => 'Y'), $filter);
        return $this->db_sekolah->count_all_results();
    }
}
