<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$klinik = $this->db->get('set_web')->row_array();
?>
<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-4 hide">
         <div class="card">
            <div class="card-header card-info">
               Pilih Tanggal dan Dokter
            </div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/komisi'); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="cari" value="search">

                  <div class="form-group ">
                     <label>Date Start</label>
                     <div class="input-group m-b">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input type="text" class="form-control" id="date1" name="keyword1" autocomplete="off" required />
                     </div>
                  </div>

                  <div class="form-group ">
                     <label>Date End</label>
                     <div class="input-group m-b">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <input type="text" class="form-control" id="date2" name="keyword2" autocomplete="off" required />
                     </div>
                  </div>

                  <div class="form-group ">
                     <label>Dokter</label>
                     <div class="input-group m-b">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                        <select id="keyword3" name="keyword3" class="theSelect" required>
                           <option>--Pilih Dokter--</option>
                           <?php foreach ($data_dokter as $dokter) : ?>
                              <option value="<?= $dokter['kode_dokter']; ?>"><?= $dokter['gl_depan']; ?> <?= $dokter['nm_depan']; ?> <?= $dokter['nm_belakang']; ?>, <?= $dokter['gl_belakang']; ?></option>
                           <?php endforeach; ?>
                        </select>
                     </div>
                  </div>

                  <button type="submit" class="btn btn-sm btn-primary btn-block"><i class="fa fa-search"></i> Submit</button>
               </form>
            </div>
         </div>
      </div>

      <div class="col-md-8">
         <div class="card">
            <div class="card-header card-info">
               <div class="float-right">
                  <a href="<?= base_url(); ?>klinik/komisi" class="btn btn-info btn-rounded box-shadow btn-sm" data-toggle="tooltip" data-placement="bottom" title="Reload Halaman"><i class="icon-reload"></i> Reload Komisi</a>
               </div>
               Data Komisi Dokter
            </div>
            <div class="card-body">
               <?php if ($this->input->post('cari')) { ?>
                  <div class="float-right mb-2">
                     <a href="#" class="btn btn-sm btn-primary cetak hide"><i class="fa fa-print"></i> Cetak</a>
                  </div>
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
                           <td class="text-right" style="font-size: 12px;">LAPORAN KOMISI DOKTER</td>
                        </tr>
                        <tr style="border-bottom: 1px solid #e9ecef;">
                           <td colspan="11" style="font-size: 12px;">Telp. <?= $klinik['telepon_web']; ?></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td></td>
                           <td class="text-right" style="font-size: 12px;"><?= date('d M Y', strtotime($per_awal)); ?> - <?= date('d M Y', strtotime($per_akhir)); ?></td>
                        </tr>
                     </tbody>
                  </table>
                  <table class="table mt-20" style="font-size: 12px;">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>No.Pendaftaran</th>
                           <th>Nama</th>
                           <th>Kunjungan</th>
                           <th>Komisi</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $no = 1;
                        foreach ($data_komisi as $komisi_dok) : ?>
                           <tr>
                              <td><?= $no; ?></td>
                              <td><?= $komisi_dok['no_pendaftaran']; ?></td>
                              <td><?= $komisi_dok['nl_pasien']; ?></td>
                              <td><?= date('d M Y', strtotime($komisi_dok['tgl_kunjungan'])); ?></td>
                              <td>Rp. <?= number_format($komisi_dok['hg_tp_tindakan'], 0, ".", "."); ?></td>
                           </tr>
                        <?php $no++;
                        endforeach; ?>
                        <tr>
                           <td colspan="4" class="text-center" style="font-weight: 700;">Total Komisi</td>
                           <td style="font-weight: 700;">Rp. <?= number_format($hg_komisi['total_hg_tindakan'], 0, ".", "."); ?></td>
                        </tr>
                     </tbody>
                  </table>
               <?php } else { ?>
                  <div class="alert bg-danger alert-dismissible text-center" role="alert"> --Belum ada data untuk ditampilkan-- </div>
               <?php } ?>
            </div>
         </div>
      </div>

   </div>


   <footer class="footer">
      <span>Copyright &copy; 2021 Medical</span>
   </footer>
</section>