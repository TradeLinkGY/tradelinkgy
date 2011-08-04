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
        $this->load->library('pagination');
        $this->load->library('functions');
        $this->meta['css'] = array('style');
        $this->meta['categories'] = $this->category->get_all_categories();
        $this->args['links'] = array(
            'img_dir' => base_url() . 'assets/img/',
            'link_category' => 'category/',
            'link_listing' => 'listings/display/',
            'link_about' => '',
            'link_tos' => 'listings/terms',
            'link_privacy' => '',
            'link_faq' => ''
        );
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

    public function email_check($email) {
        if ($email) {
            $result = $this->user->unique_email($email);
            if (!$result) {
                $user = $this->user->get_user(
                                $this->user->get_user_id(
                                        array('user_email' => $email))
                        )->user_fullname;
                $this->user->is_admin() ?
                                $err = "The email is already registered under name $user" :
                                $err = "The email address supplied is already in use";


                $this->form_validation->set_message('email_check', $err);

                return $result;
            }
        }
        return TRUE;
    }

    public function insert_listing() {
        $uri = $_SERVER['REQUEST_URI'];
        if ($this->user->is_logged_in()) {
            $this->load->view('header_view', $this->meta);
            if (!$_POST) {
                $this->load->view('account/account_create_listing_view', $this->args);
                $this->load->view('account/account_links_view.php', $this->args);
            } else {
                $this->form_validation->set_rules('user_exists', 'Existing User', 'required|trim');
                $this->form_validation->set_rules('user_fullname', 'Full Name', 'required|trim');

                $this->input->post('user_exists') == 'No' ? $req = 'required|' : $req = '';

                $this->form_validation->set_rules('user_email', 'Email', "$req" . 'valid_email|callback_email_check|trim');
                $this->form_validation->set_rules('user_country_code', 'Country Code', "$req" . 'numeric|trim');
                $this->form_validation->set_rules('user_area_code', 'Area Code', "$req" . 'numeric|trim');
                $this->form_validation->set_rules('user_telephone', 'Telephone', "$req" . 'numeric|trim');
                $this->form_validation->set_rules('user_address_country', 'Country', "$req" . 'trim');


                $this->form_validation->set_rules('prod_name', 'Listing Name', 'required|trim');
                $this->form_validation->set_rules('prod_keyword', 'Keyword', 'required|trim');
                $this->form_validation->set_rules('prod_plan', 'Plan Type', 'required|trim');
                $this->form_validation->set_rules('prod_category', 'Category', 'required|trim');
                $this->form_validation->set_rules('prod_desc', 'Description', 'required|trim');
                $this->form_validation->set_rules('prod_currency', 'Currency', 'trim');
                $this->form_validation->set_rules('prod_price', 'Price', 'trim');
                $this->form_validation->set_rules('prod_img_path', 'Picture', 'trim');


                if ($this->form_validation->run() == TRUE) {

                    if ($this->input->post('user_exists') == 'No') {

                        $temp_pwd = $this->functions->randompassword(5);
                        $telephone = $this->functions->join_telephone(
                                        $this->input->post('user_country_code'), $this->input->post('user_area_code'), $this->input->post('user_telephone'));

                        $id_user = $this->user->insert_user_temp(
                                        $temp_pwd, '', $this->input->post('user_fullname'), $this->input->post('user_email'), $telephone, '', $this->input->post('user_address_country'));

                        if ($id_user) {
                            
                        }
                    }

                    //$this->listings->insert_listing($id_user, $id_subcategory, $listing_name, $listing_desc, $listing_keywords, $listing_price, $listing_userdesc, $listing_featured, $listing_status, $listing_created, $listing_expiry_period, $listing_inserted_by); 
                } else {
                    $this->load->view('account/account_create_listing_view', $this->args);
                    $this->load->view('account/account_links_view.php', $this->args);
                }
            }
            $this->load->view('footer_view', $this->args);
        } else {
            redirect("auth/login/?path=$uri");
        }
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

        if (strcmp($password, $confpass) != 0) {
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

