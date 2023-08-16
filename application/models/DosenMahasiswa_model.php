<?php
// DosenMahasiswa_model.php
class DosenMahasiswa_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Operasi pada tabel Dosen
    public function create_dosen($data) {
        $this->db->insert('pejabat', $data);
        return $this->db->insert_id();
    }

    public function read_dosen($id = null) {
        if ($id) {
            return $this->db->get_where('Dosen', ['ID' => $id])->row_array();
        } else {
            return $this->db->get('Dosen')->result_array();
        }
    }
    public function get_all_mahasiswa(){
        return $this->db->query("SELECT mahasiswa.id, mahasiswa.nama, mahasiswa.nomor_taruna, mahasiswa.tempat_lahir, mahasiswa.tanggal_lahir, mahasiswa.program_studi, mahasiswa.foto, kota.nama as namakota, prodi.nama as namaprodi, prodi.program_pendidikan, prodi.akreditasi FROM `taruna` as mahasiswa 
        LEFT JOIN kota  as kota
        ON mahasiswa.tempat_lahir = kota.id
        LEFT JOIN program_studi as prodi
        ON mahasiswa.program_studi = prodi.id")->result_array();   
    }
    public function get_all_dosen(){
        return $this->db->get('pejabat')->result_array();   
    }
    public function update_dosen($id, $data) {
        $this->db->where('ID', $id);
        $this->db->update('pejabat', $data);
        return $this->db->affected_rows();
    }

    public function delete_dosen($id) {
        $this->db->where('ID', $id);
        $this->db->delete('pejabat');
        return $this->db->affected_rows();
    }

  public function create_mahasiswa($data) {
    // Ambil data dari parameter
    $nama = $data["nama"];
    $nomor_taruna = $data["nomor_taruna"];
    $tempat_lahir = $data["tempat_lahir"];
    $tanggal_lahir = $data["tanggal_lahir"];
    $program_studi = $data["program_studi"];

    // Proses unggah foto
    $foto = '';
    if (!empty($_FILES['foto']['name'])) {
        $config['upload_path'] = './upload/'; // Tentukan direktori penyimpanan file
        $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Jenis file yang diizinkan
        $config['max_size'] = 2048; // Batas ukuran file (dalam kilobyte)
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('foto')) {
            // Jika unggahan berhasil, simpan nama file foto ke variabel $foto
            $upload_data = $this->upload->data();
            $foto = $upload_data['file_name'];
        } else {
            // Jika unggahan gagal, tangani kesalahan jika diperlukan
            // Anda dapat menyesuaikan penanganan kesalahan sesuai kebutuhan Anda
            // Misalnya, memberikan pesan error atau mencatat pesan kesalahan
            echo 'Gagal mengunggah foto: ' . $this->upload->display_errors();
            return false; // Mengembalikan false untuk menandakan kegagalan
        }
    }

    // Data mahasiswa yang akan disimpan ke database
    $data = array(
        'nama' => $nama,
        'nomor_taruna' => $nomor_taruna,
        'tempat_lahir' => $tempat_lahir,
        'tanggal_lahir' => $tanggal_lahir,
        'program_studi' => $program_studi,
        'foto' => $foto
    );

    // Panggil fungsi insert pada CI_Model untuk menyimpan data ke database
    return $this->db->insert('taruna', $data);
}


    public function read_mahasiswa($id = null) {
        if ($id) {
            return $this->db->get_where('Mahasiswa', ['ID' => $id])->row_array();
        } else {
            return $this->db->get('Mahasiswa')->result_array();
        }
    }

    public function update_mahasiswa($id, $data) {
        // Ambil data dari parameter
        $nama = $data["nama"];
        $nomor_taruna = $data["nomor_taruna"];
        $tempat_lahir = $data["tempat_lahir"];
        $tanggal_lahir = $data["tanggal_lahir"];
        $program_studi = $data["program_studi"];
        // Proses unggah foto
        $foto = '';
        if (!empty($_FILES['foto']['name'])) {
            $config['upload_path'] = './upload/'; // Tentukan direktori penyimpanan file
            $config['allowed_types'] = 'jpg|jpeg|png|gif'; // Jenis file yang diizinkan
            $config['max_size'] = 2048; // Batas ukuran file (dalam kilobyte)
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                // Jika unggahan berhasil, simpan nama file foto ke variabel $foto
                $upload_data = $this->upload->data();
                $foto = $upload_data['file_name'];
            } else {
                // Jika unggahan gagal, tangani kesalahan jika diperlukan
                // Anda dapat menyesuaikan penanganan kesalahan sesuai kebutuhan Anda
                // Misalnya, memberikan pesan error atau mencatat pesan kesalahan
                echo 'Gagal mengunggah foto: ' . $this->upload->display_errors();
                return false; // Mengembalikan false untuk menandakan kegagalan
            }
        }
        // Data mahasiswa yang akan disimpan ke database
        $data = array(
            'nama' => $nama,
            'nomor_taruna' => $nomor_taruna,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'program_studi' => $program_studi,
            'foto' => $foto
        );
        $this->db->where('id', $id);
        $this->db->update('taruna', $data);
        return $this->db->affected_rows();
    }

    public function delete_mahasiswa($id) {
        $this->db->where('ID', $id);
        $this->db->delete('taruna');
        return $this->db->affected_rows();
    }

// 	class DosenMahasiswa_model extends CI_Model {
//     public function create_dosen($data) {
//         $this->db->insert('Dosen', $data);
//         return $this->db->insert_id();
//     }

//     public function read_dosen($id = null) {
//         if ($id) {
//             return $this->db->get_where('Dosen', ['ID' => $id])->row_array();
//         } else {
//             return $this->db->get('Dosen')->result_array();
//         }
//     }

//     public function update_dosen($id, $data) {
//         $this->db->where('ID', $id);
//         $this->db->update('Dosen', $data);
//         return $this->db->affected_rows();
//     }

//     public function delete_dosen($id) {
//         $this->db->where('ID', $id);
//         $this->db->delete('Dosen');
//         return $this->db->affected_rows();
//     }

//     public function create_mahasiswa($data) {
//         $this->db->insert('Mahasiswa', $data);
//         return $this->db->insert_id();
//     }

//     public function read_mahasiswa($id = null) {
//         if ($id) {
//             return $this->db->get_where('Mahasiswa', ['ID' => $id])->row_array();
//         } else {
//             return $this->db->get('Mahasiswa')->result_array();
//         }
//     }

//     public function update_mahasiswa($id, $data) {
//         $this->db->where('ID', $id);
//         $this->db->update('Mahasiswa', $data);
//         return $this->db->affected_rows();
//     }

//     public function delete_mahasiswa($id) {
//         $this->db->where('ID', $id);
//         $this->db->delete('Mahasiswa');
//         return $this->db->affected_rows();
//     }
// }

}
