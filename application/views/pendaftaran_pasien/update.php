<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">Ubah Data Pasien</div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/update_pasien/' . $pasien['no_pasien']); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="ubah_data" value="ubah">

                  <input type="hidden" id="change_pasien" name="change_pasien" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="id_pasien" name="id_pasien" value="<?= $pasien['id_pasien']; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">NO ID / KTP</label>
                           <div class="col-sm-8">
                              <input type="text" id="no_pasien" name="no_pasien" value="<?= $pasien['no_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Lengkap</label>
                           <div class="col-sm-8">
                              <input type="text" id="nl_pasien" name="nl_pasien" value="<?= $pasien['nl_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tempat Lahir</label>
                           <div class="col-sm-8">
                              <input type="text" id="tmp_lahir_pasien" name="tmp_lahir_pasien" value="<?= $pasien['tmp_lahir_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                           <div class="col-sm-8">
                              <div class="input-group m-b">
                                 <input type="text" id="tgl_lahir" name="tgl_lahir_pasien" value="<?= $pasien['tgl_lahir_pasien']; ?>" class="form-control" autocomplete="off" required>
                                 <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                              </div>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                           <div class="col-sm-8">
                              <select id="jk_pasien" name="jk_pasien" class="form-control m-b" required>
                                 <option value="L">Laki-Laki</option>
                                 <option value="P">Perempuan</option>
                                 <option <?php if ($pasien['jk_pasien'] == 'L') {
                                             echo 'selected';
                                          } ?> value="L">Laki-Laki</option>
                                 <option <?php if ($pasien['jk_pasien'] == 'P') {
                                             echo 'selected';
                                          } ?> value="P">Perempuan</option>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Umur</label>
                           <div class="col-sm-8">
                              <input type="text" id="umur_pasien" name="umur_pasien" value="<?= $pasien['umur_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Golongan Darah</label>
                           <div class="col-sm-8">
                              <input type="text" id="gol_darah" name="gol_darah" value="<?= $pasien['gol_darah']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                           <div class="col-sm-8">
                              <input type="text" id="telp_pasien" name="telp_pasien" value="<?= $pasien['telp_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" id="email_pasien" name="email_pasien" value="<?= $pasien['email_pasien']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Kontak Lain</label>
                           <div class="col-sm-8">
                              <input type="text" id="kontak_lain" name="kontak_lain" value="<?= $pasien['kontak_lain']; ?>" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Pekerjaan</label>
                           <div class="col-sm-8">
                              <select id="pekerjaan" name="pekerjaan" class="form-control m-b" required>
                                 <?php foreach ($data_pekerjaan as $pekerjaan) : ?>
                                    <option <?php if ($pasien["pekerjaan"] == $pekerjaan['id_pekerjaan']) {
                                                echo 'selected';
                                             } ?> value="<?= $pekerjaan['id_pekerjaan']; ?>"><?= $pekerjaan['nm_pekerjaan']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                           <div class="col-sm-8">
                              <textarea id="alamat" name="alamat" class="form-control" rows="3" required><?= $pasien['alamat']; ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="float-right mt-10">
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