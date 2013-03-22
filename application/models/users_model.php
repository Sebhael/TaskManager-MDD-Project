<?php
class Users_model extends CI_Model {
	
	protected $username;
	protected $password;

	public function __construct()
	{
		parent::__construct();
	}

	public function validate($username='', $password='')
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$password = sha1($password);

		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get('users');

		if ( $query->num_rows() < 1 )
		{
			return FALSE;
		}
		else
		{
			return $query->row_array();
		}
	}

	public function insert()
	{
		$sql = array();
	}

	public function get_profile($id)
	{
		$sql = $this->db->get_where('users', array('users.id' => $id));
		return $sql->row_array();
	}
}