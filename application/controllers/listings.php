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
        $this->load->model('user_model', 'user');
        $this->meta['css'] = array('style');
        
        $this->args['links'] = array(
            'img_dir' => base_url().'assets/img/',
            'link_category' => 'category/',
            'link_listing' => 'listings/display/',
            'link_about' => '',
            'link_tos' => 'test/terms',
            'link_privacy' => '',
            'link_faq' => ''
            );
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

    public function insert_listing() {
        $uri = $_SERVER['REQUEST_URI'];
        if ($this->user->is_logged_in()) {
            $this->load->view('header_view', $this->meta);
            if (!$_POST) {
                
            } else {
                $this->form_validation->set_rules('listing_name', 'required|trim');

                if ($this->form_validation->run()) {
                    $this->listings->insert_listing(
                            //vars
                            $id_user, $id_subcategory, $listing_name, $listing_desc, $listing_keywords, $listing_price, $listing_userdesc, $listing_featured, $listing_status, $listing_created, $listing_expiry_period, $listing_inserted_by
                    );
                } else {
                    
                }
            }
            $this->load->view('footer_view');
        } else {
            redirect("auth/login/?path=$uri");
        }
    }

}

