<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap_model extends CI_Model
{

    public $table = 'gedung';
    public $id = 'gedung_id';
    public $id_karyawan = 'id_karyawan';
    public $order = 'DESC';
    public $column = array('nama_gedung', 'alamat');
    public $id_khd = 'id_khd';
    public $tgl = 'tgl';
    public $dayList = 'D';


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

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('gedung_id', $q);
        $this->db->or_like('nama_gedung', $q);
        $this->db->or_like('alamat', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('gedung_id', $q);
        $this->db->or_like('nama_gedung', $q);
        $this->db->or_like('alamat', $q);
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


    function get_datatables()
    {
        $query = $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            return $this->db->query($query)->result();
    }

    private function _get_datatables_query()
    {
        $query = "select * from gedung";
        $i = 0;
        if ($_POST['search']['value']) {
            $searchkey = $_POST['search']['value'];
            $query .= "
            where nama_gedung LIKE '%" . $searchkey . "%'
            or alamat LIKE '%" . $searchkey . "%'
            ";
        }

        $column = array('nama_gedung', 'alamat');
        $i = 0;
        foreach ($column as $item) {
            $column[$i] = $item;
        }

        if (isset($_POST['order'])) {
            $query .= " order by " . $column[$_POST['order']['0']['column']] . " " . $_POST['order']['0']['dir'];
        } else if (isset($order)) {
            $order = $order;
            $query .= " order by " . key($order) . " " . $order[key($order)];
        }
        return $query;
    }

    public function count_all()
    {
        $this->db->select("gedung");

        return $this->db->count_all_results();
    }

    function count_filtered()
    {
        $this->db->where("nama_gedung");
        $this->db->where("alamat");
        $this->db->from("gedung");
        $query = $this->_get_datatables_query();
        return $this->db->query($query)->num_rows();
    }


    function jmlHadir($id)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select('a.gedung_id,b.id_karyawan,c.tgl,c.id_khd');
        $this->db->from('gedung as a,karyawan as b,presensi as c');
        $this->db->where('a.gedung_id=b.gedung_id');
        $this->db->where('b.id_karyawan=c.id_karyawan');
        $this->db->group_by('c.tgl');
        $this->db->where('a.gedung_id', $id);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->distinct();
        return $this->db->get('presensi')->num_rows();
    }

    function resultHadir($id)
    {
        $this->db->select("a.id_karyawan,b.gedung_id,c.tgl,c.id_khd");
        $this->db->from("karyawan as a,gedung as b , presensi as c ");
        $this->db->where("a.id_karyawan=c.id_karyawan");
        $this->db->where("b.gedung_id=a.gedung_id");
        $this->db->where("b.gedung_id", $id);
        $this->db->group_by("c.tgl");
        $this->db->distinct();
        return $this->db->get()->result();
    }

    function resultHadir2($id, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.id_karyawan,b.gedung_id,c.tgl,c.id_khd");
        $this->db->from("karyawan as a,gedung as b , presensi as c ");
        $this->db->where("a.id_karyawan=c.id_karyawan");
        $this->db->where("b.gedung_id=a.gedung_id");
        $this->db->where("b.gedung_id", $id);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->group_by("c.tgl");
        $this->db->distinct();
        return $this->db->get()->result();
    }

    // fungsi ketika absensi hadir
    function  _cek($tanggal, $id_karyawan)
    {

        $this->db->distinct();
        $this->db->where("tgl", $tanggal);
        $this->db->where("id_karyawan", $id_karyawan);
        $this->db->where('id_khd', 1);
        $this->db->distinct();
        return $this->db->get("presensi")->num_rows();
    }

    // fungsi ketika absensi sakit
    function  _cek2($tanggal, $id_karyawan)
    {
        $this->db->distinct();
        $this->db->where("tgl", $tanggal);
        $this->db->where("id_karyawan", $id_karyawan);
        $this->db->where('id_khd', 2);
        $this->db->where('id_status', 3);
        $this->db->distinct();
        return $this->db->get("presensi")->num_rows();
    }

    // fungsi ketika ijin
    function  _cek3($tanggal, $id_karyawan)
    {
        $this->db->distinct();
        $this->db->where("tgl", $tanggal);
        $this->db->where("id_karyawan", $id_karyawan);
        $this->db->where('id_khd', 3);
        $this->db->where('id_status', 3);
        $this->db->distinct();
        return $this->db->get("presensi")->num_rows();
    }

    // fungsi ketika tanpa keterangan
    function  _cek4($tanggal, $id_karyawan)
    {
        $this->db->distinct();
        $this->db->where("tgl", $tanggal);
        $this->db->where("id_karyawan", $id_karyawan);
        $this->db->where('id_khd', 4);
        $this->db->where('id_status', 3);
        $this->db->distinct();
        return $this->db->get("presensi")->num_rows();
    }

    // fungsi ketika off/libur
    function  _cek5($tanggal, $id_karyawan)
    {
        $this->db->distinct();
        $this->db->where("tgl", $tanggal);
        $this->db->where("id_karyawan", $id_karyawan);
        $this->db->where('id_khd', 5);
        $this->db->where('id_status', 3);
        $this->db->distinct();
        return $this->db->get("presensi")->num_rows();
    }

    function resultCek($resultHadir)
    {
        $cek = count($resultHadir);
        if ($cek > 0) {
            foreach ($resultHadir as $data) {
                $cek = $this->_cek($data->tanggal);
                if (!$cek) {
                    $cek = "<i class='fa fa-close'></i>";
                } else {
                    $cek = "<i class='fa fa-check-square-o'></i>";
                };
                echo "<td>" . $cek . "</td>";
            }
        } else {
            echo "";
        };
    }


    function karyawan_bak3($id, $start, $end, $id_shift)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $id_shift = $_GET['id_shift'];
        $this->db->select("a.id_karyawan,a.nama_karyawan,a.id_shift,a.jabatan,b.nama_jabatan,c.nama_shift,d.nama_gedung,e.id_khd,e.ket
        ,g.nama_status");
        $this->db->from("karyawan as a,jabatan as b, shift as c, gedung as d,presensi as e,kehadiran as f, stts as g");
        $this->db->where("b.id_jabatan=a.jabatan");
        $this->db->where("c.id_shift=a.id_shift");
        $this->db->where("a.gedung_id=d.gedung_id");
        $this->db->where("a.id_karyawan=e.id_karyawan");
        $this->db->where("e.id_khd=f.id_khd");
        $this->db->where("e.id_status=g.id_status");
        $this->db->where("d.gedung_id", $id);
        $this->db->where("e.id_khd", 1);
        $this->db->where("e.id_status", 2);
        $this->db->where("e.tgl >=", $start);
        $this->db->where("e.tgl <=", $end);
        $this->db->where("a.id_shift", $id_shift);
        $this->db->order_by("a.id_shift", "ASC");
        $this->db->order_by("a.jabatan", "ASC");

        $this->db->distinct();
        return $this->db->get('presensi')->result();
    }

    // fungsi mendata rekap karyawan berdasarkan lokasi
    function karyawan($id)
    {

        $this->db->select("a.id_karyawan,a.nama_karyawan,b.nama_jabatan,c.nama_shift,d.nama_gedung,e.id_khd,e.ket
        ,g.nama_status");
        $this->db->from("karyawan as a,jabatan as b, shift as c, gedung as d,presensi as e,kehadiran as f, stts as g");
        $this->db->where("b.id_jabatan=a.jabatan");
        $this->db->where("c.id_shift=a.id_shift");
        $this->db->where("a.gedung_id=d.gedung_id");
        $this->db->where("a.id_karyawan=e.id_karyawan");
        $this->db->where("e.id_khd=f.id_khd");
        $this->db->where("e.id_status=g.id_status");
        $this->db->where("d.gedung_id", $id);
        $this->db->where("e.id_khd", 1);
        $this->db->where("e.id_status", 2);
        $this->db->distinct();
        return $this->db->get('presensi')->result();
    }

    function karyawan_bak2($id, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.id_karyawan,a.nama_karyawan,a.id_shift,a.jabatan,b.nama_jabatan,c.nama_shift,d.nama_gedung,e.id_khd,e.ket
        ,g.nama_status");
        $this->db->from("karyawan as a,jabatan as b, shift as c, gedung as d,presensi as e,kehadiran as f, stts as g");
        $this->db->where("b.id_jabatan=a.jabatan");
        $this->db->where("c.id_shift=a.id_shift");
        $this->db->where("a.gedung_id=d.gedung_id");
        $this->db->where("a.id_karyawan=e.id_karyawan");
        $this->db->where("e.id_khd=f.id_khd");
        $this->db->where("e.id_status=g.id_status");
        $this->db->where("d.gedung_id", $id);
        $this->db->where("e.id_khd", 1);
        $this->db->where("e.id_status", 2);
        $this->db->where("e.tgl >=", $start);
        $this->db->where("e.tgl <=", $end);
        $this->db->order_by("a.id_shift", "ASC");
        $this->db->order_by("a.jabatan", "ASC");
        $this->db->distinct();
        return $this->db->get('presensi')->result();
    }


    // fungsi menghitung total kehadiran (masuk)
    function totalHadir($id, $id_karyawan)
    {
        $this->db->select("a.gedung_id,b.id_karyawan,c.tgl");
        $this->db->from("gedung as a ,presensi as c, karyawan as b");
        $this->db->where("a.gedung_id=b.gedung_id");
        $this->db->where("b.id_karyawan=c.id_karyawan");
        $this->db->where("a.gedung_id", $id);
        $this->db->where("b.id_karyawan", $id_karyawan);
        $this->db->where("c.id_khd", 1);
        $this->db->distinct();

        return $this->db->get()->num_rows();
    }

    function tohadir($id_karyawan)
    {
        $id_karyawan = $this->input->post('id_karyawan');
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_karyawan)
            ->where('id_khd', 1)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function tosakit($id_karyawan)
    {
        $id_karyawan = $this->input->post('id_karyawan');
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_karyawan)
            ->where('id_khd', 2)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function toijin($id_karyawan)
    {
        $id_karyawan = $this->input->post('id_karyawan');
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_karyawan)
            ->where('id_khd', 3)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function toalpha($id_karyawan)
    {
        $id_karyawan = $this->input->post('id_karyawan');
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_karyawan)
            ->where('id_khd', 4)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }
    // fungsi menghitung total kehadiran (masuk)
    function totalHadir_bak($id, $id_karyawan, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.gedung_id,b.id_karyawan,c.tgl");
        $this->db->from("gedung as a ,presensi as c, karyawan as b");
        $this->db->where("a.gedung_id=b.gedung_id");
        $this->db->where("b.id_karyawan=c.id_karyawan");
        $this->db->where("a.gedung_id", $id);
        $this->db->where("b.id_karyawan", $id_karyawan);
        $this->db->where("c.id_khd", 1);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->distinct();

        return $this->db->get()->num_rows();
    }

    // fungsi menghitung total kehadiran (sakit)
    function totalHadir2($id, $id_karyawan, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.gedung_id,b.id_karyawan,c.tgl");
        $this->db->from("gedung as a ,presensi as c, karyawan as b");
        $this->db->where("a.gedung_id=b.gedung_id");
        $this->db->where("b.id_karyawan=c.id_karyawan");
        $this->db->where("a.gedung_id", $id);
        $this->db->where("b.id_karyawan", $id_karyawan);
        $this->db->where("c.id_khd", 2);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->distinct();
        return $this->db->get()->num_rows();
    }

    // fungsi menghitung total kehadiran (ijin)
    function totalHadir3($id, $id_karyawan, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.gedung_id,b.id_karyawan,c.tgl");
        $this->db->from("gedung as a ,presensi as c, karyawan as b");
        $this->db->where("a.gedung_id=b.gedung_id");
        $this->db->where("b.id_karyawan=c.id_karyawan");
        $this->db->where("a.gedung_id", $id);
        $this->db->where("b.id_karyawan", $id_karyawan);
        $this->db->where("c.id_khd", 3);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->distinct();
        return $this->db->get()->num_rows();
    }

    // fungsi menghitung total kehadiran (alpha)
    function totalHadir4($id, $id_karyawan, $start, $end)
    {
        $start = $_GET['start'];
        $end = $_GET['end'];
        $this->db->select("a.gedung_id,b.id_karyawan,c.tgl");
        $this->db->from("gedung as a ,presensi as c, karyawan as b");
        $this->db->where("a.gedung_id=b.gedung_id");
        $this->db->where("b.id_karyawan=c.id_karyawan");
        $this->db->where("a.gedung_id", $id);
        $this->db->where("b.id_karyawan", $id_karyawan);
        $this->db->where("c.id_khd", 4);
        $this->db->where("c.tgl >=", $start);
        $this->db->where("c.tgl <=", $end);
        $this->db->distinct();
        return $this->db->get()->num_rows();
    }

    function update_khd()
    {
        $tgl = date('d');
        $id_status = 3;
        $id = $this->input->get('tgl');
        $seg = $this->input->get('gedung_id');
        $id_khd = $this->input->get('id_khd');
        $kar = $this->input->get('id_karyawan');
        $ket = $this->input->post('ket');
        $query_str  =
            $this->db->where('tgl', $id)
            ->where('id_karyawan', $kar)
            ->where('id_status', 3)
            ->get('presensi');
        if ($query_str->num_rows() == 0) {
            $this->insert_khd();
        } else {
            $data = array(
                'id_khd' => $this->input->get('id_khd'),
                'ket' => $this->input->get('ket'),
            );
            $this->db->where('tgl', $id);
            $this->db->where('id_karyawan', $kar);
            $this->db->update('presensi', $data);
        }
    }

    function insert_khd()
    {
        $tgl = date('d');
        $id_status = 3;
        $id = $this->input->get('tgl');
        $seg = $this->input->get('gedung_id');
        $id_khd = $this->input->get('id_khd');
        $kar = $this->input->get('id_karyawan');
        $ket = $this->input->get('ket');
        $insert = array(
            'id_karyawan' => $kar,
            'tgl' => $id,
            'id_khd' => $id_khd,
            'id_status' => $id_status,
            'ket' => $ket,
        );
        $this->db->where("id_karyawan", $this->input->get('kar'));
        $this->db->insert('presensi', $insert);
    }

    function tohadirM($id_krywn)
    {
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_krywn)
            ->where('id_khd', 1)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function tosakitM($id_krywn)
    {
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_krywn)
            ->where('id_khd', 2)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function toijinM($id_krywn)
    {
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_krywn)
            ->where('id_khd', 3)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }

    function toalphaM($id_krywn)
    {
        return
            $this->db->select('count(id_karyawan) as total')
            ->where('id_karyawan', $id_krywn)
            ->where('id_khd', 4)
            ->where('month(tgl) = month(CURRENT_date())')
            ->get('presensi')->result_array();
    }
}
