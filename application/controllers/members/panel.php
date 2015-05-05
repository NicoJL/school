<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelGroups');
		$this->load->model('ModelTeachers');
		$this->load->model('ModelStudents');
		$this->form_validation->set_message('required', '%s es un campo requerido');

	}

	public function index()
	{
		$this->checkLogin();
	}

	function addGroup(){
		$this->form_validation->set_rules('txtPass', 'Contraseña', 'trim|required|md5');
		if($this->form_validation->run()==false){
			$this->frmGroups("");
		}
		else{
			$data['id_grade'] = $this->input->post('lstGrade');
			$data['id_teacher'] = $this->input->post('lstTeacher');
			$data['group_name'] = $this->input->post('lstNameGroup');
			$data['group_password'] = $this->input->post('txtPass');
			$check = $this->ModelGroups->checkGroup($data['id_grade'],$data['id_teacher'],$data['group_name']);
			if($check->num_rows() > 0)
				$cadena = '<div class="alert alert-danger" role="alert">Ese grupo ya esta dado de alta</div>';
			else{
				$query = $this->ModelGroups->addGroup($data);
				if($query > 0)
					$cadena = '<div class="alert alert-success" role="alert">Se agrego el grupo correctamente</div>';
				else
					$cadena = '<div class="alert alert-danger" role="alert">Hubo un error consulte con su proveedor de software</div>';
			}
			$this->frmGroups($cadena);

		}
		
	}


	function addTeacher(){
		$this->form_validation->set_rules('txtName', 'Nombre','required');
		$this->form_validation->set_rules('txtUser', 'Usuario','required|trim');
		$this->form_validation->set_rules('txtPass', 'Contraseña', 'trim|required|md5');
		if($this->form_validation->run()==false){
			$this->frmTeacher("");
		}
		else{
			$data['id_type'] = $this->input->post('lstTipos');
			$data['teacher_name'] = $this->input->post('txtName');
			$data['teacher_nick_name'] = $this->input->post('txtUser');
			$data['teacher_password'] = $this->input->post('txtPass');
			$data['teacher_status'] = 1;
			$check = $this->ModelTeachers->checkTeacher($data['teacher_nick_name']);
			if($check->num_rows() > 0)
				$cadena = '<div class="alert alert-danger" role="alert">El nombre de usuario '.$data['teacher_nick_name'].' ya esta dado de alta</div>';
			else{
				$query = $this->ModelTeachers->addTeacher($data);
				if($query > 0)
					$cadena = '<div class="alert alert-success" role="alert">Se agrego el maestro correctamente</div>';
				else
					$cadena = '<div class="alert alert-danger" role="alert">Hubo un error consulte con su proveedor de software</div>';
			}
			$this->frmTeacher($cadena);

		}
	}


	function changeGroup(){
		$data['id_group'] = $this->input->post('id_group');
		$data['id_student'] = $this->input->post('id_student');
		$query = $this->ModelStudents->changeGroup($data);
		if($query)
			echo true;
		else
			echo false;
	}


	function checkLogin(){
		$this->form_validation->set_rules('txtUser', 'Usuario','required|trim');
		$this->form_validation->set_rules('txtPass', 'Contraseña', 'trim|required|md5');
		if($this->form_validation->run()==false){
			$this->login("");
		}
		else{
			$data['usuario'] = $this->input->post('txtUser');
			$data['contraseña']= $this->input->post('txtPass');
			$check = $this->ModelTeachers->checkLogin($data['usuario'],$data['contraseña']);
			if($check->num_rows() > 0){
				foreach($check->result() as $row)
				{
					$this->session->set_userdata('user',$row->teacher_nick_name);
					$this->session->set_userdata('id_user',$row->id_teacher);
					$this->session->set_userdata('type_user',$row->id_type);
				}
				$this->inicio();
			}
			else{
				$this->login('Usuario o contraseña incorrectos');
			}
		}
	}


	function closeSesion()
	{
		$this->session->sess_destroy();
		$this->index();
	}


	function frmGroups($msj){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Alta de Grupos";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['msj'] = $msj;
		$data['teachers'] = $this->ModelTeachers->getTeachers();
		$data['grades'] = $this->ModelGroups->getGrades();
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/addgroups');
		$this->load->view('members/footer');
		$this->load->view('members/endfile');
	}

	function frmTeacher($msj){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Alta de Maestros";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['msj'] = $msj;
		$data['types'] = $this->ModelTeachers->getTypes();
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/addteacher');
		$this->load->view('members/footer');
		$this->load->view('members/endfile');
	}


	function getGroups(){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Lista de grupos";
		$data['user'] = $this->session->userdata('user');
		if($this->input->post('lstGroup'))
			$id = $this->input->post('lstGroup');
		else
			$id = 0;
		if($this->session->userdata('type_user') == 1){
			$data['groups'] = $this->ModelGroups->groups();
			$data['listgroups'] = $this->ModelGroups->getGroups($id);
			$data['liststudents'] = $this->ModelGroups->getStudents($id);
		}
		else{
			$data['groups'] = $this->ModelGroups->groupsType($this->session->userdata('id_user'));
			//$data['listgroups'] = $this->ModelGroups->getGroupType($id,$this->session->userdata('id_user'));
			$data['listgroups'] = $this->ModelGroups->getGroups($id);
			$data['liststudents'] = $this->ModelGroups->getStudentsType($id,$this->session->userdata('id_user'));
		}
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['ruta'] = 'groups.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/grouplist');
		$this->load->view('members/footer');
		$this->load->view('members/tables');
		$this->load->view('members/scripts');
		$this->load->view('members/endfile');
	}

	function getTeachers(){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Lista de maestros";
		$data['user'] = $this->session->userdata('user');
		$data['teachers'] = $this->ModelTeachers->getAllTeacher();
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['ruta'] = 'teachers.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/teacherlist');
		$this->load->view('members/footer');
		$this->load->view('members/tables');
		$this->load->view('members/scripts');
		$this->load->view('members/endfile');
	}

	function inicio(){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Inicio";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/1');
		$this->load->view('members/footer');
		$this->load->view('members/endfile');
	}

	function login($msj){
		$data['title'] = "Acceso a usuarios";
		$data['msj'] = $msj;
		$this->load->view('members/header',$data);
		$this->load->view('members/login');
	}

	function updateStatus(){
		$id = $this->input->post('id');
		$data['teacher_status'] = false;
		$ban = $this->ModelTeachers->changeStatus($id,$data);
		echo $ban;

	}

	function updateStatusStudent(){
		$id = $this->input->post('id');
		$data['student_status'] = false;
		$ban = $this->ModelGroups->changeStatus($id,$data);
		echo $ban;

	}

}

?>
