<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

		public function __construct()
		{
				parent::__construct();
				$this->load->model('Auth_model', 'auth', true);
		}

    public function login()
    {
			if (!$_POST) {
				$input = (object) $this->auth->getDefaultValues();
			} else {
				$input = (object) $this->input->post();
			}

			if (!$this->auth->validate('login')) {
				$this->load->view('auth/login', compact('input'));
				return;
			}

			if (!$this->auth->runLogin($input)) {
				redirect('auth/login');
			} else {
				redirect('home');
			}
    }

    public function register()
    {
			if (!$_POST) {
				$input = (object) $this->auth->getDefaultValues();
			} else {
				$input = (object) $this->input->post();
			}

			if (!$this->auth->validate('register')) {
				$this->load->view('auth/register', compact('input'));
				return;
			}

			if (!$this->auth->runRegister($input)) {
				redirect('auth/register');
			} else {
				redirect('home');
			}
    }

    public function forgot()
    {
			if (!$_POST) {
				$input = (object) $this->auth->getDefaultValues();
			} else {
				$input = (object) $this->input->post();
			}

			if (!$this->auth->validate('forgot')) {
				$this->load->view('auth/forgot', compact('input'));
				return;
			}

			if (!$this->auth->runForgot($input)) {
				redirect('auth/forgot');
			} else {
				redirect('/');
			}
    }

    public function logout()
    {
			$this->auth->logout();
			redirect('/');
    }
}
