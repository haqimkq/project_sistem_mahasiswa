<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataKuliah extends CI_Controller {
public function __construct(){
		parent::__construct();

		$this->load->model('MataKuliah_model');
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
			$data['url'] = '../assets/icon.png';
			$this->load->view('resource2', $data);
			$this->load->view('nav', $data);
			$this->load->view('dash_mata_kuliah');
		} else {
			// navigate to login
			redirect(base_url());
		}
	}
		// get data all program studi
	public function get_all_matakuliah(){
		$data = $this->MataKuliah_model->get_all_matakuliah();
		echo json_encode($data);
	}

    // Tampilkan halaman form tambah data mata kuliah
	public function create_matakuliah() {
		$data['kode'] = $this->input->post('kode');
		$data['matakuliah'] = $this->input->post('matakuliah');
		$data['sks'] = $this->input->post('sks');
		$data['semester'] = $this->input->post('semester');
		$processadd = $this->MataKuliah_model->create($data);
		echo json_encode($processadd);
	}


public function store_matakuliah() {
    // Proses tambah data mata kuliah ke database
}

public function edit_matakuliah($id) {
    // Tampilkan halaman form edit data mata kuliah berdasarkan ID
}

public function update_matakuliah() {
    // Proses update data mata kuliah ke database berdasarkan ID
	$id = $this->input->post('id');
	$data['kode'] = $this->input->post('kode');
	$data['matakuliah'] = $this->input->post('matakuliah');
	$data['sks'] = $this->input->post('sks');
	$data['semester'] = $this->input->post('semester');
	
	$processedit = $this->MataKuliah_model->update($id, $data);
	echo json_encode($processedit);
}

public function delete_matakuliah($id) {
    // Proses hapus data mata kuliah dari database berdasarkan ID
	$processdata = $this->MataKuliah_model->delete($id);
	return $processdata;
}

}
