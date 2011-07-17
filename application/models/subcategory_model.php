<?php

class Subcategory_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_all_subcatgeories() {
        $query = $this->db->get('subcategory_tb');
        return $query->result();
    }

    function get_subcatgeory_by_id($id_subcatgeory) {
        $this->db->where('id_subcategory', $id_subcatgeory);
        $query = $this->db->get('subcategory_tb');
        return $query->result();
    }

    function get_subcategories_by_category_name($name_category) {
        $this->db->where('name_category', $name_category);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $this->db
                    ->where('id_category', $query->row()->id_category)
                    ->order_by('name_category', 'asc');
            $categories = $this->db->get('subcategory_tb');
            return $categories->result();
        }
        else
            return FALSE;
    }

    function get_subcategories_in_category($category) {
        $this->db->where('id_category', $category->id_category);
        $this->db->order_by('name_subcategory', 'ASC');
        $query = $this->db->get('subcategory_tb');
        return $query->result();
    }

    function insert_subcategory($id_category, $subcategory_name) {
        $this->db->from('subcategory_tb');
        $this->db->where('name_subcategory', $subcategory_name);
        $this->db->where('category_tb.id_category', $id_category);
        $this->db->join('category_tb', 'category_tb.id_category=subcategory_tb.id_category');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return FALSE;
        } else {
            $data = array('id_category' => $id_category, 'name_subcategory' => $subcategory_name);
            $this->db->insert('subcategory_tb', $data);
            return TRUE;
        }
    }

    function edit_subcategory($id_subcategory, $id_category, $subcategory_name, $subcategory_desc) {
        $data = array('id_category' => $id_category, 'name_subcategory' => $subcategory_name, 'subcategory_desc' => $subcategory_desc);
        $this->db->where('id_subcategory', $id_subcatgeory);
        $this->db->update('subcategory_tb', $data);
    }

    function delete_subcatgeory($id_subcategory) {
        $this->db->where('id_subcategory', $id_subcatgeory);
        $this->db->delete('subcategory_tb');
    }

}