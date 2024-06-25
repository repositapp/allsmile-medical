<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <?php if ($user['akses'] == "1") { ?>
                     <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahBiodata"><i class="fa fa-edit"></i> Ubah Biodata</a>
                     <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah Password</a>
                     <a href="#" class="btn btn-sm btn-info" data-toggle="modal" data-target="#ubahGambar"><i class="fa fa-edit"></i> Ubah Foto</a>
                  <?php } elseif ($user['akses'] == "2") { ?>
                     <a href="<?= base_url(); ?>klinik/update_dokter/<?= $user['ktp']; ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Ubah Profil</a>
                  <?php } elseif ($user['akses'] == "3") { ?>
                     <a href="<?= base_url(); ?>klinik/update_dokter/<?= $user['ktp']; ?>" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Ubah Profil</a>
                  <?php } ?>
               </div>
               Profil
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user['foto_user']; ?>" class="img-fluid rounded" width="300">
                  </div>
                  <div class="col-md-9">
                     <table class="table bordered">
                        <tbody>
                           <tr>
                              <td>KTP</td>
                              <td><b>: <?= $user['ktp']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Nama</td>
                              <td><b>: <?= $user['nm_depan']; ?> <?= $user['nm_belakang']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Telepon</td>
                              <td><b>: <?= $user['telepon']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Email</td>
                              <td><b>: <?= $user['email']; ?></b></td>
                           </tr>
                           <tr>
                              <td>Username</td>
                              <td><b>: <?= $user['username']; ?></b></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>

   <!-- Modal Ubah Data -->
   <form method="post" action="<?= base_url('klinik/profil'); ?>" enctype="multipart/form-data">
      <div id="ubahBiodata" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Ubah Biodata</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="ubah_data" value="ubahBiodata">
                  <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">NO ID / KTP</label>
                     <div class="col-sm-8">
                        <input type="text" id="ktp" name="ktp" class="form-control" autocomplete="off" required value="<?= $user['ktp']; ?>">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">Nama Depan</label>
                     <div class="col-sm-8">
                        <input type="text" id="nm_depan" name="nm_depan" class="form-control" autocomplete="off" required value="<?= $user['nm_depan']; ?>">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">Nama Belakang</label>
                     <div class="col-sm-8">
                        <input type="text" id="nm_belakang" name="nm_belakang" class="form-control" autocomplete="off" required value="<?= $user['nm_belakang']; ?>">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                     <div class="col-sm-8">
                        <input type="text" id="telepon" name="telepon" class="form-control" autocomplete="off" required value="<?= $user['telepon']; ?>">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">Email</label>
                     <div class="col-sm-8">
                        <input type="email" id="email" name="email" class="form-control" autocomplete="off" required value="<?= $user['email']; ?>">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
               </div>
            </div>
         </div>
      </div>
   </form>

   <!-- Modal Ubah Data -->
   <form method="post" action="<?= base_url('klinik/profil'); ?>" enctype="multipart/form-data">
      <div id="ubahData" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Ubah Password</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="ubah_data" value="ubah">
                  <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Password Lama</label>
                     <div class="col-sm-9">
                        <input type="text" id="old_password" name="old_password" class="form-control" autocomplete="off" required>
                     </div>
                  </div>

                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Password Baru</label>
                     <div class="col-sm-9">
                        <input type="text" id="new_password" name="new_password" class="form-control" autocomplete="off" required>
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
               </div>
            </div>
         </div>
      </div>
   </form>

   <!-- Modal Ubah Foto -->
   <form method="post" action="<?= base_url('klinik/profil'); ?>" enctype="multipart/form-data">
      <div id="ubahGambar" class="modal fade bs-example-modal-default" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Ubah Foto Profil</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="ubah_data" value="ubahGambar">
                  <input type="hidden" id="id_user" name="id_user" value="<?= $user['id_user']; ?>">
                  <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user['foto_user']; ?>">

                  <div class="form-group row">
                     <label for="label" class="col-sm-4 col-form-label">Foto User</label>
                     <div class="col-sm-4">
                        <div class="fileinput-new" data-provides="fileinput">
                           <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:150px;"></div>
                           <span class="btn btn-primary  btn-file">
                              <span class="fileinput-new">Select</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" id="gambar" name="foto_user" onchange="validate(this);">
                           </span>
                           <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                     </div>
                     <div class="col-sm-4">
                        <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user['foto_user']; ?>" class="img-fluid rounded" style="width: 150px;">
                     </div>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Simpan Data</button>
               </div>
            </div>
         </div>
      </div>
   </form>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>