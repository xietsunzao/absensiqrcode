<?php

class Dashboard_model extends Ci_Model{

  public function total($table)


  {
      $query = $this->db->get($table)->num_rows();
      return $query;
  }

  function get_maxd($pl){
          $this->db->select('a.id_karyawan,a.nama_karyawan,b.nama_jabatan,d.nama_shift');
          $this->db->from('karyawan as a,jabatan as b,gedung as c,shift as d');
          $this->db->where('b.id_jabatan=a.jabatan');
          $this->db->where('a.gedung_id = c.gedung_id');
          $this->db->where('d.id_shift = a.id_shift');
          $this->db->where_in('c.gedung_id',$pl);
          return $this->db->get();
        }

    // jangan pake fungsi ini, testing query
    function get_maxe($in){
      $sql =  " SELECT COUNT(id_karyawan) as total_karyawan
                FROM karyawan
                WHERE gedung_id IN ('1','2','3','4','5','6','7')
                GROUP BY gedung_id
                ORDER BY total_karyawan desc, id_karyawan
                ";

     $sql2 = " SELECT a.nama_gedung, COUNT(b.id_karyawan) as total_karyawan
                FROM karyawan as b, gedung as a
                WHERE b.gedung_id IN ('1','2','3','4','5','6','7')
                AND a.gedung_id=b.gedung_id
                GROUP BY b.gedung_id
                ORDER BY total_karyawan desc, b.id_karyawan";
                return $this->db->query($sql,$in);
    $sql3 = " CREATE view total_jabatan as
              (SELECT a.nama_jabatan, COUNT(b.id_karyawan) as total_karyawan
                FROM karyawan as b, jabatan as a
                WHERE b.jabatan IN ('1','2','3','4')
                AND a.id_jabatan=b.jabatan
                GROUP BY b.jabatan
                ORDER BY total_karyawan desc, b.id_karyawan)";

    $sql4 = "SELECT	a.nama_karyawan,b.nama_jabatan,d.nama_gedung, count(c.id_khd) as total_kehadiran
                FROM karyawan as a, jabatan as b,presensi as c,gedung as d
              	where a.jabatan=b.id_jabatan
                and c.id_karyawan=a.id_karyawan
                and a.gedung_id=d.gedung_id
                GROUP BY a.id_karyawan
                ORDER BY total_kehadiran desc, a.id_karyawan";
    }

      function get_max($id){
          $gi = $this->group_by_gi($id);
          $select = array('a.nama_gedung,count(b.id_karyawan) as total_karyawan');
          $this->db->select($select);
          $this->db->from('karyawan as b , gedung as a');
          $this->db->where('b.gedung_id=a.gedung_id');
          $this->db->group_by('b.gedung_id');
          $this->db->order_by('total_karyawan desc, b.id_karyawan');
          return $this->db->get();
      }

    function get_max2($in){
            $select = array('a.nama_jabatan,count(b.id_karyawan) as total_karyawan');
            $this->db->select($select);
            $this->db->from('karyawan as b , jabatan as a');
            $this->db->where('b.jabatan=a.id_jabatan');
            $this->db->group_by('b.jabatan');
            $this->db->order_by('total_karyawan desc, b.id_karyawan');
            return $this->db->get();
    }

        function group_by_gi($id){
          $this->db->select('gedung_id');
          $this->db->from('gedung');
          $this->db->group_by('gedung_id');
          return $this->db->get()->result_array();
        }
}

 ?>
