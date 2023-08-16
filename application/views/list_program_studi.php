<!-- list_program_studi.php -->
<table>
    <thead>
        <tr>
            <th>Nama Program Studi</th>
            <th>Program Pendidikan</th>
            <th>Akreditasi</th>
            <th>SK Akreditasi</th>
            <th>Aksi</th> <!-- Kolom untuk tombol edit dan delete -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($programstudi as $ps) { ?>
            <tr>
                <td><?php echo $ps['nama']; ?></td>
                <td><?php echo $ps['program_pendidikan']; ?></td>
                <td><?php echo $ps['akreditasi']; ?></td>
                <td><?php echo $ps['sk_akreditasi']; ?></td>
                <td>
                    <!-- Tombol edit dengan mengarahkan ke halaman edit -->
                    <a href="<?php echo base_url('programstudi/edit/' . $ps['id']); ?>">Edit</a>
                    
                    <!-- Tombol delete dengan mengarahkan ke fungsi delete_programstudi di controller -->
                    <a href="<?php echo base_url('programstudi/delete/' . $ps['id']); ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
