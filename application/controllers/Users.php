<?php
// user.php
class Users extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function get_all_user(){
        $data = $this->User_model->get_all_user();
		   echo json_encode($data);   
    }

    public function create() {
        $this->load->view('user/create');
    }

    public function store() {
        $data = [
            'Kode_user' => $this->input->post('kode_user'),
            'Nama' => $this->input->post('nama')
        ];

        $insert_id = $this->User_model->create($data);

        if ($insert_id) {
            $this->session->set_flashdata('success', 'Data user berhasil ditambahkan.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menambahkan data user.');
            redirect('user/create');
        }
    }

    public function edit($id) {
        // $data['user'] = $this->User_model->read($id);
        // $this->load->view('user/edit', $data);
    }

    public function update($id) {
        $data = [
            'Kode_user' => $this->input->post('kode_user'),
            'Nama' => $this->input->post('nama')
        ];

        $affected_rows = $this->User_model->update($id, $data);

        if ($affected_rows) {
            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data user.');
            redirect('user/edit/'.$id);
        }
    }

    public function delete($id) {
        $affected_rows = $this->User_model->delete($id);

        if ($affected_rows) {
            $this->session->set_flashdata('success', 'Data user berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menghapus data user.');
        }

        redirect('user');
    }

	public function create_user() {
    // Tampilkan halaman form tambah data user
      $data['email'] = $this->input->post('email');
      $data['nama'] = $this->input->post('nama');
      $data['role'] = $this->input->post('role');
      $password = md5($this->input->post('password'));
      $data['password'] = $password;
      $processadd = $this->User_model->create($data);
      echo json_encode($processadd);
    }

    public function validasi_user(){
      $this->load->library('session');
      $email = $this->input->post('username');
      $password = $this->input->post('password');
      $enc_pw = md5($password);
      $user_exist = $this->User_model->check_user($email, $enc_pw);
      if(count($user_exist) > 0){
         $this->session->set_userdata('username', $user_exist[0]['nama']);
         $this->session->set_userdata('role', $user_exist[0]['role']);
      }
      echo json_encode($user_exist);
    }

    public function index() {
        $data['url'] = '../assets/icon.png';
        $this->load->library('session');
        $user_session = $this->session->username;
        $user_role = $this->session->role;
        // check session
        if( $user_session != null || $user_session != ''){
            // validasi role user
			if($user_role == 'Administrator'){
                $data['userlogged'] = $user_session;
                $data['role'] = $user_role;
                $this->load->view('resource2', $data);
                $this->load->view('nav', $data);
                $this->load->view('dash_users');
            } else {
                redirect("/not-found");
            }
        } else {
            // navigate to login
            redirect(base_url());
        }
    }

    public function store_user() {
        // Proses tambah data user ke database
    }

    public function edit_user($id) {
        // Tampilkan halaman form edit data user berdasarkan ID
    }

    public function update_user() {
        // Proses update data user ke database berdasarkan ID
         $id = $this->input->post('id');
         $password = $this->input->post('password');
         $data['email'] = $this->input->post('email');
         $data['nama'] = $this->input->post('nama');
         $data['role'] = $this->input->post('role');
         // jika tidak ada update password
         if($password != ''){
            $data['password'] = md5($this->input->post('password'));
         }
         $processedit = $this->User_model->update_user($id, $data);
         echo json_encode($processedit);
      }

    public function delete_user($id) {
        // Proses hapus data user dari database berdasarkan ID
        $processdata = $this->User_model->delete_user($id);
        return $processdata;
    }

}
