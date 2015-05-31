<?php

class Login_model extends CI_Model {

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */

    /*Check Login*/
   	function validate($username, $password)
	{
		$this->db->where('password', $password);
		$this->db->where('username', $username);
		$query = $this->db->get('membership');
		if($query->num_rows == 1)
		{
			return true;
		}		
	}

	/*Get Session values */
		
	function get_id($username, $password)
	{
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('password', $password);
		$this->db->where('username', $username);
		$query = $this->db->get();
		return $query->result();
				
	}
		
}