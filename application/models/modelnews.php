<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelNews extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}


	function addNews($data){
		$this->db->insert('school_notices',$data);
		return $this->db->affected_rows();
	}

	function getCategories(){
		$query = $this->db->get('school_notice_categories');
		return $query;
	}

	function getNews(){
		$this->db->select('*');
		$this->db->from('school_notices');
		$this->db->join('school_teachers','school_teachers.id_teacher=school_notices.id_teacher');
		$this->db->order_by('id_notice','desc');
		$query = $this->db->get();
		return $query;

	}
	
	
}
?>
