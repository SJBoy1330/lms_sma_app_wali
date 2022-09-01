<?php if (!defined('BASEPATH')) exit('No direct script allowed');

class Manual_m extends CI_Model
{

	public function get_today_lesson($id_sekolah, $date, $filter = 'all', $id_kelas = NULL, $time_access = NULL)
	{
		$hari_libur = $this->db->get_where('sekolah', ['id_sekolah' => $id_sekolah])->row()->hari_libur_global;
		if ($hari_libur) {
			$cari_koma = strpos($hari_libur, ",");
			if ($cari_koma) {
				$arrLibur = explode(',', $hari_libur);
			} else {
				$arrLibur[] = $hari_libur;
			}
		} else {
			$arrLibur = NULL;
		}
		$this->db->select('waktu.id_waktu,pelajaran.id_pelajaran,jadwal.id_jadwal,staf.id_staf,jadwal.id_kelas, pelajaran.nama AS nama_pelajaran, staf.nama AS pengajar,jam_mulai,jam_selesai, waktu.kbm, waktu.kegiatan_lain');
		$this->db->from('waktu');
		$this->db->join('jadwal', 'waktu.id_waktu = jadwal.id_waktu', 'LEFT');
		$this->db->join('pelajaran', 'jadwal.id_pelajaran = pelajaran.id_pelajaran', 'LEFT');
		$this->db->join('staf', ' jadwal.id_staf = staf.id_staf', 'LEFT');
		$this->db->where('waktu.id_sekolah', $id_sekolah);
		$this->db->where('jadwal.id_kelas', $id_kelas);
		$this->db->where('waktu.hari', $date);
		if ($arrLibur != NULL) {
			$this->db->where_not_in('waktu.hari', $arrLibur);
		}
		if ($filter == 'kbm') {
			$this->db->where('waktu.kbm', 'Y');
		}
		if ($time_access != NULL) {
			$this->db->where('waktu.jam_selesai >', $time_access);
		}
		$this->db->order_by('waktu.jam_mulai', 'ASC');

		$data = $this->db->get();
		return $data->result();
	}
	public function get_data_siswa_lengkap($id_siswa, $id_sekolah)
	{
		$query = "SELECT siswa.id_siswa,siswa.id_sekolah,kelas.id_jurusan, kelas.id_tingkat, siswa.nis,siswa.nisn,siswa.nama AS nama_siswa,siswa.password,siswa.gender,alamat,telp,email,foto,thumb,last_access,aktif,jurusan.nama AS nama_jurusan,tingkat.nama AS nama_tingkat, kelas.nama AS nama_kelas,tahun_ajaran.nama AS nama_tahun_ajaran,kelas.id_tingkat AS tingkatan, kelas.id_kelas FROM siswa LEFT JOIN peserta_kelas ON siswa.id_siswa = peserta_kelas.id_siswa LEFT JOIN kelas ON kelas.id_kelas = peserta_kelas.id_kelas LEFT JOIN tahun_ajaran ON tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran LEFT JOIN tingkat ON tingkat.id_tingkat = kelas.id_tingkat LEFT JOIN jurusan ON jurusan.id_jurusan = kelas.id_jurusan WHERE siswa.id_siswa = $id_siswa AND siswa.id_sekolah = $id_sekolah";
		$data = $this->db->query($query);
		return $data->row();
	}
	public function get_mapel_by_time($id_waktu, $id_kelas)
	{
		$query = "SELECT * FROM jadwal LEFT JOIN pelajaran ON jadwal.id_pelajaran = pelajaran.id_pelajaran WHERE jadwal.id_waktu = $id_waktu AND jadwal.id_kelas = $id_kelas";
		$data = $this->db->query($query);
		return $data->row();
	}

	public function get_data_single_materi_lengkap($id_materi, $id_sekolah)
	{
		$this->db->select('id_materi,materi.id_bab,bab.id_pelajaran,materi.id_staf,staf.nama AS nama_guru, materi.judul AS judul_materi, materi.keterangan, bab.nama AS judul_bab, pelajaran.nama AS nama_pelajaran');
		$this->db->from('materi');
		$this->db->join('bab', 'materi.id_bab = bab.id_bab', 'LEFT');
		$this->db->join('pelajaran', 'bab.id_pelajaran = pelajaran.id_pelajaran', 'LEFT');
		$this->db->join('staf', 'materi.id_staf = staf.id_staf', 'LEFT');
		if (is_array($id_materi)) {
			$this->db->where_in('materi.id_materi', $id_materi);
		} else {
			$this->db->where('materi.id_materi', $id_materi);
		}
		$this->db->where('pelajaran.id_sekolah', $id_sekolah);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->row();
		} else {
			return false;
		}
	}
	public function get_data_single_lesson_lengkap($id_pelajaran, $id_sekolah, $id_waktu, $id_staf = NULL)
	{
		$this->db->select('id_materi,materi.id_bab,bab.id_pelajaran,materi.id_staf,kelas.id_kelas,kelas.nama AS nama_kelas, staf.nama AS nama_guru, materi.judul AS judul_materi, materi.keterangan, bab.nama AS judul_bab, pelajaran.nama AS nama_pelajaran, waktu.jam_mulai, waktu.jam_selesai');
		$this->db->from('pelajaran');
		$this->db->join('bab', 'pelajaran.id_pelajaran = bab.id_pelajaran', 'LEFT');
		$this->db->join('jadwal', 'jadwal.id_pelajaran = pelajaran.id_pelajaran', 'LEFT');
		$this->db->join('materi', 'materi.id_bab = bab.id_bab', 'LEFT');
		$this->db->join('waktu', 'waktu.id_waktu = jadwal.id_waktu', 'LEFT');
		$this->db->join('staf', 'materi.id_staf = staf.id_staf', 'LEFT');
		$this->db->join('kelas', 'jadwal.id_kelas = kelas.id_kelas', 'LEFT');
		$this->db->where('pelajaran.id_pelajaran', $id_pelajaran);
		$this->db->where('pelajaran.id_sekolah', $id_sekolah);
		$this->db->where('waktu.id_waktu', $id_waktu);
		if ($id_staf != NULL) {
			$this->db->where('jadwal.id_staf', $id_staf);
		}
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->row();
		} else {
			return false;
		}
	}

	public function get_pelajaran_by_staf($id_staf)
	{
		$this->db->select('guru_pelajaran.id_staf,guru_pelajaran.id_pelajaran,pelajaran.nama');
		$this->db->from('guru_pelajaran');
		$this->db->where('guru_pelajaran.id_staf', $id_staf);
		$this->db->join('pelajaran', 'pelajaran.id_pelajaran = guru_pelajaran.id_pelajaran', 'LEFT');
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return FALSE;
		}
	}
	public function get_data_kbm_lengkap($where = array())
	{
		$this->db->select('kbm.id_kbm,kbm.id_pelajaran,kbm.id_staf,kbm.id_kelas, staf.nama AS nama_staf, pelajaran.nama AS judul_pelajaran, kelas.nama AS nama_kelas, kbm.tanggal AS tanggal_kbm, kbm.link_zoom, kbm.link_googlemeet, kbm.selesai');
		$this->db->from('kbm');
		$this->db->join('pelajaran', 'kbm.id_pelajaran = pelajaran.id_pelajaran', 'LEFT');
		$this->db->join('staf', 'staf.id_staf = kbm.id_staf', 'LEFT');
		$this->db->join('kelas', 'kelas.id_kelas = kbm.id_kelas', 'LEFT');

		if (isset($where) && is_array($where)) {
			foreach ($where as $field => $value) {
				$this->db->where($field, $value);
			}
		}
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return false;
		}
	}

	public function get_laporan_absensi_by($id_siswa, $date, $id_pelajaran = NULL, $id_staf = NULL)
	{
		// 2021-11-01 05:27:06.000000
		$dt = date_create($date);
		$this->db->select('presensi_detail.id_presensi,id_presensi_detail,id_siswa,presensi_detail.tanggal, presensi_detail.scan_masuk, presensi.id_pelajaran,presensi.id_kelas, presensi_detail.latitude, presensi_detail.longitude, status, jam_mulai, jam_selesai');
		$this->db->from('presensi_detail');
		$this->db->join('presensi', 'presensi.id_presensi = presensi_detail.id_presensi', 'LEFT');
		$this->db->where('presensi_detail.id_siswa', $id_siswa);
		if ($id_staf) {
			$this->db->where('presensi.id_staf', $id_staf);
		}

		if ($id_pelajaran) {
			$this->db->where('presensi.id_pelajaran', $id_pelajaran);
		}
		$this->db->where('DATE(presensi.tanggal)', $date);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return false;
		}
	}

	public function get_select($select = "*", $tabel, $where = array(), $type = 'object', $limit = NULL, $start = 0)
	{
		$this->db->select($select);
		$this->db->from($tabel);
		if (isset($where)) {
			foreach ($where as $row => $value) {
				if (is_array($value)) {
					$this->db->where_in($row, $value);
				} else {
					$this->db->where($row, $value);
				}
			}
		}
		if ($limit != NULL) {
			$this->db->limit($limit, $start);
		}
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			if ($data->num_rows() > 1) {
				if ($type == 'array') {
					return $data->result_array();
				} else {
					return $data->result();
				}
			} else {
				if ($type == 'array') {
					return $data->row_array();
				} else {
					return $data->row();
				}
			}
		} else {
			return false;
		}
	}
	public function get_tugas_siswa_lengkap($id_sekolah, $id_kelas, $id_tugas = NULL, $order_by = NULL, $sort = 'ASC', $limit = NULL, $start = 0)
	{
		$this->db->Select('id_tugas, tugas.id_pelajaran, pelajaran.nama AS nama_pelajaran, tugas.nama AS nama_tugas,tugas.batas_waktu,tugas.keterangan,tugas.file_tugas');
		$this->db->from('tugas');
		$this->db->join('pelajaran', 'tugas.id_pelajaran = pelajaran.id_pelajaran', 'LEFT');
		$this->db->where('tugas.id_kelas', $id_kelas);
		$this->db->where('id_sekolah', $id_sekolah);
		if ($id_tugas != NULL) {
			$this->db->where('tugas.id_tugas', $id_tugas);
		}
		if ($limit != NULL) {
			$this->db->limit($limit, $start);
		}
		if ($order_by != NULL) {
			$this->db->order_by($order_by, $sort);
		}
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return false;
		}
	}

	public function get_siswa_by_id($id)
	{
		$data = $this->db->get_where('siswa', ['id_siswa' => $id]);
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return false;
		}
	}
	public function get_staf_by_id($id)
	{
		$data = $this->db->get_where('staf', ['id_staf' => $id]);
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return false;
		}
	}
	public function get_absensi_lengkap($id_siswa, $id_pelajaran = NULL, $date = NULL)
	{
		$this->db->select('id_presensi_detail,presensi_detail.id_presensi,presensi_detail.id_siswa,presensi_detail.tanggal AS tanggal_absen_siswa,presensi.tanggal AS tanggal_absen,presensi_detail.scan_masuk, presensi_detail.latitude AS lat_siswa, presensi_detail.longitude AS long_siswa, presensi.latitude AS lat_guru, presensi.longitude AS long_guru, status');
		$this->db->from('presensi_detail');
		$this->db->join('presensi', 'presensi.id_presensi = presensi_detail.id_presensi', 'left');
		$this->db->where('id_siswa', $id_siswa);
		if ($id_pelajaran != NULL) {
			$this->db->where('id_pelajaran', $id_pelajaran);
		}
		if ($date != NULL) {
			$this->db->where('DATE(presensi.tanggal)', $date);
		}
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return FALSE;
		}
	}
	public function get_status_absen($status)
	{
		if ($status == 0) {
			$data = array('status' => 'Alpha', 'warna' => '#f73563', 'border' => 'border-danger');
		} elseif ($status == 1) {
			$data = array('status' => 'Hadir', 'warna' => '#00dfa3', 'border' => 'border-success');
		} elseif ($status == 2) {
			$data = array('status' => 'Izin', 'warna' => '#0D6EFD', 'border' => 'border-info');
		} elseif ($status == 3) {
			$data = array('status' => 'Sakit', 'warna' => '#ffbd17', 'border' => 'border-warning');
		} else {
			$data = array('status' => ' - ', 'warna' => '#6c757d', 'border' => 'border-secondary');
		}
		return $data;
	}

	public function get_like($table, $value_like = array(), $params = array(), $select = '*', $where)
	{

		if (isset($where)) {

			foreach ($where as $field => $value) {
				$this->db->where($field, $value);
			}
		}
		if (isset($value_like)) {
			$this->db->group_start();
			$i = 1;
			foreach ($value_like as $field => $value) {
				if ($i == 1) {
					$this->db->like($field, $value, 'before');
				} else {
					$this->db->or_like($field, $value, 'before');
				}
				$this->db->or_like($field, $value, 'both');
				$this->db->or_like($field, $value, 'after');
			}
			$this->db->group_end();
		}
		if (isset($params['arrjoin'])) {

			foreach ($params['arrjoin'] as $tabel => $statement) {
				$type = (isset($statement['type']) && $statement['type'] != '') ? $statement['type'] : 'INNER';

				$this->db->join($tabel, $statement['statement'], $type);
			}
		}
		if (isset($params['limit'])) {
			if (isset($params['offset'])) {
				$this->db->limit($params['limit'], $params['offset']);
			} else {
				$this->db->limit($params['limit']);
			}
		}
		$this->db->select($select);
		$this->db->from($table);
		$data = $this->db->get();

		if ($data->num_rows() > 0) {
			return $data->result();
		} else {
			return FALSE;
		}
	}
	public function get_nilai_tugas($id_siswa, $id_tugas)
	{
		$this->db->select('nilai');
		$this->db->from('tugas_siswa');
		$this->db->where('id_siswa', $id_siswa);
		$this->db->where('id_tugas', $id_tugas);
		$data = $this->db->get();
		if ($data->num_rows() > 0) {
			if ($data->num_rows() > 1) {
				foreach ($data->result() as $key) {
					$array[] = $key->nilai;
				}
				$row = array_sum($array);
				return $row;
			} else {
				return $data->result()[0]->nilai;
			}
		} else {
			return FALSE;
		}
	}

	public function get_number_exam($id_ujian, $id_soal = NULL)
	{
		if ($id_soal != NULL) {
			$this->db->select('id_ujian_detail');
			$this->db->from('ujian_detail');
			$this->db->where('id_ujian', $id_ujian);
			$for = $this->db->get();
			foreach ($for->result() as $row) {
				$array[] = $row->id_ujian_detail;
			}

			$number = array_search($id_soal, $array);

			$return = $number + 1;
		} else {
			$return = 00;
		}

		return $return;
	}


	public function get_nama_guru($type = 'staf', $id)
	{
		if ($type == 'staf') {
			$data = $this->db->get_where('staf', ['id_staf' => $id])->row();
		} else {
			$get = $this->db->get_where('materi', ['id_materi' => $id])->row();
			$data = $this->db->get_where('staf', ['id_staf' => $get->id_staf])->row();
		}
		return $data->nama;
	}

	public function get_data_guru($type = 'staf', $id)
	{
		if ($type == 'staf') {
			$data = $this->db->get_where('staf', ['id_staf' => $id])->row();
		} else {
			$get = $this->db->get_where('materi', ['id_materi' => $id])->row();
			$data = $this->db->get_where('staf', ['id_staf' => $get->id_staf])->row();
		}
		return $data;
	}

	public function get_nama_materi($id)
	{
		$data = $this->db->get_where('materi', ['id_materi' => $id])->row();
		return $data->judul;
	}

	public function get_max_skor_soal($paket_ujian, $tipe = 1, $id_soal = NULL)
	{
		$this->db->select('ujian_detail.id_soal,skor_benar,skor_penjodohan');
		$this->db->from('ujian_detail');
		$this->db->join('ujian', 'ujian.id_ujian = ujian_detail.id_ujian', 'LEFT');
		$this->db->join('soal_ujian', 'soal_ujian.id_soal = ujian_detail.id_soal', 'LEFT');
		$this->db->where('ujian_detail.id_soal', $id_soal);
		$this->db->where('ujian.id_siswa', $this->session->userdata('lms_id_siswa'));
		$this->db->where('ujian.id_paket_ujian', $paket_ujian);
		$cek = $this->db->get()->row();
		if ($id_soal != NULL && $cek) {
			if ($tipe == 5) {
				$arr = json_decode($cek->skor_penjodohan);
				if (isset($arr) || is_object($arr)) {
					foreach ($arr as $key => $value) {
						$arrNum[] = $value->benar;
					}
					$skor = array_sum($arrNum);
				} else {
					$skor = 0;
				}
			} else {
				if ($cek->skor_benar != NULL || $cek->skor_benar != '') {
					$skor = $cek->skor_benar;
				} else {
					$skor = 0;
				}
			}
		} else {
			$skor = 0;
		}

		return $skor;
	}
	public function get_nama_pelajaran($id)
	{
		$data = $this->db->get_where('pelajaran', ['id_pelajaran' => $id])->row();
		return $data->nama;
	}
}
