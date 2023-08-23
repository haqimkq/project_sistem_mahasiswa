<?php
// ProgramStudi_model.php
class MataKuliah_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        // $this->db->insert('mata_kuliah', $data);
        // return $this->db->insert_id();
        $data = array(
            'kode' => $data["kode"],
            'matakuliah' => $data["matakuliah"],
            'sks' => $data["sks"],
            'prodi' => $data["prodi"],
            'semester' => $data["semester"],
        );
        // return $this->db->insert('mata_kuliah', $data);
        return $this->db->insert('matakuliah', $data);
    }

    public function read($id = null) {
        if ($id) {
            return $this->db->get_where('mata_kuliah', ['ID' => $id])->row_array();
        } else {
            return $this->db->get('mata_kuliah')->result_array();
        }
    }
    // get all data program studi
    public function get_all_matakuliah(){
        // return $this->db->get('mata_kuliah')->result_array();
        return $this->db->get('matakuliah')->result_array();
    }
    // handle update program studi
    public function update($id, $data) {
        $this->db->where('ID', $id);
        // $this->db->update('mata_kuliah', $data);
        $this->db->update('matakuliah', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('ID', $id);
        // $this->db->delete('mata_kuliah');
        $this->db->delete('matakuliah');
        return $this->db->affected_rows();
    }

}
