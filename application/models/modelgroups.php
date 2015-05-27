<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class ModelGroups extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function addFile($data){
		$this->db->trans_start();
		$file = $this->db->query('insert into school_files(file_name) values ("'.$data['file_name'].'")');
		if($file){
			$this->db->select_max('id_file','mayor');
			$query = $this->db->get('school_files');
			foreach($query->result() as $max){
				$id_file = $max->mayor;
			}
			$result = $this->db->query('insert into school_group_files (id_group,id_file)values('.$data['id_group'].','.$id_file.')');
		}
		$this->db->trans_complete();
		return $result;
	}

	function addGroup($data){
		$query = $this->db->insert('school_groups',$data);
		return $query;
	}

	function getFile($id){
		if($id > 0){
			$query = $this->db->query('select f.file_name , fg.group_file_date from school_files f 
				inner join school_group_files fg on f.id_file = fg.id_file where fg.id_group = '.$id.';');
			
		}
		else{
			$query = $this->db->query('select f.file_name , fg.group_file_date from school_files f inner join school_group_files fg
			on f.id_file = fg.id_file where fg.id_group = (select max(id_group) from school_groups);');
		}
		return $query;
	}


	function changePass($data){
		$this->db->query('update school_groups set group_password="'.$data['group_password'].'" 
			where id_group='.$data['id_group'].';');
		return $this->db->affected_rows();
	}


	function changeTeacher($data){
		$this->db->query('update school_groups set id_teacher='.$data['id_teacher'].' where id_group='.$data['id_group'].';');
		return $this->db->affected_rows();
	}


	function changeStatus($id,$data){
		$this->db->where('id_student',$id);
		$this->db->update('school_students',$data);
		return $this->db->affected_rows();
	}


	function checkGroup($grade,$teacher,$group){
		$this->db->where('id_grade',$grade);
		//$this->db->where('id_teacher',$teacher);
		$this->db->where('group_name',$group);
		$query = $this->db->get('school_groups');
		return $query;
	}


	function checkAlumno($usuario){
		$query = $this->db->query('select (select max(id) from school_groups_students where 
			id_student = school_students.id_student)as mayor,id_student from school_students
			where student_user="'.$usuario.'" and student_status=true;');
		return $query;
	}

	function getGrades(){
		$query=$this->db->get('school_grades');
		return $query;
	}

	function groups(){
		$this->db->select('id_group,id_grade, group_name');
		$this->db->order_by('id_grade','asc');
		$this->db->order_by('group_name','asc');
		$query = $this->db->get('school_groups');
		return $query;
	}


	function groupsType($id){
		$this->db->where('id_teacher',$id);
		$this->db->select('id_group,id_grade, group_name');
		$this->db->order_by('id_grade','asc');
		$this->db->order_by('group_name','asc');
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

	function showGroup($id,$usuario,$contraseña){
		$query = $this->db->query('select s.student_user , s.id_student ,g.id_group, g.id_grade , 
		g.group_name from school_students s inner join school_groups_students sg on s.id_student = sg.id_student 
		join school_groups g on sg.id_group = g.id_group where s.student_user = "'.$usuario.'" 
		and g.group_password = "'.$contraseña.'" and sg.id = '.$id.';');
		return $query;

	}
	
}
?>
