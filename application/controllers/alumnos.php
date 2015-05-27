<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumnos extends CI_Controller {

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
		if(!$this->session->userdata('alumno')){
			$this->checkLogin();
		}
		else
			$this->panel();
	
		
	}

	function checkLogin(){
		$this->form_validation->set_rules('txtUser', 'Usuario','required|trim');
		$this->form_validation->set_rules('txtPass', 'Contraseña', 'trim|required|md5');
		if($this->form_validation->run()==false){
			$this->acceso("");
		}
		else{
			$data['usuario'] = $this->input->post('txtUser');
			$data['contraseña']= $this->input->post('txtPass');
			$checkUser = $this->ModelGroups->checkAlumno($data['usuario']);
			if($checkUser->num_rows() > 0){
				foreach($checkUser->result() as $row){
					$idG = $row->mayor;
					$query = $this->ModelGroups->showGroup($idG,$data['usuario'],$data['contraseña']);
					if($query->num_rows() > 0)
					{
						foreach($query->result() as $res){
							$this->session->set_userdata('alumno',$res->student_user);
							$this->session->set_userdata('group',$res->group_name);
							$this->session->set_userdata('grade',$res->id_grade);
							$this->session->set_userdata('idgrupo',$res->id_group);
							//$vec['grado'] = $res->id_grade;
							//$vec['grupo'] = $res->group_name; 
							
						}
						$this->panel();

					}
					else{
						$this->acceso('Contraseña de grupo incorrecta');
					}
				}

			}
			else
				$this->acceso('Usuario inexistente o desactivado');
			
		}
	}

	function acceso($msj){
		$data['title'] = "Acceso a alumnos";
		$data['msj'] = $msj;
		$this->load->view('includes/header');
		$this->load->view('login',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
	}

	function cerrar(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

	function frmRegistro($msj){
		$data['title'] = "Registro de alumnos";
		$data['msj'] = $msj;
		$data['groups'] = $this->ModelGroups->groups();
		$this->load->view('includes/header');
		$this->load->view('registro',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
	}

	function panel(){
		if(!$this->session->userdata('alumno')){
			redirect(base_url().'alumnos/index');
		}

		$data['user'] = $this->session->userdata('alumno');
		$data['grado'] = $this->session->userdata('grade'); 
		$data['grupo'] = $this->session->userdata('group');
		$data['idgrupo'] = $this->session->userdata('idgrupo');
		$data['files'] = $this->ModelGroups->getFile($this->session->userdata('idgrupo'));
		$this->load->view('panel',$data);
	}


	function registro(){
		$this->form_validation->set_rules('lstGroup', 'Grupo','required');
		$this->form_validation->set_rules('student_name', 'Nombre','required');
		$this->form_validation->set_rules('student_last_name', 'Apellido Materno', 'required');
		$this->form_validation->set_rules('student_second_last_name', 'Apellido Paterno', 'required');
		$this->form_validation->set_rules('student_user', 'Usuario','required|trim');
		
		if($this->form_validation->run()==false){
			$this->frmRegistro("");
		}
		else{
			$data['student_user'] = $this->input->post('student_user');
			$data['student_name'] = $this->input->post('student_name');
			$data['student_last_name'] = $this->input->post('student_last_name');
			$data['student_second_last_name'] = $this->input->post('student_second_last_name');
			$data['id_group'] = $this->input->post('lstGroup');
			$check = $this->ModelStudents->checkUser($this->input->post('student_user'));
			if($check->num_rows() > 0)
				$cadena = '<div class="alert alert-danger" role="alert">El usuario '.$data['student_user'].' ya esta dado de alta</div>';
			else{
				$query = $this->ModelStudents->addStudent($data);
				if($query > 0)
					$cadena = '<div class="alert alert-success" role="alert">Registro correcto</div>';
				else
					$cadena = '<div class="alert alert-danger" role="alert">Hubo un error consulte con su proveedor de software</div>';
			}
			$this->frmRegistro($cadena);
			
		}
	}

	
}
?>
