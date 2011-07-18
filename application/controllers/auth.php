<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

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
            'img_dir' => base_url() . 'assets/img/',
            'link_category' => 'category/',
            'link_listing' => 'listings/display/');
        $this->args['categories'] = $this->category->get_all_categories();

        $this->meta['css'] = array('style');
        $this->meta['categories'] = $this->args['categories'];
    }

    public function login() {
        $this->meta['css'] = array('style');

        $this->args['categories'] = $this->category->get_all_categories();
        $this->meta['categories'] = $this->args['categories'];

        $this->load->view('header_view', $this->meta);

        if (!$_POST) {
            $this->load->view('login_view', $this->args);
        } else {
            $path = $this->input->post('path');
            $this->form_validation->set_rules('user_email', 'email_address', 'required|trim|valid_email');
            $this->form_validation->set_rules('user_password', 'password', 'required');
            if ($this->form_validation->run()) {
                $logged = $this->user->login($this->input->post('user_email'), md5($this->input->post('user_password')));
                if ($logged) {
                    if ($this->session->userdata('password_temp')) {
                        $url = 'user/reset_password?email=' . $this->session->userdata('email') . '&tid=y&temp_code=' . $this->session->userdata('temp_code');
                        redirect($url);
                        return;
                    }
                    if ($path == '')
                        redirect(base_url());
                    else {
                        $path = strstr($path, 'index.php');
                        $path = base_url() . $path;
                        redirect($path);
                    }
                    return;
                } else {
                    $this->args['login_err'] = TRUE;
                    $this->load->view('login_view', $this->args);
                }
            }
        }
        $this->load->view('footer_view');
    }

    public function logout() {
        $path = $this->input->get('current_url');
        $this->session->sess_destroy();

        if ($path == '')
            redirect(base_url());
        else {
            $path = strstr($path, 'index.php');
            $path = base_url() . $path;
            redirect($path);
        }
    }

    function email_check($email) {
        $exists = $this->user->unique_email($email);
        if (!$exists) {
            $err = "We have determined that this email address is already registered with TradeLinkGY.com. If you have forgotten your password, " . anchor('auth/forgot_password', 'click here');
            $this->form_validation->set_message("email_check", $err);
            return false;
        }
        return true;
    }

    public function register() {
        $this->meta['css'] = array('style');

        $this->args['categories'] = $this->category->get_all_categories();
        $this->meta['categories'] = $this->args['categories'];

        $this->load->view('header_view', $this->meta);
        if (!$_POST)
            $this->load->view('register_view', $this->args);
        else {
            $this->form_validation->set_rules('user_fullname', 'Full Name', 'required|trim');
            $this->form_validation->set_rules('user_country_code', 'Country Code (Telephone)', 'trim|required|numeric');
            $this->form_validation->set_rules('user_area_code', 'Area Code (Telephone)', 'trim|required|numeric');
            $this->form_validation->set_rules('user_telephone', 'Telephone', 'trim|required|numeric');
            $this->form_validation->set_rules('user_mobile_country_code', 'Country Code (Mobile)', 'trim|numeric');
            $this->form_validation->set_rules('user_mobile_area_code', 'Country Code (Mobile)', 'trim|numeric');
            if ($this->input->post('user_mobile_area_code'))
                $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|numeric|required');
            else
                $this->form_validation->set_rules('user_mobile', 'Mobile', 'trim|numeric');
            $this->form_validation->set_rules('user_email', 'Email', 'required|trim|valid_email|callback_email_check');
            $this->form_validation->set_rules('user_address_street', 'Street Address', 'trim');
            $this->form_validation->set_rules('user_address_secondary', 'Street Address (line 2)', 'trim');
            $this->form_validation->set_rules('user_address_city', 'City', 'trim');
            $this->form_validation->set_rules('user_address_country', 'Country', 'trim');
            $this->form_validation->set_rules('user_password', 'Password', 'required|md5');
            $this->form_validation->set_rules('user_confpass', 'Confirm Password', 'required|matches[user_password]');
            $this->form_validation->set_rules('user_agree', 'Agree to conditions', 'required');
            $this->form_validation->set_rules('user_title', 'Title', 'trim');

            $telephone =
                    $this->functions->join_telephone(
                            $this->input->post('user_country_code'), $this->input->post('user_area_code'), $this->input->post('user_telephone')
            );


            $mobile =
                    $this->input->post('user_mobile') ?
                    $this->functions->join_telephone(
                            $this->input->post('user_mobile_country_code'), $this->input->post('user_mobile_area_code'), $this->input->post('user_mobile')
                    ) : '';

            if (!$this->form_validation->run()) {
                $this->load->view('register_view');
            } else {
                if ($this->user->insert_user(
                                $this->input->post('user_title'), $this->input->post('user_fullname'), $this->input->post('user_email'), $this->input->post('user_password'), $telephone, $mobile, $this->input->post('user_address_street'), $this->input->post('user_address_secondary'), $this->input->post('user_address_city'), $this->input->post('user_address_country'), 'user')) {
                    // SEND A CONFIRMATION EMAIL HERE
                    $this->args['action'] = 'Registered';
                    $this->load->view('confirmation_view', $this->args);
                }
            }
        }
        $this->load->view('footer_view');
    }

    public function account($offset = 0) {
        $this->meta['css'] = array('style');
        $this->args['categories'] = $this->category->get_all_categories();
        $this->meta['categories'] = $this->args['categories'];
        $this->load->view('header_view', $this->meta);

        if (!$this->session->userdata('uid'))
            redirect('auth/login');
        else {
            $this->args['user'] = $this->user->get_user($this->session->userdata('uid'));

            switch ($this->uri->segment(3)) {
                default:;
                case 'my_listings':
                    $limit = 2;
                    $this->uri->segment(4) ? $offset = $this->uri->segment(4) : $offset = 0;

                    $this->args['listings'] = $this->listings->get_listings_by_user($this->args['user']->id_user, $limit, $offset);

                    $config['base_url'] = site_url('auth/account/my_listings');
                    $config['total_rows'] = $this->args['listings']['num_rows'];
                    $config['per_page'] = $limit;
                    $config['uri_segment'] = 4;
                    $this->pagination->initialize($config);

                    $this->args['pagination'] = $this->pagination->create_links();

                    $this->load->view('account/my_listings_view', $this->args);
                    break;
                case 'basic':
                    if ($_POST) {
                        /*  $this->form_validation->set_rules('user_title', 'Salutation', 'required');    */
                        $this->form_validation->set_rules('user_fullname', 'Full Name', 'required');
                        $this->form_validation->set_rules('user_telephone', 'Telephone', 'required');
                        $this->form_validation->set_rules('user_mobile', 'Mobile', '');
                        $this->form_validation->set_rules('user_address', 'Address', 'trim');
                        if ($this->form_validation->run()) {
                            if ($this->user->edit_user(array(
                                        'id_user' => $this->args['user']->id_user,
                                        'user_salutation' => $this->input->post('user_title'),
                                        'user_fullname' => $this->input->post('user_fullname'),
                                        'user_phone' => $this->input->post('user_telephone'),
                                        'user_mobile' => $this->input->post('user_mobile'),
                                        'user_address' => $this->input->post('user_address')
                                    )))
                                $this->args['msg'] = 'Sucessfully updated personal information';
                            $this->args['user'] = $this->user->get_user($this->session->userdata('uid'));
                        }
                    }

                    $this->load->view('account/account_home_view', $this->args);
                    break;
                case 'change_password':
                    if ($_POST) {
                        $this->form_validation->set_rules('password', 'New Password', 'required|md5');
                        $this->form_validation->set_rules('passwordconf', 'Confirm Password', 'required|matches[password]');
                        $new_password = $this->input->post('password');
                        if ($this->form_validation->run()) {
                            $this->user->modify_password($this->args['user']->id_user, $new_password);
                            $this->args['msg'] = 'Password updated';
                        }
                    }
                    $this->load->view('account/account_password_view', $this->args);
                    break;
                case 'change_email':
                    if ($_POST) {
                        $this->form_validation->set_rules('email_address', 'Email Address', 'valid_email|callback_email_check');
                        $new_email = $this->input->post('email_address');
                        if ($new_email != $this->args['user']->user_email) {
                            if ($this->form_validation->run()) {
                                $this->user->modify_email($this->args['user']->id_user, $new_email);
                                $this->args['msg'] = 'Email address updated';
                                $this->args['user'] = $this->user->get_user($this->session->userdata('uid'));
                            }
                        } else {
                            $this->args['msg'] = 'No Changes have been made';
                        }
                    }
                    $this->load->view('account/account_email_view', $this->args);
                    break;
            }
            $this->load->view('account/account_links_view');
        }
        $this->load->view('footer_view');
    }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */