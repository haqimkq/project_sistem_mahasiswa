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
		// get all data kota
		const getAllKota = () => {
			$.ajax({
				url: `<?=base_url()?>index.php/Kota/get_all_kota`,
				method: 'GET',
				success: data => {
					setListData(JSON.parse(data))
				},
				error: () => {
					alert('Gagal mendapatkan daftar kota')
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
			if (confirm('Apakah Anda yakin ingin menghapus data Kota?')){
				$.ajax({
					url: `<?= base_url() ?>index.php/Kota/delete_kota/${id}`,
					method: 'POST',
					success: function(data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false),5000)
						// Refresh halaman setelah menghapus data
						getAllKota()
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
					{ data: 'kode_kota', title: 'Kode' },
					{ data: 'nama', title: 'Nama Kota' },
					{ data: 'id', title: 'Action', render: function(data){
						return `
							<i title="Edit Program Studi" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
							<i title="Hapus Program Studi" class="fa-solid fa-trash" data-id="${data}"></i>
        				`;
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
		// get all kota on render
		useEffect(() => {
			getAllKota()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-building"></i>
						<div>
							<h1> Kota</h1>
							<p>Klik <strong>Tambah</strong> untuk menambahkan kota. </p>
						</div>
					</div>
					{
						showMessageSuccess ? (
							<p className="successmessage"><i className="fa-solid fa-circle-info"></i> Kota berhasil dihapus.</p>
						) : false
					}
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
							<FormInput 
								setShowForm={setShowForm} 
								setListData={setListData}
								type={showForm}
								editedData={editedData} 
								refreshData={getAllKota}
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
	// form input program studi
	const FormInput = props => {
		const { setShowForm, setListData, type, editedData, refreshData } = props
		const [successMessage, setSuccessMessage] = useState(null)
		// on submit form add new program studi
		const handleSubmit = (e, type, editedData) => {
			e.preventDefault()
			const data = Object.fromEntries(new FormData(document.querySelector('#formprogramstudi')).entries())
			let url = type == 'add' ? "<?=base_url()?>index.php/Kota/create_kota" : "<?=base_url()?>index.php/Kota/update_kota"
			// menyisipkan id program studi jika edit
			if(type == 'edit'){
				data.id = editedData.id
			}
			// proses simpan atau update kota
			$.ajax({
				url,
				data,
				method: 'POST',
				success: data => {
					// on success
					if(data == "true" || data > 0){
						$('#formprogramstudi')[0].reset()
						setSuccessMessage(`Kota berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
						refreshData()
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
			}
		}, [type, editedData])
		return (
			<div className="forms">
				<h1>{type == 'add' ? 'Tambah' : 'Update'} Kota</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formprogramstudi" onSubmit={e => handleSubmit(e, type, editedData)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="kode_kota">Kode</label>
							<input name="kode_kota" type="text" placeholder="e.g. PLG" required />
						</div>
						<div className="formel">
							<label htmlFor="nama">Nama Kota</label>
							<input name="nama" type="text" placeholder="e.g. Palembang" required />
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