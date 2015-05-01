<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelTeachers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function addTeacher($data){
		$query = $this->db->insert('school_teachers',$data);
		return $query;
	}

	function changeStatus($id,$data){
		$this->db->where('id_teacher',$id);
		$this->db->update('school_teachers',$data);
		return $this->db->affected_rows();
	}

	function checkTeacher($name){
		$this->db->where('teacher_nick_name',$name);
		$query = $this->db->get('school_teachers');
		return $query;
	}

	function getAllTeacher(){
		$this->db->select('id_teacher,teacher_name,teacher_nick_name,teacher_password,teacher_status');
		$query=$this->db->get('school_teachers');
		return $query;
	}

	function getTeachers(){
		$this->db->where('teacher_status',true);
		$this->db->select('id_teacher,teacher_name');
		$query=$this->db->get('school_teachers');
		return $query;
	}
	
	function getTypes(){
		$query = $this->db->get('school_types');
		return $query;
	}
}
?>
