<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelStudents extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function addStudent($data){
		$this->db->trans_start();
		$stu = $this->db->query('insert into school_students values(null,"'.$data['student_user'].'",
			"'.$data['student_name'].'","'.$data['student_last_name'].'",
			"'.$data['student_second_last_name'].'",true);');
		if($stu){
			$this->db->select_max('id_student','mayor');
			$query = $this->db->get('school_students');
			foreach($query->result() as $max){
				$id_student = $max->mayor;
			}
			$result = $this->db->query('insert into school_groups_students(id_group,id_student)values
				('.$data['id_group'].','.$id_student.');');
		}
		$this->db->trans_complete();
		return $result;

	}

	function allowStudent($id,$data){
		$this->db->where('id_student',$id);
		$this->db->update('school_students',$data);
		return $this->db->affected_rows();

	}


	function changeGroup($data){
		$query = $this->db->query('insert into school_groups_students values(null,'.$data['id_group'].','.$data['id_student'].')');
		return $query;
	}

	function checkUser($user){
		$this->db->where('student_user',$user);
		$query = $this->db->get('school_students');
		return $query;
	}

	function editStudent($data){
		$this->db->query('update school_students set student_name="'.$data['student_name'].'",student_last_name="'.$data['student_last_name'].'",
			student_second_last_name="'.$data['student_second_last_name'].'", student_user="'.$data['student_user'].'"  
			where id_student='.$data['id_student'].';');
		return $this->db->affected_rows();
	}

	function getStudentsDisabled(){
		$query = $this->db->query('select s.id_student,s.student_name , s.student_last_name, s.student_second_last_name,s.student_user, s.student_status,g.id_grade, g.group_name
			from school_students s inner join school_groups_students sg on s.id_student=sg.id_student join
			school_groups g on sg.id_group=g.id_group where sg.id=(
			select max(id) from school_groups_students where id_student=s.id_student) and s.student_status=false;');
		return $query;
	}
	
	
}
?>
