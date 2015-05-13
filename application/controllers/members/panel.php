<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelGroups');
		$this->load->model('ModelTeachers');
		$this->load->model('ModelStudents');
		$this->load->model('ModelNews');
		$this->form_validation->set_message('required', '%s es un campo requerido');

	}

	public function index()
	{
		$this->checkLogin();
	}


	function addFile(){
		$data['id_group'] = $this->input->post('id_group');
		$data['file_name'] = $this->input->post('file_name');
		$query = $this->ModelGroups->addFile($data);
		if($query)
			echo true;
		else
			echo false;

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

	function addNews(){
		$this->form_validation->set_rules('txtTitle','Título','required');
		$this->form_validation->set_rules('txtContent','Contenido','required');
		$this->form_validation->set_rules('rdoPro','Noticia destacada','required');
		if($this->form_validation->run()==false){
			$this->frmNews('');
		}
		else{
			$data['id_teacher'] = $this->session->userdata('id_user');
			$data['id_notice_category'] = $this->input->post('slctCategory');
			$data['notice_title'] = $this->input->post('txtTitle');
			$data['notice_content'] = $this->input->post('txtContent');
			$data['notice_picture'] = $this->input->post('txtFile');
			$data['notice_prominent'] = $this->input->post('rdoPro');
			$query = $this->ModelNews->addNews($data);
			if($query > 0){
				$this->getNews();
			}
			else
			{
				$this->frmNews('Error al insertat el registro');
			}

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


	function allowStudent(){
		$id = $this->input->post('id');
		$data['student_status'] = true;
		$ban = $this->ModelGroups->changeStatus($id,$data);
		echo $ban;

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


	function changePass(){
		$data['id_group'] = $this->input->post('id_group');
		$data['group_password'] = md5($this->input->post('group_password'));
		$query = $this->ModelGroups->changePass($data);
		if($query)
			echo true;
		else
			echo false;
	}


	function changeTeacher(){
		$data['id_group'] = $this->input->post('id_group');
		$data['id_teacher'] = $this->input->post('id_teacher');
		$ban = $this->ModelGroups->changeTeacher($data);
		echo $ban;
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

	function editNew(){
		
		$id = $this->uri->segment(4);
		$this->form_validation->set_rules('txtTitle','Título','required');
		$this->form_validation->set_rules('txtContent','Contenido','required');
		$this->form_validation->set_rules('rdoPro','Noticia destacada','required');
		if($this->form_validation->run()==false){
			$this->frmEditNews('',$id);
		}
		else{
			$id = $this->input->post('txtId');
			$data['id_teacher'] = $this->session->userdata('id_user');
			$data['id_notice_category'] = $this->input->post('slctCategory');
			$data['notice_title'] = $this->input->post('txtTitle');
			$data['notice_content'] = $this->input->post('txtContent');
			$data['notice_picture'] = $this->input->post('txtFile');
			$data['notice_prominent'] = $this->input->post('rdoPro');
			$query = $this->ModelNews->editNotice($data,$id);
			if($query > 0){
				$this->getNews();
			}
			else
			{
				$this->frmEditNews('No se modificaron datos',$id);
			}

		}
	}


	function editTeacher(){
		$data = array();
		$data = $this->input->post();
		$query = $this->ModelTeachers->getPassT($data['id_teacher']);
		if($query->num_rows() > 0){
			foreach ($query->result() as $t) {
				if(strcmp($data['teacher_password'], $t->teacher_password) != 0)
					$data['teacher_password'] = md5($data['teacher_password']);
			}
		}
		$ban = $this->ModelTeachers->editTeacher($data);
		echo $ban;
	}

	function frmEditNews($msj,$id){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Edición de avisos";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['msj'] = $msj;
		$data['categories'] = $this->ModelNews->getCategories();
		$data['notice'] = $this->ModelNews->showNotice($id);
		$data['ruta'] = 'news.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/editnews');
		$this->load->view('members/footer');
		$this->load->view('members/scripts');
		$this->load->view('members/tinymce');
		$this->load->view('members/endfile');
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

	function frmNews($msj){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Alta de Avisos";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['msj'] = $msj;
		$data['categories'] = $this->ModelNews->getCategories();
		$data['ruta'] = 'news.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/addnews');
		$this->load->view('members/footer');
		$this->load->view('members/scripts');
		$this->load->view('members/tinymce');
		$this->load->view('members/endfile');

	}

	function getStudentsDisabled(){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Lista de alumnos desabilitados";
		$data['user'] = $this->session->userdata('user');
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['liststudents'] = $this->ModelStudents->getStudentsDisabled();
		$data['ruta'] = 'sdisabled.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/grouplistdisabled');
		$this->includes();
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
			$data['listgroups'] = $this->ModelGroups->getGroupType($id,$this->session->userdata('id_user'));
			//$data['listgroups'] = $this->ModelGroups->getGroups($id);
			$data['liststudents'] = $this->ModelGroups->getStudentsType($id,$this->session->userdata('id_user'));
		}
		$data['teachers'] = $this->ModelTeachers->getTeachers();
		$data['files'] = $this->ModelGroups->getFile($id);
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

	function getNews(){
		if(!$this->session->userdata('user')){
			redirect(base_url().'members/panel');
		}
		$data['title'] = "Lista de noticias";
		$data['user'] = $this->session->userdata('user');
		$data['news'] = $this->ModelNews->getNews();
		$data['options'] = $this->ModelTeachers->getOptions($this->session->userdata('type_user'));
		$data['ruta'] = 'noticelist.js';
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/news');
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

	function deleteNew(){
		$id = $this->input->post('id');
		$query = $this->ModelNews->deleteNew($id);
		if($query > 0)
			echo true;
		else
			echo false;
	}


	function includes(){
		
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
		$data['news'] = $this->ModelNews->getNews();
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

	function upload(){
		$config['upload_path']="./uploads/";
		$config['allowed_types']='gif|png|jpg|doc|docx|pdf';
		$config['max_size']='2048';
		$config['max_width']='0';
		$config['max_height']='0';
		$this->load->library('upload',$config);
		if(!$this->upload->do_upload("user_file"))
		{
			//$data['mensaje']="Inserte la imagen correcta";
			//$error=$this->upload->display_errors('<div class="error">','</div>');
			//$this->frmProducto($data);
			echo 'error';
		}
		else
		{
			$data=$this->upload->data();
			echo $data['file_name'];
		}
	}

}

?>
