<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends CI_Controller {

    private $args;
    private $meta;
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('language');
        $this->load->model('listing_model', 'listings');
        $this->load->model('category_model', 'category');
        $this->load->model('user_model', 'user');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->library('functions');
        
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

        $this->load->view('header_view', $this->meta);
        $this->load->view('account/account_create_listing_view', $this->args);
        $this->load->view('account/account_links_view.php', $this->args);
        $this->load->view('footer_view');
    }
    
    public function terms() {
        
        $this->load->view('header_view', $this->meta);
        $this->load->view('info/terms_view', $this->args);
        $this->load->view('footer_view');
    }
    
    /* AJAX CONSTRUCTORS */
    function ajax_email() {
        $email = $this->input->post('user_email');
        $exists = $this->user->unique_email($email);
        if (!$exists) {
            $err = 'Email address already in use. ' . anchor('auth/forgot_password', 'Forgot your password?');
            $this->form_validation->set_message("email_check", $err);
            echo json_encode($err);
            return false;
        }
        return true;
    }
    
    function ajax_confpass() {
        $password = $this->input->post('user_password');
        $confpass = $this->input->post('user_confpass');
        
        if (strcmp($password,$confpass) != 0) {
            $err = 'The passwords do not match.';
            $this->form_validation->set_message("password_check", $err);
            echo json_encode($err);
            return FALSE;
        }
        return TRUE;
    }
    
    function ajax_searchusers() {
        $user_data = $this->input->post('user_name');
        echo json_encode($this->user->list_users($user_data));
    }

}