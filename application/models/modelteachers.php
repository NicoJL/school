<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelTeachers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getTeachers(){
		$this->db->where('teacher_status',true);
		$this->db->select('id_teacher,teacher_name');
		$query=$this->db->get('school_teachers');
		return $query;
	}
	
}
?>
