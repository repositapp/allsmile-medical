<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
?>
<section class="main-content">
   <form method="post" action="<?= base_url('klinik/catatan_tindakan_pasien/' . $pasien['id_antrian']); ?>" enctype="multipart/form-data">
      <div class="row">

         <div class="toastr1"></div>

         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-default">
                  <div class="pull-right">
                     <button type="submit" class="btn btn-sm btn-warning"><i class="fa fa-save"></i> Selesai</button>
                  </div>
                  Catatan Tindakan Pasien
               </div>
               <div class="card-body">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <input type="hidden" id="change_catatan" name="change_catatan" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="change_diagnosa" name="change_diagnosa" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="change_resep" name="change_resep" value="<?= $tanggal; ?>">
                  <input type="hidden" id="change_tindakan" name="change_tindakan" value="<?= $tanggalwaktu; ?>">
                  <input type="hidden" id="id_dokter" name="id_dokter" value="<?= $pasien['id_dokter']; ?>">
                  <input type="hidden" id="id_antrian" name="id_antrian" value="<?= $pasien['id_antrian']; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <table style="width: 100%;">
                           <tr>
                              <td width="140">No.Pendaftaran</td>
                              <td>
                                 : <?= $pasien['no_pendaftaran']; ?>
                              </td>
                           </tr>
                           <tr>
                              <td width="140">No.Pasien</td>
                              <td>
                                 : <?= $pasien['no_pasien']; ?>
                                 <input type="hidden" name="no_pasien" value="<?= $pasien['no_pasien']; ?>">
                              </td>
                           </tr>
                           <tr>
                              <td>Nama Pasien</td>
                              <td>: <?= $pasien['nl_pasien']; ?></td>
                           </tr>
                           <tr>
                              <td>TTL</td>
                              <td>: <?= $pasien['tmp_lahir_pasien']; ?>, <?= date('d M Y', strtotime($pasien['tgl_lahir_pasien'])); ?></td>
                           </tr>
                           <tr>
                              <td>Sex/Umur</td>
                              <td>: <?= $pasien['jk_pasien']; ?>/<?= $pasien['umur_pasien']; ?> Thn</td>
                           </tr>
                        </table>
                     </div>
                     <div class="col-md-6">
                        <table style="width: 100%;">
                           <tr>
                              <td width="140">Tanggal</td>
                              <td>: <?= date('d M Y', strtotime($tanggal)); ?></td>
                           </tr>
                           <tr>
                              <td width="140">Jam Kunjungan</td>
                              <td>: <?= date('H:i', strtotime($waktu)); ?></td>
                           </tr>
                           <tr>
                              <td width="140">Jenis Layanan</td>
                              <td>: <?= $pasien['jenis_layanan']; ?></td>
                           </tr>
                        </table>
                     </div>

                     <div class="col-md-12">
                        <div class="card-body">

                           <div class="tabs">
                              <!-- Nav tabs -->

                              <ul class="nav nav-tabs">
                                 <li class="nav-item" role="presentation"><a class="nav-link active" href="#catatan" aria-controls="catatan" role="tab" data-toggle="tab">Catatan</a></li>
                                 <li class="nav-item" role="presentation"><a class="nav-link" href="#diagnosa" aria-controls="diagnosa" role="tab" data-toggle="tab">Diagnosa</a></li>
                                 <li class="nav-item" role="presentation"><a class="nav-link" href="#tindakan" aria-controls="tindakan" role="tab" data-toggle="tab">Tindakan</a></li>
                                 <li class="nav-item" role="presentation"><a class="nav-link" href="#resep" aria-controls="resep" role="tab" data-toggle="tab">Resep</a></li>
                              </ul>
                              <!-- Tab panes -->
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="catatan">
                                    <input type="hidden" id="id_tp_catatan" name="id_tp_catatan" value="<?= $pasien['id_tp_catatan']; ?>">

                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-2 col-form-label">Riwayat Penyakit</label>
                                             <div class="col-sm-10">
                                                <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" required><?= $pasien['riwayat_penyakit']; ?></textarea>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="col-md-12">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-2 col-form-label">Riwayat Alergi</label>
                                             <div class="col-sm-10">
                                                <input type="text" id="riwayat_alergi" name="riwayat_alergi" class="form-control" value="<?= $pasien['riwayat_alergi']; ?>" autocomplete="off" required>
                                             </div>
                                          </div>
                                       </div>

                                       <div class="col-md-3">
                                          <label>Berat Badan</label>
                                          <div class="input-group m-b">
                                             <input type="text" id="berat_badan" name="berat_badan" class="form-control form-control-rounded" value="<?= $pasien['berat_badan']; ?>" placeholder="000">
                                             <span class="input-group-addon">Kg</span>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <label>Tinggi Badan</label>
                                          <div class="input-group m-b">
                                             <input type="text" id="tinggi_badan" name="tinggi_badan" class="form-control form-control-rounded" value="<?= $pasien['tinggi_badan']; ?>" placeholder="000">
                                             <span class="input-group-addon">cm</span>
                                          </div>
                                       </div>
                                       <div class="col-md-3">
                                          <label>Tekanan Darah</label>
                                          <div class="input-group m-b">
                                             <input type="text" id="tekanan_darah" name="tekanan_darah" class="form-control form-control-rounded" value="<?= $pasien['tekanan_darah']; ?>" placeholder="000/00">
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

                                       <div class="col-md-12">
                                          <div class="form-group ">
                                             <label>Catatan</label>
                                             <textarea class="ckeditor" id="editor-custom" name="catatan_dokter"></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="diagnosa">
                                    <div class="row tambDiagnos">
                                       <div class="col-md-5">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Diagnosa</label>
                                             <div class="col-sm-9">
                                                <select name="id_diagnosa[]" class="form-control m-b" required>
                                                   <?php foreach ($data_diagnosa as $diagnosa) : ?>
                                                      <option value="<?= $diagnosa['id_diagnosa']; ?>"><?= $diagnosa['diagnosa']; ?></option>
                                                   <?php endforeach; ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Catatan</label>
                                             <div class="col-sm-9">
                                                <textarea class="form-control" name="ket_diagnosa[]"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreDiag"><i class="fa fa-plus"></i></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="tindakan">
                                    <div class="row tambTind">
                                       <div class="col-md-5">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Tindakan</label>
                                             <div class="col-sm-9">
                                                <select name="id_tindakan[]" class="form-control m-b" required id="tind_pasien">
                                                   <?php foreach ($data_tindakan as $tindakan) : ?>
                                                      <option value="<?= $tindakan['id_tindakan']; ?>"><?= $tindakan['nm_tindakan']; ?></option>
                                                   <?php endforeach; ?>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-5">
                                          <div class="form-group row">
                                             <label for="label" class="col-sm-3 col-form-label">Catatan</label>
                                             <div class="col-sm-9">
                                                <textarea class="form-control" name="ket_tindakan[]"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreTind"><i class="fa fa-plus"></i></a>
                                       </div>
                                    </div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane" id="resep">
                                    <div class="row tambObat">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label>Obat</label>
                                             <select name="id_obat[]" class="form-control m-b" required>
                                                <?php foreach ($data_obat as $obat) : ?>
                                                   <option value="<?= $obat['id_obat']; ?>"><?= $obat['nm_obat']; ?></option>
                                                <?php endforeach; ?>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-2">
                                          <div class="form-group">
                                             <label>Quantity</label>
                                             <input type="number" id="quantity_obat" name="quantity_obat[]" class="form-control" autocomplete="off">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label>Catatan</label>
                                             <textarea class="form-control" name="aturan_pakai[]"></textarea>
                                          </div>
                                       </div>
                                       <div class="col-md-2" style="padding-top: 2.1rem;">
                                          <a href="javascript:void(0)" class="btn btn-success btn-sm addMoreObat"><i class="fa fa-plus"></i></a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </form>

   <div style="display: none;">
      <div class="row tambDiagnosCopy">
         <div class="col-md-5">
            <div class="form-group row">
               <label for="label" class="col-sm-3 col-form-label">Diagnosa</label>
               <div class="col-sm-9">
                  <select name="id_diagnosa[]" class="form-control m-b" required>
                     <?php foreach ($data_diagnosa as $diagnosa) : ?>
                        <option value="<?= $diagnosa['id_diagnosa']; ?>"><?= $diagnosa['diagnosa']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="form-group row">
               <label for="label" class="col-sm-3 col-form-label">Catatan</label>
               <div class="col-sm-9">
                  <textarea class="form-control" name="ket_diagnosa[]"></textarea>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeDiag"><i class="fa fa-trash"></i></a>
         </div>
      </div>

      <div class="row tambTindCopy">
         <div class="col-md-5">
            <div class="form-group row">
               <label for="label" class="col-sm-3 col-form-label">Tindakan</label>
               <div class="col-sm-9">
                  <select name="id_tindakan[]" class="form-control m-b" required>
                     <?php foreach ($data_tindakan as $tindakan) : ?>
                        <option value="<?= $tindakan['id_tindakan']; ?>"><?= $tindakan['nm_tindakan']; ?></option>
                     <?php endforeach; ?>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="form-group row">
               <label for="label" class="col-sm-3 col-form-label">Catatan</label>
               <div class="col-sm-9">
                  <textarea class="form-control" name="ket_tindakan[]"></textarea>
               </div>
            </div>
         </div>
         <div class="col-md-2">
            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeTind"><i class="fa fa-trash"></i></a>
         </div>
      </div>

      <div class="row tambObatCopy">
         <div class="col-md-4">
            <div class="form-group">
               <label>Obat</label>
               <select name="id_obat[]" class="form-control m-b" required>
                  <?php foreach ($data_obat as $obat) : ?>
                     <option value="<?= $obat['id_obat']; ?>"><?= $obat['nm_obat']; ?></option>
                  <?php endforeach; ?>
               </select>
            </div>
         </div>
         <div class="col-md-2">
            <div class="form-group">
               <label>Quantity</label>
               <input type="number" id="quantity_obat" name="quantity_obat[]" class="form-control" autocomplete="off">
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-group">
               <label>Catatan</label>
               <textarea class="form-control" name="aturan_pakai[]"></textarea>
            </div>
         </div>
         <div class="col-md-2" style="padding-top: 2.1rem;">
            <a href="javascript:void(0)" class="btn btn-danger btn-sm removeObat"><i class="fa fa-trash"></i></a>
         </div>
      </div>
   </div>

   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>