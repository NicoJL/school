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

	function deleteNew($id){
		$this->db->where('id_notice',$id);
		$this->db->delete('school_notices');
		return $this->db->affected_rows();

	}

	function countCat($id){
		$query = $this->db->query('select count(*)as cantidad from school_notices where id_notice_category = '.$id.' ');
		return $query;

	}

	function editNotice($data,$id){
		$this->db->where('id_notice',$id);
		$this->db->update('school_notices',$data);
		return $this->db->affected_rows();
	}

	function getCategories(){
		$query = $this->db->get('school_notice_categories');
		return $query;
	}

	function getNoticeCat($cat,$limite){
		$this->db->where('id_notice_category',$cat);
		$this->db->limit($limite);
		$this->db->order_by('id_notice','desc');
		$query = $this->db->get('school_notices');
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

	function getNewsPagination($id,$inicio,$tope){
		$query = $this->db->query('select * from school_notices inner join school_teachers 
			on school_notices.id_teacher = school_teachers.id_teacher 
			where id_notice_category ='.$id.' limit '.$inicio.','.$tope.';');
		return $query;
	}

	function getNoticeSelec($id){
		$this->db->where('id_notice',$id);
		$this->db->select('*');
		$this->db->from('school_notices');
		$this->db->join('school_teachers','school_teachers.id_teacher=school_notices.id_teacher');
		$query = $this->db->get();
		return $query;

	}

	function getNoticePro(){
		$this->db->where('notice_prominent',true);
		$this->db->limit(8);
		$this->db->order_by('id_notice','desc');
		$query = $this->db->get('school_notices');
		return $query;
	}

	function showNotice($id){
		$this->db->where('id_notice',$id);
		$query = $this->db->get('school_notices');
		return $query;
	}

	function getSearch($cadena){
		$query = $this->db->query('select * from school_notices where notice_title like "%'.$cadena.'%" 
			or notice_content like "%'.$cadena.'%" ;');
		return $query;

	}
	
	
}
?>
