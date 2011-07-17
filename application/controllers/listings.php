<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Listings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->model('listing_model', 'listings');
        $this->load->model('category_model', 'category');
    }

    public function display() {
        $meta['css'] = array('style');
        $args['categories'] = $this->category->get_all_categories();

        $this->load->view('header_view', $meta);
        $this->load->view('listing_view', $args);
        $this->load->view('footer_view');
    }
}