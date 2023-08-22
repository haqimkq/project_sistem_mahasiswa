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
	.nopad{
		padding-top: 0.5em;
	}
	.redinfo{
		color: crimson;
		opacity: 1;
	}
</style>
<div id="appss"></div>
<script type="text/babel">
	const { useState, useEffect } = React
	const App = () => {
		const [activeTab, setActiveTab] = useState(1)
		const [showForm, setShowForm] = useState(null)
		const [listMahasiswa, setListMahasiswa] = useState([])
		const [listDosen, setListDosen] = useState([])
		const [showMessageSuccess, setShowMessageSuccess] = useState(false)
		const [editedData, setEditedData] = useState(null)
		const [listProdi, setListProdi] = useState([])
		const [listKota, setListKota] = useState([])
		// get data from database
		const getAllMahasiswa = () => {
			$.ajax({
				url: "<?=base_url()?>index.php/DosenMahasiswa/get_all_mahasiswa",
				method: 'GET',
				success: data => {
					setListMahasiswa(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data Taruna')
				}
			})
		}
		// get data from database
		const getAllDosen = () => {
			$.ajax({
				url: "<?=base_url()?>index.php/DosenMahasiswa/get_all_dosen",
				method: 'GET',
				success: data => {
					setListDosen(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data Dosen')
				}
			})
		}
		// get data from database
		const getAllProdi = () => {
			$.ajax({
				url: "<?=base_url()?>index.php/ProgramStudi/get_all_programstudi",
				method: 'GET',
				success: data => {
					setListProdi(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data Prodi')
				}
			})
		}
		const getAllKota = () => {
			$.ajax({
				url: "<?=base_url()?>index.php/Kota/get_all_kota",
				method: 'GET',
				success: data => {
					setListKota(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data Kota')
				}
			})
		}
		// mendapatkan data dari database saat pertama kali page loaded
		useEffect(() => {
			getAllMahasiswa()
			getAllDosen()
			getAllProdi()
			getAllKota()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-users"></i>
						<div>
							<h1> Dosen & Taruna</h1>
							<p>Pilih pada tab <strong>Taruna / Dosen</strong> untuk manage data. </p>
						</div>
					</div>
					{
						showMessageSuccess ? (
							<p className="successmessage"><i className="fa-solid fa-circle-info"></i> Data {activeTab == 1 ? 'Mahasiswa' : 'Dosen'} berhasil dihapus.</p>
						) : false
					}
					<div className="navigations">
						<a 
							href="#"
							className={activeTab == 1 ? 'activetab' : ''}
							onClick={() => setActiveTab(1)}
						>Taruna</a>
						<a 
							href="#"
							className={activeTab == 2 ? 'activetab' : ''}
							onClick={() => setActiveTab(2)}
						>Dosen</a>
					</div>
					{ /* tab mahasiswa */
						activeTab == 1 ? (
							<TabMahasiswa 
								data={listMahasiswa}
								refresh={getAllMahasiswa}
								setShowMessageSuccess={setShowMessageSuccess}
								listKota={listKota}
								listProdi={listProdi}
							/>
						) : false
					}
					{/* tab dosen */
						activeTab == 2 ? (
							<TabDosen 
								data={listDosen}
								refresh={getAllDosen}
								setShowMessageSuccess={setShowMessageSuccess}
							/>
						) : false
					}
				</div>
			</div>
		)
	}
	const root = document.querySelector("#appss")
	const el = ReactDOM.createRoot(root)
	el.render(<App />)
	// tab mahasiswa
	const TabMahasiswa = props => {
		const {data, listProdi, listKota, refresh, setShowMessageSuccess} = props
		const [showForm, setShowForm] = useState(null)
		const [editedData, setEditedData] = useState(null)
		// Fungsi untuk menangani klik tombol edit
		const handleEditData = (id, listData) => {
			setEditedData(listData.filter(it => it.id == id)[0])
			setShowForm('edit')
		}
		// Fungsi untuk menangani klik tombol delete
		const handleDeleteData = id => {
			if (confirm('Apakah Anda yakin ingin menghapus data mahasiswa ini?')){
            // Kirim request AJAX untuk menghapus data program studi berdasarkan ID
				$.ajax({
					url: `<?= base_url() ?>index.php/DosenMahasiswa/delete_mahasiswa/${id}`,
					method: 'POST',
					success: function(data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false),5000)
						// Refresh halaman setelah menghapus data
						refresh()
					},
					error: function() {
						alert('Gagal menghapus data program studi.');
					}
				});
			}
		}
		// menampilkan data ke dalam database ketika ada perubahan state
		useEffect(() => {
			$(`#listmahasiswa`).DataTable({
				destroy: true,
				data,
				columns: [
					{ data: 'nama', title: 'Nama' },
					{ data: 'nomor_taruna', title: 'NPT' },
					{ data: 'tempat_lahir', title: 'Tempat Lahir' },
					{ data: 'tanggal_lahir', title: 'Tanggal Lahir'},
					{ data: 'namaprodi', title: 'Program Studi'},
					{ 
						data: 'id',
    					render: function (data, type, row) {
        					return `
							<i title="Edit Program Studi" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
							<i title="Hapus Program Studi" class="fa-solid fa-trash" data-id="${data}"></i>
        					`;
    					},
    					title: 'Action' 
					},
				],
				initComplete: function(){
					$('#listmahasiswa').off().on('click', 'tr td i', function(){
						const buttonType = $(this).attr('class')
						// jika tombol edi ditekan
						if(buttonType.includes('btn-edit')){
							handleEditData($(this).attr('data-id'), data)
						} else {
							handleDeleteData($(this).attr('data-id'))
						}
					})
				}
			})
		}, [data])
		return (
			<React.Fragment>
				<div className="btnarea btnarea-nopad">
					{ /* hide show button add */
						showForm == null ? (
							<button
								title="Tambah program studi"
								onClick={() => setShowForm('add')}
							>
								<i className="fas fa-plus"></i> Tambah</button>
						) : false
					}
				</div>
				{
					showForm != null ? (
						<FormInputMahasiswa 
							type={showForm} 
							setShowForm={setShowForm} 
							listKota={listKota}
							listProdi={listProdi}
							// setListData={setListData} 
							refreshData={refresh}
							editedData={editedData}
						/>
					) : false
				}
				<div className="tablebox">
					<table id="listmahasiswa"></table>
				</div>
			</React.Fragment>
		)
	}
	// form input program studi
	const FormInputMahasiswa = props => {
		const { setShowForm, setListData, refreshData, editedData, type, listKota, listProdi } = props
		const [foto, setFoto] = useState(null)
		const [successMessage, setSuccessMessage] = useState(null)
		const [isIdTrue, setIsIdTrue] = useState(true)
		const handleFotoChange = (e) => setFoto(e.target.files[0])  // Menyimpan file foto yang dipilih dalam state};
		// on submit form add new program studi 
		const handleSubmit = (e, type, editedData) => {
			e.preventDefault()
			const data = new FormData(document.querySelector('#formprogramstudi'));
    		// data.append('foto', foto); // Menambahkan file foto ke FormData
			let url = type == 'add' ? "<?=base_url()?>index.php/DosenMahasiswa/create_mahasiswa" : "<?=base_url()?>index.php/DosenMahasiswa/update_mahasiswa"
			// menyisipkan id program studi jika edit
			if(type == 'edit'){
				data.append('id', editedData.id)
			}
			$.ajax({
				url,
				data,
				method: 'POST',
				processData: false, // Tidak memproses data secara otomatis karena kita menggunakan FormData
				contentType: false, // Tidak mengatur tipe konten secara otomatis karena kita menggunakan FormData
				success: (data) => {
					// on success
					if(data == "true" || data > 0){
						$('#formprogramstudi')[0].reset()
						setSuccessMessage(`Taruna berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
						refreshData()
						setTimeout(() => setSuccessMessage(null),5000)
					}
				},
				error: () => {
					alert('Gagal menyimpan data Taruna')
				}
			})
		}
		// validate nik
		const validateNIK = val => {
			let lengthTrue = val.length > 16
			lengthTrue && val != '' ? setIsIdTrue(true) : setIsIdTrue(false)  
		}
		useEffect(() => {
			if(type == 'edit'){
				// update nilai elemen berdasarkan key value
				for(let obj in editedData){
					if(obj != 'foto'){
						$(`[name="${obj}"]`).val(editedData[obj])
					}
				}
			}
		}, [type, editedData])
		return (
			<div className="forms">
				<h1>{type == 'add' ? 'Tambah' : 'Update'} Taruna</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formprogramstudi" onSubmit={e => handleSubmit(e, type, editedData)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="nama">Nama</label>
							<input name="nama" type="text" placeholder="e.g. Rizki Ramadhan" required />
						</div>
						<div className="formel">
							<label htmlFor="nomor_taruna">Nomor Taruna</label>
							<input name="nomor_taruna" type="text" placeholder="e.g. 220401020003" required />
						</div>
						<div className="formel">
							<label htmlFor="nik">NIK {!isIdTrue ? (<span className="redinfo"> * min 16 character's</span>) : ''}</label>
							<input name="nik" placeholder="Should be 16 character's " required type="number" onChange={e => validateNIK(e.target.value)} />
						</div>
					</div>
					<div className="wrap nopad">
						<div className="formel">
							<label htmlFor="tempat_lahir">Tempat Lahir</label>
							<input name="tempat_lahir" placeholder="e.g. Palembang" required type="text" />
						</div>
						<div className="formel">
							<label htmlFor="tanggal_lahir">Tanggal Lahir</label>
							<input name="tanggal_lahir" type="date" placeholder="e.g. Informatika" required />
						</div>
						<div className="formel">
							<label htmlFor="program_studi">Program Studi</label>
							<select name="program_studi" required>
								<option value="">--- Pilih Program Studi ---</option>
								{listProdi.map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
						</div>
						<div className="formel">
							<label htmlFor="foto">Foto Profil</label>
							<input name="foto" type="file" onChange={handleFotoChange} placeholder="e.g. Foto" />
						</div>
					</div>
					<div className="btnarea">
						<a href="#" onClick={() => setShowForm(null)}>Batal</a>
						<button><i className="fas fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		)
	}
	// tab mahasiswa
	const TabDosen = props => {
		const {data, refresh, setShowMessageSuccess} = props
		const [showForm, setShowForm] = useState(null)
		const [editedData, setEditedData] = useState(null)
		// Fungsi untuk menangani klik tombol edit
		const handleEditData = (id, listData) => {
			setEditedData(listData.filter(it => it.id == id)[0])
			setShowForm('edit')
		}
		// Fungsi untuk menangani klik tombol delete
		const handleDeleteData = id => {
			if (confirm('Apakah Anda yakin ingin menghapus data dosen?')){
            // Kirim request AJAX untuk menghapus data program studi berdasarkan ID
				$.ajax({
					url: `<?= base_url() ?>index.php/DosenMahasiswa/delete_dosen/${id}`,
					method: 'POST',
					success: function(data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false),5000)
						// Refresh halaman setelah menghapus data
						refresh()
					},
					error: function() {
						alert('Gagal menghapus data dosen.');
					}
				});
			}
		}
		// menampilkan data ke dalam database ketika ada perubahan state
		useEffect(() => {
			$(`#listdosen`).DataTable({
				destroy: true,
				data,
				columns: [
					{ data: 'nama', title: 'Nama' },
					{ data: 'nidn', title: 'NIDN' },
					{ data: 'golongan', title: 'Golongan' },
					{ data: 'jabatan', title: 'Jabatan'},
					{ 
						data: 'id',
    					render: function (data, type, row) {
        					return `
							<i title="Edit Program Studi" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
							<i title="Hapus Program Studi" class="fa-solid fa-trash" data-id="${data}"></i>
        					`;
    					},
    					title: 'Action' 
					},
				],
				initComplete: function(){
					$('#listdosen').off().on('click', 'tr td i', function(){
						const buttonType = $(this).attr('class')
						// jika tombol edi ditekan
						if(buttonType.includes('btn-edit')){
							handleEditData($(this).attr('data-id'), data)
						} else {
							handleDeleteData($(this).attr('data-id'))
						}
					})
				}
			})
		}, [data])
		return (
			<React.Fragment>
				<div className="btnarea btnarea-nopad">
					{ /* hide show button add */
						showForm == null ? (
							<button
								title="Tambah program studi"
								onClick={() => setShowForm('add')}
							>
								<i className="fas fa-plus"></i> Tambah</button>
						) : false
					}
				</div>
				{
					showForm != null ? (
						<FormInputDosen 
							type={showForm} 
							setShowForm={setShowForm} 
							// setListData={setListData} 
							refreshData={refresh}
							editedData={editedData}
						/>
					) : false
				}
				<div className="tablebox">
					<table id="listdosen"></table>
				</div>
			</React.Fragment>
		)
	}
	// form input program studi
	const FormInputDosen = props => {
		const { setShowForm, setListData, refreshData, editedData, type } = props
		const [successMessage, setSuccessMessage] = useState(null)
		// on submit form add new program studi
		const handleSubmit = (e, type, editedData) => {
			e.preventDefault()
			const data = Object.fromEntries(new FormData(document.querySelector('#formprogramstudi')).entries())
			let url = type == 'add' ? "<?=base_url()?>index.php/DosenMahasiswa/create_dosen" : "<?=base_url()?>index.php/DosenMahasiswa/update_dosen"
			// menyisipkan id program studi jika edit
			if(type == 'edit'){
				data.id = editedData.id
			}
			$.ajax({
				url,
				data,
				method: 'POST',
				success: data => {
					// on success
					if(data == "true" || data > 0){
						$('#formprogramstudi')[0].reset()
						setSuccessMessage(`Dosen berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
						refreshData()
						setTimeout(() => setSuccessMessage(null),5000)
					}
				},
				error: () => {
					alert('Gagal menyimpan data Dosen')
				}
			})
		}
		useEffect(() => {
			if(type == 'edit'){
				// update nilai elemen berdasarkan key value
				for(let obj in editedData){
					$(`[name="${obj}"]`).val(editedData[obj])
				}
			}
		}, [type, editedData])
		return (
			<div className="forms">
				<h1>{type == 'add' ? 'Tambah' : 'Update'} Dosen</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formprogramstudi" onSubmit={e => handleSubmit(e, type, editedData)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="nama">Nama</label>
							<input name="nama" type="text" placeholder="e.g. Muhammad Abdullah" required />
						</div>
						<div className="formel">
							<label htmlFor="nidn">NIDN</label>
							<input name="nidn" type="text" placeholder="e.g. 220401020003" required />
						</div>
						<div className="formel">
							<label htmlFor="golongan">Golongan</label>
							<input name="golongan" type="text" placeholder="e.g. 1A" required />
						</div>
						<div className="formel">
							<label htmlFor="jabatan">Jabatan</label>
							<input name="jabatan" type="text" placeholder="e.g. Dosen Tetap" required />
						</div>
					</div>
					<div className="btnarea">
						<a href="#" onClick={() => setShowForm(null)}>Batal</a>
						<button><i className="fas fa-save"></i> Simpan</button>
					</div>
				</form>
			</div>
		)
	}
</script>
