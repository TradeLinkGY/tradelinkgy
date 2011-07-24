<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('functions');
    }

    function is_logged_in() {
        return $this->session->userdata('uid') ? true : false;
    }

    function get_user($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user_tb');
        return $query->row();
    }

    function get_user_id($args) {
        $query = $this->db->get_where('user_tb', $args);
        foreach ($query->result() as $row)
            return $row->id_user;
        return FALSE;
    }

    function list_users($user_data) {
        $this->db->select('user_fullname');
        $this->db->from('user_tb');
        $this->db->like('user_fullname', $user_data);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $user_list[] = $row->user_fullname;
            }
            return $user_list;
        }
        return FALSE;
    }
    
    function unique_email($email) {
        $this->db->where('user_email', $email);
        $query = $this->db->get('user_tb');
        if ($query->num_rows() > 0)
            return FALSE;
        return TRUE;
    }

    function login($user, $password) {

        $temp_pw = FALSE;

        $this->db->where('user_email', $user);
        $this->db->where('user_password', $password);
        $query = $this->db->get('user_tb');

        if ($query->num_rows() == 0) {
            $this->db->where('user_email', $user);
            $this->db->where('user_temp_pw', md5($password));
            $query = $this->db->get('user_tb');
            if ($query->num_rows() > 0)
                $temp_pw = TRUE;
        }

        if ($query->num_rows() > 0) {
            $data = $query->row_array();
            if (!$temp_pw)
                $session_arr = array('uid' => $data ['id_user'], 'name' => $data['user_fullname'], 'role' => $data ['user_usertype'], 'logged_in' => true, 'time' => date('Y-m-d H:i:s'), 'email' => $data ['user_email']);
            else
                $session_arr = array('uid' => $data ['id_user'], 'name' => $data['user_fullname'], 'role' => $data ['user_usertype'], 'logged_in' => true, 'time' => date('Y-m-d H:i:s'), 'email' => $data ['user_email'], 'temp_password' => $data['user_temp_pw']);

            $this->session->set_userdata($session_arr);
            return TRUE;
        }

        return FALSE;
    }

    function insert_user($salutation, $fullname, $email, $password, $telephone, $mobile, $address_street, $address_secondary, $address_city, $address_country, $type) {
        $data = array(
            'user_salutation' => $salutation,
            'user_fullname' => $fullname,
            'user_password' => $password,
            'user_address_street' => $address_street,
            'user_address_secondary' => $address_secondary,
            'user_address_city' => $address_city,
            'user_address_country' => $address_country,
            'user_email' => $email,
            'user_phone' => $telephone,
            'user_mobile' => $mobile,
            'user_usertype' => $type
        );

        $this->db->insert('user_tb', $data);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    function insert_user_temp($temp_password, $salutation, $fullname, $email, $telephone, $mobile, $address) {
        $data = array(
            'user_salutation' => $salutation,
            'user_fullname' => $fullname,
            'user_temp_pw' => $temp_password,
            'user_address' => $address,
            'user_email' => $email,
            'user_telephone' => $telephone,
            'user_mobile' => $mobile,
            'user_usertype' => 'user');

        $this->db->insert('user_tb', $data);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        return FALSE;
    }

    function set_password($email, $old_password, $new_password) {
        $id = $this->get_user_id(array('user_email' => $email, 'user_password' => $password));

        if ($id) {
            $this->db->where('id_user', $email);
            $this->db->update('user_tb', array('user_password' => $new_password));
            return TRUE;
        }

        return FALSE;
    }

    function set_temp_password($email) {
        $id = $this->get_user_id(array('user_email' => $email));
        if ($id) {
            $temp_password = $this->functions->randompassword(7);
            $this->db->where('id_user', $id);
            $this->db->update('user_tb', array('user_temp_pw' => $temp_password));
            return TRUE;
        }
        return FALSE;
    }

    function edit_user($user_data) {
        $this->db->where('id_user', $user_data['id_user']);
        $this->db->update('user_tb', $user_data);
        return TRUE;
    }

    function modify_email($id_user, $new_email) {
        $this->db->where('id_user', $id_user);
        $this->db->update('user_tb', array('user_email' => $new_email));
        return TRUE;
    }

    function modify_password($id_user, $new_password) {
        $this->db->where('id_user', $id_user);
        $this->db->update('user_tb', array('user_password' => md5($new_password)));
        return TRUE;
    }

}