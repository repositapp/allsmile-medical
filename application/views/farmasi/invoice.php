<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
$total = $harga_tindakan['total_tindakan'] + $harga_resep['total_resep'];
$total_diskon = $total - ($total * ($pembayaran['pers_diskon'] / 100));
$kembalian = $pembayaran['jumlah_bayar'] - $total;
$kembalian_diskon = $pembayaran['jumlah_bayar'] - $total_diskon;
$klinik = $this->db->get('set_web')->row_array();
?>
<section class="main-content">
   <div class="row">
      <div class="toastr1"></div>
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right d-flex">
                  <a href="#" class="btn btn-sm btn-primary cetak"><i class="fa fa-print"></i> Cetak</a>
               </div>
               Invoice
            </div>
            <div class="card-body" style="font-size: 12px; margin-top:-30px;">
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                     <table style="width: 100%;">
                        <tbody>
                           <tr>
                              <th colspan="11">
                                 <h4><b><?= $klinik['nama_klinik']; ?></b></h4>
                              </th>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>No.Invoice</td>
                              <td>: <?= $pembayaran['no_invoice']; ?></td>
                           </tr>
                           <tr>
                              <td colspan="11"><?= $klinik['alamat_web']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>No.Pendaftaran</td>
                              <td>: <?= $antrian_pasien['no_pendaftaran']; ?></td>
                           </tr>
                           <tr>
                              <td colspan="11">Telp. <?= $klinik['telepon_web']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>No.ID/KTP</td>
                              <td>: <?= $antrian_pasien['no_pasien']; ?></td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-8 offset-md-2">
                     <table style="width: 100%;">
                        <tbody>
                           <tr style="border-top: 1px solid #e9ecef;">
                              <td width="135">Nama Pasien</td>
                              <td>: <?= $antrian_pasien['nl_pasien']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td width="135">Sex/Umur</td>
                              <td>: <?= $antrian_pasien['jk_pasien']; ?> / <?= $antrian_pasien['umur_pasien']; ?> Thn</td>
                           </tr>
                           <tr>
                              <td>Alamat</td>
                              <td>: <?= $live['alamat']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Dokter</td>
                              <td>: <?= $antrian_pasien['gl_depan']; ?> <?= $antrian_pasien['nm_depan']; ?> <?= $antrian_pasien['nm_belakang']; ?></td>
                           </tr>
                           <tr>
                              <td>Tanggal Daftar</td>
                              <td>: <?= date('d M Y', strtotime($antrian_pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian_pasien['waktu_kunjungan'])); ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Jenis Layanan</td>
                              <td>: <?= $antrian_pasien['jenis_layanan']; ?></td>
                           </tr>
                           <tr>
                              <td>Tanggal Pembayaran</td>
                              <td>: <?= date('d M Y', strtotime($antrian_pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian_pasien['waktu_kunjungan'])); ?></td>
                           </tr>
                           <tr style="border-top: 1px solid #e9ecef;">
                              <th colspan="11">Biaya Tindakan</th>
                           </tr>
                           <?php foreach ($data_tindakan as $tindakan) : ?>
                              <tr>
                                 <td><?= $tindakan['nm_tindakan']; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td class="text-right">Rp.</td>
                                 <td class="text-right">
                                    <?= number_format($tindakan['hg_tindakan'], 0, ".", "."); ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <tr>
                              <th colspan="11">Biaya Obat-obatan</th>
                           </tr>
                           <?php foreach ($data_resep as $resep) : ?>
                              <tr>
                                 <td><?= $resep['nm_obat']; ?></td>
                              </tr>
                              <tr>
                                 <td><?= $resep['quantity_obat']; ?> x <?= number_format($resep['hg_satuan'], 0, ".", "."); ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td class="text-right">Rp.</td>
                                 <td class="text-right">
                                    <?php $sub_total = $resep['quantity_obat'] * $resep['hg_satuan']; ?>
                                    <?= number_format($sub_total, 0, ".", "."); ?>
                                 </td>
                              </tr>
                           <?php endforeach; ?>
                           <?php if ($pembayaran['diskon'] == '0') { ?>
                           <?php } else { ?>
                              <tr>
                                 <th colspan="11">Diskon</th>
                              </tr>
                              <tr>
                                 <td><?= $pembayaran['ket_diskon']; ?></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td class="text-right"></td>
                                 <td class="text-right">
                                    <?= $pembayaran['pers_diskon']; ?>%
                                 </td>
                              </tr>
                           <?php } ?>
                           <tr style="border-top: 1px solid #e9ecef;">
                              <th colspan="8" class="text-center">Total</th>
                              <td></td>
                              <td class="text-right">Rp.</td>
                              <th class="text-right">
                                 <?php if ($pembayaran['diskon'] == '0') { ?>
                                    <?= number_format($total, 0, ".", "."); ?>
                                 <?php } else { ?>
                                    <?= number_format($total_diskon, 0, ".", "."); ?>
                                 <?php } ?>
                              </th>
                           </tr>
                           <tr>
                              <th colspan="8" class="text-center">Jumlah Bayar</th>
                              <td></td>
                              <td class="text-right">Rp.</td>
                              <th class="text-right">
                                 <?= number_format($pembayaran['jumlah_bayar'], 0, ".", "."); ?>
                              </th>
                           </tr>
                           <tr>
                              <th colspan="8" class="text-center">Kembali</th>
                              <td></td>
                              <td class="text-right">Rp.</td>
                              <th class="text-right">
                                 <?php if ($pembayaran['diskon'] == '0') { ?>
                                    <?= number_format($kembalian, 0, ".", "."); ?>
                                 <?php } else { ?>
                                    <?= number_format($kembalian_diskon, 0, ".", "."); ?>
                                 <?php } ?>
                              </th>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>