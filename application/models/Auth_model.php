<?php
class Auth_model extends CI_Model{
	
	private $users = 'users';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function checkLogin($username, $password)
	{
		$query= "SELECT * FROM $this->users WHERE (username = ? OR email = ?) AND password = ?";
		$result= $this->db->query($query, array($username, $username, hash('sha512', $password)));
		
		return $result->row();
		
	}
	
	//----------signup------------
	
	

	function addUser($data){
          return $this->_save(array(
               'table' => $this->users,
               'data' => $data
          ));
     }
	
	// function addUser($data)
	// {
		// $this->db->insert($this->users, $data);
		
		// return $this->db->affected_rows();
		
	// }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}