<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

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

	public function getValidationRules()
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
				'rules' => 'required'
			]
		];
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$rules = $this->getValidationRules();
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<span class="help-block"><strong>', '</strong></span>');
		return $this->form_validation->run();
	}

	public function find($id)
	{
		return $this->db->where('id', $id)
						->get($this->table)
						->row();
	}

	public function where($key, $value)
	{
		return $this->db->where($key, $value)->get($this->table)->row();
	}

	public function update($id, $data)
	{
		$user = $this->find($id);
		if ($data->password == '') {
			$password = $user->password;
		} else {
			$password = md5($data->password);
		}

		return $this->db->where('id', $id)
						->update($this->table, [
							'name' => $data->name,
							'email' => $data->email,
							'password' => $password
						]);
	}

	

}
