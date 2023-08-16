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
		const [editedData, setEditedData] = useState(null)
		const [showMessageSuccess, setShowMessageSuccess] = useState(false)
 		// get data from database
		const getAllDataMataKuliah = () => {
			$.ajax({
				url: "<?=base_url()?>index.php/MataKuliah/get_all_matakuliah",
				method: 'GET',
				success: data => {
					setListData(JSON.parse(data))
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
            // handle delete Mata kuliah by ID
			if (confirm('Apakah Anda yakin ingin menghapus Mata Kuliah?')){
				$.ajax({
					url: `<?= base_url() ?>index.php/MataKuliah/delete_matakuliah/${id}`,
					method: 'POST',
					success: function(data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false),5000)
						// Refresh halaman setelah menghapus data
						getAllDataMataKuliah()
					},
					error: function() {
						alert('Gagal menghapus data mata kuliah.');
					}
				});
			}
		}
		// menampilkan data ke dalam database ketika ada perubahan state
		useEffect(() => {
			$(`#listdata`).DataTable({
				destroy: true,
				data: listData,
				columns: [
					{ data: 'kode', title: 'Kode' },
					{ data: 'matakuliah', title: 'Mata Kuliah' },
					{ data: 'sks', title: 'SKS' },
					{ data: 'semester', title: 'Semester' },
					{ 
						data: null,
    					render: function (data, type, row) {
        					return `
							<i title="Edit Mata Kuliah" class="fa-solid fa-pen-to-square btn-edit" data-id="${data.id}"></i>
							<i title="Hapus Mata Kuliah" class="fa-solid fa-trash" data-id="${data.id}"></i>
        					`;
    					},
    					title: 'Action' 
					},
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
		// mendapatkan data dari database saat pertama kali page loaded
		useEffect(() => {
			getAllDataMataKuliah()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-book"></i>
						<div>
							<h1> Mata Kuliah</h1>
							<p>Klik <strong>Tambah</strong> untuk menambahkan Mata Kuliah. </p>
						</div>
					</div>
					{
						showMessageSuccess ? (
							<p className="successmessage"><i className="fa-solid fa-circle-info"></i> Mata Kuliah berhasil dihapus.</p>
						) : false
					}
					<div className="btnarea btnarea-nopad">
						{ /* hide show button add */
							showForm == null ? (
								<button
									title="Tambah mata kuliah"
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
								refreshData={getAllDataMataKuliah}
								editedData={editedData}
								type={showForm}
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
	// form input mata kuliah
	const FormInput = props => {
		const { setShowForm, setListData, refreshData, editedData, type } = props
		const [successMessage, setSuccessMessage] = useState(null)
		// on submit form add new mata kuliah
		const handleSubmit = (e, type, editedData) => {
			e.preventDefault()
			const data = Object.fromEntries(new FormData(document.querySelector('#formmatakuliah')).entries())
			let url = type == 'add' ? "<?=base_url()?>index.php/MataKuliah/create_matakuliah" : "<?=base_url()?>index.php/MataKuliah/update_matakuliah"
			// menyisipkan nilai id dari mata kuliah yg diedit
			if(type == 'edit') {
				data.id = editedData.id
			}
			$.ajax({
				url,
				data,
				method: 'POST',
				success: data => {
					// on success
					if(data == "true" || data > 0){
						$('#formmatakuliah')[0].reset()
						setSuccessMessage(`Mata Kuliah berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
						refreshData()
						setTimeout(() => setSuccessMessage(null),5000)
					}
				},
				error: () => {
					alert('Gagal menyimpan data Mata Kuliah')
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
				<h1>{type == 'add' ? 'Tambah' : 'Update'} Mata Kuliah</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formmatakuliah" onSubmit={e => handleSubmit(e, type, editedData)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="kode">Kode</label>
							<input name="kode" type="num" placeholder="e.g. 4523" required />
						</div>
						<div className="formel">
							<label htmlFor="matakuliah">Mata Kuliah</label>
							<input name="matakuliah" type="text" placeholder="e.g. Pemrograman Web II" required />
						</div>
					</div>
					<div className="wrap nowrap">
						<div className="formel">
							<label htmlFor="sks">SKS</label>
							<input name="sks" type="num" placeholder="e.g. 19" required />
						</div>
						<div className="formel fulls">
							<label htmlFor="semester">Semester</label>
							<select required name="semester">
								<option value="">--- Pilih Semester ---</option>
								<option value="Semester I"> Semester I </option>
								<option value="Semester II">Semester II</option>
								<option value="Semester III">Semester III</option>
								<option value="Semester IV">Semester IV</option>
								<option value="Semester V">Semester V</option>
								<option value="Semester VI">Semester VI</option>
								<option value="Semester VII">Semester VII</option>
								<option value="Semester VIII">Semester VIII</option>
								<option value="Ujian Akhir Program Studi">Ujian Akhir Program Studi</option>
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
