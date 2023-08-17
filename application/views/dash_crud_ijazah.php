<style>
   table{
      border: none;
      animation: show 0.5s ease;
   }
   .tablebox{
      overflow: auto;
   }
   .nopad{
      padding-top: 0.5em;
   }
</style>
<script type="text/babel">
   const {useState, useEffect} = React
   const IjazahComponent = props => {
      const [showForm, setShowForm] = useState(null)
      const [listData, setListData] = useState([])
      const [listMahasiswa, setListMahasiswa] = useState([])
      const [listProdi, setListProdi] = useState([])
      const [listPejabat, setListPejabat] = useState([])
      const [editedData, setEditedData] = useState(null)
      const [showMessageSuccess, setShowMessageSuccess] = useState(false)
      // get data mahasiwa, prodi dan pejabat
      const getAllOptionalData = () => {
         $.ajax({
            url: '<?=base_url()?>index.php/ProgramStudi/get_all_programstudi',
            method: 'GET',
            success: data => {
               setListProdi(JSON.parse(data))
            }
         })
         $.ajax({
            url: '<?=base_url()?>index.php/DosenMahasiswa/get_all_dosen',
            method: 'GET',
            success: data => {
               setListPejabat(JSON.parse(data))
            }
         })
         $.ajax({
            url: '<?=base_url()?>index.php/DosenMahasiswa/get_all_mahasiswa',
            method: 'GET',
            success: data => {
               setListMahasiswa(JSON.parse(data))
            }
         })
      }
      // get data from database
      const getAllDataIjazah = () => {
         $.ajax({
            url: "<?=base_url()?>index.php/IjazahTranskrip/get_all_ijazah",
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
         // handle delete ijazah
         if (confirm('Apakah Anda yakin ingin menghapus Ijazah?')) {
            $.ajax({
               url: `<?= base_url() ?>index.php/IjazahTranskrip/delete_ijazah/${id}`,
               method: 'POST',
               success: function (data) {
                  setShowMessageSuccess(true)
                  setTimeout(() => setShowMessageSuccess(false), 5000)
                  // Refresh halaman setelah menghapus data
                  getAllDataIjazah()
               },
               error: function () {
                  alert('Gagal menghapus data ijazah.');
               }
            });
         }
      }
      // menampilkan data ke dalam database ketika ada perubahan state
      useEffect(() => {
         $(`#listdata`).DataTable({
            destroy: true,
            data: listData,
            // scrollX: true,
            columns: [
               { data: 'tarunanama', title: 'Mahasiswa' },
               { data: 'nim', title: 'NIM'},
               { data: 'prodiname', title: 'Program Studi' },
               { data: 'tanggal_ijazah', title: 'Tanggal Ijazah' },
               { data: 'tanggal_pengesahan', title: 'Pengesahan' },
               { data: 'gelar_akademik', title: 'Gelar' },
               { data: 'nomor_sk', title: 'SK No.' },
               { data: 'nomor_ijazah', title: 'Ijazah No.' },
               { data: 'nomor_seri', title: 'Seri No.' },
               { data: 'tanggal_yudisium', title: 'Yudisium' },
               { data: 'judul_kkw', title: 'Judul Skripsi' },
               {
                  data: 'id',
                  render: function (data, type, row) {
                     return `
                     <i title="Edit Ijazah" class="fa-solid fa-pen-to-square btn-edit" data-id="${data}"></i>
                     <i title="Hapus Ijazah" class="fa-solid fa-trash" data-id="${data}"></i>
                     `;
                  },
                  title: 'Action'
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
      // mendapatkan data dari database saat pertama kali page loaded
      useEffect(() => {
         getAllDataIjazah()
         getAllOptionalData()
      }, [])
      return (
         <div >
            <div>
               {
                  showMessageSuccess ? (
                     <p className="successmessage"><i className="fa-solid fa-circle-info"></i> Data Ijazah berhasil dihapus.</p>
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
                     <FormInputIjazah
                        setShowForm={setShowForm}
                        setListData={setListData}
                        listProdi={listProdi}
                        listPejabat={listPejabat}
                        listMahasiswa={listMahasiswa}
                        refreshData={getAllDataIjazah}
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
   // form input
   const FormInputIjazah = props => {
      const { setShowForm, setListData, refreshData, editedData, type, listProdi, listMahasiswa, listPejabat } = props
      const [successMessage, setSuccessMessage] = useState(null)
      // on submit form add new mata kuliah
      const handleSubmit = (e, type, editedData) => {
         e.preventDefault()
         const data = Object.fromEntries(new FormData(document.querySelector('#formmatakuliah')).entries())
         let url = type == 'add' ? "<?=base_url()?>index.php/IjazahTranskrip/create_ijazah" : "<?=base_url()?>index.php/IjazahTranskrip/update_ijazah"
         // menyisipkan nilai id dari mata kuliah yg diedit
         if (type == 'edit') {
            data.id = editedData.id
         }
         $.ajax({
            url,
            data,
            method: 'POST',
            success: data => {
               // on success
               if (data == "true" || data > 0) {
                  $('#formmatakuliah')[0].reset()
                  setSuccessMessage(`Ijazah berhasil di${type == 'add' ? 'tambahkan' : 'update'}, Terima kasih.`)
                  refreshData()
                  setTimeout(() => setSuccessMessage(null), 5000)
               }
            },
            error: () => {
               alert('Gagal menyimpan data Mata Kuliah')
            }
         })
      }
      useEffect(() => {
         if (type == 'edit') {
            // update nilai elemen berdasarkan key value
            for (let obj in editedData) {
               $(`[name="${obj}"]`).val(editedData[obj])
            }
         }
      }, [type, editedData])
      // inisialisasi select2
      useEffect(() => {
         $('select[name="taruna"]').select2()
      }, [])
      return (
         <div className="forms">
            <h1>{type == 'add' ? 'Tambah' : 'Update'} Data Ijazah</h1>
            <p>Silahkan lengkapi form dibawah ini.</p>
            {
               successMessage != null ? (
                  <span className="successmessage"><i className="fas fa-check-circle"></i> {successMessage}</span>
               ) : false
            }
            <form id="formmatakuliah" onSubmit={e => handleSubmit(e, type, editedData)}>
               <div className="wrap">
                  <div className="formel">
                     <label htmlFor="taruna">Taruna</label>
                     <select name="taruna" required>
								<option value="">--- Pilih Taruna ---</option>
								{listMahasiswa.map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
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
                     <label htmlFor="tanggal_ijazah">Tanggal Ijazah</label>
                     <input name="tanggal_ijazah" type="date" required />
                  </div>
                  <div className="formel">
                     <label htmlFor="tanggal_pengesahan">Tanggal Pengesahan</label>
                     <input name="tanggal_pengesahan" type="date" required />
                  </div>
               </div>
               <div className="wrap nopad">
                  <div className="formel">
                     <label htmlFor="gelar_akademik">Gelar Akademik</label>
                     <input name="gelar_akademik" type="text" required placeholder="e.g. Ahli Madya Transportasi (A.Md.Tra)" />
                  </div>
                  <div className="formel">
                     <label htmlFor="nomor_sk">Nomor SK</label>
                     <input name="nomor_sk" type="text" required placeholder="e.g. INF-001-UNSIA" />
                  </div>
                  <div className="formel">
                     <label htmlFor="wakil_direktur">Wakil Direktur</label>
                     <select name="wakil_direktur" required>
								<option value="">--- Pilih Wadir ---</option>
								{listPejabat.filter(it => it.jabatan.toLowerCase().includes("wakil direktur")).map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
                  </div>
                  <div className="formel">
                     <label htmlFor="direktur">Direktur</label>
                     <select name="direktur" required>
								<option value="">--- Pilih Direktur ---</option>
								{listPejabat.filter(it => it.jabatan.toLowerCase() == "direktur").map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
                  </div>
               </div>
               <div className="wrap nopad">
                  <div className="formel">
                     <label htmlFor="nomor_ijazah">Nomor Ijazah</label>
                     <input name="nomor_ijazah" type="text" required placeholder="e.g. 1201" />
                  </div>
                  <div className="formel">
                     <label htmlFor="nomor_seri">Nomor Seri</label>
                     <input name="nomor_seri" type="text" required placeholder="e.g. UNSIA-INF-012" />
                  </div>
                  <div className="formel">
                     <label htmlFor="tanggal_yudisium">Tanggal Yudisium</label>
                     <input name="tanggal_yudisium" type="date" required />
                  </div>
                  <div className="formel">
                     <label htmlFor="judul_kkw">Judul KKW</label>
                     <input name="judul_kkw" type="text" required placeholder="e.g. Sistem Informasi Manajemen Data" />
                  </div>
               </div>
               <div className="btnarea ">
                  <a href="#" onClick={() => setShowForm(null)}>Batal</a>
                  <button><i className="fas fa-save"></i> Simpan</button>
               </div>
            </form>
         </div>
      )
   }
</script>