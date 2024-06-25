<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">Form Ubah Data User</div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/update_user/' . $user_set['ktp']); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="ubah_data" value="ubah">

                  <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="id_user" name="id_user" value="<?= $user_set['id_user']; ?>">
                  <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $user_set['foto_user']; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">NO ID / KTP</label>
                           <div class="col-sm-8">
                              <input type="text" id="ktp" name="ktp" class="form-control" autocomplete="off" required value="<?= $user_set['ktp']; ?>">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Depan</label>
                           <div class="col-sm-8">
                              <input type="text" id="nm_depan" name="nm_depan" class="form-control" autocomplete="off" required value="<?= $user_set['nm_depan']; ?>">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Belakang</label>
                           <div class="col-sm-8">
                              <input type="text" id="nm_belakang" name="nm_belakang" class="form-control" autocomplete="off" required value="<?= $user_set['nm_belakang']; ?>">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                           <div class="col-sm-8">
                              <input type="text" id="telepon" name="telepon" class="form-control" autocomplete="off" required value="<?= $user_set['telepon']; ?>">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control" autocomplete="off" required value="<?= $user_set['email']; ?>">
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Hak Akses</label>
                           <div class="col-sm-8">
                              <select id="hak" name="hak" class="form-control m-b" required>
                                 <?php foreach ($data_hak_akses as $hak_akses) : ?>
                                    <option <?php if ($user_set["akses"] == $hak_akses["kode_akses"]) {
                                                echo 'selected';
                                             } ?> value="<?= $hak_akses['kode_akses']; ?>"><?= $hak_akses['akses']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Foto User</label>
                           <div class="col-sm-4">
                              <div class="fileinput-new" data-provides="fileinput">
                                 <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:100px;"></div>
                                 <span class="btn btn-primary  btn-file">
                                    <span class="fileinput-new">Select</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="gambar" name="foto_user" onchange="validate(this);">
                                 </span>
                                 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                           </div>
                           <div class="col-sm-4">
                              <img alt="" src="<?= base_url(); ?>assets/upload/<?= $user_set['foto_user']; ?>" class="img-fluid rounded" style="width: 150px; height:100px;">
                           </div>
                           <div class="col-sm-8 offset-sm-4">
                              <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                 <input type="checkbox" id="ubah_gambar" name="ubah_gambar">
                                 <label for="ubah_gambar"> Ubah Gambar! </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Username</label>
                           <div class="col-sm-8">
                              <input type="text" id="username" name="username" class="form-control" autocomplete="off" required value="<?= $user_set['username']; ?>">
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="thresholdconfig" class="col-sm-4 col-form-label">Password</label>
                           <div class="col-sm-8">
                              <input type="password" id="thresholdconfig" name="pass" class="form-control" autocomplete="off">
                              <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                 <input type="checkbox" onclick="Toggle()" id="show-hide" name="password">
                                 <label for="show-hide"> Show Password </label>
                              </div>
                              <small class="text-danger">Silahkan masukan password baru jika ingin mengubah password yang sudah ada.</small>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="float-right mt-10">
                     <a href="<?= base_url(); ?>klinik/user" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Batal</a>
                     <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                  </div>
               </form>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>