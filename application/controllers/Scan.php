<?php

class Scan extends Ci_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->in_group('Operator') && !$this->ion_auth->is_admin()) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$this->load->library('user_agent');
		$this->load->model('Gedung_model');
		$this->load->library('form_validation');
		$this->user = $this->ion_auth->user()->row();
		$this->load->model('Scan_model','Scan');
	}


	public function messageAlert($type, $title)
	{
		$messageAlert = "const Toast = Swal.mixin({
			toast: true,
			position: 'top-end',
			showConfirmButton: false,
			timer: 3000
		});
		Toast.fire({
			type: '" . $type . "',
			title: '" . $title . "'
		});";
		return $messageAlert;
	}

	function index()
	{
		$user = $this->user;
		$data = array('user' => $user, 'users' => $this->ion_auth->user()->row());
		if ($this->agent->is_mobile('iphone')) {
			$this->template->load('template/template', 'scan/scan_mobile', $data);
		} elseif ($this->agent->is_mobile()) {
			$this->template->load('template/template', 'scan/scan_mobile', $data);
		} else {
			$this->template->load('template/template', 'scan/scan_desktop', $data);
		}
	}

	function cek_id()
	{
		$user = $this->user;
		$result_code = $this->input->post('id_karyawan');
		$tgl = date('Y-m-d');
		$jam_msk = date('h:i:s');
		$jam_klr = date('h:i:s');
		$cek_id = $this->Scan->cek_id($result_code);
		$cek_kehadiran = $this->Scan->cek_kehadiran($result_code, $tgl);
		if (!$cek_id) {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'absen gagal data QR tidak ditemukan'));
			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($cek_kehadiran && $cek_kehadiran->jam_msk != '00:00:00' && $cek_kehadiran->jam_klr == '00:00:00' && $cek_kehadiran->id_status == 1) {
			$data = array(
				'jam_klr' => $jam_klr,
				'id_status' => 2,
			);
			$this->Scan->absen_pulang($result_code, $data);
			$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'absen pulang'));
			redirect($_SERVER['HTTP_REFERER']);
		} elseif ($cek_kehadiran && $cek_kehadiran->jam_msk != '00:00:00' && $cek_kehadiran->jam_klr != '00:00:00' && $cek_kehadiran->id_status == 2) {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'sudah absen'));
			redirect($_SERVER['HTTP_REFERER']);
			return false;
		} else {
			$data = array(
				'id_karyawan' => $result_code,
				'tgl' => $tgl,
				'jam_msk' => $jam_msk,
				'id_khd' => 1,
				'id_status' => 1,
			);
			$this->Scan->absen_masuk($data);
			$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'absen masuk'));
			redirect($_SERVER['HTTP_REFERER']);
		}
	}
}
