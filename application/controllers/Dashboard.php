<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	* 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$data['url'] = '../assets/icon.png';
		$this->load->library('session');
		// check session
		$user_session = $this->session->username;
		$user_role = $this->session->role;
		if( $user_session != null || $user_session != ''){
			$data['userlogged'] = $user_session;
			$data['role'] = $user_role;
			$this->load->view('resource2', $data);
			$this->load->view('nav', $data);
			$this->load->view('welcome_message', $data);
		} else {
			// navigate to login
			redirect(base_url());
		}
	}
	public function login(){
		// clear session
		$this->load->library('session');
		$this->session->set_userdata('username', null);
		$data['userlogged'] = $this->session->username;
		// load page login
		$data['url'] = './assets/icon.png';
		$this->load->view('resource', $data);
		$this->load->view('login');
	}
}
