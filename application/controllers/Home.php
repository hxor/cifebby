<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public $layout = 'layouts/app';

    public function index()
    {
        $main_view = 'pages/home/index';
        $this->load->view($this->layout, compact('main_view'));
    }

    public function profile()
    {
        $main_view = 'pages/home/profile';
        $this->load->view($this->layout, compact('main_view'));
    }

}
