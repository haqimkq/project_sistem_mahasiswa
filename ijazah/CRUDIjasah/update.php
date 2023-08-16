<?php
include('koneksi.php');

$id = $_GET['id'];
$taruna = "";
$program_studi = "";
$tanggal_ijazah = "";
$tanggal_pengesahan = "";
$gelar_akademik = "";
$nomor_sk = "";
$wakil_direktur = "";
$direktur = "";
$nomor_ijazah = "";
$nomor_seri = "";
$tanggal_yudisium = "";
$judul_kkw = "";
$sukses = "";
$error = "";

$query = mysqli_query($koneksi, "SELECT * FROM ijazah WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header('Location: index.php');
    exit();
}

$taruna = $data['taruna'];
$program_studi = $data['program_studi'];
$tanggal_ijazah = $data['tanggal_ijazah'];
$tanggal_pengesahan = $data['tanggal_pengesahan'];
$gelar_akademik = $data['gelar_akademik'];
$nomor_sk = $data['nomor_sk'];
$wakil_direktur = $data['wakil_direktur'];
$direktur = $data['direktur'];
$nomor_ijazah = $data['nomor_ijazah'];
$nomor_seri = $data['nomor_seri'];
$tanggal_yudisium = $data['tanggal_yudisium'];
$judul_kkw = $data['judul_kkw'];

if (isset($_POST['update'])) {
    $taruna = $_POST['taruna'];
    $program_studi = $_POST['program_studi'];
    $tanggal_ijazah = $_POST['tanggal_ijazah'];
    $tanggal_pengesahan = $_POST['tanggal_pengesahan'];
    $gelar_akademik = $_POST['gelar_akademik'];
    $nomor_sk = $_POST['nomor_sk'];
    $wakil_direktur = $_POST['wakil_direktur'];
    $direktur = $_POST['direktur'];
    $nomor_ijazah = $_POST['nomor_ijazah'];
    $nomor_seri = $_POST['nomor_seri'];
    $tanggal_yudisium = $_POST['tanggal_yudisium'];
    $judul_kkw = $_POST['judul_kkw'];

    if ($taruna && $program_studi && $tanggal_ijazah && $tanggal_pengesahan && $gelar_akademik && $nomor_sk && $wakil_direktur &&
        $direktur && $nomor_ijazah && $nomor_seri && $tanggal_yudisium && $judul_kkw) {

        $sql = "UPDATE ijazah SET taruna=?, program_studi=?, tanggal_ijazah=?, tanggal_pengesahan=?, gelar_akademik=?, nomor_sk=?, 
                wakil_direktur=?, direktur=?, nomor_ijazah=?, nomor_seri=?, tanggal_yudisium=?, judul_kkw=? WHERE id=?";
        $stmt = mysqli_prepare($koneksi, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssi", $taruna, $program_studi, $tanggal_ijazah, $tanggal_pengesahan, $gelar_akademik,
            $nomor_sk, $wakil_direktur, $direktur, $nomor_ijazah, $nomor_seri, $tanggal_yudisium, $judul_kkw, $id);
        $q = mysqli_stmt_execute($stmt);

        if ($q) {
            $sukses = "Data berhasil diupdate";
            header("location: index.php");
        } else {
            $error = "Gagal mengupdate data";
        }
    } else {
        $error = "Silahkan isi semua data";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Data Ijazah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header ">
                Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="POST">

                    <div class="mb-1 row">
                        <label for="taruna" class="col-sm-2 col-form-label">Taruna</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="taruna" id="taruna">
                                <option value="">- Pilih Taruna -</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM taruna");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($taruna == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="program_studi" class="col-sm-2 col-form-label">Program Studi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="program_studi" id="program_studi">
                                <option value="">- Pilih Program Studi -</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM program_studi");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($program_studi == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="tanggal_ijazah" class="col-sm-2 col-form-label">Tanggal Ijazah</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_ijazah" name="tanggal_ijazah" value="<?php echo $tanggal_ijazah ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="tanggal_pengesahan" class="col-sm-2 col-form-label">Tanggal Pengesahan</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_pengesahan" name="tanggal_pengesahan" value="<?php echo $tanggal_pengesahan ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="gelar_akademik" class="col-sm-2 col-form-label">Gelar Akademik</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="gelar_akademik" name="gelar_akademik" value="<?php echo $gelar_akademik ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="nomor_sk" class="col-sm-2 col-form-label">Nomor SK</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_sk" name="nomor_sk" value="<?php echo $nomor_sk ?>">
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="wakil_direktur" class="col-sm-2 col-form-label">Wakil Direktur</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="wakil_direktur" id="wakil_direktur">
                                <option value="">- Pilih Wakil Direktur -</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM pejabat");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($wakil_direktur == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="direktur" class="col-sm-2 col-form-label">Direktur</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="direktur" id="direktur">
                                <option value="">- Pilih Direktur -</option>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM pejabat");
                                while ($row = mysqli_fetch_assoc($query)) {
                                    $selected = ($direktur == $row['id']) ? "selected" : "";
                                    echo "<option value='" . $row['id'] . "' " . $selected . ">" . $row['nama'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-1 row">
                        <label for="nomor_ijazah" class="col-sm-2 col-form-label">Nomor Ijazah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_ijazah" name="nomor_ijazah" value="<?php echo $nomor_ijazah ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="nomor_seri" class="col-sm-2 col-form-label">Nomor Seri</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nomor_seri" name="nomor_seri" value="<?php echo $nomor_seri ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="tanggal_yudisium" class="col-sm-2 col-form-label">Tanggal Yudisium</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tanggal_yudisium" name="tanggal_yudisium" value="<?php echo $tanggal_yudisium ?>">
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <label for="judul_kkw" class="col-sm-2 col-form-label">Judul KKW</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="judul_kkw" name="judul_kkw" value="<?php echo $judul_kkw ?>">
                        </div>
                    </div>
                    <br>
                    <div class="col-12">
                        <input type="submit" name="update" value="Update Data" class="btn btn-primary" />
                        <a href="index.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
