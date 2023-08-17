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
   const TranskripComponent = props => {
      const [showForm, setShowForm] = useState(null)
      const [listData, setListData] = useState([])
      const [listMahasiswa, setListMahasiswa] = useState([])
      const [listIjazah, setListIjazah] = useState([])
      const [listProdi, setListProdi] = useState([])
      const [listPejabat, setListPejabat] = useState([])
      const [editedData, setEditedData] = useState(null)
      const [showMessageSuccess, setShowMessageSuccess] = useState(false)
      // get data mahasiwa, prodi dan pejabat
      const getAllOptionalData = () => {
         $.ajax({
            url: '<?=base_url()?>index.php/IjazahTranskrip/get_all_ijazah',
            method: 'GET',
            success: data => {
               setListIjazah(JSON.parse(data))
            }
         })
         $.ajax({
            url: '<?=base_url()?>index.php/ProgramStudi/get_all_programstudi',
            method: 'GET',
            success: data => {
               setListProdi(JSON.parse(data))
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
            url: "<?=base_url()?>index.php/IjazahTranskrip/get_all_transkrip",
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
         if (confirm('Apakah Anda yakin ingin menghapus Ijazah?')) {
            $.ajax({
               url: `<?= base_url() ?>index.php/IjazahTranskrip/delete_transkrip/${id}`,
               method: 'POST',
               success: function (data) {
                  setShowMessageSuccess(true)
                  setTimeout(() => setShowMessageSuccess(false), 5000)
                  // Refresh halaman setelah menghapus data
                  getAllDataIjazah()
               },
               error: function () {
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
            // scrollX: true,
            columns: [
               { data: 'tarunanama', title: 'Mahasiswa' },
               { data: 'nim', title: 'NIM' },
               { data: 'nomor_ijazah', title: 'Ijazah' },
               { data: 'prodinama', title: 'Program Studi' },
               {
                  data: 'id',
                  render: function (data, type, row) {
                     return `
                     <i title="Hapus Transkrip" class="fa-solid fa-trash" data-id="${data}"></i>
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
                     <FormInputTranskrip
                        setShowForm={setShowForm}
                        setListData={setListData}
                        listIjazah={listIjazah}
                        listProdi={listProdi}
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
   const FormInputTranskrip = props => {
      const { setShowForm, setListData, refreshData, editedData, type, listIjazah, listMahasiswa, listProdi } = props
      const [successMessage, setSuccessMessage] = useState(null)
      // on submit form add new mata kuliah
      const handleSubmit = (e, type, editedData) => {
         e.preventDefault()
         const data = Object.fromEntries(new FormData(document.querySelector('#formmatakuliah')).entries())
         let url = type == 'add' ? "<?=base_url()?>index.php/IjazahTranskrip/create_transkrip" : "<?=base_url()?>index.php/IjazahTranskrip/update_transkrip"
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
      const searchIjazah = (val, list) => {
         let filtered = list.filter(it => it.taruna == val)
         if(!filtered.length){
            alert('Data Ijazah mahasiwa tidak ditemukan, silahkan tambahkan terlebih dahulu')
         } else {
            for (let obj in filtered[0]) {
               $(`[name="${obj}"]`).val(filtered[0][obj])
               if(obj == "nomor_ijazah"){
                  $(`[name="ijazah"]`).val(filtered[0].id)
               }
            }
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
                     <select name="taruna" required onChange={e => searchIjazah(e.target.value, listIjazah)}>
								<option value="">--- Pilih Taruna ---</option>
								{listMahasiswa.map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
                  </div>
                  <div className="formel">
                     <label htmlFor="nim">NIM</label>
                     <input name="nim" type="text" required placeholder="Auto complete" />
                  </div>
                  <div className="formel">
                     <label htmlFor="ijazah">Ijazah</label>
                     <input name="ijazah" type="text" required readOnly placeholder="Auto complete"/>
                  </div>
                  <div className="formel">
                     <label htmlFor="program_studi">Program Studi</label>
                     <select name="program_studi" required disabled>
                        <option value="">--- Pilih Program Studi ---</option>
								{listProdi.map((it, index) => (
									<option key={index} value={it.id}>{it.nama}</option>
								))}
							</select>
                  </div>
                  <input name="program_studi" type="text" hidden />
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