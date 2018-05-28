<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public $table = 'users';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDefaultValues()
	{
		return [
			'name' => '',
			'email' => '',
			'password' => ''
		];
	}

	public function getValidationLoginRules()
	{
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			],
		];
	}

	public function getValidationRegisterRules()
	{
		return [
			[
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required'
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|is_unique[users.email]'
			],
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required'
			],
		];
	}

	public function getValidationForgotRules()
	{
		return [
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required'
			]
		];
	}

	public function validate($action)
	{
		if ($action == 'login') {
			$rules = $this->getValidationLoginRules();
		} elseif ($action == 'register') {
			$rules = $this->getValidationRegisterRules();
		} else {
			$rules = $this->getValidationForgotRules();
		}
		$this->load->library('form_validation');
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<span class="help-block"><strong>', '</strong></span>');
		return $this->form_validation->run();
	}

	public function runLogin($input)
	{
		$input->password = md5($input->password);

		$user = $this->db->where('email', $input->email)
						->where('password', $input->password)
						->get($this->table)
						->row();

		if (count($user)) {
			$sess_data = [
				'login' => true,
				'id' => $user->id,
				'name' => $user->name,
				'email' => $user->email
			];

			$this->session->set_userdata($sess_data);
			return true;
		}

		return false;
	}

	public function runRegister($input)
	{
		$input->password = md5($input->password);

		$user = $this->db->insert($this->table, $input);

		if (count($user)) {
			$sess_data = [
				'login' => true,
				'id' => $user->id,
				'name' => $input->name,
				'email' => $input->email
			];

			$this->session->set_userdata($sess_data);
			return true;
		}

		return false;
	}

	public function runForgot($input)
	{
		$user = $this->db->where('email', $input->email)
						->get($this->table)
						->row();

		if (count($user)) {
			$this->sendPassword($user);
			return true;
		}
	}

	public function sendPassword($data)
	{
		$email = $data->email;
		$password = intval( "0" . rand(1,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9) );
		$password_user = md5($password);

		$input = [
			'email' => $email,
			'password' => $password_user
		];

		$user = $this->db->where('email', $email)
						->update($this->table, $input);

		$mail_message='Dear '.$data->name.','. "\r\n";
        $mail_message.='Thanks for contacting regarding to forgot password,<br> Your <b>Password</b> is <b>'.$password.'</b>'."\r\n";
        $mail_message.='<br>Please Update your password.';
        $mail_message.='<br>Thanks & Regards';
        $mail_message.='<br>Your company name';

        $this->load->library('email');

		$this->email->initialize(array(
		 	'protocol' => 'smtp',
			'smtp_host' => 'smtp.mailtrap.io',
			'smtp_user' => '52af14dcfb148c',
			'smtp_pass' => '940f9dfa7c0e75',
			'smtp_port' => 25,
			'crlf' => "\r\n",
			'newline' => "\r\n",
	        'mailtype'  => 'html', 
	        'charset' => 'utf-8',
		));

		$this->email->to($email);
		$this->email->from('forum@example.com','Forum');
		$this->email->subject('Reset Password');
		$this->email->message($mail_message);

		$this->email->send();

		return true;
	}

	public function logout()
	{
		$sess_data = ['login', 'name', 'email'];
		$this->session->unset_userdata($session_data);
		$this->session->sess_destroy();
	}

}
