<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shift extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth');
        } 
        $this->load->model('Shift_model');
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
        $shift = $this->Shift_model->get_all();

        $data = array(
            'shift_data' => $shift,
            'user' => $user, 'users'     => $this->ion_auth->user()->row(),
            'users'     => $this->ion_auth->user()->row(),
            'result' => $hasil,
        );
        $this->template->load('template/template', 'shift/shift_list', $data);
        $this->load->view('template/datatables');
    }


    public function rd($id)
    {
        $user = $this->user;
        $shift = $this->Shift_model->get_by_id_q($id);

        $data = array(
            'shift_data2' => $shift,
            'user' => $user,
            'users'     => $this->ion_auth->user()->row(),

        );
        $this->template->load('template/template', 'shift/shift_read', $data);
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
            'action' => site_url('shift/create_action'),
            'id_shift' => set_value('id_shift'),
            'nama_shift' => set_value('nama_shift'),
            'user' => $user, 'users'     => $this->ion_auth->user()->row(),
            'users'     => $this->ion_auth->user()->row(),
        );
        $this->template->load('template/template', 'shift/shift_form', $data);
        $this->load->view('template/datatables');
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
                'nama_shift' => strtoupper($this->input->post('nama_shift', TRUE)),
            );

            $this->Shift_model->insert($data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menambahkan Shift'));
            redirect(site_url('shift'));
        }
    }

    public function update($id)
    {
         if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $user = $this->user;
        $row = $this->Shift_model->get_by_id($id);

        if ($row) {
            $data = array(
                'box' => 'warning',
                'button' => 'Update',
                'action' => site_url('shift/update_action'),
                'id_shift' => set_value('id_shift', $row->id_shift),
                'nama_shift' => set_value('nama_shift', $row->nama_shift),
                'user' => $user, 'users'     => $this->ion_auth->user()->row(),
                'users'     => $this->ion_auth->user()->row(),
            );
            $this->template->load('template/template', 'shift/shift_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('shift'));
        }
    }

    public function update_action()
    {
         if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_shift', TRUE));
        } else {
            $data = array(
                'nama_shift' => strtoupper($this->input->post('nama_shift', TRUE)),
            );

            $this->Shift_model->update($this->input->post('id_shift', TRUE), $data);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data Shift'));
            redirect(site_url('shift'));
        }
    }

    public function delete($id)
    {
         if (!$this->ion_auth->is_admin()) {
            show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
        }
        $row = $this->Shift_model->get_by_id($id);

        if ($row) {
            $this->Shift_model->delete($id);
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil menghapus data Shift'));
            redirect(site_url('shift'));
        } else {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Data tidak ditemukan'));
            redirect(site_url('shift'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_shift', 'nama shift', 'trim|required');
        $this->form_validation->set_rules('id_shift', 'id_shift', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
