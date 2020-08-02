<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rekap extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } else if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $models = array(
            'Rekap_model' => 'rekap',
            'Gedung_model' => 'gedung',
            'Karyawan_model' => 'kar',
        );
        $this->load->model($models);
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
        $this->route = "rekap";
    }

    public function index()
    {
        $user = $this->user;
        $rekap = $this->rekap->get_all();
        $data = array(
            'rekap_data' => $rekap,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'rekap/rekap_list', $data);
        $this->load->view('template/datatables');
    }

    public function ajax_list()
    {
        $list = $this->rekap->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $gedung) {
            $no++;
            $row = array();
            $row[]  =  $gedung->nama_gedung;
            $row[] = $gedung->alamat;
            $row[] =
                '
        <a class="btn btn-lg btn-info btn3d" href="#" title="Rekap Absensi" onclick="absen(' . "'" . $gedung->gedung_id . "'" . ')"><i class="fa fa-check-square"></i> Absensi</a>
        <a class="btn btn-lg btn-primary btn3d" href="#" title="Laporan" onclick="laporan(' . "'" . $gedung->gedung_id . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Laporan</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rekap->count_all(),
            "recordsFiltered" => $this->rekap->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list_modal($id)
    {
        $id_karyawan = $this->input->get('id_karyawan');
        $start = $this->input->get('tgl');
        $end = $this->input->get('tgl');
        $id_shift = $this->input->get('id_shift');
        $data['segment'] = $id;
        $data['colspan'] = $this->rekap->jmlHadir($segment = $this->uri->segment(3), $start, $end);
        $data['gedung'] =  $this->gedung->get_by_id($segment = $this->uri->segment(3));
        $data['start'] = $this->input->get('tgl');
        $data['end'] = $this->input->get('tgl');
        $data['id_shift'] = $this->input->get('id_shift');
        $data['resultHadir'] =   $this->rekap->resultHadir2($segment, $start, $end);
        $data['data'] = $this->rekap->resultHadir2($segment, $start, $end);
        $startdate = $this->input->get('start');
        $st = date('Y-m-d', strtotime($startdate));
        $t = explode('-', $st);
        $bulan = $this->tanggal->bulan($t[1]);
        $data['periode'] = $bulan . '&nbsp' . $t[0];
        $id_khd['id_khd'] = set_value('id_khd');
        $result = array(
            $this->rekap->karyawan_bak2($id, $start, $end),
        );
        $this->load->view("rekap/modalAbsen", $data, $id_khd, $result);
    }

    public function ajax_list_laporan($id)
    {
        $user = $this->user;
        $data['user'] = $user;
        $start = $this->input->get('tgl');
        $end = $this->input->get('tgl');
        $data['segment'] = $id;
        $this->load->view("rekap/ModalLaporan", $data, $start, $end);
    }

    public function ajax_list_modal2($id)
    {

        $id_karyawan = $this->input->get('id_karyawan');
        $start = $this->input->get('tgl');
        $end = $this->input->get('tgl');
        $id_shift = $this->input->get('$id_shift');
        $data['segment'] = $id;
        $data['id_khd'] = set_value('id_khd');
        $data['colspan'] = $this->rekap->jmlHadir($segment = $this->uri->segment(3), $start, $end);
        $data['gedung'] =  $this->gedung->get_by_id($segment = $this->uri->segment(3));
        $data['start'] = $this->input->get('tgl');
        $data['end'] = $this->input->get('tgl');
        $data['id_shift'] = $this->input->get('id_shift');
        $data['resultHadir2'] = $this->rekap->karyawan_bak3($segment, $start, $end, $id_shift);
        $startdate = $this->input->get('start');
        $st = date('Y-m-d', strtotime($startdate));
        $t = explode('-', $st);
        $bulan = $this->tanggal->bulan($t[1]);
        $data['periode'] = $bulan . '&nbsp' . $t[0];
        $result = array(
            $this->rekap->karyawan_bak3($id, $start, $end, $id_shift),
        );
        $this->load->view("rekap/modalAbsen", $data, $result);
    }

    function addkhd()
    {
        $data = $this->rekap->update_khd();
    }
}
