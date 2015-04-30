<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('ModelGroups');
		$this->load->model('ModelTeachers');
		$this->form_validation->set_message('required', '%s es un campo requerido');

	}

	public function index()
	{
		$data['title'] = "Inicio";
		$this->load->view('members/header',$data);
		$this->load->view('members/wrapper');
		$this->load->view('members/home');
		$this->load->view('members/1');
		$this->load->view('members/footer');
		$this->load->view('members/endfile');
	}

	function frmGroups($msj){
		$data['title'] = "Alta de Grupos";
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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */