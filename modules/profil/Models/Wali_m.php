<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Wali_m extends MY_Model
{
    private $db_sekolah = NULL;
    protected $_table_name = 'wali';
    protected $_primary_key = 'id_wali';

    public function __construct()
    {
        parent::__construct();
        $this->db_sekolah = $this->load->database('db_sekolah', TRUE);
    }

    public function get_data_wali($idwali)
    {
        $query = $this->db_sekolah->get_where($this->_table_name, array($this->_primary_key => $idwali));
        return $query->row();
        // return $this->db_sekolah->get_compiled_select();
    }

    public function update($data, $id = NULL)
    {
        $this->db_sekolah->update($this->_table_name, $data, array($this->_primary_key => $id));
    }
}
