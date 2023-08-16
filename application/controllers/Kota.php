<?php
// Kota.php
class Kota extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Kota_model');
    }

    public function get_all_kota(){
        $data = $this->Kota_model->get_all_kota();
		echo json_encode($data);   
    }

    public function create() {
        $this->load->view('kota/create');
    }

    public function store() {
        $data = [
            'Kode_Kota' => $this->input->post('kode_kota'),
            'Nama' => $this->input->post('nama')
        ];

        $insert_id = $this->Kota_model->create($data);

        if ($insert_id) {
            $this->session->set_flashdata('success', 'Data kota berhasil ditambahkan.');
            redirect('kota');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan data kota.');
            redirect('kota/create');
        }
    }

    public function edit($id) {
        // $data['kota'] = $this->Kota_model->read($id);
        // $this->load->view('kota/edit', $data);
    }

    public function update($id) {
        $data = [
            'Kode_Kota' => $this->input->post('kode_kota'),
            'Nama' => $this->input->post('nama')
        ];

        $affected_rows = $this->Kota_model->update($id, $data);

        if ($affected_rows) {
            $this->session->set_flashdata('success', 'Data kota berhasil diperbarui.');
            redirect('kota');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data kota.');
            redirect('kota/edit/'.$id);
        }
    }

    public function delete($id) {
        $affected_rows = $this->Kota_model->delete($id);

        if ($affected_rows) {
            $this->session->set_flashdata('success', 'Data kota berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data kota.');
        }

        redirect('kota');
    }

	public function create_kota() {
    // Tampilkan halaman form tambah data kota
        $data['kode_kota'] = $this->input->post('kode_kota');
        $data['nama'] = $this->input->post('nama');
        $processadd = $this->Kota_model->create($data);
        echo json_encode($processadd);
    }

    public function index() {
        $data['url'] = '../assets/icon.png';
        $this->load->view('resource2', $data);
        $this->load->view('nav');
        $this->load->view('dash_kota');
    }

    public function store_kota() {
        // Proses tambah data kota ke database
    }

    public function edit_kota($id) {
        // Tampilkan halaman form edit data kota berdasarkan ID
    }

    public function update_kota() {
        // Proses update data kota ke database berdasarkan ID
        $id = $this->input->post('id');
        $data['kode_kota'] = $this->input->post('kode_kota');
        $data['nama'] = $this->input->post('nama');
        $processedit = $this->Kota_model->update($id, $data);
        echo json_encode($processedit);
    }

    public function delete_kota($id) {
        // Proses hapus data kota dari database berdasarkan ID
        $processdata = $this->Kota_model->delete($id);
        return $processdata;
    }

}
