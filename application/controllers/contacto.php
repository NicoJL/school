<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("email");
		$this->form_validation->set_message('required', '%s es un campo requerido');

	}

	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('contacto');
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
		
	}

	function sendMail(){
		$configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'iscoshy@gmail.com',
            'smtp_pass' => 'IscoShy1*%@',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );    
 
        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);
 
		$this->email->from($this->input->post('txtemail'),$this->input->post('txtname'));
		$this->email->to('njl27@hotmail.com');
		$this->email->subject($this->input->post('txtAsunto'));
		$this->email->message('<p>Email enviado desde '.$this->input->post('txtemail').'</p>'.$this->input->post('txtMensaje'));
		//$this->email->send();
	  	//var_dump($this->email->print_debugger());
	  	$data['msj']='';
	  	if($this->email->send())
	  		$data['msj'] = "Tu correo ha sido enviado correctamente , en breve estaremos en contacto ";
	  	else
	  		$data['msj'] = 'No hemos podido enviar tu mensaje intentalo mas tarde';

	  	$this->load->view('includes/header');
		$this->load->view('mensaje.php',$data);
		$this->load->view('includes/prefooter');
		$this->load->view('includes/footer');
	}

	
}
?>
