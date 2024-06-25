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
                  <a href="<?= base_url(); ?>klinik/user" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
               </div>
               Detail User
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user_set['foto_user']; ?>" class="img-fluid rounded" style="width: 240px; height: 210px;">
                  </div>
                  <div class="col-md-9">
                     <table class="table bordered">
                        <tbody>
                           <tr>
                              <td width="200">KTP</td>
                              <td><b>: <?= $user_set['ktp']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Nama Depan</td>
                              <td><b>: <?= $user_set['nm_depan']; ?> </b></td>
                           </tr>
                           <tr>
                              <td>Nama Belakang</td>
                              <td><b>: <?= $user_set['nm_belakang']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Telepon</td>
                              <td><b>: <?= $user_set['telepon']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td><b>: <?= $user_set['email']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Username</td>
                              <td><b>: <?= $user_set['username']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Hak Akses</td>
                              <td><b>: <?= $user_set['akses']; ?></b></td>
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