<?php

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        $data = array(
            'email' => $data["email"],
            'nama' => $data["nama"],
            'role' => $data["role"],
            'password' => $data["password"]
        );
        return $this->db->insert('user_access', $data);
    }
    public function get_all_user(){
        return $this->db->get('user_access')->result_array();
    }
    public function check_user($email, $password){
        return $this->db->query(" SELECT * FROM user_access WHERE email = '$email' AND password = '$password' ")->result_array();
    }
    public function read_kota($id = null) {
        if ($id) {
            return $this->db->get_where('Kota', ['ID' => $id])->row_array();
        } else {
            return $this->db->get('Kota')->result_array();
        }
    }

    public function update_user($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('user_access', $data);
        return $this->db->affected_rows();
    }

    public function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('user_access');
        return $this->db->affected_rows();
    }
}
