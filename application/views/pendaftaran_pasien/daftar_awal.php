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
            <div class="card-header card-default">Pendaftaran Pasien Baru</div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/pendaftaran'); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <input type="hidden" id="change_pasien" name="change_pasien" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="tgl_kunjungan" name="tgl_kunjungan" value="<?= $tanggal; ?>">
                  <input type="hidden" id="waktu_kunjungan" name="waktu_kunjungan" value="<?= $waktu; ?>">
                  <input type="hidden" id="no_pendaftaran" name="no_pendaftaran" value="<?= $nomor_pendaftaran; ?>">
                  <input type="hidden" id="no_antrian" name="no_antrian" value="<?= $nomor_antrian; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">NO ID / KTP</label>
                           <div class="col-sm-8">
                              <input type="text" id="no_pasien" name="no_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Nama Lengkap</label>
                           <div class="col-sm-8">
                              <input type="text" id="nl_pasien" name="nl_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tempat Lahir</label>
                           <div class="col-sm-8">
                              <input type="text" id="tmp_lahir_pasien" name="tmp_lahir_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                           <div class="col-sm-8">
                              <div class="input-group m-b">
                                 <input type="text" id="tgl_lahir" name="tgl_lahir_pasien" class="form-control" autocomplete="off" required>
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
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Umur</label>
                           <div class="col-sm-8">
                              <input type="text" id="umur_pasien" name="umur_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Golongan Darah</label>
                           <div class="col-sm-8">
                              <input type="text" id="gol_darah" name="gol_darah" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">No. Telepon</label>
                           <div class="col-sm-8">
                              <input type="text" id="telp_pasien" name="telp_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Email</label>
                           <div class="col-sm-8">
                              <input type="text" id="email_pasien" name="email_pasien" class="form-control" autocomplete="off" required>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Kontak Lain</label>
                           <div class="col-sm-8">
                              <input type="text" id="kontak_lain" name="kontak_lain" class="form-control" autocomplete="off" required>
                              <small class="text-primary">Beri tanda ' <strong>-</strong> ' jika tidak ada kontak lain.</small>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Pekerjaan</label>
                           <div class="col-sm-8">
                              <select id="pekerjaan" name="pekerjaan" class="theSelect m-b" required>
                                 <?php foreach ($data_pekerjaan as $pekerjaan) : ?>
                                    <option value="<?= $pekerjaan['id_pekerjaan']; ?>"><?= $pekerjaan['nm_pekerjaan']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Alamat</label>
                           <div class="col-sm-8">
                              <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Dokter</label>
                           <div class="col-sm-8">
                              <select id="id_dokter" name="id_dokter" class="theSelect m-b" required>
                                 <?php foreach ($data_dokter as $dokter) : ?>
                                    <option value="<?= $dokter['kode_dokter']; ?>"><?= $dokter['gl_depan']; ?> <?= $dokter['nm_depan']; ?> <?= $dokter['nm_belakang']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Jenis Layanan</label>
                           <div class="col-sm-8">
                              <select id="jenis_layanan" name="jenis_layanan" class="form-control m-b" required>
                                 <option>Umum</option>
                                 <option>Asuransi</option>
                                 <option>BPJS</option>
                              </select>
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