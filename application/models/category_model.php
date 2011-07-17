<?php

class Category_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_id_category($category_name) {
        $this->db->where('name_category', $category_name);
        $query = $this->db->get('category_tb')->row();
        return $query->id_category;
    }

    function insert_category($category_name) {
        $this->db->where('name_category', $category_name);
        $query = $this->db->get('category_tb');
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $data = array('name_category' => $category_name);
            $this->db->insert('category_tb', $data);
            return TRUE;
        }
    }

    function edit_category($id_category, $category_name, $category_desc, $popularity_index) {
        $data = array('name_category' => $category_name, 'desc_category' => $category_desc, 'popularity_index' => $popularity_index);
        $this->db->where('id_category', $id_category);
        $this->db->update('category_tb', $data);
    }

    function get_category($id_category) {
        $this->db->where('id_category', $id_category);
        $query = $this->db->get('category_tb');
        return $query->row();
    }

    function delete_category($id_category) {
        $this->db->where('id_category', $id_category);
        $query = $this->db->delete('category_tb');
    }

    function get_all_categories() {
        $this->db->order_by('name_category', 'ASC');
        $query = $this->db->get('category_tb');
        return $query->result();
    }

}

?>