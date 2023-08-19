<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IjazahTranskrip extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('IjazahTranskrip_model');
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
			$this->load->view('dash_ijazah_transkrip');
			$this->load->view('dash_crud_ijazah');
			$this->load->view('dash_crud_transkrip');
		} else {
			// navigate to login
			redirect(base_url());
		}
	}
	public function get_all_ijazah(){
		$data = $this->IjazahTranskrip_model->get_all_ijazah();
		echo json_encode($data);
	}
	public function get_all_transkrip(){
		$data = $this->IjazahTranskrip_model->get_all_transkrip();
		echo json_encode($data);
	}
	// Ijazah
public function create_ijazah() {
		// Tampilkan halaman form tambah data ijazah
		$data['taruna'] = $this->input->post('taruna');
		$data['program_studi'] = $this->input->post('program_studi');
		$data['tanggal_ijazah'] = $this->input->post('tanggal_ijazah');
		$data['tanggal_pengesahan'] = $this->input->post('tanggal_pengesahan');
		$data['gelar_akademik'] = $this->input->post('gelar_akademik');
		$data['nomor_sk'] = $this->input->post('nomor_sk');
		$data['direktur'] = $this->input->post('direktur');
		$data['wakil_direktur'] = $this->input->post('wakil_direktur');
		$data['nomor_ijazah'] = $this->input->post('nomor_ijazah');
		$data['nomor_seri'] = $this->input->post('nomor_seri');
		$data['tanggal_yudisium'] = $this->input->post('tanggal_yudisium');
		$data['judul_kkw'] = $this->input->post('judul_kkw');
		$processadd = $this->IjazahTranskrip_model->create_ijazah($data);
		echo json_encode($processadd);
}

public function store_ijazah() {
    // Proses tambah data ijazah ke database
}

public function edit_ijazah($id) {
    // Tampilkan halaman form edit data ijazah berdasarkan ID
}

public function update_ijazah() {
		// Proses update data ijazah ke database berdasarkan ID
		$id = $this->input->post('id');
		$data['taruna'] = $this->input->post('taruna');
		$data['program_studi'] = $this->input->post('program_studi');
		$data['tanggal_ijazah'] = $this->input->post('tanggal_ijazah');
		$data['tanggal_pengesahan'] = $this->input->post('tanggal_pengesahan');
		$data['gelar_akademik'] = $this->input->post('gelar_akademik');
		$data['nomor_sk'] = $this->input->post('nomor_sk');
		$data['direktur'] = $this->input->post('direktur');
		$data['wakil_direktur'] = $this->input->post('wakil_direktur');
		$data['nomor_ijazah'] = $this->input->post('nomor_ijazah');
		$data['nomor_seri'] = $this->input->post('nomor_seri');
		$data['tanggal_yudisium'] = $this->input->post('tanggal_yudisium');
		$data['judul_kkw'] = $this->input->post('judul_kkw');
		$processedit = $this->IjazahTranskrip_model->update_ijazah($id, $data);
		echo json_encode($processedit);
}

public function delete_ijazah($id) {
    // Proses hapus data ijazah dari database berdasarkan ID
		$processdata = $this->IjazahTranskrip_model->delete_ijazah($id);
		return $processdata;
}

public function print_ijazah($id) {
    // Proses cetak ijazah dalam bentuk PDF berdasarkan ID
}

// Transkrip Nilai
public function create_transkrip() {
    // Tampilkan halaman form tambah data transkrip nilai
	 $data['taruna'] = $this->input->post('taruna');
	 $data['program_studi'] = $this->input->post('program_studi');
	 $data['ijazah'] = $this->input->post('ijazah');
	 $processadd = $this->IjazahTranskrip_model->create_transkrip($data);
	 echo json_encode($processadd);
}

public function store_transkrip() {
    // Proses tambah data transkrip nilai ke database
}

public function edit_transkrip($id) {
    // Tampilkan halaman form edit data transkrip nilai berdasarkan ID
}

public function update_transkrip() {
    // Proses update data transkrip nilai ke database berdasarkan ID
	 // Tampilkan halaman form tambah data transkrip nilai
	 $data['taruna'] = $this->input->post('taruna');
	 $data['program_studi'] = $this->input->post('program_studi');
	 $data['ijazah'] = $this->input->post('ijazah');
	 $processadd = $this->IjazahTranskrip_model->update_transkrip($data);
	 echo json_encode($processadd);
}

public function delete_transkrip($id) {
    // Proses hapus data transkrip nilai dari database berdasarkan ID
	 $processdata = $this->IjazahTranskrip_model->delete_transkrip($id);
	return $processdata;
}

public function print_transkrip($id) {
    // Proses cetak transkrip nilai dalam bentuk PDF berdasarkan ID
}

}
