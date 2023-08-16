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

	form {
		margin: 0;
	}

	.formel>button,
	.headprint>button {
		transition: all 0.3s;
		padding: 0.75em 1.4em;
		background: #0079FF;
		cursor: pointer;
		color: white;
		border: none;
		border-radius: 0.5em;
	}

	.formel>button:hover,
	.headprint>button:hover {
		background: #0055b6;
	}

	.warnmessage {
		color: #FF0060;
		background: #ffeaf2;
		border-radius: 0.5em;
		margin: 0.5em 0;
		text-align: center;
		padding: 0.75em;
	}

	.headers {
		animation: show 0.5s ease;
		display: flex;
		gap: 1.5em;
		align-items: center;
		margin: 1.5em 0;
	}

	.headers>div {
		flex: 1;
	}

	.mahasiswainfo>h5 {
		font-size: 1.5em;
	}

	.mahasiswainfo>p {
		margin-top: 0.3em;
		opacity: 0.6;
	}

	.headprint {
		display: flex;
		justify-content: center;
		align-items: flex-start;
		gap: 1em;
	}

	.tbox {
		padding: 1.5em 0 !important;
	}

	.infos {
		padding: 1.5em 0;
		display: flex;
		width: 100%;
		flex-direction: column;
		align-items: center;
		gap: 0.7em;
	}

	.infos>img {
		filter: grayscale(20%);
	}

	.infos>h3 {
		color: crimson;
		font-weight: 400;
		margin-top: 0.5em;
		font-size: 1.4em;
	}

	.infos>h3>i {
		font-size: 1.2em;
		transform: translateY(0.06em);
	}

	.boxijazah {
		position: fixed;
		overflow: auto;
		top: 0;
		left: 0;
		padding: 1em;
		width: 100%;
		height: 100%;
		background: rgba(20, 20, 20, 0.5) !important;
		display: flex;
		justify-content: center;
		border-radius: 0 !important;
		animation: show 0.5s ease;
	}

	.formijazah {
		font-family: Calibri;
		font-size: 11px !important;
		height: max-content;
		border-radius: 0.3em;
		background: white;
		padding: 1.5em 2.5em;
		font-size: 1.3em;
		line-height: 1.5;
	}

	.between {
		display: flex;
		align-items: flex-end;
		justify-content: space-between;
	}

	.between>p {
		font-weight: 600;
	}

	.text-center {
		text-align: center;
	}

	.between>div {
		width: 22em;
	}
	.ijpad>div{
		width: 17em !important;
	}
	.between>div>div>p>strong{
		font-size: 1.3em;
	}
	.text-center>h1 {
		font-size: 26px;
		font-family: none;
		margin-top: 0.5em;
	}

	.wrap-center {
		padding: 3em 4em;
		display: flex;
		gap: 5em;
	}

	.bots {
		margin: 1em 0;
	}

	.pads {
		padding: 0em 1.5em 2em 1.5em;
		text-align: justify;
	}
	.ijpad{
		justify-content: space-between;
		padding: 1em 0;
	}
	.watermark{
		position: absolute;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 100%;
		height: 100%;
	}
	.watermark>img{
		opacity: 0.1;
		z-index: 1;
	}
	.boxijazah::-webkit-scrollbar, .boxijazah::-webkit-scrollbar-thumb{
		width: 0;
	}
	.ijazahcontent{
		position: relative;
		height: fit-content;
		width: 80%;
		padding: 1em;
		background: white;
		border-radius: 0.5em;
	}
	.wraptranskrip{
		display: flex;
		padding: 1.5em 2em;
		gap: 1em;
	}
	.ijazahcontent p, td>b{
		font-size: 10px !important;
		line-height: 1.5;
	}
	.ijazahcontent >h1{
		text-align: center;
		padding-top: 1.2em;
		text-decoration: underline;
	}
	.tablewraps{
		display: flex;
		gap: 1em;
	}
	.tablewraps>div{
		flex: 1;
	}
	.tablewraps>div>table{
		border-collapse: collapse;
		width: 100%;
	}
	.tablewraps>div>table>tbody>tr>td, .tablewraps>div>table>thead>tr>th{
		padding: 0.2em !important;
		font-size: 10px !important;
	}
	.titlesm{
		background: rgb(245,245,245);
		text-align: center;
		font-weight: 600;
	}
	.keterang{
		margin: 1em 0;
	}
	.btop{
		border=top: 1px solid rgb(220,220,220)
	}
	.btop>div{
		margin: 0.5em 0;
		display: flex;
		gap: 2em;
		padding: 0 1.5em;
	}
	table{
		border: 1px solid rgb(220,220,220);
	}
	.btop>div>p:nth-child(1){
		width: 15em;
		text-align: left;
	}
	.bolds{
		font-weight: 600;
	}
	.tablewraps>div>table>tbody>tr>td.expad{
		padding: 1em !important;
	}
	tr>td:nth-child(3){
		text-align: left;
	}
	.lefts{
		text-align: left !important;
	}
	.fotobox{
		position: relative;
	}
	.fotobox>.prof{
		width: 7.5em;
		height: 10em;
		top: 0;
		left: 0;
		position: absolute;
		object-fit: cover;
		border: 1px solid rgb(50,50,50);
		transform: translate(-8em, -1.2em);
	}
	@media print {
		.no-print {
			display: none;
		}
		.tablewraps>div{
			flex: 1;
		}
		.boxijazah{
			justify-content: flex-start;
			padding: 0;
		}
		.ijazahcontent{
			width: 100%;
		}
		.ijazahcontent>h1{
			text-align: center;
		}
		table>thead>tr>th{
			background: rgb(245,245,245) !important;
			border-top: 1px solid rgb(220,220,220) !important;
			border-bottom: 1px solid rgb(220,220,220) !important;
		}
		table>tbody>tr>td, table>thead>tr>th{
			border-left: 1px solid rgb(220,220,220) !important;
			border-right: 1px solid rgb(220,220,220) !important;
		}
		.titlesm{
			background-color: rgb(245,245,245);
			border: 1px solid rgb(220,220,220) !important;
			padding: 1em 0;
			text-align: center;
			font-weight: 600;
		}
		.centers{
			text-align: center !important;
		}
	}
	@page{
		margin: 0;
	}
</style>

<?php
// Fungsi untuk mendapatkan nomor acak antara 100 hingga 1000
function getRandomNumber() {
    return rand(100, 1000);
}

// Mendapatkan nomor seri dan nomor ijazah secara acak
$nomorSeri = getRandomNumber();
$nomorIjazah = getRandomNumber();
?>

<div id="appss"></div>
<script type="text/babel">
	const { useState, useEffect } = React
	const App = () => {
		const [mahasiswaInfo, setMahasiswaInfo] = useState(null)
		const [mahasiswaNotFound, setMahasiswaNotFound] = useState(false)
		const [listNilai, setListNilai] = useState([])
		const [onStart, setOnStart] = useState(true)
		const [isPrintIjazah, setIsPrintIjazah] = useState(false)
		const [isPrintTranskrip, setIsPrintTranskrip] = useState(false)
		const [dataPejabat, setDataPejabat] = useState([])
		const [activeTab, setActiveTab] = useState(1)
		// get data direktur dan wadir
		const getDataPejabat = () => {
			$.ajax({
				url: '<?=base_url()?>index.php/DosenMahasiswa/get_all_dosen',
				method: 'GET',
				success: data => {
					let filteredData = JSON.parse(data)
					filteredData = filteredData.filter(it => it.jabatan.toLowerCase().includes("wakil direktur") || it.jabatan.toLowerCase().includes("direktur"))
					setDataPejabat(filteredData)
				}
			})
		}
		// get detail list nilai
		const getDetailTranskrip = id => {
			$.ajax({
				url: `<?=base_url()?>index.php/Penilaian/get_all_penilaian`,
				method: 'GET',
				success: data => {
					let allData = JSON.parse(data)
					let filteredDataByIdMhs = allData.filter(it => it.tarunaid == id)
					setListNilai(filteredDataByIdMhs)
				},
				error: () => {
					alert('Gagal mendapatkan data penilaian')
				}
			})
		}
		// search mahasiswa
		const handleSearchMahasiswa = e => {
			e.preventDefault()
			$.ajax({
				url: "<?=base_url()?>index.php/IjazahTranskrip/get_all_ijazah",
				method: 'GET',
				success: data => {
					let allData = JSON.parse(data)
					let filtered = allData.filter(it => it.nim.includes($('[name="nim"]').val()))
					if(!filtered.length){
						setMahasiswaNotFound(true)
						setMahasiswaInfo(null)
					} else {
						setMahasiswaInfo(filtered[0])
						getDetailTranskrip(filtered[0].taruna)
						setMahasiswaNotFound(false)
						setOnStart(false)
					}
				},
				error: () => {
					alert('Gagal mendapatkan data Mahasiswa')
				}
			})
		}
		// generate datatable
		useEffect(() => {
			if(activeTab == 1){
				const root = document.querySelector("#crudijazah")
				const el = ReactDOM.createRoot(root)
				el.render(<IjazahComponent />)
			} else if(activeTab == 2){
				const root = document.querySelector("#crudtranskrip")
				const el = ReactDOM.createRoot(root)
				el.render(<TranskripComponent />)
			} else if(activeTab == 3){
				$('#listdata').DataTable({
					destroy: true,
					data: listNilai,
					columns: [
						{ data: 'matakuliah', title: 'Mata Kuliah' },
						{ data: 'nilai_angka', title: 'Nilai Angka' },
						{ data: 'nilai_huruf', title: 'Nilai Huruf' },
					]
				})
			}
		}, [listNilai, activeTab])
		// get data pejabat
		useEffect(() => {
			getDataPejabat()
		}, [])
		return (
			<div id="container">
				<div>
					<div className="title">
						<i className="fas fa-file-signature"></i>
						<div>
							<h1> Transkrip & Ijazah</h1>
							<p>Silahkan masukkan <strong>NIM</strong> mahasiswa untuk pencetakan Ijazah dan Traksrip. </p>
						</div>
					</div>
					{ /* navigation */
						<div className="navigations">
							<a 
								href="#"
								className={activeTab == 1 ? 'activetab' : ''}
								onClick={() => setActiveTab(1)}
							>Ijazah</a>
							<a 
								href="#"
								className={activeTab == 2 ? 'activetab' : ''}
								onClick={() => setActiveTab(2)}
							>Transkrip</a>
							<a 
								href="#"
								className={activeTab == 3 ? 'activetab' : ''}
								onClick={() => setActiveTab(3)}
							>Print Dokumen</a>
						</div>
					}
					{ /* crud ijazah */
						activeTab == 1 ? (
							<div id="crudijazah"></div>
						) : false
					}
					{ /* crud transkrip */
						activeTab == 2 ? (
							<div id="crudtranskrip"></div>
						) : false
					}
					{ /* print dokumen */
						activeTab == 3 ? (
							<React.Fragment>
								<div>
									<form onSubmit={e => handleSearchMahasiswa(e)}>
										<div className="wrap" style={{padding: '1em 0'}}>
											<div className="formel">
												<label htmlFor="nim">NIM</label>
												<input type="text" name="nim" placeholder="e.g. 220401020003" />
											</div>
											<div className="formel">
												<label htmlFor="nim"></label>
												<button type="submit">Cari</button>
											</div>
										</div>
									</form>
								</div>
								{ /* eror not found mahasiswa */
									mahasiswaNotFound ? (
										<p className="warnmessage"><i className="fa-solid fa-circle-info"></i>Maaf, Data Mahasiswa tidak ditemukan</p>
									) : false
								}
								{ /* tampilkan data mahasiswa */
									mahasiswaInfo != null ? (
										<React.Fragment>
											<div className="headers">
												<div className="mahasiswainfo">
													<h5>{mahasiswaInfo.tarunanama}</h5>
													<p><i className="fa-solid fa-calendar-week"></i> {mahasiswaInfo.namakota}, {mahasiswaInfo.tanggal_lahir}</p>
												</div>
												<div className="mahasiswainfo">
													<h5>{mahasiswaInfo.nim}</h5>
													<p><i className="fas fa-graduation-cap"></i>Prodi {mahasiswaInfo.prodiname}</p>
												</div>
												<div className="headprint">
													<button 
														title="Cetak Ijazah" 
														onClick={() => setIsPrintIjazah(true)}
													><i className="fa-solid fa-print"></i> Ijazah</button>
													<button
														title="Cetak Transkrip"
														onClick={() => setIsPrintTranskrip(true)}
													><i className="fa-solid fa-print"></i> Transkrip</button>
												</div>
											</div>
											<div className="tbox">
												<table id="listdata"></table>
											</div>
										</React.Fragment>
									) : false
								}
								{ /* tampilkan pesan belum mencari */
									onStart ? (
										<div className="infos">
											<img src="<?=base_url()?>assets/wait.jpg" alt="illustration" />
											<h3><i className="fa-solid fa-circle-info"></i> Anda belum melakukan pencarian. </h3>
										</div>
									) : false
								}
							</React.Fragment>
						) : false
					}
				</div>
				{ /* cetak ijazah */
					isPrintIjazah ? (
						<FormIjazah 
							data={mahasiswaInfo} 
							hide={setIsPrintIjazah} 
							dataPejabat={dataPejabat}
						/>
					) : false
				}
				{ /* cetak transkrip */
					isPrintTranskrip ? 
						<FormTranskrip 
							data={mahasiswaInfo} 
							hide={setIsPrintTranskrip}
							allNilai={listNilai}
							dataPejabat={dataPejabat} 
						/>
					: false
				}
			</div>
		)
	}
	const root = document.querySelector("#appss")
	const el = ReactDOM.createRoot(root)
	el.render(<App />)
	// form ijazah
	const FormIjazah = props => {
		const { tarunanama, namakota, nim, prodiname, tanggal_lahir, tanggal_ijazah, wadir, dir, noakred, wadirnip, dirnip, gelar_akademik, prodipendidikan, akreditasi, nomor_seri, nomor_ijazah } = props.data
		const { hide, dataPejabat } = props
		// get data direktur dan wadir
		useEffect(() => {
			// auto print
			setTimeout(() => window.print(), 1500)
		}, [dataPejabat])
		return (
			<div className="boxijazah" onClick={() => hide(false)}>
				<div className="watermark">
					<img src="<?=base_url()?>assets/icon.png" alt="illustration" />
				</div>
				<div className="formijazah">
					<div className="between">
						<p>No. Seri : {nomor_seri}</p>
						<p>No. Ijazah : {nomor_ijazah}</p>
					</div>
					<div className="text-center">
						<h1>IJAZAH</h1>
					</div>
					<div className="wrap-center">
						<div>
							<p>Memberikan Ijazah Kepada </p>
							<p>Tempat dan Tanggal Lahir </p>
							<p>Nomor Taruna </p>
							<p>Program Pendidikan </p>
							<p>Program Studi </p>
							<p>Status </p>
						</div>
						<div>
							<p><strong>: {tarunanama.toUpperCase()}</strong></p>
							<p>: {namakota}, {tanggal_lahir} </p>
							<p>: {nim} </p>
							<p>: {prodipendidikan} </p>
							<p>: {prodiname} </p>
							<p>: TERAKREDITASI <strong>"{akreditasi.toUpperCase()}"</strong> </p>
							<p><i style={{ paddingLeft: '0.4em' }}>Berdasarkan Keputusan BAN PT No. {noakred}</i></p>
						</div>
					</div>
					<div className="pads">
						<p>Ijazah ini diserahkan berdasarkan Surat Keputusan Direktur Politeknik Siber Asia Nomor: SK. 321 Tahun 2022, setelah yang bersangkutan memenuhi semua persyaratan yang telah ditentukan dan kepadanya dilimpahkan segala wewenang dan hak yang berhubungan dengan Ijazah yang dimilikinya serta berhak menggunakan Gelar Akademik <strong>{gelar_akademik}</strong></p>
					</div>
					<div className="between pads">
						<div className="text-center">
							<p>WAKIL DIREKTUR I </p>
							<p>POLITEKNIK SIBER ASIA</p>
							<div className="bots">
								<img src="<?=base_url() ?>assets/barcode.png" alt="barcode" width="100" />
							</div>
							<div>
								<p><strong>{wadir.toUpperCase()}</strong></p>
								<p>NIP. {wadirnip}</p>
							</div>
						</div>
						<div className="text-center">
							<p>Jakarta, {tanggal_ijazah}</p>
							<p>DIREKTUR</p>
							<p>POLITEKNIK SIBER ASIA</p>
							<div className="bots">
								<img src="<?=base_url() ?>assets/barcode.png" alt="barcode" width="100" />
							</div>
							<div>
								<p><strong>{dir.toUpperCase()}</strong></p>
								<p>NIP. {dirnip}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		)
	}
	// form transkrip
	const FormTranskrip = props => {
		const { tarunanama, namakota, nim, prodiname, tanggal_lahir, tanggal_ijazah, wadir, dir, noakred, wadirnip, dirnip, gelar_akademik, prodipendidikan, akreditasi, nomor_seri, judul_kkw, nomor_ijazah, tanggal_yudisium, foto } = props.data
		const {hide, data, dataPejabat, allNilai} = props
		// const [listNilai, setListNilai] = useState([])
		const [listNilai, setListNilai] = useState([])
		const [ipk, setIpk] = useState(0.0)
		// generate predikat ipk
		const generatePredikat = ipk => {
			let predikat = ''
			if(ipk >= 2.0 && ipk <= 2.75){
				predikat = "MEMUASKAN"
			} else if(ipk >= 2.76 && ipk <= 3.5){
				predikat = "SANGAT MEMUASKAN"
			} else if(ipk > 3.5){
				predikat = "DENGAN PUJIAN"
			}
			return predikat
		}
		// get data direktur dan wadir
		useEffect(() => {
			// auto print
			setTimeout(() => window.print(), 1500)
		}, [data])
		// get detail nilai
		useEffect(() => {
			$.ajax({
				url: `<?=base_url()?>index.php/Penilaian/get_penilaian_by_nim/${nim}`,
				method: 'GET',
				success: data => {
					let nim = data.nomor_taruna
					let listNilai = {
						A: 4, AB: 3.5, B: 3, BC: 2.5, C:2, D:1, E:0
					}
					let listData = JSON.parse(data)
					listData = listData.map(it => {
						let semester = 0
						if(it.semester == 'Semester I'){
							semester = 1
						} else if(it.semester == 'Semester II'){
							semester = 2
						} else if(it.semester == 'Semester III'){
							semester = 3
						} else if(it.semester == 'Semester IV'){
							semester = 4
						} else if(it.semester == 'Semester V'){
							semester = 5
						} else if(it.semester == 'Semester VI'){
							semester = 6
						} else if(it.semester == 'Ujian Akhir Program Studi'){
							semester = 7
						}
						return {...it, nosemester: semester}
					})
					listData = listData.sort((a,b) => a.nosemester - b.nosemester)
					listData = listData.map((it, index) => ({...it, sks: parseInt(it.sks), urutan: index+1}))
					// get total nilai sks * grade nilai
					listData = listData.map((it => ({...it, totalScore: it.sks * listNilai[it.nilai_huruf]})))
					setListNilai(listData)
					// set nilai ipk
					let totalScore = listData.reduce((a,b) => a + b.totalScore, 0)
					let totalSKS = listData.reduce((a,b) => a + b.sks, 0)
					setIpk(totalScore/totalSKS)
				}
			})
		}, [data, allNilai])
		return (
			<div className="boxijazah" onClick={() => hide(false)}>
				<div className="watermark">
					<img src="<?=base_url()?>assets/icon.png" alt="illustration" />
				</div>
				<div className="ijazahcontent">
					<p>Lampiran Ijazah Nomor : {nomor_ijazah}</p>
					<h1>TRANSKRIP NILAI AKADEMIK</h1>
					<div className="wraptranskrip mini">
						<div>
							<p>NAMA</p>
							<p>NOMOR TARUNA</p>
							<p>TEMPAT / TANGGAL LAHIR</p>
							<p>JURUSAN / PROGRAM STUDI</p>
							<p>STATUS</p>
							<p>TANGGAL YUDISIUM</p>
						</div>
						<div>
							<p>: {tarunanama}</p>
							<p>: {nim}</p>
							<p>: {namakota}, {tanggal_lahir}</p>
							<p>: {prodipendidikan.toUpperCase()} {prodiname.toUpperCase()}</p>
							<p>: TERAKREDITASI {akreditasi.toUpperCase()}</p>
							<p>: {tanggal_yudisium}</p>
						</div>
					</div>
					{/* bagian transkrip */}
					<div className="tablewraps">
						<div>
							<table className="table-bor">
								<thead>
									<tr>
										<th>NO</th>
										<th>KODE</th>
										<th className="Matkul">MATA KULIAH</th>
										<th>SKS</th>
										<th>NILAI</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER I</td>
									</tr>
									{ // semester I 
										listNilai.filter(it => it.semester == "Semester I").length ? listNilai.filter(it => it.semester == 'Semester I').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER II</td>
									</tr>
									{ // Semester II
										listNilai.filter(it => it.semester == "Semester II").length ? listNilai.filter(it => it.semester == 'Semester II').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER III</td>
									</tr>
									{ // semester III
										listNilai.filter(it => it.semester == "Semester III").length ? listNilai.filter(it => it.semester == 'Semester III').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
								</tbody>
							</table>
						</div>
						<div>
							<table className="table-bor">
								<thead>
									<tr>
										<th>NO</th>
										<th>KODE</th>
										<th className="Matkul">MATA KULIAH</th>
										<th>SKS</th>
										<th>NILAI</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER VI</td>
									</tr>
									{ // semester IV
										listNilai.filter(it => it.semester == "Semester IV").length ? listNilai.filter(it => it.semester == 'Semester IV').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER V</td>
									</tr>
									{ // semester V
										listNilai.filter(it => it.semester == "Semester V").length ? listNilai.filter(it => it.semester == 'Semester V').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">SEMESTER VI</td>
									</tr>
									{ // semester VI
										listNilai.filter(it => it.semester == "Semester VI").length ? listNilai.filter(it => it.semester == 'Semester VI').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts">{it.matakuliah}</td>
												<td>{it.sks}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">UJIAN AKHIR PROGRAM STUDI</td>
									</tr>
									{ // semester VI
										listNilai.filter(it => it.semester == "Ujian Akhir Program Studi").length ? listNilai.filter(it => it.semester == 'Ujian Akhir Program Studi').map((it, index) => (
											<tr key={index}>
												<td>{it.urutan}</td>
												<td>{it.kode}</td>
												<td className="lefts" colSpan="2">{it.matakuliah}</td>
												<td>{it.nilai_huruf}</td>
											</tr>
										)) : (
											<tr>
												<td colSpan="5">Tidak ada mata kuliah.</td>
											</tr>
										)
									}
									<tr>
										<td colSpan="5" className="titlesm">JUDUL KERTAS KERJA WAJIB</td>
									</tr>
									<tr>
										<td colSpan="5" className="expad">{judul_kkw}</td>
									</tr>
									<tr>
										<td colSpan="5" className="btop">
											<div>
												<p>JUMLAH SKS</p>
												<p className="bolds">: {listNilai.reduce((a,b) => a + b.sks, 0)} SKS</p>
											</div>
											<div>
												<p>IP KUMULATIF</p>
												<p className="bolds">: {ipk.toFixed(2)}</p>
											</div>
											<div>
												<p>PREDIKAT KELULUSAN </p>
												<p className="bolds">: {generatePredikat(ipk)}</p>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<p className="keterang">KETERANGAN: A=4; AB=3.50; B=3; BC=2.50; C=2; D=1; E=0 </p>
					<div className="between pads ijpad">
						<div className="text-center">
							<p>WAKIL DIREKTUR I </p>
							<p>POLITEKNIK SIBER ASIA</p>
							<div className="bots">
								<img src="<?=base_url() ?>assets/barcode.png" alt="barcode" width="100" />
							</div>
							<div>
								<p><strong>{wadir.toUpperCase()}</strong></p>
								<p>NIP. {wadirnip}</p>
							</div>
						</div>
						<div className="text-center">
							<p>Jakarta, {tanggal_ijazah}</p>
							<p>DIREKTUR</p>
							<p>POLITEKNIK SIBER ASIA</p>
							<div className="bots fotobox">
								<img src="<?=base_url() ?>assets/barcode.png" alt="barcode" width="100" />
								<img className="prof" src={`<?=base_url()?>upload/${foto}`} alt="fotoprofil" />
							</div>
							<div>
								<p><strong>{dir.toUpperCase()}</strong></p>
								<p>NIP. {dirnip}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		)
	}
</script>