<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    
    private $args;
    private $meta;

    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->model('listing_model', 'listings');
        $this->load->model('category_model', 'category');
        
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
        
        $this->meta['css'] = array('style');
        $this->meta['categories'] = $this->args['categories'];
    }

    public function index() {
        $this->args['featured_listings'] = $this->listings->get_featured_listings('For Sale');
        $this->args['recent_listings'] = $this->listings->get_recent_listings('For Sale', 20);

        $this->load->view('header_view', $this->meta);
        $this->load->view('homepage_view', $this->args);
        $this->load->view('footer_view');
    }

    public function search() {
        if ($_POST) {
            $this->args['search_str'] = $this->input->post('keyword');
            $this->args['search_cat'] = $this->input->post('categories');
        }
        $this->load->view('header_view', $this->meta);

        if ($_POST) {
            $this->args['search_items'] = $this->listings->search($this->args['search_str'], $this->args['search_cat'] );
        }

        $this->load->view('search_view', $this->args);
        $this->load->view('footer_view');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */