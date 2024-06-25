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
               <div class="float-right d-flex">
                  <a href="<?= base_url(); ?>klinik/antrian_farmasi" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>&nbsp;&nbsp;&nbsp;
                  <?php if ($antrian_pasien['sts_antrian'] == "2") { ?>
                     <form method="post" action="<?= base_url('klinik/permintaan/' . $antrian_pasien['id_antrian']); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="ubah_data" value="ubah">
                        <input type="hidden" name="id_antrian" value="<?= $antrian_pasien['id_antrian']; ?>">
                        <input type="hidden" name="sts_antrian" value="3">
                        <input type="hidden" name="tgl_farmasi" value="<?= $tanggalwaktu; ?>">
                        <?php foreach ($data_resep as $resep) : $sisa = $resep['stok'] - $resep['quantity_obat']; ?>
                           <input type="hidden" name="id_obat[]" value="<?= $resep['id_obat']; ?>">
                           <input type="hidden" name="sisa_stok[]" value="<?= $sisa; ?>">
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-sm btn-warning"><i class="icon-reload"></i> Selesai</button>
                     </form>
                  <?php } elseif ($antrian_pasien['sts_antrian'] == "3") { ?>
                     <a href="<?= base_url(); ?>klinik/input_pembayaran/<?= $antrian_pasien['id_antrian']; ?>" class="btn btn-sm btn-info"><i class="fa fa-money"></i> Pembayaran</a>
                  <?php } ?>
               </div>
               Proses Permintaan Farmasi
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card">
            <div class="card-header card-info">
               Data Pasien
            </div>
            <div class="card-body">
               <table style="width: 100%;">
                  <tbody>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;width: 130px;">No.Pendaftaran</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $antrian_pasien['no_pendaftaran']; ?></td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">No.Pasien</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $antrian_pasien['no_pasien']; ?></td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">Nama Pasien</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $antrian_pasien['nl_pasien']; ?></td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">Sex/Umur</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $antrian_pasien['jk_pasien']; ?> / <?= $antrian_pasien['umur_pasien']; ?> Thn</td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">Tanggal Permintaan</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $tanggalwaktu; ?></td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">Dokter</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">: <?= $antrian_pasien['gl_depan']; ?> <?= $antrian_pasien['nm_depan']; ?> <?= $antrian_pasien['nm_belakang']; ?></td>
                     </tr>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <td style="padding-top: 15px;padding-bottom:15px;">Status Permintaan</td>
                        <td style="padding-top: 15px;padding-bottom:15px;">:
                           <?php if ($antrian_pasien['sts_antrian'] == 2) { ?>
                              <span class="badge badge-teal">Dalam Proses</span>
                           <?php } elseif ($antrian_pasien['sts_antrian'] == 3) { ?>
                              <span class="badge badge-success">Selesai</span>
                           <?php } ?>
                        </td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
      <div class="col-md-8">
         <div class="card">
            <div class="card-header card-info">
               Resep Dokter
            </div>
            <div class="card-body">
               <table style="width: 100%;">
                  <thead>
                     <tr style="border-top: 1px solid #e9ecef;">
                        <th style="padding-top: 15px;padding-bottom:15px;width: 39px;">No.</th>
                        <th style="padding-top: 15px;padding-bottom:15px;">Kode Item</th>
                        <th style="padding-top: 15px;padding-bottom:15px;">Nama Item</th>
                        <th style="padding-top: 15px;padding-bottom:15px;">Qty</th>
                        <th style="padding-top: 15px;padding-bottom:15px;">Satuan</th>
                        <th style="padding-top: 15px;padding-bottom:15px;">Aturan</th>
                        <!-- <th class="text-center" style="padding-top: 15px;padding-bottom:15px;">Stok</th> -->
                     </tr>
                  </thead>
                  <tbody>
                     <?php $no = 1;
                     foreach ($data_resep as $resep) : ?>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $no; ?></td>
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $resep['kode_obat']; ?></td>
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $resep['nm_obat']; ?></td>
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $resep['quantity_obat']; ?></td>
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $resep['satuan']; ?></td>
                           <td style="padding-top: 15px;padding-bottom:15px;"><?= $resep['aturan_pakai']; ?></td>
                           <!-- <td class="text-center" style="padding-top: 15px;padding-bottom:15px;">
                              <?php if ($resep['stok'] > 5) { ?>
                                 <span class="badge badge-info"><?= $resep['stok']; ?></span>
                              <?php } elseif ($resep['stok'] <= 5) { ?>
                                 <span class="badge badge-danger"><?= $resep['stok']; ?></span>
                              <?php } ?>
                           </td> -->
                        </tr>
                     <?php $no++;
                     endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>