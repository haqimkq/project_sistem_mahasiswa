<style>
   .btnlogout {
      cursor: pointer;
      transition: all 0.3s;
      padding: 0.9em;
      border: none;
      font-size: 0.9em;
   }
   .headmenu{
      display: flex;
      align-items: center;
      flex-direction: column;
      padding: 1em 0.5em;
      border-bottom: 1px solid rgb(230,230,230);
      margin-bottom: 1em;
   }
   .headmenu>div>h3{
      line-height: 1.2;
   }
   .headmenu>img{
      width: 80px;
      height: 80px;
   }
   .headmenu>div>p{
      font-size: 0.8em;
      opacity: 0.6;
   }
   .btnlogout:hover {
      background: #333333
   }
   a>i{
      width: 1.3em;
   }
   @media screen and (max-width: 768px){
      .menuall{
         padding: 0 !important;
      }
      .menuall>a{
         width: 100% !important;
         padding: 0 !important;
         margin-bottom: 1.5em;
      }
      .boxcards>div>p{
         line-height: 1.4 !important;
      }
      .boxcards>img{
         width: 6em !important;
      }
      #container>div>h1>strong{
         display: block;
         margin-top: 0.4em;
      }
      #container>div>p{
         line-height: 1.4 !important;
         margin-top: 1.5em !important;
      }
      .menus>a>i{
         font-size: 1.2em;
      }
      .menus>a{
         font-size: 1.4em;
      }
   }
</style>
<div id="apps"></div>
<script type="text/babel">
   const App = () => {
      const role = '<?=$role?>'
      const listRole = ['Administrator']
      const [showMenu, setShowMenu] = useState(false)
      const handleLogOut = () => {
         let confirm = window.confirm('Anda yakin ingin Log Out?')
         if(confirm){
            window.location.href="<?=base_url()?>"
         }
      }
      useEffect(() => {
         if('<?= $userlogged ?>' == null || '<?= $userlogged ?>' == ''){
            window.location.href="<?=base_url()?>"
         }
      }, [])
      return (
         <nav className="navigation">
            {/* mobile nav */}
            <div className="mobile">
               <img src="<?=base_url()?>assets/icon.png" alt="logo kampus" width="40" height="40"/>
               <i 
                  className="fas fa-bars"
                  onClick={e => setShowMenu(!showMenu)}
               ></i>
               {
                  !showMenu ? (<ListMenuMobile />) : false
               }
            </div>
            {/* desktop nav */}
            <div className="desktop">
               <div>
                  <a href="<?= base_url() ?>index.php/Dashboard" className="headmenu">
                     <img src="<?=base_url()?>assets/icon.png" alt="logo kampus" width="60" height="60"/>
                     <div>
                        <h3>SI Cetak Ijazah</h3>
                        <p>Poltektrans SDP Palembang</p>
                     </div>
                  </a>
                  <div className="menus">
                     <a href="<?= base_url() ?>index.php/DosenMahasiswa"><i className="fas fa-users"></i> Dosen & Taruna </a>
                     {role == 'Administrator' || role == 'Akademik' ? (
                        <a href="<?= base_url() ?>index.php/IjazahTranskrip"><i className="fas fa-file-signature"></i> Ijazah & Transkrip</a>
                     ) : false}
                     {role == 'Administrator' || role == 'Unit Prodi' ? (
                        <a href="<?= base_url() ?>index.php/Penilaian"><i className="fas fa-award"></i> Penilaian</a>
                     ) : false}
                     <a href="<?= base_url() ?>index.php/MataKuliah"><i className="fas fa-book"></i> Mata Kuliah</a>
                     {role == 'Administrator' || role == 'Akademik' ? (
                        <a href="<?= base_url() ?>index.php/ProgramStudi"><i className="fas fa-graduation-cap"></i> Program Studi</a>
                     ) : false}
                     <a href="<?= base_url() ?>index.php/Kota"><i className="fas fa-building"></i> Kota</a>
                     {role == 'Administrator' ? (
                        <a href="<?= base_url() ?>index.php/Users"><i className="fas fa-user"></i> User</a>
                     ) : false}
                  </div>
               </div>
               <button 
                  title="Keluar dari Akun" 
                  className="bggreen btnlogout"
                  onClick={handleLogOut}
               >Log Out</button>
            </div>
         </nav>
      )
   }
   const root = document.querySelector("#apps")
   const el = ReactDOM.createRoot(root)
   el.render(<App />)
   // list menu mobile
   const ListMenuMobile = props => {
      return (
         <div className="listmenumobile">
            <div className="menus">
               <a href="<?= base_url() ?>index.php/DosenMahasiswa"><i className="fas fa-users"></i> Dosen & Taruna </a>
               <a href="<?= base_url() ?>index.php/IjazahTranskrip"><i className="fas fa-file-signature"></i> Ijazah & Transkrip</a>
               <a href="<?= base_url() ?>index.php/Penilaian"><i className="fas fa-award"></i> Penilaian</a>
               <a href="<?= base_url() ?>index.php/MataKuliah"><i className="fas fa-book"></i> Mata Kuliah</a>
               <a href="<?= base_url() ?>index.php/ProgramStudi"><i className="fas fa-graduation-cap"></i> Program Studi</a>
               <a href="<?= base_url() ?>index.php/Kota"><i className="fas fa-building"></i> Kota</a>
               <a href="<?= base_url() ?>index.php/Users"><i className="fas fa-user"></i> User</a>
            </div>
         </div>
      )
   }
</script>
