<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	public function __construct(){
		parent::__construct();
	
		$this->load->model('Nilai_model');
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
		// check session
		if( $user_session != null || $user_session != ''){
			$data['userlogged'] = $user_session;
			$data['url'] = '../assets/icon.png';
			$this->load->view('resource2', $data);
			$this->load->view('nav', $data);
			$this->load->view('dash_penilaian');
		} else {
			// navigate to login
			redirect(base_url());
		}
	}
	// get all data penilaian
	public function get_all_penilaian(){
		$data = $this->Nilai_model->get_all_penilaian();
		echo json_encode($data);
	}
	public function create_penilaian() {
		// Tampilkan halaman form tambah data penilaian
		$data['taruna'] = $this->input->post('taruna');
		$data['nilai_huruf'] = $this->input->post('nilai_huruf');
		$data['nilai_angka'] = $this->input->post('nilai_angka');
		$data['matakuliah'] = $this->input->post('matakuliah');
		$processadd = $this->Nilai_model->create($data);
		echo json_encode($processadd);
	}
	public function get_penilaian_by_nim($nim){
		$data = $this->Nilai_model->get_penilaian_by_nim($nim);
		echo json_encode($data);
	}
	public function store_penilaian() {
		// Proses tambah data penilaian ke database
	}

	public function edit_penilaian($id) {
		// Tampilkan halaman form edit data penilaian berdasarkan ID
	}

	public function update_penilaian() {
		// Proses update data penilaian ke database berdasarkan ID
		$id = $this->input->post('id');
        $data['taruna'] = $this->input->post('taruna');
        $data['nilai_angka'] = $this->input->post('nilai_angka');
        $data['nilai_huruf'] = $this->input->post('nilai_huruf');
        $data['matakuliah'] = $this->input->post('matakuliah');
		$processedit = $this->Nilai_model->update($id, $data);
		echo json_encode($processedit);
	}

	public function delete_penilaian($id) {
		// Proses hapus data penilaian dari database berdasarkan ID
		$processdata = $this->Nilai_model->delete($id);
		return $processdata;
	}

}
