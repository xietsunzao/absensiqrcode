<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Presensi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        }
        $this->load->model('Presensi_model');
        $this->load->model('Gedung_model');
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
        $this->load->library('user_agent');
    }

    public function output_json($data, $encode = true)
    {
        if ($encode) $data = json_encode($data);
        $this->output->set_content_type('application/json')->set_output($data);
    }

    public function data()
    {
        $this->output_json($this->Presensi_model->get_all_q($this->uri->segment(3)), false);
    }

    public function index()
    {
        $user = $this->user;
        $gedung = $this->Gedung_model->get_all();
        $data = array(
            'gedung_data' => $gedung,
            'user' => $user, 'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'presensi/presensi_v', $data);
        $this->load->view('template/datatables');
    }

    public function messageAlert($type, $title)
    {
        $messageAlert = "
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        Toast.fire({
            type: '" . $type . "',
            title: '" . $title . "'
        });
        ";
        return $messageAlert;
    }

    public function read($id)
    {
        $this->session->set_userdata('referred_from', current_url());
        $chek = $this->ion_auth->is_admin();
        if (!$chek) {
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        $user = $this->user;
        $presensi = $this->Presensi_model->get_all_query($id);
        $data = array(
            'presensi_data' => $presensi,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
            'result' => $hasil,
        );
        $this->template->load('template/template', 'presensi/presensi_list', $data);
        $this->load->view('template/datatables');
    }


    public function create($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $data = array(
            'button' => 'Create',
            'action' => site_url('presensi/create_action'),
            'id_absen' => set_value('id_absen'),
            'id_karyawan' => set_value('id_karyawan'),
            'tgl' => set_value('tgl'),
            'jam_msk' => set_value('jam_msk'),
            'jam_klr' => set_value('jam_klr'),
            'id_khd' => set_value('id_khd'),
            'ket' => set_value('ket'),
            'id_status' => set_value('id_status'),
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'presensi/presensi_form_in', $data);
        return  $id;
    }

    public function create_action()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();
        $refer =  $this->agent->referrer();
        if ($this->agent->is_referral()) {
            $refer =  $this->agent->referrer();
        }
        $id = $this->input->post('id');
        $result = $this->Presensi_model->search_value($_POST['id_karyawan'], $id);
        $karyawan = $this->input->post('id_karyawan');
        if ($result != FALSE) {
            $data = array(
                'id_karyawan' => $result[0]->id_karyawan,
                'tgl' => date('Y-m-d'),
                'jam_msk' => $this->input->post('jam_msk', TRUE),
                'jam_klr' => $this->input->post('jam_klr', TRUE),
                'id_khd' => 1,
                'id_status' => 1,
            );
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Data Anggota tidak ditemukan'));
            redirect($_SERVER['HTTP_REFERER']);
            return false;
        }
        $result_tgl = $data['tgl'];
        $result_id = $result[0]->id_karyawan;
        $cek_absen = $this->Presensi_model->cek_id($result_id, $result_tgl);
        if ($cek_absen !== FALSE  && $cek_absen->num_rows() == 1) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'Nama Anggota Sudah diabsen'));
            redirect($_SERVER['HTTP_REFERER']);
            return false;
        } else {
            $kar_result = $result[0]->id_karyawan;
            if ($kar_result == NULL || $karyawan == "") {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('Error', 'Data tidak ditemukan'));
                redirect($_SERVER['HTTP_REFERER']);
                return false;
            } else {
                $tgl = date('Y-m-d');
                $id_krywn = $data['id_karyawan'];
                $this->Presensi_model->insert($data);
                $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menambahkan data presensi'));
                $referred_from = $this->session->userdata('referred_from');
                redirect($referred_from, 'refresh');
            }
        }
    }

    public function update($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $row = $this->Presensi_model->get_by_ids($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('presensi/update_action'),
                'id_absen' => set_value('id_absen', $row->id_absen),
                'id_karyawan' => set_value('id_karyawan', $row->id_karyawan),
                'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
                'tgl' => set_value('tgl', $row->tgl),
                'jam_msk' => set_value('jam_msk', $row->jam_msk),
                'jam_klr' => set_value('jam_klr', $row->jam_klr),
                'id_khd' => set_value('id_khd', $row->id_khd),
                'gedung_id' =>  $row->gedung_id,
                'ket' => set_value('ket', $row->ket),
                'id_status' => set_value('id_status', $row->ket),
                'user' => $user, 'users'     => $this->ion_auth->user()->row(),
            );
            $this->template->load('template/template', 'presensi/presensi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('presensi'));
        }
    }

    public function update_action()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_absen', TRUE));
        } else {
            $row = $this->input->post('id_absen');
            $cek_id = $this->Presensi_model->get_by_ids($row);
            if ($cek_id->id_khd == 1) {
                $data = array(
                    'id_karyawan' => $this->input->post('id_karyawan', TRUE),
                    'tgl' => $this->input->post('tgl', TRUE),
                    'jam_msk' => $this->input->post('jam_msk', TRUE),
                    'jam_klr' => $this->input->post('jam_klr', TRUE),
                    'id_khd' => $this->input->post('id_khd', TRUE),
                    'ket' => $this->input->post('ket', TRUE),
                    'id_status' => 2,
                );
            } else {
                $data = array(
                    'id_karyawan' => $this->input->post('id_karyawan', TRUE),
                    'tgl' => $this->input->post('tgl', TRUE),
                    'jam_msk' => $this->input->post('jam_msk', TRUE),
                    'jam_klr' => $this->input->post('jam_klr', TRUE),
                    'id_khd' => $this->input->post('id_khd', TRUE),
                    'ket' => $this->input->post('ket', TRUE),
                    'id_status' => 3,
                );
            }
            $this->Presensi_model->update($this->input->post('id_absen', TRUE), $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data presensi'));
            $referred_from = $this->session->userdata('referred_from');
            redirect($referred_from, 'refresh');
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $row = $this->Presensi_model->get_by_id($id);
        if ($row) {
            $this->Presensi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('presensi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('presensi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_karyawan', 'id karyawan', 'trim|required');
        $this->form_validation->set_rules('tgl', 'tgl', 'trim|required');
        $this->form_validation->set_rules('id_khd', 'id khd', 'trim|required');
        $this->form_validation->set_rules('id_absen', 'id_absen', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    function get_autocomplete($id)
    {
        if (isset($_GET['term'])) {
            $result = $this->Presensi_model->search_value($_GET['term'], $id);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'            => $row->nama_karyawan,
                    );
                echo json_encode($arr_result);
            }
        }
    }
}
