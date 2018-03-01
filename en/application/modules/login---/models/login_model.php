<?php

class Login_model extends CI_Model{
	function __construct(){
	   parent::__construct();
	   $this->load->driver('cache');
	}
	
	function login($username, $password)
	{
		$this->db-> select('*');
		$this->db-> where('emailUser',$username);
		$this->db-> where('passwordUser', $password); 
		$this->db-> from('tbl_user');
		$this->db-> limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1){
			return $query->result();
		}else{ 
			return false;
		}
	}
	function Getuser($username)
	{
		$this->db-> select('*');
		$this->db-> where('emailUser',$username);
		$this->db-> from('tbl_user');
		$query = $this->db->get();
			return $query->result_array();
	}
	/******************************************************/	
	/******************************************************/	
}

?>
