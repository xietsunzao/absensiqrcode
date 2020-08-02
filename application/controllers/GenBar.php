<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GenBar extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->load->library('form_validation', 'ion_auth');
		$this->load->model('GenBar_model');
		$this->load->helper('url');
		$this->user = $this->ion_auth->user()->row();
	}
	public function index()

	{
		$user = $this->user;
		$data = array(
			'user' => $user, 'users' 	=> $this->ion_auth->user()->row(),
		);
		$this->template->load('template/template', 'ambilqr/v_web', $data);
	}

	public function showw()
	{
		$this->load->library('ciqrcode');
		$id = $this->input->post('id');
		$this->load->model('GenBar_model');
		$car = $this->GenBar_model->getShow_query($id);
		if ($car->num_rows() > 0) {
			foreach ($car->result() as $row) {
				$shows = array(
					'id_karyawan' => $row->id_karyawan,
					'nama_karyawan' => $row->nama_karyawan,
					'nama_jabatan' => $row->nama_jabatan,
					'nama_shift' => $row->nama_shift,
					'nama_gedung' => $row->nama_gedung
				);
				$this->load->view('ambilqr/v_scan', $shows);
			}
		} else {
			$this->load->view('ambilqr/v_scan_kosong');
		}
	}


	function get_autocomplete()
	{
		if (isset($_GET['term'])) {
			$result = $this->GenBar_model->search_value($_GET['term']);
			if (count($result) > 0) {
				foreach ($result as $row)
					$arr_result[] = array(
						'label'			=> $row->nama_karyawan,
					);
				echo json_encode($arr_result);
			}
		}
	}
}
