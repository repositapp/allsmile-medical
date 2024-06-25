<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
?>
<section class="main-content">
   <form method="post" action="<?= base_url('klinik/input_pembayaran/' . $antrian_pasien['id_antrian']); ?>" enctype="multipart/form-data">
      <div class="row">
         <div class="toastr1"></div>
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-default">
                  <div class="float-right d-flex">
                     <?php $total = $harga_tindakan['total_tindakan'] + $harga_resep['total_resep'];
                     if ($diskon->num_rows() > 0) {
                        $disk = $diskon->row_array();
                        $total_diskon = $total - ($total * ($disk['pers_diskon'] / 100)); 
                     } else {
                        $total_diskon = "0"; 
                     }
                     ?>
                     <a href="<?= base_url(); ?>klinik/pembayaran" class="btn btn-sm btn-default"><i class="fa fa-reply"></i> Kembali</a>
                     <input type="hidden" name="ubah_data" value="ubah">
                     <input type="hidden" name="id_antrian" value="<?= $antrian_pasien['id_antrian']; ?>">
                     <input type="hidden" name="id_dokter" value="<?= $antrian_pasien['kode_dokter']; ?>">
                     <input type="hidden" name="no_pasien" value="<?= $antrian_pasien['no_pasien']; ?>">
                     <input type="hidden" id="no_invoice" name="no_invoice" value="<?= $nomor_invoice; ?>">
                     <?php if ($this->db->get_where('diskon', ['sts_diskon' => '1'])->num_rows() > 0) { ?>
                        <input type="hidden" name="total_harga" value="<?= $total_diskon; ?>">
                        <input type="hidden" name="diskon" value="<?= $disk['id_diskon']; ?>">
                     <?php } else { ?>
                        <input type="hidden" name="total_harga" value="<?= $total; ?>">
                        <input type="hidden" name="diskon" value="0">
                     <?php } ?>
                     <input type="hidden" name="sts_antrian" value="4">
                     <input type="hidden" name="tgl_pembayaran" value="<?= $tanggal; ?>">
                     <input type="hidden" name="waktu_bayar" value="<?= $waktu; ?>">
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
                           <td style="padding-top: 7px;padding-bottom:7px;width: 130px;">No.Pendaftaran</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['no_pendaftaran']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">No.Pasien</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['no_pasien']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Nama Pasien</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['nl_pasien']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Alamat</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['alamat']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Kontak</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['telp_pasien']; ?>, <?= $antrian_pasien['email_pasien']; ?>, <?= $antrian_pasien['kontak_lain']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Sex/Umur</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['jk_pasien']; ?> / <?= $antrian_pasien['umur_pasien']; ?> Thn</td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Tanggal Datang</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= date('d M Y', strtotime($antrian_pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian_pasien['waktu_kunjungan'])); ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Dokter</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['gl_depan']; ?> <?= $antrian_pasien['nm_depan']; ?> <?= $antrian_pasien['nm_belakang']; ?></td>
                        </tr>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <td style="padding-top: 7px;padding-bottom:7px;">Jenis Layanan</td>
                           <td style="padding-top: 7px;padding-bottom:7px;">: <?= $antrian_pasien['jenis_layanan']; ?></td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-md-5">
            <div class="card">
               <div class="card-header card-info">
                  Daftar Biaya
               </div>
               <div class="card-body">
                  <table style="width: 100%;">
                     <tbody>
                        <tr>
                           <th colspan="7" style="padding-top: 5px;padding-bottom:5px;">Biaya Tindakan</th>
                        </tr>
                        <?php foreach ($data_tindakan as $tindakan) : ?>
                           <tr>
                              <td style="padding-top: 5px;padding-bottom:5px;"><?= $tindakan['nm_tindakan']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Rp.</td>
                              <td></td>
                              <td class="text-right">
                                 <?= number_format($tindakan['hg_tindakan'], 0, ".", "."); ?>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                        <tr>
                           <th colspan="8" style="padding-top: 5px;padding-bottom:5px;">Biaya Obat-obatan</th>
                        </tr>
                        <?php foreach ($data_resep as $resep) : ?>
                           <tr>
                              <td style="padding-top: 5px;"><?= $resep['nm_obat']; ?></td>
                           </tr>
                           <tr>
                              <td style="padding-top: 1px;padding-bottom:1px;">
                                 <?php $sisa_stok = $resep['stok'] - $resep['quantity_obat']; ?>
                                 <input type="hidden" name="id_obat[]" value="<?= $resep['id_obat']; ?>">
                                 <input type="hidden" name="stok[]" value="<?= $sisa_stok; ?>">
                                 <?= $resep['quantity_obat']; ?> x <?= number_format($resep['hg_satuan'], 0, ".", "."); ?>
                              </td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Rp.</td>
                              <td></td>
                              <td style="padding-top: 1px;padding-bottom:1px;" class="text-right">
                                 <?php $sub_total = $resep['quantity_obat'] * $resep['hg_satuan']; ?>
                                 <?= number_format($sub_total, 0, ".", "."); ?>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                        <?php if ($this->db->get_where('diskon', ['sts_diskon' => '1'])->num_rows() > 0) { ?>
                           <tr>
                              <th colspan="7" style="padding-top: 10px;padding-bottom:5px;">Diskon</th>
                           </tr>
                           <tr>
                              <td style="padding-top: 5px;padding-bottom:5px;"><?= $disk['ket_diskon']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-right">
                                 <?= $disk['pers_diskon']; ?>%
                              </td>
                           </tr>
                        <?php } else {
                        } ?>
                        <tr style="border-top: 1px solid #e9ecef;">
                           <th colspan="4" class="text-center" style="padding-top: 10px;">Total</th>
                           <td>Rp.</td>
                           <td></td>
                           <th style="padding-top: 1px;padding-bottom:1px;" class="text-right">
                              <?php if ($this->db->get_where('diskon', ['sts_diskon' => '1'])->num_rows() > 0) { ?>
                                 <?= number_format($total_diskon, 0, ".", "."); ?>
                              <?php } else { ?>
                                 <?= number_format($total, 0, ".", "."); ?>
                              <?php } ?>
                           </th>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="card">
               <div class="card-header card-info">
                  Jumlah Bayar
               </div>
               <div class="card-body">
                  <table style="width: 100%;">
                     <tbody>
                        <tr>
                           <td style="padding-top: 7px;padding-bottom:7px;width: 130px;">
                              <input type="text" name="jumlah_bayar" class="form-control form-control-rounded" required>
                           </td>
                        </tr>
                        <tr>
                           <td style="padding-top: 7px;padding-bottom:7px;">
                              <button type="submit" class="btn btn-primary btn-sm btn-block btn-rounded btn-icon"><i class="fa fa-money"></i> Proses Pembayaran</button>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </form>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>