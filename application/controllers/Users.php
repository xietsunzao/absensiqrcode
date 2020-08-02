<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Users extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		}
		$this->load->model('Users_model');
		$this->load->library('form_validation');
		$this->load->library('form_validation', 'ion_auth');
		$this->load->helper('url');
		$this->user = $this->ion_auth->user()->row();
		$this->form_validation->set_error_delimiters('', '');
	}

	public function output_json($data, $encode = true)
	{
		if ($encode) $data = json_encode($data);
		$this->output->set_content_type('application/json')->set_output($data);
	}

	public function data($id = null)
	{
		$this->is_admin();
		$this->output_json($this->users->getDataUsers($id), false);
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
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->is_admin()) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$user = $this->user;
		$users = $this->Users_model->get_all_query();
		$data = array(
			'users_data' => $users,
			'user' => $user,
			'users' 	=> $this->ion_auth->user()->row(),
		);

		$this->template->load('template/template', 'users/users_list', $data);
		$this->load->view('template/datatables');
	}


	public function profile($id)
	{
		$user = $this->user;
		$row = $this->Users_model->get_by_id($id);
		$level = $this->ion_auth->get_users_groups($id)->result();
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('users/upload_image_post'),
				'id' => set_value('id', $row->id),
				'username' => set_value('username', $row->username),
				'email' => set_value('email', $row->email),
				'active' => set_value('active', $row->active),
				'first_name' => set_value('first_name', $row->first_name),
				'last_name' => set_value('last_name', $row->last_name),
				'user' => $user,
				'user1'	=> $this->ion_auth->user()->row(),
				'users' 	=> $this->ion_auth->user($id)->row(),
				'groups'	=> $this->ion_auth->groups()->result(),
				'level'		=> $level[0],
			);
			$this->template->load('template/template', 'profile/users_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function update_profile()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = false;
			$data['errors'] = [
				'username' => form_error('username'),
				'first_name' => form_error('first_name'),
				'last_name' => form_error('last_name'),
				'email' => form_error('email'),
			];
		} else {
			$id = $this->input->post('id', true);
			$input = [
				'username' 		=> $this->input->post('username', true),
				'first_name'	=> $this->input->post('first_name', true),
				'last_name'		=> $this->input->post('last_name', true),
				'email'			=> $this->input->post('email', true)
			];
			$update = $this->Users_model->update_b('users', $input, 'id', $id);
			$data['status'] = $update ? true : false;
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data info'));
		$this->output_json($data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function change_pwprof()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if ($this->form_validation->run() === FALSE) {
			$data = [
				'status' => false,
				'errors' => [
					'old' => form_error('old'),
					'new' => form_error('new'),
					'new_confirm' => form_error('new_confirm')
				]
			];
		} else {
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
			if ($change) {
				$data['status'] = true;
				$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah password'));
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$data = [
					'status' 	=> false,
					'msg'		=> $this->ion_auth->errors(),
				];
			}
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'passswod salah'));
		$this->output_json($data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function read($id)
	{
		$user = $this->user;
		$row = $this->Users_model->get_by_id($id);
		if ($row) {
			$data = array(
				'id' => $row->id,
				'ip_address' => $row->ip_address,
				'username' => $row->username,
				'password' => $row->password,
				'email' => $row->email,
				'activation_selector' => $row->activation_selector,
				'activation_code' => $row->activation_code,
				'forgotten_password_selector' => $row->forgotten_password_selector,
				'forgotten_password_code' => $row->forgotten_password_code,
				'forgotten_password_time' => $row->forgotten_password_time,
				'remember_selector' => $row->remember_selector,
				'remember_code' => $row->remember_code,
				'FROM_UNIXTIME(created_on)' => $row->FROM_UNIXTIME(created_on),
				'last_login' => $row->last_login,
				'active' => $row->active,
				'first_name' => $row->first_name,
				'last_name' => $row->last_name,
				'company' => $row->company,
				'phone' => $row->phone,
				'user' => $user
			);
			$this->template->load('template/template', 'users/users_read', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function create()
	{
		if (!$this->ion_auth->logged_in()) {
			redirect('auth');
		} else if (!$this->ion_auth->is_admin()) {
			show_error('Hanya Administrator yang diberi hak untuk mengakses halaman ini, <a href="' . base_url('dashboard') . '">Kembali ke menu awal</a>', 403, 'Akses Terlarang');
		}
		$this->data['title'] = "Create User";
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth');
		}
		$tables = $this->config->item('tables', 'ion_auth');
		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true) {
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
		}


		$user = $this->user;
		$data = array(
			'button' => 'Create',
			'action' => site_url('users/create_action'),
			'username' => set_value('username'),
			'password' => set_value('password'),
			'password_confirm' => set_value('password_confirm'),
			'email' => set_value('email'),
			'active' => set_value('active'),
			'first_name' => set_value('first_name'),
			'last_name' => set_value('last_name'),
			'company' => set_value('company'),
			'phone' => set_value('phone'),
			'user' => $user,
			'users' 	=> $this->ion_auth->user()->row(),

		);
		// $this->load->view('users/users_form_r',$data);
		$this->template->load('template/template', 'users/users_form_r', $data);
	}

	public function create_user()
	{
		$this->data['title'] = "Create User";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth');
		}

		$tables = $this->config->item('tables', 'ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true) {
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data)) {
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth");
		} else {
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

			$this->_render_page('auth/create_user', $this->data);
		}
	}
	public function create_action()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->create();
		} else {
			$data = array(
				'ip_address' => $this->input->post('ip_address', TRUE),
				'username' => $this->input->post('username', TRUE),
				'password' => $this->input->post('password', TRUE),
				'email' => $this->input->post('email', TRUE),
				'activation_selector' => $this->input->post('activation_selector', TRUE),
				'activation_code' => $this->input->post('activation_code', TRUE),
				'forgotten_password_selector' => $this->input->post('forgotten_password_selector', TRUE),
				'forgotten_password_code' => $this->input->post('forgotten_password_code', TRUE),
				'forgotten_password_time' => $this->input->post('forgotten_password_time', TRUE),
				'remember_selector' => $this->input->post('remember_selector', TRUE),
				'remember_code' => $this->input->post('remember_code', TRUE),
				'created_on' => $this->input->post('created_on', TRUE),
				'last_login' => $this->input->post('last_login', TRUE),
				'active' => $this->input->post('active', TRUE),
				'first_name' => $this->input->post('first_name', TRUE),
				'last_name' => $this->input->post('last_name', TRUE),
				'company' => $this->input->post('company', TRUE),
				'phone' => $this->input->post('phone', TRUE),
			);

			$this->Users_model->insert($data);
			$this->session->set_flashdata('message', 'Create Record Success');
			redirect(site_url('users'));
		}
	}

	public function update($id)

	{
		$user = $this->user;
		$row = $this->Users_model->get_by_id($id);
		$level = $this->ion_auth->get_users_groups($id)->result();
		if ($row) {
			$data = array(
				'button' => 'Update',
				'action' => site_url('users/update_action'),
				'id' => set_value('id', $row->id),
				'username' => set_value('username', $row->username),
				'email' => set_value('email', $row->email),
				'active' => set_value('active', $row->active),
				'first_name' => set_value('first_name', $row->first_name),
				'last_name' => set_value('last_name', $row->last_name),
				'user' => $user,
				'user1'	=> $this->ion_auth->user()->row(),
				'users' 	=> $this->ion_auth->user($id)->row(),
				'groups'	=> $this->ion_auth->groups()->result(),
				'level'		=> $level[0],
			);
			$this->template->load('template/template', 'users/users_form', $data);
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function delete($id)
	{
		$row = $this->Users_model->get_by_id($id);

		if ($row) {
			$this->Users_model->delete($id);
			$this->session->set_flashdata('message', 'Delete Record Success');
			redirect(site_url('users'));
		} else {
			$this->session->set_flashdata('message', 'Record Not Found');
			redirect(site_url('users'));
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'username', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required');
		$this->form_validation->set_rules('first_name', 'first name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'last name', 'trim|required');


		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}




	public function update_status()
	{

		$this->form_validation->set_rules('status', 'Status', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = false;
			$data['errors'] = [
				'status' => form_error('status'),
			];
		} else {
			$id = $this->input->post('id', true);
			$input = [
				'active' 		=> $this->input->post('status', true),
			];
			$update = $this->Users_model->update_b('users', $input, 'id', $id);
			$data['status'] = $update ? true : false;
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data user'));
		$this->output_json($data);
		redirect(site_url('users'));
	}

	public function update_level()
	{

		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = false;
			$data['errors'] = [
				'level' => form_error('level'),
			];
		} else {
			$id = $this->input->post('id', true);
			$input = [
				'group_id' 		=> $this->input->post('level', true),
			];
			$update = $this->Users_model->update_b('users_groups', $input, 'user_id', $id);
			$data['status'] = $update ? true : false;
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data level'));
		$this->output_json($data);
		redirect(site_url('users'));
	}



	public function update_info()
	{

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		if ($this->form_validation->run() === FALSE) {
			$data['status'] = false;
			$data['errors'] = [
				'username' => form_error('username'),
				'first_name' => form_error('first_name'),
				'last_name' => form_error('last_name'),
				'email' => form_error('email'),
			];
		} else {
			$id = $this->input->post('id', true);
			$input = [
				'username' 		=> $this->input->post('username', true),
				'first_name'	=> $this->input->post('first_name', true),
				'last_name'		=> $this->input->post('last_name', true),
				'email'			=> $this->input->post('email', true)
			];
			$update = $this->Users_model->update_b('users', $input, 'id', $id);
			$data['status'] = $update ? true : false;
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah data info'));
		$this->output_json($data);
		redirect(site_url('users'));
	}

	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if ($this->form_validation->run() === FALSE) {
			$data = [
				'status' => false,
				'errors' => [
					'old' => form_error('old'),
					'new' => form_error('new'),
					'new_confirm' => form_error('new_confirm')
				]
			];
		} else {
			$identity = $this->session->userdata('identity');
			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));
			if ($change) {
				$data['status'] = true;
				$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Berhasil merubah password'));
				redirect(site_url('users'));
			} else {
				$data = [
					'status' 	=> false,
					'msg'		=> $this->ion_auth->errors(),
				];
			}
		}
		$this->session->set_flashdata('messageAlert', $this->messageAlert('warning', 'passswod salah'));
		$this->output_json($data);
		redirect($_SERVER['HTTP_REFERER']);
	}


	function _render_page($view, $data = null, $render = false)
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}
}
