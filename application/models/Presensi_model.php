<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Presensi_model extends CI_Model
{

    public $table = 'presensi';
    public $id = 'id_absen';
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

    function get_all_query($id)
    {

        $sql = "SELECT a.id_absen,b.id_karyawan,b.nama_karyawan,a.tgl,a.jam_msk,a.jam_klr,c.nama_khd,a.ket,d.nama_status,d.id_status
              FROM presensi as a,karyawan as b,kehadiran as c,stts as d,gedung as e
              WHERE a.id_karyawan=b.id_karyawan
              AND c.id_khd=a.id_khd
              AND d.id_status=a.id_status
              AND e.gedung_id=b.gedung_id
              AND e.gedung_id=$id";
        return $this->db->query($sql)->result();
    }

    function get_all_q($id)
    {
        $this->datatables->select('a.id_absen,b.id_karyawan,b.nama_karyawan,a.tgl,a.jam_msk,a.jam_klr,c.id_khd,c.nama_khd,a.ket,d.nama_status,d.id_status')
            ->from('presensi as a,karyawan as b,kehadiran as c,stts as d')
            ->where('b.gedung_id', $id)
            ->where('a.id_karyawan=b.id_karyawan')
            ->where('c.id_khd=a.id_khd')
            ->where('d.id_status=a.id_status');
        return $this->datatables->generate();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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

    function search_value($title, $id)
    {
        $query_result =
            $this->db->where('gedung_id', $id)
            ->like('nama_karyawan', $title, 'both')
            ->order_by('nama_karyawan', 'ASC')
            ->limit(10)->get('karyawan');
        if ($query_result->num_rows() > 0) {
            return $query_result->result();
        } else {
            return false;
        }
    }

    function get_by_ids($id)
    {
        return $this->db->where($this->id, $id)
            ->join('karyawan', 'karyawan.id_karyawan =' . $this->table . '.id_karyawan', 'left')
            ->get('presensi')
            ->row();
    }


    function cek_id($id_karyawan, $tgl)
    {
        $query_str = "SELECT * FROM presensi WHERE id_karyawan= ? AND tgl= ? ";
        $result = $this->db->query($query_str, array($id_karyawan, $tgl));
        if ($result->num_rows() == 1) {
            return $result;
        } else {
            return false;
        }
    }
}
