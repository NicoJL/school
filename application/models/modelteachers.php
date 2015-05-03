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


	function checkLogin($user,$pass){
		$this->db->where('teacher_nick_name',$user);
		$this->db->where('teacher_password',$pass);
		$this->db->where('teacher_status',1);
		$query = $this->db->get('school_teachers');
		return $query;
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


	function getOptions($id){
		$query = $this->db->query('select * from school_options where id_option in
			(select id_option from school_type_options where id_type='.$id.');');
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
