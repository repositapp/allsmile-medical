<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">Form Tambah Data Dokter</div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/tambah_dokter'); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <input type="hidden" id="change_user" name="change_user" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="kode_dokter" name="kode_dokter" value="<?= $kode; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">NO ID / KTP</label>
                           <div class="col-sm-8">
                              <input type="text" id="ktp" name="ktp" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Depan</label>
                           <div class="col-sm-8">
                              <input type="text" id="nm_depan" name="nm_depan" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Belakang</label>
                           <div class="col-sm-8">
                              <input type="text" id="nm_belakang" name="nm_belakang" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Gelar Depan</label>
                           <div class="col-sm-8">
                              <input type="text" id="gl_depan" name="gl_depan" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Gelar Belakang</label>
                           <div class="col-sm-8">
                              <input type="text" id="gl_belakang" name="gl_belakang" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">SIP</label>
                           <div class="col-sm-8">
                              <input type="text" id="sip" name="sip" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Spesialis</label>
                           <div class="col-sm-8">
                              <input type="text" id="spesialis" name="spesialis" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tempat Lahir</label>
                           <div class="col-sm-8">
                              <input type="text" id="tmp_lahir" name="tmp_lahir" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                           <div class="col-sm-8">
                              <div class="input-group m-b">
                                 <input type="text" id="tgl_lahir" name="tgl_lahir" class="form-control" autocomplete="off" required>
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Agama</label>
                           <div class="col-sm-8">
                              <select id="agama" name="agama" class="form-control m-b" required>
                                 <option>Islam</option>
                                 <option>Protestan</option>
                                 <option>Katolik</option>
                                 <option>Hindu</option>
                                 <option>Budha</option>
                                 <option>Konghucu</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                           <div class="col-sm-8">
                              <select id="jk" name="jk" class="form-control m-b" required>
                                 <option value="L">Laki-Laki</option>
                                 <option value="P">Perempuan</option>
                              </select>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                           <div class="col-sm-8">
                              <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                           <div class="col-sm-8">
                              <input type="text" id="telepon" name="telepon" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" id="email" name="email" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Foto Dokter</label>
                           <div class="col-sm-8">
                              <div class="fileinput-new" data-provides="fileinput">
                                 <div class="fileinput-preview" data-trigger="fileinput" style="width: 270px; height:210px;"></div>
                                 <span class="btn btn-primary  btn-file">
                                    <span class="fileinput-new">Select</span>
                                    <span class="fileinput-exists">Change</span>
                                    <input type="file" id="gambar" name="foto_user" onchange="validate(this);" required>
                                 </span>
                                 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                              </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Hak Akses</label>
                           <div class="col-sm-8">
                              <select id="akses" name="akses" class="form-control m-b" required>
                                 <?php foreach ($data_hak_akses as $hak_akses) : ?>
                                    <option value="<?= $hak_akses['kode_akses']; ?>"><?= $hak_akses['akses']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Username</label>
                           <div class="col-sm-8">
                              <input type="text" id="username" name="username" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="thresholdconfig" class="col-sm-4 col-form-label">Password</label>
                           <div class="col-sm-8">
                              <input type="password" id="thresholdconfig" name="pass" class="form-control" autocomplete="off" required>
                              <div class="checkbox checkbox-primary" style="margin-top: -1rem;">
                                 <input type="checkbox" onclick="Toggle()" id="show-hide" name="password">
                                 <label for="show-hide"> Show Password </label>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="float-right mt-10">
                     <a href="<?= base_url(); ?>klinik/dokter" class="btn btn-sm btn-danger"><i class="fa fa-reply"></i> Batal</a>
                     <button type="submit" name="add_dokter" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
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