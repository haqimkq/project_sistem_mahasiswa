<style>
	.wrap {
		padding: 2em 0 1em 0;
		display: flex;
		gap: 2em;
		align-items: flex-end;
	}

	.fulls {
		flex: 1;
	}

	.btnarea {
		display: flex;
		justify-content: flex-end;
		align-items: center;
		gap: 2em;
		padding: 1em 0;
	}

	.btnarea-nopad {
		padding: 0;
	}

	.btnarea>button {
		transition: all 0.3s ease;
		background: #0079FF;
		cursor: pointer;
		color: white;
		border: none;
		padding: .75em 1.5em;
		border-radius: 0.5em;
	}

	.btnarea>a {
		color: #0079FF
	}

	.btnarea>button:hover {
		background: #015cc5;
	}

	.btnarea>button:active {
		transform: translateY(0.2em);
	}

	.successmessage {
		margin: 1em 0;
		padding: 0.7em;
		border-radius: 0.3em;
		display: block;
		text-align: center;
		color: #1B9C85;
		background: #f5fffd;
	}
</style>
<div id="appss"></div>
<?php
    // Mengecek apakah ada data programstudi yang dikirimkan dari controller
    if(isset($programstudi)) {
        // Jika ada, gunakan data tersebut untuk mengisi nilai awal form
        $nama = $programstudi['nama'];
        $program_pendidikan = $programstudi['program_pendidikan'];
        $akreditasi = $programstudi['akreditasi'];
        $sk_akreditasi = $programstudi['sk_akreditasi'];
    } else {
        // Jika tidak ada, set nilai awal form ke kosong
        $nama = '';
        $program_pendidikan = '';
        $akreditasi = '';
        $sk_akreditasi = '';
    }
    ?>
<div id="container">
	<div>
		<div className="title">
			<i className="fas fa-graduation-cap"></i>
			<div>
				<h1>Edit Program Studi</h1>
			</div>
			<form method="post" action="<?php echo base_url('index.php/ProgramStudi/update/' . $programstudi['id']); ?>">
			<label for="nama">Nama Program Studi:</label>
			<input type="text" name="nama" value="<?php echo $programstudi['nama']; ?>"><br>

			<label for="program_pendidikan">Program Pendidikan:</label>
			<select required name="program_pendidikan">
				<option value="">--- Pilih Program ---</option>
				<option value="Diploma III" <?php echo ($programstudi['program_pendidikan'] == "Diploma III") ? 'selected' : '' ?>>Diploma III</option>
				<option value="Diploma IV" <?php echo ($programstudi['program_pendidikan'] == "Diploma IV") ? 'selected' : '' ?>>Diploma IV</option>
				<option value="Sarjana" <?php echo ($programstudi['program_pendidikan'] == "Sarjana") ? 'selected' : '' ?>>Sarjana</option>
			</select>
			
			<label for="akreditasi">Akreditasi:</label>
			<select required name="akreditasi">
				<option value="">--- Pilih Akreditasi ---</option>
				<option value="Baik Sekali" <?php echo ($programstudi['akreditasi'] == "Baik Sekali") ? 'selected' : '' ?>>Baik Sekali</option>
				<option value="Baik" <?php echo ($programstudi['akreditasi'] == "Baik") ? 'selected' : '' ?>>Baik</option>
				<option value="Unggul" <?php echo ($programstudi['akreditasi'] == "Unggul") ? 'selected' : '' ?>>Unggul</option>
			</select>

			<label for="sk_akreditasi">SK Akreditasi:</label>
			<input type="text" name="sk_akreditasi" value="<?php echo $programstudi['sk_akreditasi']; ?>"><br>

			<input type="submit" value="Update">
		</form>
		</div>
	</div>
</div>