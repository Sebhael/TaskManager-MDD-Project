<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
	}

	/**
	 * Index Controller
	 */
	public function index()
	{
		$data['pageTitle'] = 'Login / Register';
		$data['mainBlock'] = 'auth/form';
		$data['modules'] = array('placeholder');
		$data['test'] = 'We be loggin in and regisrurin an stuffz';
		$this->load->view('inc/container', $data);
	}

	/**
	 * Process Login Auth
	 */
	public function process()
	{
		/* Check Validation Rules (@app/config/form_validation.php) */
		if($this->form_validation->run() == FALSE)
		{
			/* Apparently we are lacking a username or password in the field...shame on you...*/
			$this->index();
		}

		/* Send to users_model to validate the user's credentials to the database */
		$validate = $this->users_model->validate();

		if($validate) // If a match...
		{
			/* Session Vars */
			$session = array(
					'logged' => 1,
					'username' => $validate['username'],
					'uid' => $validate['id'],
					'admin' => $validate['admin']
				);
			/* Set Session Data */
			$this->session->set_userdata($session);
			/* Successful Login Message @TODO--MSG_SUCCESS Constant */
			$this->session->flashdata('test','testing');
			/* Carry on my friend, and bring me back some beer...*/
			redirect(base_url(),'refresh');
		} else {
			/* Username or Password doesn't exist, send back to the form */
			/* @TODO--Additional validation/response information */
			$this->index();
		}
	}

	public function register()
	{
		$reg = $this->users_model->insert();
		if($reg)
		{
			/* Successful Login Message @TODO--MSG_SUCCESS Constant */
			$this->session->set_flashdata('success_r','<div class="success">You\'ve successfully registered! You can now log in below!</div>');
			/* Carry on my friend, and bring me back some beer...*/
			$this->index();
		}
		else
		{
			$this->session->set_flashdata('error', '<div class="error">I am error.</div>');
			$this->index();
		}
	}

	/**
	 * Logoff Controller
	 *
	 * I didn't want to be here anyways.
	 */ 
	public function logoff()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */