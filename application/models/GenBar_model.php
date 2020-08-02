<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Genbar_Model extends CI_model
{



	function __construct()
	{
		parent::__construct();
	}

	public function getShow($id_karyawan)
	{
		$this->db->where('id_karyawan', $id_karyawan);
		$hasil = $this->db->get('karyawan');
		return $hasil;
	}

	public function getshow_query($id_karyawan)
	{
		$result = $this->search_value($_POST['term'] = null);
		$this->db->select('a.id_karyawan,a.nama_karyawan,b.nama_jabatan,d.nama_shift,c.nama_gedung');
		$this->db->from('karyawan as a,jabatan as b,gedung as c,shift as d');
		$this->db->where('b.id_jabatan = a.jabatan');
		$this->db->where('a.gedung_id = c.gedung_id');
		$this->db->where('d.id_shift = a.id_shift');
		$this->db->where('nama_karyawan', $_POST['id']);
		$hasil = $this->db->get();
		return $hasil;
	}
	
	function search_value($title)
	{
		$this->db->like('nama_karyawan', $title, 'both');
		$this->db->order_by('nama_karyawan', 'ASC');
		$this->db->limit(10);
		return $this->db->get('karyawan')->result();
	}
}
