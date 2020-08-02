<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lokasi extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } 
        $this->load->model('Gedung_model');
        $this->load->library('form_validation');
        $this->user = $this->ion_auth->user()->row();
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

    public function index()
    {

        $chek = $this->ion_auth->is_admin();
        if (!$chek) {
            $hasil = 0;
        } else {
            $hasil = 1;
        }
        $user = $this->user;
        $gedung = $this->Gedung_model->get_all();
        $data = array(
            'gedung_data' => $gedung,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
            'result' => $hasil,
        );
        $this->template->load('template/template', 'lokasi/lokasi_list', $data);
        $this->load->view('template/datatables');
    }

    public function rd($id)
    {
        $user = $this->user;
        $gedung = $this->Gedung_model->get_by_id_q($id);

        $data = array(
            'gedung_data' => $gedung,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'lokasi/gedung_read', $data);
        $this->load->view('template/datatables');
    }


    public function create()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $data = array(
            'box' => 'info',
            'button' => 'Create',
            'action' => site_url('lokasi/create_action'),
            'gedung_id' => set_value('gedung_id'),
            'nama_gedung' => set_value('nama_gedung'),
            'alamat' => set_value('alamat'),
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'lokasi/gedung_form', $data);
    }

    public function create_action()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_gedung' => strtoupper($this->input->post('nama_gedung', TRUE)),
                'alamat' => $this->input->post('alamat', TRUE),
            );
            $this->Gedung_model->insert($data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menambahkan Lokasi'));
            redirect(site_url('lokasi'));
        }
    }

    public function update($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $row = $this->Gedung_model->get_by_id($id);
        if ($row) {
            $data = array(
                'box' => 'warning',
                'button' => 'Update',
                'action' => site_url('lokasi/update_action'),
                'gedung_id' => set_value('gedung_id', $row->gedung_id),
                'nama_gedung' => set_value('nama_gedung', $row->nama_gedung),
                'alamat' => set_value('alamat', $row->alamat),
                'user' => $user,
                'users'     => $this->ion_auth->user()->row(),
            );
            $this->template->load('template/template', 'lokasi/gedung_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('lokasi'));
        }
    }

    public function update_action()
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();
        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('gedung_id', TRUE));
        } else {
            $data = array(
                'nama_gedung' => strtoupper($this->input->post('nama_gedung', TRUE)),
                'alamat' => $this->input->post('alamat', TRUE),
            );
            $this->Gedung_model->update($this->input->post('gedung_id', TRUE), $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data lokasi'));
            redirect(site_url('lokasi'));
        }
    }

    public function delete($id)
    {
        if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $row = $this->Gedung_model->get_by_id($id);
        if ($row) {
            $this->Gedung_model->delete($id);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menghapus data Lokasi'));
            redirect(site_url('lokasi'));
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Data lokasi tidak ditemukan'));
            redirect(site_url('lokasi'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_gedung', 'nama gedung', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('gedung_id', 'gedung_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
