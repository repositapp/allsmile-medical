<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right">
                  <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ubahData"><i class="fa fa-edit"></i> Ubah</a>
               </div>
               Profil
            </div>
            <div class="card-body">
               <table class="table bordered">
                  <tbody>
                     <tr>
                        <td width="250">Nama Klinik</td>
                        <td>: <?= $set_web['nama_klinik']; ?></td>
                     </tr>
                     <tr>
                        <td width="250">Title Web</td>
                        <td>: <?= $set_web['title_web']; ?></td>
                     </tr>
                     <tr>
                        <td width="250">Title Sidebar</td>
                        <td>: <?= $set_web['sidebar_title']; ?></td>
                     </tr>
                     <tr>
                        <td>Email</td>
                        <td>: <?= $set_web['email_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Telepon</td>
                        <td>: <?= $set_web['telepon_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Fax</td>
                        <td>: <?= $set_web['fax_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Facebook</td>
                        <td>: <?= $set_web['fb_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Twitter</td>
                        <td>: <?= $set_web['twitter_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Alamat</td>
                        <td>: <?= $set_web['alamat_web']; ?></td>
                     </tr>
                     <tr>
                        <td>Logo</td>
                        <td>
                           <div class="d-flex">
                              : <img src="<?= base_url() ?>assets/upload/<?= $set_web['logo_web']; ?>" class="img-thumbnail rounded d-block ml-1" alt="..." style="width: 100px; height: 100px;">
                           </div>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

   </div>

   <!-- Modal Ubah Data -->
   <form method="post" action="<?= base_url('klinik/web_settings'); ?>" enctype="multipart/form-data">
      <div id="ubahData" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myDefaultModalLabel">
         <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="fa fa-times"></span></button>
                  <h5 class="modal-title" id="myDefaultModalLabel">Ubah Data Klinik</h5>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="ubah_data" value="ubah">
                  <input type="hidden" name="id_web" value="<?= $set_web['id_web']; ?>">
                  <input type="hidden" class="form-control" id="old_image" name="old_image" value="<?= $set_web['title_web']; ?>">

                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Nama Klinik</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="nama_klinik" name="nama_klinik" value="<?= $set_web['nama_klinik']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Title Website</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="title_web" name="title_web" value="<?= $set_web['title_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Sidebar Title</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="sidebar_title" name="sidebar_title" value="<?= $set_web['sidebar_title']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Email</label>
                     <div class="col-9">
                        <input type="email" class="form-control" id="email_web" name="email_web" value="<?= $set_web['email_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Telepon</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="telepon_web" name="telepon_web" value="<?= $set_web['telepon_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Fax</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="fax_web" name="fax_web" value="<?= $set_web['fax_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Facebook</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="fb_web" name="fb_web" value="<?= $set_web['fb_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Twitter</label>
                     <div class="col-9">
                        <input type="text" class="form-control" id="twitter_web" name="twitter_web" value="<?= $set_web['twitter_web']; ?>" required>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-3 col-form-label" for="example-email">Alamat</label>
                     <div class="col-9">
                        <textarea class="form-control" id="alamat_web" name="alamat_web" rows="5" required><?= $set_web['alamat_web']; ?></textarea>
                        <span class="help-block"><small>Alamat Berisikan : Nama Jalan, Kelurahan, Kecamatan, Kota</small></span>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="label" class="col-sm-3 col-form-label">Logo</label>
                     <div class="col-sm-3">
                        <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                           <input type="checkbox" id="ubah_gambar" name="ubah_gambar">
                           <label for="ubah_gambar"> Ubah Gambar! </label>
                        </div>
                        <img alt="" src="<?= base_url(); ?>assets/upload/<?= $set_web['logo_web']; ?>" class="img-fluid rounded" style="width: 150px; height:100px;">
                     </div>
                     <div class="col-sm-4">
                        <div class="fileinput-new" data-provides="fileinput">
                           <div class="fileinput-preview" data-trigger="fileinput" style="width: 150px; height:100px;"></div>
                           <span class="btn btn-primary  btn-file">
                              <span class="fileinput-new">Select</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" id="gambar" name="logo_web" onchange="validate(this);">
                           </span>
                           <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
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