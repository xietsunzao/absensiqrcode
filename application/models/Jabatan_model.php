<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jabatan_model extends CI_Model
{

    public $table = 'jabatan';
    public $id = 'id_jabatan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_id_q($id)
    {
      $sql = "SELECT a.id_karyawan,a.nama_karyawan,b.nama_jabatan,c.nama_shift,d.nama_gedung,d.alamat
              from karyawan as a,jabatan as b, shift as c,gedung as d
              where b.id_jabatan=a.jabatan
              AND c.id_shift=a.id_shift
              AND a.gedung_id=d.gedung_id
              AND b.id_jabatan=$id ";
        return $this->db->query($sql)->result();
    }

    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_jabatan', $q);
	$this->db->or_like('nama_jabatan', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_jabatan', $q);
	$this->db->or_like('nama_jabatan', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}