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
<script type="text/babel">
	const { useState, useEffect } = React
	const App = () => {
		const [showForm, setShowForm] = useState(null)
		const [listData, setListData] = useState([])
		const [showMessageSuccess, setShowMessageSuccess] = useState(false)
		const [editedData, setEditedData] = useState(null)
		const [listTaruna, setListTaruna] = useState([])
		const [listMataKuliah, setListMataKuliah] = useState([])
		// get all data penilaian
		const getAllPenilaian = () => {
			$.ajax({
				url: `<?=base_url()?>index.php/Penilaian/get_all_penilaian`,
				method: 'GET',
				success: data => {
					setListData(JSON.parse(data))
				},
				error : () => {
					alert('Gagal mendapatkan data penilaian')
				}
			})
			// get list mata kuliah
			$.ajax({
				url: "<?=base_url()?>index.php/MataKuliah/get_all_matakuliah",
				method: 'GET',
				success: data => {
					setListMataKuliah(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data dari database')
				}
			})
			// get list mahasiswa
			$.ajax({
				url: "<?=base_url()?>index.php/DosenMahasiswa/get_all_mahasiswa",
				method: 'GET',
				success: data => {
					setListTaruna(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan data dari database')
				}
			})
		}
		// Fungsi untuk menangani klik tombol edit
		const handleEditData = (id, listData) => {
			setEditedData(listData.filter(it => it.id == id)[0])
			setShowForm('edit')
		}
		// Fungsi untuk menangani klik tombol delete
		const handleDeleteData = id => {
			if (confirm('Apakah Anda yakin ingin menghapus Penilaian ini?')){
            // Kirim request AJAX untuk menghapus data program studi berdasarkan ID
				$.ajax({
					url: `<?= base_url() ?>index.php/Penilaian/delete_penilaian/${id}`,
					method: 'POST',
					success: function(data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false),5000)
						// Refresh halaman setelah menghapus data
						getAllPenilaian()
					},
					error: function() {
						alert('Gagal menghapus data program studi.');
					}
				});
			}
		}
		useEffect(() => {
			$(`#listdata`).DataTable({
				destroy: true,
				data: listData,
				columns: [
					{ data: 'taruna', title: 'Taruna' },
					{ data: 'nilai_angka', title: 'Nilai Angka' },
					{ data: 'nilai_huruf', title: 'Nilai Huruf' },
					{ data: 'matakuliah', title: 'Mata Kuliah' },
					{ data: 'id', title: 'Action', render: function(data){
						return `
							<i title="Edit Mata Kuliah" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
							<i title="Hapus Mata Kuliah" class="fa-solid fa-trash" data-id="${data}"></i>
						`
					}},
				],
				initComplete: function(){
					$('#listdata').off().on('click', 'tr td i', function(){
						const buttonType = $(this).attr('class')
						// jika tombol edi ditekan
						if(buttonType.includes('btn-edit')){
							handleEditData($(this).attr('data-id'), listData)
						} else {
							handleDeleteData($(this).attr('data-id'))
						}
					})
				}
			})
		}, [listData])
		// get all data on first page load
		useEffect(() => {
			getAllPenilaian()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-award"></i>
						<div>
							<h1> Penilaian</h1>
							<p>Klik <strong>Tambah</strong> untuk menambahkan Penilaian. </p>
						</div>
					</div>
					{
						showMessageSuccess ? (
							<p className="successmessage"><i className="fa-solid fa-circle-info"></i> Penilaian berhasil dihapus.</p>
						) : false
					}
					<div className="btnarea btnarea-nopad">
						{ /* hide show button add */
							showForm == null ? (
								<button
									title="Tambah Penilaian"
									onClick={() => setShowForm('add')}
								>
									<i className="fas fa-plus"></i> Tambah</button>
							) : false
						}
					</div>
					{
						showForm != null ? (
							<FormInput 
								setShowForm={setShowForm} 
								setListData={setListData}
								editedData={editedData}
								listMataKuliah={listMataKuliah}
								listTaruna={listTaruna}
								type={showForm} 
								getAllPenilaian={getAllPenilaian}
							/>
						) : false
					}
					<div className="tablebox">
						<table id="listdata"></table>
					</div>
				</div>
			</div>
		)
	}
	const root = document.querySelector("#appss")
	const el = ReactDOM.createRoot(root)
	el.render(<App />)
	// form input Penilaian
	const FormInput = props => {
		const { setShowForm, setListData, editedData, type, listMataKuliah, listTaruna, getAllPenilaian } = props
		const [successMessage, setSuccessMessage] = useState(null)
		// on submit form add new Penilaian
		const handleSubmit = (e, type, editedData) => {
			e.preventDefault()
			const data = Object.fromEntries(new FormData(document.querySelector('#formpenilaian')).entries())
			let url = type == 'add' ? "<?=base_url()?>index.php/Penilaian/create_penilaian" : "<?=base_url()?>index.php/Penilaian/update_penilaian"
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
						// on success
						$('#formpenilaian')[0].reset()
						setSuccessMessage(`Penilaian berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
						getAllPenilaian()
						setTimeout(() => setSuccessMessage(null),5000)
					}
				},
				error: () => {
					alert('Gagal menyimpan data Program Studi')
				}
			})
		}
		useEffect(() => {
			if(type == 'edit'){
				// update nilai elemen berdasarkan key value
				for(let obj in editedData){
					$(`[name="${obj}"]`).val(editedData[obj])
				}
				for(let obj in editedData){
					if(obj == 'tarunaid'){
						$(`[name="taruna"]`).val(editedData[obj])
					}
					if(obj == 'matakuliahid'){
						$(`[name="matakuliah"]`).val(editedData[obj])
					}
				}
			}
		}, [type, editedData])
		return (
			<div className="forms">
				<h1>{type == 'add' ? 'Tambah' : 'Update'} Penilaian</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formpenilaian" onSubmit={e => handleSubmit(e, type, editedData)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="taruna">Taruna</label>
							<select required name="taruna">
								<option value="">--- Pilih Taruna ---</option>
								{listTaruna.map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
						</div>
						<div className="formel">
							<label htmlFor="penilaian">Nilai Angka</label>
							<input name="nilai_angka" type="num" placeholder="e.g. 40" required />
						</div>
						<div className="formel">
							<label htmlFor="Nilai_Huruf">Nilai Huruf</label>
							<select required name="nilai_huruf">
								<option value="">--- Pilih Nilai Huruf ---</option>
								<option value="A">A</option>
								<option value="AB">AB</option>
								<option value="B">B</option>
								<option value="BC">BC</option>
								<option value="C">C</option>
								<option value="D">D</option>
								<option value="E">E</option>
							</select>
						</div>
						<div className="formel fulls">
							<label htmlFor="sk">Mata Kuliah</label>
							<select required name="matakuliah">
								<option value="">--- Pilih Mata Kuliah ---</option>
								{listMataKuliah.map((it, index) => (
									<option key={index} value={it.id}>{it.matakuliah}</option>
								))}
							</select>
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
