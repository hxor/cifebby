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
		$this->load->model('Post_model', 'post', true);
		$this->load->model('Comment_model', 'comment', true);
	}

    public function index()
    {
		$inputComment = (object) $this->comment->getDefaultValues();
		$posts = $this->post->all();
		$input = (object) $this->post->getDefaultValues();

        $main_view = 'pages/home/index';
        $this->load->view($this->layout, compact('main_view', 'posts', 'input', 'inputComment'));
	}
	
	public function status()
	{
		if (!$_POST) {
			$inputComment = (object) $this->comment->getDefaultValues();
			$input = (object) $this->post->getDefaultValues();
		} else {
			$inputComment = (object) $this->comment->getDefaultValues();
			$input = (object) $this->input->post();
		}

		if (!$this->post->validate()) {
			$posts = $this->post->all();
			$main_view = 'pages/home/index';
			$this->load->view($this->layout, compact('main_view', 'posts', 'input', 'inputComment'));
			return;
		}

		$this->post->insert($input);
		redirect('home');
	}

	public function comment()
	{
		if (!$_POST) {
			$inputComment = (object) $this->comment->getDefaultValues();
		} else {
			$inputComment = (object) $this->input->post();
		}

		if (!$this->comment->validate()) {
			$posts = $this->post->all();
			$main_view = 'pages/home/index';
			$this->load->view($this->layout, compact('main_view', 'posts', 'inputComment'));
			return;
		}

		$this->comment->insert($inputComment);
		redirect('home');
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
