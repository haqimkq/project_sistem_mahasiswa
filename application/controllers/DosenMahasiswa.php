<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DosenMahasiswa extends CI_Controller {
	public function __construct(){
		parent::__construct();
	
		$this->load->model('DosenMahasiswa_model');
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
		$data['url'] = '../assets/icon.png';
		$this->load->library('session');
		$user_session = $this->session->username;
		// check session
		if( $user_session != null || $user_session != ''){
			$data['userlogged'] = $user_session;
			$this->load->view('resource2', $data);
			$this->load->view('nav', $data);
			$this->load->view('dash_dosen_mahasiswa');
		} else {
			// navigate to login
			redirect(base_url());
		}
	}

	// Dosen
	public function create_dosen() {
		// Tampilkan halaman form tambah data dosen
		$data['nama'] = $this->input->post('nama');
		$data['nidn'] = $this->input->post('nidn');
		$data['golongan'] = $this->input->post('golongan');
		$data['jabatan'] = $this->input->post('jabatan');
		$processadd = $this->DosenMahasiswa_model->create_dosen($data);
		echo json_encode($processadd);
	}

	public function store_dosen() {
		// Proses tambah data dosen ke database
	}

	public function edit_dosen($id) {
		// Tampilkan halaman form edit data dosen berdasarkan ID
	}

	public function update_dosen() {
		// Proses update data dosen ke database berdasarkan ID
		$id = $this->input->post('id');
        $data['nama'] = $this->input->post('nama');
        $data['nidn'] = $this->input->post('nidn');
        $data['golongan'] = $this->input->post('golongan');
        $data['jabatan'] = $this->input->post('jabatan');
		$processedit = $this->DosenMahasiswa_model->update_dosen($id, $data);
		echo json_encode($processedit);
	}

	public function delete_dosen($id) {
		// Proses hapus data dosen dari database berdasarkan ID
		$processdata = $this->DosenMahasiswa_model->delete_dosen($id);
		return $processdata;
	}
	public function get_all_mahasiswa(){
		$data = $this->DosenMahasiswa_model->get_all_mahasiswa();
		echo json_encode($data);
	}
	public function get_all_dosen(){
		$data = $this->DosenMahasiswa_model->get_all_dosen();
		echo json_encode($data);
	}
	// Mahasiswa
	public function create_mahasiswa() {
		// Tampilkan halaman form tambah data mahasiswa
		$data['nama'] = $this->input->post('nama');
		$data['nomor_taruna'] = $this->input->post('nomor_taruna');
		$data['tempat_lahir'] = $this->input->post('tempat_lahir');
		$data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
		$data['program_studi'] = $this->input->post('program_studi');
		$data['foto'] = $this->input->post('foto');
		$processadd = $this->DosenMahasiswa_model->create_mahasiswa($data);
		echo json_encode($processadd);
	}

	public function store_mahasiswa() {
		// Proses tambah data mahasiswa ke database
	}

	public function edit_mahasiswa($id) {
		// Tampilkan halaman form edit data mahasiswa berdasarkan ID
	}

	public function update_mahasiswa() {
		// Proses update data mahasiswa ke database berdasarkan ID
		$id = $this->input->post('id');
		$data['nama'] = $this->input->post('nama');
		$data['nomor_taruna'] = $this->input->post('nomor_taruna');
		$data['tempat_lahir'] = $this->input->post('tempat_lahir');
		$data['tanggal_lahir'] = $this->input->post('tanggal_lahir');
		$data['program_studi'] = $this->input->post('program_studi');
		$data['foto'] = $this->input->post('foto');
		$processedit = $this->DosenMahasiswa_model->update_mahasiswa($id, $data);
		echo json_encode($processedit);
	}

	public function delete_mahasiswa($id) {
		// Proses hapus data mahasiswa dari database berdasarkan ID
		$processdata = $this->DosenMahasiswa_model->delete_mahasiswa($id);
		return $processdata;
	}

}
