<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
$total = $harga_tindakan['total_tindakan'] + $harga_resep['total_resep'];
$kembalian = $pembayaran['jumlah_bayar'] - $total;
$klinik = $this->db->get('set_web')->row_array();
?>
<section class="main-content" style="">
   <div class="row">
      <div class="toastr1"></div>
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="float-right d-flex">
                  <a href="#" class="btn btn-sm btn-primary cetak"><i class="fa fa-print"></i> Cetak</a>
               </div>
               Rekam Medis Pasien
            </div>
            <div class="card-body" style="font-size: 12px; margin-top:-30px; color: #000000 !important;">
               <div class="row">
                  <div class="col-md-8 offset-md-2">
                     <table style="width: 100%;">
                        <tbody>
                           <tr>
                              <th colspan="11" style="font-size: 16px; font-weight:700;"><?= $klinik['nama_klinik']; ?></th>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                           </tr>
                           <tr>
                              <td colspan="11" style="font-size: 12px;"><?= $klinik['alamat_web']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-right" style="font-size: 12px;">LAPORAN REKAM MEDIS PASIEN</td>
                           </tr>
                           <tr>
                              <td colspan="11" style="font-size: 12px;">Telp. <?= $klinik['telepon_web']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-right" style="font-size: 12px;">Baubau, <?= date('d M Y', strtotime($tanggal)); ?></td>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-8 offset-md-2">
                     <table style="width: 100%;">
                        <tbody>
                           <tr style="border-top: 1px solid #e9ecef;">
                              <td>No.Pendaftaran</td>
                              <td>: <?= $antrian_pasien['no_pendaftaran']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Tanggal Daftar</td>
                              <td>: <?= date('d M Y', strtotime($antrian_pasien['tgl_kunjungan'])); ?> <?= date('H:i', strtotime($antrian_pasien['waktu_kunjungan'])); ?></td>
                           </tr>
                           <tr>
                              <td>No.ID/KTP</td>
                              <td>: <?= $antrian_pasien['no_pasien']; ?></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Tanggal Pembayaran</td>
                              <td>: <?= date('d M Y', strtotime($pembayaran['tgl_pembayaran'])); ?> <?= date('H:i', strtotime($pembayaran['waktu_bayar'])); ?></td>
                           </tr>
                           <tr>
                              <td width="135">Nama Pasien</td>
                              <td>: <?= $antrian_pasien['nl_pasien']; ?></td>
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
                              <td>Alamat</td>
                              <td>: <?= $antrian_pasien['alamat']; ?></td>
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
                              <td width="135">Sex/Umur</td>
                              <td>: <?= $antrian_pasien['jk_pasien']; ?> / <?= $antrian_pasien['umur_pasien']; ?> Thn</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Gol.Darah</td>
                              <td>: <?= $antrian_pasien['gol_darah']; ?></td>
                           </tr>
                        </tbody>
                     </table>
                     <table class="table mt-20">
                        <thead>
                           <tr>
                              <th class="text-center" colspan="4" style="padding: 10px;">Catatan Dokter</th>
                           </tr>
                           <tr>
                              <th class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;">Riwayat Alergi</th>
                              <th class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;">Berat Badan</th>
                              <th class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;">Tinggi Badan</th>
                              <th class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;">Tekanan Darah</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;"><?= $catatan['riwayat_alergi']; ?></td>
                              <td class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;"><?= $catatan['berat_badan']; ?></td>
                              <td class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;"><?= $catatan['tinggi_badan']; ?></td>
                              <td class="text-center" style="padding-top: .4rem;padding-bottom: .4rem;"><?= $catatan['tekanan_darah']; ?></td>
                           </tr>
                           <tr>
                              <td style="font-weight: 700;padding-top: .4rem;padding-bottom: .4rem;" class="text-center">Keterangan</td>
                              <td colspan="3">
                                 <div class="text-justify" style="margin-top: 5px;padding-top: .4rem;padding-bottom: .4rem;padding-left: .4rem;"><?= $catatan['catatan_dokter']; ?></div>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                     <table class="table">
                        <thead>
                           <tr>
                              <th class="text-center" colspan="2" style="padding: 10px;">Diagnosa Dokter</th>
                           </tr>
                           <tr>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;" width="200">Nama Diagnosa</th>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;">Keterangan</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($data_diagnosa as $diagnosa) : ?>
                              <tr>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $diagnosa['diagnosa']; ?></td>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $diagnosa['ket_diagnosa']; ?></td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                     <table class="table">
                        <thead>
                           <tr>
                              <th class="text-center" colspan="2" style="padding: 10px;">Tindakan Dokter</th>
                           </tr>
                           <tr>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;" width="200">Nama Tindakan</th>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;">Keterangan</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($data_tindakan as $tindakan) : ?>
                              <tr>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $tindakan['nm_tindakan']; ?></td>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $tindakan['ket_tindakan']; ?></td>
                              </tr>
                           <?php endforeach; ?>
                        </tbody>
                     </table>
                     <table class="table">
                        <thead>
                           <tr>
                              <th class="text-center" colspan="4" style="padding: 10px;">Resep Dokter</th>
                           </tr>
                           <tr>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;" width="100">Kode</th>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;">Nama Obat</th>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;">Satuan</th>
                              <th style="padding-top: .4rem;padding-bottom: .4rem;">Aturan Pakai</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php foreach ($data_resep as $resep) : ?>
                              <tr>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $resep['kode_obat']; ?></td>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $resep['nm_obat']; ?></td>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $resep['satuan']; ?></td>
                                 <td style="padding-top: .4rem;padding-bottom: .4rem;"><?= $resep['aturan_pakai']; ?></td>
                              </tr>
                           <?php endforeach; ?>
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