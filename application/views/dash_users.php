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

	.truepw {
		color: #1B9C85 !important;
		background: #d6fff7 !important;
	}

	.errorsec>p {
		color: #FF0060;
		padding: 0.75em;
		text-align: center;
		border-radius: 0.3em;
		background: #ffe7f0
	}

	.errorsec>p:nth-child(2) {
		margin-top: 0.5em;
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
		const getAllUser = () => {
			$.ajax({
				url: `<?=base_url()?>index.php/Users/get_all_user`,
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
			let filtered = listData.filter(it => it.id == id)[0]
			filtered.password = null
			setEditedData(filtered)
			setShowForm('edit')
		}
		// Fungsi untuk menangani klik tombol delete
		const handleDeleteData = id => {
			if (confirm('Apakah Anda yakin ingin menghapus data User?')) {
				$.ajax({
					url: `<?= base_url() ?>index.php/Users/delete_user/${id}`,
					method: 'POST',
					success: function (data) {
						setShowMessageSuccess(true)
						setTimeout(() => setShowMessageSuccess(false), 5000)
						// Refresh halaman setelah menghapus data
						getAllUser()
					},
					error: function () {
						alert('Gagal menghapus data program studi.');
					}
				});
			}
		}
		// create datatabel on load page
		useEffect(() => {
			$(`#listdata`).DataTable({
				destroy: true,
				data: listData,
				columns: [
					{ data: 'nama', title: 'Nama User' },
					{ data: 'email', title: 'Email' },
					{ data: 'role', title: 'Role' },
					{
						data: 'id', title: 'Action', render: function (data) {
							return `
						<i title="Edit Program Studi" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
						<i title="Hapus Program Studi" class="fa-solid fa-trash" data-id="${data}"></i>
						`;
						}
					},
				],
				initComplete: function () {
					$('#listdata').off().on('click', 'tr td i', function () {
						const buttonType = $(this).attr('class')
						// jika tombol edi ditekan
						if (buttonType.includes('btn-edit')) {
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
			getAllUser()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-users-cog"></i>
						<div>
							<h1> Users</h1>
							<p>Klik <strong>Tambah</strong> untuk menambahkan user. </p>
						</div>
					</div>
					{
						showMessageSuccess ? (
							<p className="successmessage"><i className="fa-solid fa-circle-info"></i> User berhasil dihapus.</p>
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
								refreshData={getAllUser}
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
		const [errorEmail, setErrorEmail] = useState(false)
		const [errorPassword, setErrorPassword] = useState(false)
		// on submit form add new program studi
		const handleSubmit = (e, type, editedData, errEmail, errPassword) => {
			e.preventDefault()
			// jika format email dan berhasil confirm password
			if(!errEmail && !errPassword){
				const data = Object.fromEntries(new FormData(document.querySelector('#formuser')).entries())
				let url = type == 'add' ? "<?=base_url()?>index.php/Users/create_user" : "<?=base_url()?>index.php/Users/update_user"
				// menyisipkan id program studi jika edit
				if (type == 'edit') {
					data.id = editedData.id
				}
				// proses simpan atau update kota
				$.ajax({
					url,
					data,
					method: 'POST',
					success: data => {
						// on success
						if (data == "true" || data > 0) {
							$('#formuser')[0].reset()
							setSuccessMessage(`User berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
							refreshData()
							setTimeout(() => setSuccessMessage(null), 5000)
						}
					},
					error: () => {
						alert('Gagal menyimpan data User')
					}
				})
			} else {
				alert('Inputan belum sesuai, silahkan periksa kembali sesuai.')
			}
		}
		// check inputan email dan confirm password
		const checkValidity = (type, value) => {
			// inputan email
			if (type == 'email') {
				setErrorEmail(value.includes('.com') && value.includes('@') ? false : true)
			} else if((type == 'password')) {
				// inputan password 
				let confirmPassword = $('input[name="password"]').val()
				setErrorPassword(value == confirmPassword ? false : true)
			}
		}
		useEffect(() => {
			if (type == 'edit') {
				// update nilai elemen berdasarkan key value
				for (let obj in editedData) {
					$(`[name="${obj}"]`).val(editedData[obj])
				}
			}
		}, [type, editedData])
		return (
			<div className="forms">
				<h1>{type == 'add' ? 'Tambah' : 'Update'} User</h1>
				<p>Silahkan lengkapi form dibawah ini.</p>
				{
					successMessage != null ? (
						<span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
					) : false
				}
				<form id="formuser" onSubmit={e => handleSubmit(e, type, editedData, errorEmail, errorPassword)}>
					<div className="wrap">
						<div className="formel">
							<label htmlFor="email">Email</label>
							<input
								name="email"
								type="text"
								placeholder="e.g. rzk.ramadhan@gmail.com"
								required
								onChange={e => checkValidity('email', e.target.value)}
							/>
						</div>
						<div className="formel">
							<label htmlFor="nama">Nama User</label>
							<input name="nama" type="text" placeholder="e.g. Rizki Ramadhan" required />
						</div>
						<div className="formel">
							<label htmlFor="role">Role</label>
							<select name="role" required>
								<option value="">--- Pilih Role --- </option>
								<option value="Administrator">Administrator</option>
								<option value="Unit Prodi">Unit Prodi</option>
								<option value="Akademik">Akademik</option>
							</select>
						</div>
					</div>
					<div className="wrap" style={{ paddingTop: '0.5em' }}>
						<div className="formel">
							<label htmlFor="password">Password </label>
							<input name="password" type="password" placeholder="Type password ..." required={type == 'add'} />
						</div>
						<div className="formel">
							<label htmlFor="confirm_password">Confirm Password</label>
							<input
								name="confirm_password"
								type="password"
								placeholder="Re-type password ..."
								onKeyUp={e => checkValidity('password', e.target.value)}
								required={type == 'add'}
							/>
						</div>
					</div>
					<div className="errorsec">
						{
							errorEmail ? (
								<p><i className="fas fa-info-circle"></i> Format email invalid, silahkan periksa kembali.</p>
							) : false
						}
						{
							errorPassword ? (
								<p><i className="fas fa-info-circle"></i> Password tidak sama, silahkan perbaiki.</p>
							) : false
						}
						{ // confirm password success info
							$('[name="password"]').val() != null && $('[name="password"]').val() != "" && !errorPassword ? (
								<p className="truepw"><i className="fas fa-check-circle"></i> Berhasil confirm password (password sesuai)</p>
							) : false
						}
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