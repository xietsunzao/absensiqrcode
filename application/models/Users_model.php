<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
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
    function get_all_query()
    {
        $sql = "SELECT b.id,b.first_name,b.last_name,b.username,b.email,c.name,FROM_UNIXTIME(b.created_on) as created_on,b.active
                FROM users_groups as a , users as b , groups as c
                WHERE a.user_id=b.id
                AND a.group_id=c.id";
        return $this->db->query($sql)->result();
    }

    public function getProfile($id = null)
    {
        $user = $this->ion_auth->user()->row();
        $user_id = is_null($id) ? $user->id : $id;
        $this->db->where("users.id", $user_id);
        $this->db->join('users_groups','users_groups.user_id = users.id','left');
        $this->db->join('groups','groups.id = users_groups.group_id','right');
        return $this->db->get("users")->row();
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
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_selector', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_selector', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_selector', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_selector', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_selector', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_selector', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
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

    public function update_b($table, $data, $pk, $id = null, $batch = false)
    {
        if ($batch === false) {
            $insert = $this->db->update($table, $data, array($pk => $id));
        } else {
            $insert = $this->db->update_batch($table, $data, $pk);
        }
        return $insert;
    }
}
