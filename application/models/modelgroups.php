<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelGroups extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function addGroup($data){
		$query = $this->db->insert('school_groups',$data);
		return $query;
	}

	function checkGroup($grade,$teacher,$group){
		$this->db->where('id_grade',$grade);
		$this->db->where('id_teacher',$teacher);
		$this->db->where('group_name',$group);
		$query = $this->db->get('school_groups');
		return $query;
	}

	function getGrades(){
		$query=$this->db->get('school_grades');
		return $query;
	}
	
}
?>
