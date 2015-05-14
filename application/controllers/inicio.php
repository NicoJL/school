<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

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
		$data['slides'] = $this->ModelNews->getNoticePro();
		$this->load->view('includes/header');
		$this->load->view('inicio',$data);
		$this->load->view('includes/footer');
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */