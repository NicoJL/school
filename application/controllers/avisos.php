<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avisos extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('pagination');
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

	function categoria(){
		$id = $this->uri->segment(3);
		$cantidad = 0;
		$uri_segment=4;
		$offset=$this->uri->segment($uri_segment);
		if (empty($offset))
			$offset=0;
		/* cantidad de elementos que regresa la consulta */
		$qty = $this->ModelNews->countCat($id);
		foreach($qty->result() as $cant)
			$cantidad = $cant->cantidad;
		$config['base_url']=base_url().'avisos/categoria/'.$id.'/';
		$config['total_rows'] = $cantidad;
		$config['per_page'] = 2; 
		$connfig['num_links']=5;
		$config['first_link']="Primero";
		$config['last_link']="Último";
		$config['next_link']="Siguiente";
		$config['prev_link']="Atrás";
		$config['cur_tag_open']="<strong>";
		$config['cur_tag_close']="</strong>";
		$config['uri_segment']=$uri_segment;
		$this->pagination->initialize($config); 
		$data['paginacion'] = $this->pagination->create_links();
		$data['notices'] = $this->ModelNews->getNewsPagination($id,$offset,$config['per_page']);
		$this->load->view('includes/header');
		$this->load->view('categoria',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');

	}

	function busqueda(){
		$data['cadena'] = $this->input->post('txtSearch');
		$data['notices'] = $this->ModelNews->getSearch($data['cadena']);
		$this->load->view('includes/header');
		$this->load->view('busqueda',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
	}


}
?>