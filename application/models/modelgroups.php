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


	function changeStatus($id,$data){
		$this->db->where('id_student',$id);
		$this->db->update('school_students',$data);
		return $this->db->affected_rows();
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

	function groups(){
		$this->db->select('id_group,id_grade, group_name');
		$query = $this->db->get('school_groups');
		return $query;
	}


	function groupsType($id){
		$this->db->where('id_teacher',$id);
		$this->db->select('id_group,id_grade, group_name');
		$query = $this->db->get('school_groups');
		return $query;
	}

	function getGroups($id){
		if($id > 0)
			$query = $this->db->query('select g.id_group,g.id_grade, g.group_name, g.group_password, t.id_teacher, t.teacher_name, 
				t.teacher_status from school_groups g inner join school_teachers t on g.id_teacher = t.id_teacher 
				where g.id_group='.$id.';');
		else
			$query = $this->db->query('select g.id_group,g.id_grade, g.group_name, g.group_password, t.id_teacher, t.teacher_name, 
				t.teacher_status from school_groups g inner join school_teachers t on g.id_teacher = t.id_teacher 
				where g.id_group=(select max(id_group) from school_groups);');
		return $query;
	}


	function getGroupType($id,$id_teacher){
		if($id > 0)
			$query = $this->db->query('select g.id_group,g.id_grade, g.group_name, g.group_password, t.id_teacher, t.teacher_name, 
				t.teacher_status from school_groups g inner join school_teachers t on g.id_teacher = t.id_teacher 
				where g.id_group='.$id.';');
		else
			$query = $this->db->query('select g.id_group,g.id_grade, g.group_name, g.group_password, t.id_teacher, t.teacher_name, 
				t.teacher_status from school_groups g inner join school_teachers t on g.id_teacher = t.id_teacher 
				where g.id_group=(select max(id_group) from school_groups where id_teacher='.$id_teacher.');');
		return $query;
	}


	function getStudents($id){
		if($id > 0)
			$query = $this->db->query('select * from school_students where id_student in(
					select id_student from school_groups_students where id_group = '.$id.' and id=(
					select max(id)from school_groups_students where id_student=school_students.id_student))
					and student_status = true;');
		else
			$query = $this->db->query('select * from school_students where id_student in(
					select id_student from school_groups_students where id_group = (select max(id_group) from school_groups)
					and id=(select max(id)from school_groups_students where id_student=school_students.id_student))
					and student_status = true;');
		return $query;
	}

	function getStudentsType($id,$id_teacher){
		if($id > 0)
			$query = $this->db->query('select * from school_students where id_student in(
					select id_student from school_groups_students where id_group = '.$id.' and id=(
					select max(id)from school_groups_students where id_student=school_students.id_student))
					and student_status = true;');
		else
			$query = $this->db->query('select * from school_students where id_student in(
					select id_student from school_groups_students where id_group = 
					(select max(id_group) from school_groups where id_teacher='.$id_teacher.')and 
					id=(select max(id)from school_groups_students where id_student=school_students.id_student))
					and student_status = true;');
		return $query;
	}
	
}
?>
