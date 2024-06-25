<section class="main-content">
   <div class="row">

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/pasien" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
               </div>
               Detail Pasien
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12">
                     <table class="table bordered">
                        <tbody>
                           <tr>
                              <td width="220">No Pasien</td>
                              <td><b>: <?= $pasien['no_pasien']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Nama Lengkap</td>
                              <td><b>: <?= $pasien['nl_pasien']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Tempat / Tanggal Lahir</td>
                              <td><b>: <?= $pasien['tmp_lahir_pasien']; ?> / <?= date('d M Y', strtotime($pasien['tgl_lahir_pasien'])); ?></b></td>
                           </tr>
                           <tr>
                              <td>Jenis Kelamin</td>
                              <td><b>:
                                    <?php if ($pasien['jk_pasien'] == 'L') { ?>
                                       Laki-Laki
                                    <?php } elseif ($pasien['jk_pasien'] == 'P') { ?>
                                       Perempuan
                                    <?php } ?>
                              </td>
                           </tr>
                           <tr>
                              <td>Umur</td>
                              <td><b>: <?= $pasien['umur_pasien']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Kontak</td>
                              <td><b>: <?= $pasien['email_pasien']; ?> / <?= $pasien['telp_pasien']; ?> / <?= $pasien['kontak_lain']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Pekerjaan</td>
                              <td><b>: <?= $pasien['nm_pekerjaan']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Alamat Lengkap</td>
                              <td><b>: <?= $pasien['alamat']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Golongan Darah</td>
                              <td><b>: <?= $pasien['gol_darah']; ?></b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

               </div>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>