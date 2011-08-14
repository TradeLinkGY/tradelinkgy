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
    
    
    function upload_file($listing_code = '') {
        $filename = $this->input->post('filename');
        if ($listing_code == ''){
            $listing_code = $this->input->post('listing_code');
        }
        $dir = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $listing_code . DIRECTORY_SEPARATOR;
        
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = 'true';
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload('filename')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
            return FALSE;
        } else {
            create_dir($listing_code);
            $data = array('upload_data' => $this->upload->data());
            echo json_encode($data);
        }
        
        return TRUE;
    }
    
    function upload_image($listing_code = '') {
        $maxSize = "9999999999";
        $maxW = "720";
        $fullPath = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $listing_code . DIRECTORY_SEPARATOR;
        $relPath = '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $listing_code . DIRECTORY_SEPARATOR;
        $colorR = "255";
        $colorG = "255";
        $colorB = "255";
        $maxH = "600";
        $filename = 'filename';
        
        if (!is_dir($fullPath)) {
            mkdir($fullPath);
        }
        
        $filesize_image = $_FILES[$filename]['size'];
        if ($filesize_image > 0) {
            $upload_image = $this->upload(false, $filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
            if (is_array($upload_image)) {
                foreach ($upload_image as $key => $value) {
                    if ($value == "-ERROR-") {
                        unset($upload_image[$key]);
                    }
                }
                $document = array_values($upload_image);
                for ($x = 0; $x < sizeof($document); $x++) {
                    $errorList[] = $document[$x];
                }
                $imgUploaded = false;
            } else {
                $imgUploaded = true;
            }
        } else {
            $imgUploaded = false;
            $errorList[] = "File Size Empty";
        }

        if ($imgUploaded) {
            $file_url = str_replace(FCPATH, base_url(), $upload_image);
            $file_url = str_replace(DIRECTORY_SEPARATOR, '/', $file_url);
            
            echo json_encode($file_url);
        } else {
            echo json_encode($errorList);
        }
    }

    function uploadImage_temp() {
        $maxSize = "9999999999";
        $maxW = "720";
        $fullPath = FCPATH.'assets'. DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $listing_code . DIRECTORY_SEPARATOR;
        $relPath = '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $listing_code . DIRECTORY_SEPARATOR;
        $colorR = "255";
        $colorG = "255";
        $colorB = "255";
        $maxH = "600";
        $filename = 'filename';
        
        if (!is_dir($fullPath)) {
            mkdir($fullPath);
        }
        
        $filesize_image = $_FILES[$filename]['size'];
        if ($filesize_image > 0) {
            $upload_image = $this->upload(true, $filename, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH);
            if (is_array($upload_image)) {
                foreach ($upload_image as $key => $value) {
                    if ($value == "-ERROR-") {
                        unset($upload_image[$key]);
                    }
                }
                $document = array_values($upload_image);
                for ($x = 0; $x < sizeof($document); $x++) {
                    $errorList[] = $document[$x];
                }
                $imgUploaded = false;
            } else {
                $imgUploaded = true;
            }
        } else {
            $imgUploaded = false;
            $errorList[] = "File Size Empty";
        }
        if ($imgUploaded) {
            $image_name = str_replace($fullPath, '', $upload_image);
            echo $this->image_manipulation->resample($image_name, 85, 85, 'temp');
        } else {
            echo '<img src="' . base_url() . 'images/error.gif" width="16" height="16px" border="0" style="margin-bottom: -3px;" /> Error(s) Found: ';
            foreach ($errorList as $value) {
                echo $value . ', ';
            }
        }
    }

    private function set_filename($front_name, $NUM, $file_ext, $isTemp) {
        $name = $front_name . "_" . $NUM . "." . end($file_ext);
        if (!$isTemp) {
            $this->session->unset_userdata('img_name');
            $this->session->set_userdata('img_name', $name);
        } else {
            if ($this->session->userdata('img_array') == null)
                $img_array = array();
            else
                $img_array = $this->session->userdata('img_array');
            array_push($img_array, $name);
            $this->session->set_userdata('img_array', $img_array);
        }
        return $name;
    }

    private function upload($isTemp, $fileName, $maxSize, $maxW, $fullPath, $relPath, $colorR, $colorG, $colorB, $maxH = null) {
        $errorList = null;
        
        $maxlimit = $maxSize;
        $allowed_ext = "jpg,jpeg,gif,png,bmp";
        $match = "";
        $filesize = $_FILES[$fileName]['size'];
        if ($filesize > 0) {
            $filename = strtolower($_FILES[$fileName]['name']);
            $filename = preg_replace('/\s/', '_', $filename);
            if ($filesize < 1) {
                $errorList[] = "File size is empty.";
            }
            if ($filesize > $maxlimit) {
                $errorList[] = "File size is too big.";
            }
            if (count($errorList) < 1) {
                $file_ext = preg_split("/\./", $filename);
                $allowed_ext = preg_split("/\,/", $allowed_ext);
                foreach ($allowed_ext as $ext) {
                    if ($ext == end($file_ext)) {
                        $match = "1"; // File is allowed
                        //file name will be usr_img_ + USER ID + RANDOM NUMBER BETWEEN VALUES BELOW.
                        $NUM = rand(1000000, 1000000000);
                        $front_name = 'usr_img_' . $this->session->userdata('uid');
                        $newfilename = $this->set_filename($front_name, $NUM, $file_ext, $isTemp);
                        $filetype = end($file_ext);
                        $save = $fullPath . $newfilename;
                        if (!file_exists($save)) {
                            list($width_orig, $height_orig) = getimagesize($_FILES[$fileName]['tmp_name']);
                            if ($maxH == null) {
                                if ($width_orig < $maxW) {
                                    $fwidth = $width_orig;
                                } else {
                                    $fwidth = $maxW;
                                }
                                $ratio_orig = $width_orig / $height_orig;
                                $fheight = $fwidth / $ratio_orig;

                                $blank_height = $fheight;
                                $top_offset = 0;
                            } else {
                                if ($width_orig <= $maxW && $height_orig <= $maxH) {
                                    $fheight = $height_orig;
                                    $fwidth = $width_orig;
                                } else {
                                    if ($width_orig > $maxW) {
                                        $ratio = ($width_orig / $maxW);
                                        $fwidth = $maxW;
                                        $fheight = ($height_orig / $ratio);
                                        if ($fheight > $maxH) {
                                            $ratio = ($fheight / $maxH);
                                            $fheight = $maxH;
                                            $fwidth = ($fwidth / $ratio);
                                        }
                                    }
                                    if ($height_orig > $maxH) {
                                        $ratio = ($height_orig / $maxH);
                                        $fheight = $maxH;
                                        $fwidth = ($width_orig / $ratio);
                                        if ($fwidth > $maxW) {
                                            $ratio = ($fwidth / $maxW);
                                            $fwidth = $maxW;
                                            $fheight = ($fheight / $ratio);
                                        }
                                    }
                                }
                                if ($fheight == 0 || $fwidth == 0 || $height_orig == 0 || $width_orig == 0) {
                                    die("FATAL ERROR REPORT ERROR CODE [add-pic-line-67-orig] to <a href='http://www.atwebresults.com'>AT WEB RESULTS</a>");
                                }
                                if ($fheight < 45) {
                                    $blank_height = 45;
                                    $top_offset = round(($blank_height - $fheight) / 2);
                                } else {
                                    $blank_height = $fheight;
                                }
                            }
                            $image_p = imagecreatetruecolor($fwidth, $blank_height);
                            $white = imagecolorallocate($image_p, $colorR, $colorG, $colorB);
                            imagefill($image_p, 0, 0, $white);
                            switch ($filetype) {
                                case "gif":
                                    $image = @imagecreatefromgif($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "jpg":
                                    $image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "jpeg":
                                    $image = @imagecreatefromjpeg($_FILES[$fileName]['tmp_name']);
                                    break;
                                case "png":
                                    $image = @imagecreatefrompng($_FILES[$fileName]['tmp_name']);
                                    break;
                            }
                            @imagecopyresampled($image_p, $image, 0, $top_offset, 0, 0, $fwidth, $fheight, $width_orig, $height_orig);
                            switch ($filetype) {
                                case "gif":
                                    if (!@imagegif($image_p, $save)) {
                                        $errorList[] = "PERMISSION DENIED [GIF]";
                                    }
                                    break;
                                case "jpg":
                                    if (!@imagejpeg($image_p, $save, 100)) {
                                        $errorList[] = "PERMISSION DENIED [JPG]";
                                    }
                                    break;
                                case "jpeg":
                                    if (!@imagejpeg($image_p, $save, 100)) {
                                        $errorList[] = "PERMISSION DENIED [JPEG]";
                                    }
                                    break;
                                case "png":
                                    if (!@imagepng($image_p, $save, 0)) {
                                        $errorList[] = "PERMISSION DENIED [PNG]";
                                    }
                                    break;
                            }
                            @imagedestroy($filename);
                        } else {
                            $errorList[] = "CANNOT MAKE IMAGE IT ALREADY EXISTS";
                        }
                    }
                }
            }
        } else {
            $errorList[] = "NO FILE SELECTED";
        }
        if (!$match) {
            $errorList[] = "File type isn't allowed: $filename";
        }
        if (sizeof($errorList) == 0) {
            return $fullPath . $newfilename;
        } else {
            $eMessage = array();
            for ($x = 0; $x < sizeof($errorList); $x++) {
                $eMessage[] = $errorList[$x];
            }
            return $eMessage;
        }
    }
}