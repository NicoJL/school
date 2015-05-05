<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStudents extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function changeGroup($data){
		$query = $this->db->query('insert into school_groups_students values(null,'.$data['id_group'].','.$data['id_student'].')');
		return $query;
	}
	
	
}
?>
