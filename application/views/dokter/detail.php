<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/dokter" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
               </div>
               Detail Dokter
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $dokter['foto_user']; ?>" class="img-fluid rounded" style="width: 240px; height: 210px;">
                  </div>
                  <div class="col-md-9">
                     <table class="table bordered">
                        <tbody>
                           <tr>
                              <td width="220">Kode Dokter</td>
                              <td><b>: <?= $dokter['kode_dokter']; ?></b></td>
                           </tr>
                           <tr>
                              <td>KTP</td>
                              <td><b>: <?= $dokter['ktp']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Nama Dokter</td>
                              <td><b>: <?= $dokter['gl_depan']; ?> <?= $dokter['nm_depan']; ?> <?= $dokter['nm_belakang']; ?>, <?= $dokter['gl_belakang']; ?></b></td>
                           </tr>
                           <tr>
                              <td>SIP</td>
                              <td><b>: <?= $dokter['sip']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Spesialis</td>
                              <td><b>: <?= $dokter['spesialis']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Tempat / Tanggal Lahir</td>
                              <td><b>: <?= $dokter['tmp_lahir']; ?> / <?= date('d M Y', strtotime($dokter['tgl_lahir'])); ?></b></td>
                           </tr>
                           <tr>
                              <td>Jenis Kelamin</td>
                              <td><b>:
                                    <?php if ($dokter['jk'] == 'L') { ?>
                                       Laki-Laki
                                    <?php } elseif ($dokter['jk'] == 'P') { ?>
                                       Perempuan
                                    <?php } ?>
                              </td>
                           </tr>
                           <tr>
                              <td>Agama</td>
                              <td><b>: <?= $dokter['agama']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Alamat Lengkap</td>
                              <td><b>: <?= $dokter['alamat']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Kontak</td>
                              <td><b>: <?= $dokter['email']; ?> / <?= $dokter['telepon']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Username</td>
                              <td><b>: <?= $dokter['username']; ?></b></td>
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