<?php
date_default_timezone_set('Asia/Makassar');
$tanggalwaktu = date("Y-m-d H:i:s");
$tanggal = date("Y-m-d");
$waktu = date("H:i:s");
?>
<section class="main-content">
   <div class="row">

      <div class="toastr1"></div>

      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-default">
               <div class="row">
                  <div class="col-md-8">
                     Data User
                  </div>
                  <div class="col-md-4">
                     <form method="post" action="<?= base_url('klinik/pasien_terdaftar'); ?>" enctype="multipart/form-data">
                        <div class="form-group row">
                           <div class="col-sm-10">
                              <input type="hidden" name="cari" value="search">
                              <select id="keyword" name="keyword" class="theSelect" required>
                                 <option>--Cari Pasien--</option>
                                 <?php foreach ($data_pasien as $pasien) : ?>
                                    <option value="<?= $pasien['no_pasien']; ?>"><?= $pasien['no_pasien']; ?> | <?= $pasien['nl_pasien']; ?></option>
                                 <?php endforeach; ?>
                              </select>
                           </div>
                           <div class="col-sm-2">
                              <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <form method="post" action="<?= base_url('klinik/pasien_terdaftar'); ?>" enctype="multipart/form-data">
                  <input type="hidden" name="tambah_data" value="tambah">

                  <input type="hidden" id="tgl_kunjungan" name="tgl_kunjungan" value="<?= $tanggal; ?>">
                  <input type="hidden" id="waktu_kunjungan" name="waktu_kunjungan" value="<?= $waktu; ?>">
                  <input type="hidden" id="no_pendaftaran" name="no_pendaftaran" value="<?= $nomor_pendaftaran; ?>">
                  <input type="hidden" id="no_antrian" name="no_antrian" value="<?= $nomor_antrian; ?>">

                  <div class="row">
                     <div class="col-md-6">
                        <?php if ($this->input->post('cari')) { ?>
                           <table style="width: 100%;">
                              <tr>
                                 <td width="140">No.Pasien</td>
                                 <td>
                                    : <?= $pasien_search['no_pasien']; ?>
                                    <input type="hidden" name="no_pasien" value="<?= $pasien_search['no_pasien']; ?>" required>
                                 </td>
                              </tr>
                              <tr>
                                 <td>Nama Pasien</td>
                                 <td>: <?= $pasien_search['nl_pasien']; ?></td>
                              </tr>
                              <tr>
                                 <td>Sex/Umur</td>
                                 <td>: <?= $pasien_search['jk_pasien']; ?>/<?= $pasien_search['umur_pasien']; ?> Thn</td>
                              </tr>
                              <tr>
                                 <td>Tanggal Lahir</td>
                                 <td>: <?= $pasien_search['tmp_lahir_pasien']; ?>, <?= date('d M Y', strtotime($pasien_search['tgl_lahir_pasien'])); ?></td>
                              </tr>
                              <tr>
                                 <td>Alamat</td>
                                 <td>: <?= $pasien_search['alamat']; ?></td>
                              </tr>
                           </table>
                        <?php } else { ?>
                           <table style="width: 100%;">
                              <tr>
                                 <td width="140">No.Pasien</td>
                                 <td>: </td>
                              </tr>
                              <tr>
                                 <td>Nama Pasien</td>
                                 <td>: </td>
                              </tr>
                              <tr>
                                 <td>Sex/Umur</td>
                                 <td>: </td>
                              </tr>
                              <tr>
                                 <td>Tanggal Lahir</td>
                                 <td>: </td>
                              </tr>
                              <tr>
                                 <td>Alamat</td>
                                 <td>: </td>
                              </tr>
                           </table>
                        <?php } ?>
                     </div>

                     <div class="col-md-6">
                        <div class="form-group row">
                           <label for="label" class="col-sm-4 col-form-label">Dokter</label>
                           <div class="col-sm-8">
                              <select id="id_dokter" name="id_dokter" class="form-control m-b" required>
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
                     <?php if ($this->input->post('cari')) { ?>
                        <button type="submit" name="add_dokter" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Daftar</button>
                     <?php } else { ?>
                        <button class="btn btn-sm btn-primary" disabled><i class="fa fa-save"></i> Daftar</button>
                     <?php } ?>
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