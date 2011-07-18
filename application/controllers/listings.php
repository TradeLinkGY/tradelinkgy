<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listings extends CI_Controller {

    private $meta = array();
    private $args = array();

    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->model('listing_model', 'listings');
        $this->load->model('category_model', 'category');
        $this->meta['css'] = array('style');
        $this->args['categories'] = $this->category->get_all_categories();
    }

    public function search() {
        if ($_POST) {
            $this->args['search_str'] = $this->input->post('keyword');
            $this->args['search_cat'] = $this->input->post('categories');
        }
        $this->load->view('header_view', $args);

        if ($_POST) {

            $this->args['search_items'] = $this->listings->search($this->args['search_str'], $this->args['search_cat']);
        }


        $this->load->view('search_view', $this->args);
        $this->load->view('footer_view');
    }

    public function display() {

        $id = base64_decode($this->uri->segment(3));

        switch ($id) {
            case is_numeric($id):
                $this->args['listing'] = $this->listings->get_listing_by_id($id);
                break;
        }
        $this->load->view('header_view', $this->meta);
        $this->load->view('listing_view', $this->args);
        $this->load->view('footer_view');
    }

}

