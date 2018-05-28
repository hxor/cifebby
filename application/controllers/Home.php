<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
	public $layout = 'layouts/app';
	
	public function __construct()
	{
		parent::__construct();
		$login = $this->session->userdata('login');
		if (!$login) {
			redirect('/');
		}
		$this->load->model('User_model', 'user', true);
	}

    public function index()
    {
        $main_view = 'pages/home/index';
        $this->load->view($this->layout, compact('main_view'));
    }

    public function profile()
    {
		$user = $this->user->where('email', $this->session->userdata('email'));

		if (!$user) {
			redirect('/home');
		}

		if (!$_POST) {
			$input = (object) $user;
		} else {
			$input = (object) $this->input->post();
		}

		if (!$this->user->validate()) {
			$main_view = 'pages/home/profile';
			$this->load->view($this->layout, compact('main_view', 'input'));
			return;
		}

		$this->user->update($user->id, $input);
		redirect('/home/profile');
        
    }

}
