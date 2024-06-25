<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-5 offset-md-3">
         <div class="card price-box">
            <div class="card-body text-left lr">
               <div class="display-awal">
                  <b>Klinik Bie Medical Enginering</b>
                  <p>Jalan Betoambari No.21 RT 003 RW 001 Kel.Sulaa Kec.Betoambari Kota</p>
               </div>
               <table class="table-pendaftaran" style="width:100%; margin: 0 auto;">
                  <tr>
                     <td width="170">No.Pendaftaran</td>
                     <td>: <?= $pasien['no_pendaftaran']; ?></td>
                  </tr>
                  <tr>
                     <td>No.Pasien</td>
                     <td>: <?= $pasien['no_pasien']; ?></td>
                  </tr>
                  <tr>
                     <td>Nama Pasien</td>
                     <td>: <?= $pasien['nl_pasien']; ?></td>
                  </tr>
                  <tr>
                     <td>Dokter</td>
                     <td>: <?= $pasien['gl_depan']; ?> <?= $pasien['nm_depan']; ?> <?= $pasien['nm_belakang']; ?></td>
                  </tr>
                  <tr>
                     <td>Tanggal</td>
                     <td>: <?= date('d M Y', strtotime($pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($pasien['waktu_kunjungan'])); ?></td>
                  </tr>
               </table>
            </div>
            <div class="price-amount">
               ANTRIAN <br>
               <?= $pasien['no_antrian']; ?>
            </div>
            <div class="card-footer">
               <a href="<?= base_url(); ?>klinik/pendaftaran" class="btn btn-sm btn-success"><i class="fa fa-user"></i> Pendaftaran Pasien</a>
               <a href="#" class="btn btn-sm btn-primary cetak"><i class="fa fa-print"></i> Cetak</a>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>