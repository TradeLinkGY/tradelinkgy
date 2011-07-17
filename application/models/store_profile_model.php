<?php

class Store_profile_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function unique_store($company) {
        $this->db->where('store_name', $company);
        $query = $this->db->get('store_profile_tb');
        if ($query->num_rows > 0)
            return FALSE;
        return TRUE;
    }
    
    function insert_profile($id_user, $store_name, $store_address, $store_telephone, $store_fax, $store_email, $store_website, $store_desc, $logo) {
        $store_address = nl2br($store_address);
        $store_desc = nl2br($store_desc);

        $this->db->where('store_name', $store_name);
        $this->db->or_where('id_user', $id_user);
        $query = $this->db->get('store_profile_tb');
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $data = array(
                'id_user' => $id_user,
                'store_name' => $store_name,
                'store_address' => $store_address,
                'store_telephone' => $store_telephone,
                'store_fax' => $store_fax,
                'store_email' => $store_email,
                'store_website' => $store_website,
                'store_desc' => $store_desc,
                'store_logo' => $logo);
            $this->db->insert('store_profile_tb', $data);
            return TRUE;
        }
    }

    function edit_profile($id_profile, $store_name, $store_address, $store_telephone, $store_fax, $store_email, $store_website, $store_desc) {
        $store_address = nl2br($store_address);
        $store_desc = nl2br($store_desc);

        $data = array(
            'id_profile' => $id_profile,
            'store_name' => $store_name,
            'store_address' => $store_address,
            'store_telephone' => $store_telephone,
            'store_fax' => $store_fax,
            'store_email' => $store_email,
            'store_website' => $store_website,
            'store_desc' => $store_desc);
        $this->db->where('id_profile', $id_profile);
        $this->db->update('store_profile_tb', $data);
        return TRUE;
    }

    function remove_profile($id_profile) {
        $this->db->where('id_profile', $id_profile);
        $this->db->delete('store_profile_tb');
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    function get_store_info($id_user) {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('store_profile_tb');
        if ($query->num_rows() > 0)
            return $query->result();
        return FALSE;
    }

    function get_profile($id_profile) {
        $this->db->where('id_profile', $id_profile);
        return $this->db->get('store_profile_tb')->row();
    }

    function get_all_profiles() {
        return $this->db->get('store_profile_tb')->result();
    }

    

}
