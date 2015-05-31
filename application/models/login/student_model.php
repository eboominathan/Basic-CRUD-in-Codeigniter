<?php

class Student_model extends CI_Model 
{

	public function insert_student($data)
	{
		$this->db->insert('student_list',$data);
		return ($this->db->affected_rows() != 1 ) ? false:true;
	}
	public function get_student()
	{
		$this->db->select('*');
		$this->db->from('student_list');
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->result();
	}
	public function delete_student($id,$data)
	{
		$this->db->where('id',$id);
		$this->db->update('student_list',$data);
		return ($this->db->affected_rows() != 1 ) ? false:true;
	}
	public function edit_student($id)
	{
		$this->db->select('*');
		$this->db->from('student_list');
		$this->db->where('id',$id);
		$this->db->where('status',1);
		$query =$this->db->get();
		return $query->result();

	}
	public function update_student($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('student_list',$data);
		return ($this->db->affected_rows() != 1 ) ? false:true;
	}
}
