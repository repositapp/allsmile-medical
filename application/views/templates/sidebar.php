<div class="main-sidebar-nav default-navigation">
   <div class="nano">
      <div class="nano-content sidebar-nav">

         <ul class="metisMenu nav flex-column" id="menu">
            <li class="nav-heading"><span>MAIN</span></li>

            <li class="nav-item <?php if ($title == 'Dashboard') {
                                    echo 'active';
                                 } ?>">
               <a class="nav-link" href="<?= base_url(); ?>klinik/dashboard">
                  <i class="fa fa-home"></i>
                  <span class="toggle-none">Dashboard </span>
               </a>
            </li>

            <?php if ($this->session->userdata('akses_user') == 1) { ?>
               <li class="nav-item <?php if ($title == 'Pendaftaran') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-user"></i> <span class="toggle-none">Pendaftaran <span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column " aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pendaftaran">Pasien Baru</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pasien_terdaftar">Pasien Terdaftar</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pembatalan">Pembatalan Transaksi</a></li>
                  </ul>
               </li>

               <li class="nav-item <?php if ($title == 'Master') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-cube"></i> <span class="toggle-none">Master Data <span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/dokter">Dokter</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pasien">Pasien</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/tindakan_set">Tindakan</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/diagnosa_set">Diagnosa</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/obat">Obat</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/supplier">Supplier</a></li>
                  </ul>
               </li>
            <?php } ?>

            <?php if ($this->session->userdata('akses_user') == 2 or $this->session->userdata('akses_user') == 3) { ?>
               <li class="nav-item <?php if ($title == 'Tindakan') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="<?= base_url(); ?>klinik/tindakan_pasien">
                     <i class="fa fa-stethoscope"></i> <span class="toggle-none">Input Tindakan
                  </a>
               </li>
            <?php } ?>

            <?php if ($this->session->userdata('akses_user') == 1) { ?>
               <li class="nav-item <?php if ($title == 'Farmasi') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-wheelchair"></i> <span class="toggle-none">Farmasi<span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/antrian_farmasi">Antrian Farmasi</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pembayaran">Pembayaran</a></li>
                  </ul>
               </li>
            <?php } ?>

            <?php if ($this->session->userdata('akses_user') == 3) { ?>
               <li class="nav-item <?php if ($title == 'Laporan') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-book"></i> <span class="toggle-none">Laporan<span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/rm_pasien">Rekam Medis</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/kj_pasien">Kunjungan</a></li>
                  </ul>
               </li>
            <?php } ?>

            <?php if ($this->session->userdata('akses_user') == 1 or $this->session->userdata('akses_user') == 2) { ?>
               <li class="nav-item <?php if ($title == 'Laporan') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-book"></i> <span class="toggle-none">Laporan<span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/rekam_medis">Rekam Medis</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/komisi">Komisi Dokter</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/kunjungan">Kunjungan</a></li>
                  </ul>
               </li>
            <?php } ?>

            <li class="nav-heading"><span>MORE</span></li>

            <?php if ($this->session->userdata('akses_user') == 1) { ?>
               <li class="nav-item <?php if ($title == 'User') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="<?= base_url(); ?>klinik/user"><i class="fa fa-group"></i> <span class="toggle-none">User
                  </a>
               </li>
               <li class="nav-item <?php if ($title == 'Settings') {
                                       echo 'active';
                                    } ?>">
                  <a class="nav-link" href="javascript: void(0);" aria-expanded="false"><i class="fa fa-cog"></i> <span class="toggle-none">Settings <span class="fa arrow"></span></span></a>
                  <ul class="nav-second-level nav flex-column sub-menu" aria-expanded="false">
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/kategori_obat">Data Kategori Obat</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/diskon">Data Diskon</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/pekerjaan">Data Pekerjaan</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/hak_akses">Data Akses</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/web_settings">Data Klinik</a></li>
                     <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/profil">Profil</a></li>
                  </ul>
               </li>
            <?php } ?>

            <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>klinik/logout"><i class="fa fa-sign-out"></i> <span class="toggle-none">Logout</a></li>
         </ul>
      </div>
   </div>
</div>