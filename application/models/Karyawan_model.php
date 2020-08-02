<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    public $table = 'karyawan';
    public $id = 'id';
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


    function get_max()
    {
        return $this->db->select('max(id) as kode')
            ->from('karyawan')->get()->result();
    }

    function get_all_query()
    {
        $sql = "SELECT a.id_karyawan,a.nama_karyawan,b.nama_jabatan,c.nama_shift,a.gedung_id
                from karyawan as a,jabatan as b,shift as c
                where b.id_jabatan=a.jabatan
                and a.id_shift=c.id_shift";
        return $this->db->query($sql)->result();
    }


    function get_by_id_query($id)
    {
        $sql = "SELECT a.id_karyawan,a.nama_karyawan,b.nama_jabatan,d.nama_shift,c.nama_gedung
        from karyawan as a,jabatan as b,gedung as c,shift as d
        where b.id_jabatan=a.jabatan
        and a.gedung_id=c.gedung_id
        and d.id_shift=a.id_shift
        and id=$id";
        return $this->db->query($sql)->row($id);
    }


    function getData()
    {
        $this->datatables->select('a.id,a.id_karyawan,a.nama_karyawan,b.nama_jabatan,d.nama_shift,c.nama_gedung')
            ->from('karyawan as a,jabatan as b,gedung as c,shift as d')
            ->where('b.id_jabatan=a.jabatan')
            ->where('a.gedung_id=c.gedung_id')
            ->where('d.id_shift=a.id_shift');
        return $this->datatables->generate();
    }
    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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
