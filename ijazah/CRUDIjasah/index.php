<?php
include('koneksi.php');

$query = mysqli_query($koneksi, "SELECT * FROM ijazah");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Ijazah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 1280px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <div class="card">
            <div class="card-header">
                Data Ijazah
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Taruna</th>
                            <th>Program Studi</th>
                            <th>Tanggal Ijazah</th>
                            <th>Tanggal Pengesahan</th>
                            <th>Gelar Akademik</th>
                            <th>Nomor SK</th>
                            <th>Wakil Direktur</th>
                            <th>Direktur</th>
                            <th>Nomor Ijazah</th>
                            <th>Nomor Seri</th>
                            <th>Tanggal Yudisium</th>
                            <th>Judul KKW</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['taruna'] . "</td>";
                            echo "<td>" . $row['program_studi'] . "</td>";
                            echo "<td>" . $row['tanggal_ijazah'] . "</td>";
                            echo "<td>" . $row['tanggal_pengesahan'] . "</td>";
                            echo "<td>" . $row['gelar_akademik'] . "</td>";
                            echo "<td>" . $row['nomor_sk'] . "</td>";
                            echo "<td>" . $row['wakil_direktur'] . "</td>";
                            echo "<td>" . $row['direktur'] . "</td>";
                            echo "<td>" . $row['nomor_ijazah'] . "</td>";
                            echo "<td>" . $row['nomor_seri'] . "</td>";
                            echo "<td>" . $row['tanggal_yudisium'] . "</td>";
                            echo "<td>" . $row['judul_kkw'] . "</td>";
                            echo "<td>
                                <a href='update.php?id=" . $row['id'] . "' class='btn btn-sm btn-primary'>Edit</a>
                                <a href='delete.php?id=" . $row['id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data?\")'>Hapus</a>
                            </td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
    </div>
</body>

</html>
