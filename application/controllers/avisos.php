<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avisos extends CI_Controller {

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
		
		
	}

	function mostrar(){
		$id = $this->uri->segment(2);
		$data['noticia'] = $this->ModelNews->getNoticeSelec($id);
		$this->load->view('includes/header');
		$this->load->view('noticia',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
	}
}
?>