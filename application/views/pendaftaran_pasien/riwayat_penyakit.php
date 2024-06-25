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
            <div class="card-header card-default">Riwayat Penyakit Pasien</div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/riwayat_penyakit/'); ?><?= $pasien['no_pendaftaran']; ?>" enctype="multipart/form-data">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <input type="hidden" id="change_catatan" name="change_catatan" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="id_antrian" name="id_antrian" value="<?= $pasien['id_antrian']; ?>">
                  <input type="hidden" id="id_dokter" name="id_dokter" value="<?= $pasien['kode_dokter']; ?>">
                  <input type="hidden" id="no_pasien" name="no_pasien" value="<?= $pasien['no_pasien']; ?>">

                  <div class="row">
                     <div class="col-md-12">
                        <div class="form-group row">
                           <label for="label" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                           <div class="col-sm-10">
                              <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" required></textarea>
                           </div>
                        </div>

                        <div class="form-group row">
                           <label for="label" class="col-sm-2 col-form-label">Riwayat Alergi</label>
                           <div class="col-sm-10">
                              <input type="text" id="riwayat_alergi" name="riwayat_alergi" class="form-control" autocomplete="off" required>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <label>Berat Badan</label>
                        <div class="input-group m-b">
                           <input type="text" id="berat_badan" name="berat_badan" class="form-control form-control-rounded" placeholder="000">
                           <span class="input-group-addon">Kg</span>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <label>Tinggi Badan</label>
                        <div class="input-group m-b">
                           <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control form-control-rounded" placeholder="000">
                           <span class="input-group-addon">cm</span>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <label>Tekanan Darah</label>
                        <div class="input-group m-b">
                           <input type="text" id="tekanan_darah" name="tekanan_darah" class="form-control form-control-rounded" placeholder="000/00">
                           <span class="input-group-addon">mmHg</span>
                        </div>
                     </div>

                     <div class="col-md-3">
                        <div class="form-group ">
                           <label>Golongan Darah</label>
                           <h1><?= $pasien['gol_darah'] ?></h1>
                           <input type="hidden" id="gol_darah" name="gol_darah" class="form-control form-control-rounded" value="<?= $pasien['gol_darah'] ?>">
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