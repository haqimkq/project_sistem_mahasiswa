<style>
	.boximage{
		margin-top: 2em;
	}
	.boximage>img{
		width: 40em;
		margin-bottom: 2em;
	}
	h1{
		font-size: 2em;
		margin-top: 0.5em;
	}
	h1>strong{
		color: #1B9C85;
		font-size: inherit;
	}
	#container>div>p{
		margin-top: 0.5em;
		color: rgb(100,100,100);
	}
	.boximage{
		display: flex;
		justify-content: center;
	}
	.menuall{
		display: flex;
		flex-wrap: wrap;
		width: 100%;
		padding: 1em;
	}
	.menuall>a{
		width:50%;
		padding: 1em;
	}
	.boxcards{
		outline: 1px solid rgb(240,240,240);
		width: 100%;
		transition: all 0.3s;
		border-radius: 0.5em;
		box-shadow: 2px 2px 2px 0 rgb(240,240,240);
		display: flex;
		align-items:center;
		gap: 0.5em;
	}
	.boxcards:hover{
		box-shadow: 10px 10px 20px 0 rgb(240,240,240);
		cursor: pointer;
		transform: translateY(-0.1em);
	}
	.boxcards>div{
		padding: 0 1em 1em 1em;
	}
	.boxcards>div>h3{
		font-size: 1.3em;
		line-height: 0.8;
	}
	.boxcards>img{
		width:8em;
		height: 7em;
		object-fit: cover;
	}
	.boxcards>div>p{
		color: rgb(100,100,100);
		margin-top: 0.4em;
	}
	.grayscale{
		filter: grayscale(100%);
	}
</style>
<div id="appss"></div>
<script type="text/babel">
	const { useState, useEffect } = React
	const App = () => {
		const role = '<?= $role ?>'
		const listMenu = [
			{
				title: "Dosen & Taruna",
				access: ['Administrator', 'Unit Prodi', 'Akademik'],
				desc: "Manage data Taruna dan Dosen",
				img: "dosenmahasiswa.svg",
				url: "index.php/DosenMahasiswa"
			},
			{
				title: "Ijazah & Transkrip",
				desc: "Manage data pencetakan Ijazah dan Transkrip",
				access: ['Administrator', 'Akademik'],
				img: "ijazahtranskrip.svg",
				url: "index.php/IjazahTranskrip"
			},
			{
				title: "Penilaian",
				desc: "Manage data Penilaian Taruna",
				access: ['Administrator', 'Unit Prodi'],
				img: "penilaian.svg",
				url: "index.php/Penilaian"
			},
			{
				title: "Mata Kuliah",
				desc: "Manage data Mata Kuliah",
				access: ['Administrator', 'Unit Prodi', 'Akademik'],
				img: "matakuliah.svg",
				url: "index.php/MataKuliah"
			},
			{
				title: "Program Studi",
				desc: "Manage data Program Studi",
				access: ['Administrator', 'Akademik'],
				img: "programstudi.svg",
				url: "index.php/ProgramStudi"
			},
			{
				title: "Kota",
				desc: "Manage data Kota",
				access: ['Administrator', 'Unit Prodi', 'Akademik'],
				img: "kota.svg",
				url: "index.php/Kota"
			},
			{
				title: "User",
				desc: "Manage data User",
				access: ['Administrator'],
				img: "team.png",
				url: "index.php/Users"
			},
		]
		return (
			<div id="container">
				<div>
					<h1>Selamat Datang, <strong><?= $userlogged ?></strong></h1>
					<p>Silahkan pilih <strong>Menu di bawah</strong> atau <strong>Sidebar</strong> sesuai kebutuhan.</p>
					<div className="boximage">
						{/*<img src="../assets/dashboard.png" alt="illustration" />*/}
						<div className="menuall">
							{
								listMenu.filter(it => it.access.includes(role)).map((it, index) => (
									<a key={index} href={`<?=base_url()?>${it.url}`}>
										<div className="boxcards">
											<img src={`<?=base_url()?>/assets/${it.img}`} alt="" height="100" className={!it.access.includes(role) ? 'grayscale' : ''}/>
											<div>
												<h3>{it.title}</h3>
												<p>{it.desc}</p>
											</div>
										</div>
									</a>
								))
							}
						</div>
					</div>
				</div>
			</div>
		)
	}
	const root = document.querySelector("#appss")
	const el = ReactDOM.createRoot(root)
	el.render(<App />)
</script>
