<?php
// ProgramStudi_model.php
class Nilai_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        $data = array(
            'taruna' => $data["taruna"],
            'nilai_angka' => $data["nilai_angka"],
            'nilai_huruf' => $data["nilai_huruf"],
            'matakuliah' => $data["matakuliah"]
        );
        return $this->db->insert('nilai', $data);
    }

    public function read($id = null) {
        if ($id) {
            return $this->db->get_where('Nilai', ['ID' => $id])->row_array();
        } else {
            return $this->db->get('Nilai')->result_array();
        }
    }
    // get penilaian by nim
    public function get_penilaian_by_nim($nim){
        return $this->db->query("SELECT nilai.nilai_angka, nilai.nilai_huruf, matakuliah.kode, matakuliah.matakuliah, matakuliah.sks, matakuliah.semester, mahasiswa.nama, mahasiswa.nomor_taruna FROM `nilai` as nilai
        LEFT JOIN matakuliah as matakuliah
        on nilai.matakuliah = matakuliah.id
        LEFT JOIN taruna as mahasiswa
        on nilai.taruna = mahasiswa.id
        WHERE mahasiswa.nomor_taruna = '$nim'")->result_array();
    }
    // get all data penilaian
    public function get_all_penilaian(){
        return $this->db->query("SELECT nilai.id, taruna.nomor_taruna as nim, taruna.nama as taruna, taruna.id as tarunaid, nilai.nilai_angka, nilai.nilai_huruf, matakuliah.semester as semester, matakuliah.matakuliah, matakuliah.id as matakuliahid FROM nilai LEFT JOIN taruna ON taruna.id = nilai.taruna LEFT JOIN matakuliah ON matakuliah.id = nilai.matakuliah")->result_array();
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('nilai', $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('nilai');
        return $this->db->affected_rows();
    }
}
