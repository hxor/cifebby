<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends CI_Model {

	public $table = 'posts';

	public function __construct()
	{
		parent::__construct();
		
	}

	public function getDefaultValues()
	{
		return [
			'body' => '',
		];
	}

	public function getValidationRules()
	{
		return [
			[
				'field' => 'body',
				'label' => 'Body',
				'rules' => 'required'
			],
		];
	}

	public function validate()
	{
		$this->load->library('form_validation');
		$rules = $this->getValidationRules();
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<span class="validation-error">', '</span>');
		return $this->form_validation->run();
	}

	public function all()
	{
		return $this->db->order_by('id', 'desc')->get($this->table)->result();
	}

	public function insert($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

}
