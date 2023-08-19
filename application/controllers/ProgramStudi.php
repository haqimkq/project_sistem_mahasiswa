<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgramStudi extends CI_Controller {
	public function __construct(){
		parent::__construct();
	
		$this->load->model('ProgramStudi_model');
	}
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
		$this->load->library('session');
			$user_session = $this->session->username;
			$user_role = $this->session->role;
			// check session
			if( $user_session != null || $user_session != ''){
				$data['userlogged'] = $user_session;
				$data['role'] = $user_role;
				$this->load->view('resource');
				$this->load->view('nav', $data);
				$this->load->view('dash_program_studi');
			} else {
				// navigate to login
				redirect(base_url());
			}
	}
	// get data all program studi
	public function get_all_programstudi(){
		$data = $this->ProgramStudi_model->get_all_programstudi();
		echo json_encode($data);
	}

    // Tampilkan halaman form tambah data program studi
	public function create_programstudi() {
		$data['nama'] = $this->input->post('nama');
		$data['program_pendidikan'] = $this->input->post('program_pendidikan');
		$data['akreditasi'] = $this->input->post('akreditasi');
		$data['sk_akreditasi'] = $this->input->post('sk_akreditasi');
		$processadd = $this->ProgramStudi_model->create($data);
		echo json_encode($processadd);
	}

	public function store_programstudi() {
		// Proses tambah data program studi ke database
	}

	public function edit_programstudi($id) {
		$this->load->view('resource');
		$this->load->view('nav');
		$data['programstudi'] = $this->ProgramStudi_model->get_programstudi_by_id($id); // Ambil data program studi berdasarkan ID
		$data['all_programstudi'] = $this->ProgramStudi_model->read(); // Ambil semua data program studi
		$this->load->view('edit_program_studi', $data);
	}
	

	public function update_programstudi() {
        $id = $this->input->post('id');
        $data['nama'] = $this->input->post('nama');
        $data['program_pendidikan'] = $this->input->post('program_pendidikan');
        $data['akreditasi'] = $this->input->post('akreditasi');
        $data['sk_akreditasi'] = $this->input->post('sk_akreditasi');
		$processedit = $this->ProgramStudi_model->update($id, $data);
		echo json_encode($processedit);
	}
		
	public function delete_programstudi($id) {
		$processdata = $this->ProgramStudi_model->delete($id);
		return $processdata;
	}
	

}
